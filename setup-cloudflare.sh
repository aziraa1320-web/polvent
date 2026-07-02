#!/bin/bash
# ============================================================
# Setup Cloudflare Tunnel untuk POLVENT
# ============================================================
# Jalankan SETELAH setup-ubuntu-mysql.sh selesai.
# Script ini membuat tunnel Cloudflare agar Polvent bisa
# diakses via domain publik (https://namadomain.xxx)

set -e

PROJECT_DIR="/var/www/polvent"
TUNNEL_NAME="polvent-tunnel"

# Warna
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
CYAN='\033[0;36m'
NC='\033[0m'
BOLD='\033[1m'

print_header() {
    echo ""
    echo -e "${CYAN}╔══════════════════════════════════════════════════════════╗${NC}"
    echo -e "${CYAN}║${NC} ${BOLD}$1${NC}"
    echo -e "${CYAN}╚══════════════════════════════════════════════════════════╝${NC}"
    echo ""
}
print_info()  { echo -e "${BLUE}[i]${NC} $1"; }
print_step()  { echo -e "${GREEN}[✓]${NC} $1"; }
print_warn()  { echo -e "${YELLOW}[!]${NC} $1"; }
print_error() { echo -e "${RED}[✗]${NC} $1"; }

# ===================== CEK ROOT =====================
if [ "$EUID" -ne 0 ]; then
    print_error "Script ini harus dijalankan sebagai root (sudo)!"
    exit 1
fi

# ===================== CEK PROJECT DIR =====================
if [ ! -d "${PROJECT_DIR}" ] || [ ! -f "${PROJECT_DIR}/.env" ]; then
    print_error "Direktori project atau file .env tidak ditemukan di ${PROJECT_DIR}"
    print_info "Pastikan setup-ubuntu-mysql.sh sudah dijalankan terlebih dahulu!"
    exit 1
fi

print_header "Setup Cloudflare Tunnel - POLVENT"

# ===================== INPUT DOMAIN =====================
echo -e "${YELLOW}Masukkan domain Cloudflare Anda.${NC}"
echo -e "Contoh: ${BOLD}polvent.my.id${NC}  atau  ${BOLD}polvent.pages.dev${NC}"
echo -e "${YELLOW}(Domain harus sudah terdaftar/aktif di akun Cloudflare Anda)${NC}"
echo ""
read -p "$(echo -e ${CYAN}Domain: ${NC})" DOMAIN

if [ -z "$DOMAIN" ]; then
    print_error "Domain tidak boleh kosong!"
    exit 1
fi

# Hapus prefix http/https jika pengguna salah input
DOMAIN=$(echo "$DOMAIN" | sed 's|https\?://||' | sed 's|/.*||')

print_step "Domain target: ${BOLD}${DOMAIN}${NC}"

# ===================== STEP 1: INSTALL CLOUDFLARED =====================
print_header "STEP 1/5 — Install Cloudflared"
if ! command -v cloudflared &> /dev/null; then
    print_info "Mendownload cloudflared (versi terbaru)..."
    wget -q "https://github.com/cloudflare/cloudflared/releases/latest/download/cloudflared-linux-amd64.deb" \
        -O /tmp/cloudflared.deb
    dpkg -i /tmp/cloudflared.deb
    rm /tmp/cloudflared.deb
    print_step "Cloudflared berhasil diinstall: $(cloudflared --version)"
else
    print_step "Cloudflared sudah terinstall: $(cloudflared --version)"
fi

# ===================== STEP 2: LOGIN CLOUDFLARE =====================
print_header "STEP 2/5 — Login ke Cloudflare"
echo -e "${YELLOW}PERHATIAN — Baca petunjuk berikut:${NC}"
echo ""
echo -e "  1. Link login akan muncul di bawah ini"
echo -e "  2. Copy link tersebut, buka di browser di komputer Windows kamu"
echo -e "  3. Login dengan akun Cloudflare, lalu pilih domain ${BOLD}${DOMAIN}${NC}"
echo -e "  4. Setelah klik 'Authorize', terminal akan otomatis lanjut"
echo ""
cloudflared tunnel login

# ===================== STEP 3: BUAT & KONFIGURASI TUNNEL =====================
print_header "STEP 3/5 — Membuat dan Konfigurasi Tunnel"

# Hapus tunnel lama jika ada
print_info "Menghapus tunnel lama jika ada..."
cloudflared tunnel delete "${TUNNEL_NAME}" 2>/dev/null || true

# Buat tunnel baru
print_info "Membuat tunnel: ${TUNNEL_NAME}..."
cloudflared tunnel create "${TUNNEL_NAME}"

# Ambil Tunnel ID
TUNNEL_ID=$(cloudflared tunnel list --output json 2>/dev/null | \
    python3 -c "import sys,json; tunnels=json.load(sys.stdin); \
    [print(t['id']) for t in tunnels if t['name']=='${TUNNEL_NAME}']" 2>/dev/null)

# Fallback: pakai grep jika python3 gagal
if [ -z "$TUNNEL_ID" ]; then
    TUNNEL_ID=$(cloudflared tunnel list | grep "${TUNNEL_NAME}" | awk '{print $1}')
fi

if [ -z "$TUNNEL_ID" ]; then
    print_error "Gagal mendapatkan Tunnel ID! Cek output 'cloudflared tunnel list'."
    exit 1
fi

print_step "Tunnel ID: ${TUNNEL_ID}"

# Buat file konfigurasi tunnel
print_info "Membuat file konfigurasi tunnel..."
mkdir -p /root/.cloudflared
cat > /root/.cloudflared/config.yml <<TUNNEL_CONF
tunnel: ${TUNNEL_ID}
credentials-file: /root/.cloudflared/${TUNNEL_ID}.json

ingress:
  - hostname: ${DOMAIN}
    service: http://localhost:80
  - hostname: www.${DOMAIN}
    service: http://localhost:80
  - service: http_status:404
TUNNEL_CONF

print_step "File konfigurasi tunnel dibuat di /root/.cloudflared/config.yml"

# ===================== STEP 4: ROUTING DNS & JALANKAN SERVICE =====================
print_header "STEP 4/5 — Routing DNS & Jalankan Service"

print_info "Mendaftarkan ${DOMAIN} ke DNS Cloudflare..."
cloudflared tunnel route dns -f "${TUNNEL_NAME}" "${DOMAIN}" || \
    print_warn "Route ${DOMAIN} mungkin sudah ada, dilanjutkan..."

print_info "Mendaftarkan www.${DOMAIN} ke DNS Cloudflare..."
cloudflared tunnel route dns -f "${TUNNEL_NAME}" "www.${DOMAIN}" || \
    print_warn "Route www.${DOMAIN} mungkin sudah ada, dilanjutkan..."

# Install sebagai systemd service
print_info "Menginstall cloudflared sebagai service (agar jalan 24/7)..."
systemctl stop cloudflared 2>/dev/null || true
cloudflared service uninstall 2>/dev/null || true

cloudflared service install
systemctl daemon-reload
systemctl enable cloudflared
systemctl start cloudflared
print_step "Service cloudflared berhasil dijalankan!"

# Verifikasi
sleep 2
if systemctl is-active --quiet cloudflared; then
    print_step "cloudflared service: RUNNING ✓"
else
    print_warn "cloudflared service tidak aktif. Cek: sudo systemctl status cloudflared"
fi

# ===================== STEP 5: UPDATE KONFIGURASI LARAVEL =====================
print_header "STEP 5/5 — Update Konfigurasi Laravel (.env)"

cd "${PROJECT_DIR}"

# Update APP_URL ke domain Cloudflare (HTTPS)
sed -i "s|^APP_URL=.*|APP_URL=https://${DOMAIN}|" .env
print_step "APP_URL diupdate ke: https://${DOMAIN}"

# Update APP_ENV dan APP_DEBUG (pastikan production)
sed -i "s|^APP_ENV=.*|APP_ENV=production|" .env
sed -i "s|^APP_DEBUG=.*|APP_DEBUG=false|" .env

# Update MAIL_FROM_NAME
sed -i "s|^MAIL_FROM_NAME=.*|MAIL_FROM_NAME=\"Polvent\"|" .env

# Tambahkan SESSION_DOMAIN agar session bekerja di domain Cloudflare
DOMAIN_ROOT=$(echo "$DOMAIN" | rev | cut -d. -f1,2 | rev)
sed -i "s|^SESSION_DOMAIN=.*|SESSION_DOMAIN=${DOMAIN_ROOT}|" .env
print_step "SESSION_DOMAIN diset ke: ${DOMAIN_ROOT}"

# Tambahkan SANCTUM_STATEFUL_DOMAINS jika belum ada
if ! grep -q "^SANCTUM_STATEFUL_DOMAINS=" .env; then
    echo "" >> .env
    echo "# Sanctum / Session" >> .env
    echo "SANCTUM_STATEFUL_DOMAINS=${DOMAIN},www.${DOMAIN}" >> .env
    print_step "SANCTUM_STATEFUL_DOMAINS ditambahkan"
fi

# Tambahkan TRUSTED_PROXIES untuk Cloudflare (agar HTTPS terdeteksi benar)
if ! grep -q "^TRUSTED_PROXIES=" .env; then
    echo "" >> .env
    echo "# Trusted Proxies (Cloudflare)" >> .env
    echo "TRUSTED_PROXIES=*" >> .env
    print_step "TRUSTED_PROXIES ditambahkan untuk Cloudflare"
fi

# Fix permissions .env
chown www-data:www-data .env
chmod 640 .env

# Rebuild Laravel cache dengan konfigurasi baru
print_info "Membersihkan dan rebuild cache Laravel..."
sudo -u www-data php artisan optimize:clear
sudo -u www-data php artisan config:cache
sudo -u www-data php artisan route:cache
sudo -u www-data php artisan view:cache
print_step "Cache Laravel berhasil diupdate"

# ===================== PATCH NGINX: TAMBAHKAN HTTPS HEADER =====================
print_info "Mengupdate Nginx untuk support Cloudflare HTTPS proxy..."
NGINX_CONF="/etc/nginx/sites-available/polvent"

if [ -f "$NGINX_CONF" ]; then
    # Tambahkan header trust untuk Cloudflare proxy jika belum ada
    if ! grep -q "X-Forwarded-Proto" "$NGINX_CONF"; then
        sed -i '/location ~ \.php\$/,/}/s|fastcgi_index index.php;|fastcgi_index index.php;\n        fastcgi_param HTTPS on;\n        fastcgi_param HTTP_X_FORWARDED_PROTO https;|' "$NGINX_CONF"
    fi

    nginx -t && systemctl reload nginx
    print_step "Nginx dikonfigurasi untuk Cloudflare proxy"
fi

# ===================== SELESAI =====================
print_header "🎉 CLOUDFLARE TUNNEL POLVENT AKTIF! 🎉"
echo ""
echo -e "${GREEN}╔══════════════════════════════════════════════════════════╗${NC}"
echo -e "${GREEN}║  POLVENT sekarang bisa diakses dari internet!           ║${NC}"
echo -e "${GREEN}╚══════════════════════════════════════════════════════════╝${NC}"
echo ""
echo -e "${CYAN}🌐 URL Akses:${NC}"
echo -e "   ${BOLD}https://${DOMAIN}${NC}"
echo -e "   ${BOLD}https://www.${DOMAIN}${NC}"
echo ""
echo -e "${YELLOW}ℹ  Status & Monitoring:${NC}"
echo -e "   sudo systemctl status cloudflared"
echo -e "   sudo journalctl -u cloudflared -f"
echo -e "   cloudflared tunnel info ${TUNNEL_NAME}"
echo ""
echo -e "${YELLOW}ℹ  Jika ada masalah HTTPS/session:${NC}"
echo -e "   - Pastikan di Cloudflare Dashboard → SSL/TLS → pilih 'Full'"
echo -e "   - Pastikan APP_URL di .env menggunakan https://"
echo ""
echo -e "${YELLOW}ℹ  File konfigurasi tunnel:${NC}"
echo -e "   /root/.cloudflared/config.yml"
echo ""
