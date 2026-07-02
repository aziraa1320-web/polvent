#!/bin/bash
# ============================================================
# POLVENT - Ubuntu Server Setup Script (Local MySQL)
# ============================================================
# Laravel + Nginx + PHP 8.3-FPM + Node.js 20
# Database: MySQL (Local Server)
# Target: Ubuntu Server on VirtualBox
# Username: zira | IP: 172.16.61.117

set -e

# ===================== KONFIGURASI =====================
PROJECT_NAME="polvent"
PROJECT_DIR="/var/www/polvent"
UPLOAD_DIR="$(pwd)"
PHP_VERSION="8.3"
NODE_VERSION="20"
SERVER_IP="172.16.61.117"

# MySQL Settings
DB_NAME="polvent"
DB_USER="polvent_user"
# Generate random password for DB
DB_PASS=$(openssl rand -base64 12)

# Mail config (dari .env lokal)
MAIL_USERNAME="masnidarakmi@gmail.com"
MAIL_PASSWORD="eeseiagpvwbriwzg"
MAIL_FROM_ADDRESS="masnidarakmi@gmail.com"

# Fonnte WhatsApp OTP
FONNTE_TOKEN="JAArKmdQuCuFjpJHw3oD"

# reCAPTCHA (test keys, ganti dengan real keys jika perlu)
RECAPTCHA_SITE_KEY="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"
RECAPTCHA_SECRET_KEY="6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe"

# ===================== WARNA =====================
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
CYAN='\033[0;36m'
MAGENTA='\033[0;35m'
NC='\033[0m'
BOLD='\033[1m'

print_header() {
    echo ""
    echo -e "${CYAN}╔══════════════════════════════════════════════════════════╗${NC}"
    echo -e "${CYAN}║${NC} ${BOLD}$1${NC}"
    echo -e "${CYAN}╚══════════════════════════════════════════════════════════╝${NC}"
    echo ""
}
print_step()  { echo -e "${GREEN}[✓]${NC} $1"; }
print_info()  { echo -e "${BLUE}[i]${NC} $1"; }
print_warn()  { echo -e "${YELLOW}[!]${NC} $1"; }
print_error() { echo -e "${RED}[✗]${NC} $1"; }

# ===================== CEK ROOT =====================
if [ "$EUID" -ne 0 ]; then
    print_error "Script ini harus dijalankan sebagai root (sudo)!"
    exit 1
fi

print_header "POLVENT - Setup Ubuntu Server (MySQL)"
print_info "Server IP   : ${SERVER_IP}"
print_info "Project Dir : ${PROJECT_DIR}"
print_info "PHP Version : ${PHP_VERSION}"
print_info "Node Version: ${NODE_VERSION}"

# ===================== STEP 1: UPDATE SYSTEM =====================
print_header "STEP 1/9 — Update System"
apt update -y && apt upgrade -y
apt install -y software-properties-common curl wget gnupg2 unzip git ca-certificates apt-transport-https

# ===================== STEP 2: INSTALL MYSQL =====================
print_header "STEP 2/9 — Install MySQL Server"
apt install -y mysql-server
systemctl start mysql
systemctl enable mysql

print_info "Membuat Database dan User MySQL..."
mysql -e "CREATE DATABASE IF NOT EXISTS \`${DB_NAME}\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -e "CREATE USER IF NOT EXISTS '${DB_USER}'@'localhost' IDENTIFIED BY '${DB_PASS}';"
mysql -e "ALTER USER '${DB_USER}'@'localhost' IDENTIFIED BY '${DB_PASS}';"
mysql -e "GRANT ALL PRIVILEGES ON \`${DB_NAME}\`.* TO '${DB_USER}'@'localhost';"
mysql -e "FLUSH PRIVILEGES;"
print_step "Database : ${DB_NAME}"
print_step "Username : ${DB_USER}"
print_step "Password : ${DB_PASS}"

# ===================== STEP 3: INSTALL PHP =====================
print_header "STEP 3/9 — Install PHP ${PHP_VERSION} + Extensions"
add-apt-repository -y ppa:ondrej/php
apt update -y
apt install -y \
    php${PHP_VERSION} \
    php${PHP_VERSION}-fpm \
    php${PHP_VERSION}-cli \
    php${PHP_VERSION}-common \
    php${PHP_VERSION}-mysql \
    php${PHP_VERSION}-mbstring \
    php${PHP_VERSION}-xml \
    php${PHP_VERSION}-bcmath \
    php${PHP_VERSION}-curl \
    php${PHP_VERSION}-gd \
    php${PHP_VERSION}-intl \
    php${PHP_VERSION}-zip \
    php${PHP_VERSION}-readline \
    php${PHP_VERSION}-tokenizer \
    php${PHP_VERSION}-dom \
    php${PHP_VERSION}-fileinfo \
    php${PHP_VERSION}-sqlite3

# Konfigurasi PHP-FPM
sed -i "s/^user = .*/user = www-data/" /etc/php/${PHP_VERSION}/fpm/pool.d/www.conf
sed -i "s/^group = .*/group = www-data/" /etc/php/${PHP_VERSION}/fpm/pool.d/www.conf
sed -i "s/upload_max_filesize = .*/upload_max_filesize = 64M/" /etc/php/${PHP_VERSION}/fpm/php.ini
sed -i "s/post_max_size = .*/post_max_size = 64M/" /etc/php/${PHP_VERSION}/fpm/php.ini
sed -i "s/memory_limit = .*/memory_limit = 256M/" /etc/php/${PHP_VERSION}/fpm/php.ini
systemctl restart php${PHP_VERSION}-fpm
print_step "PHP ${PHP_VERSION}-FPM dikonfigurasi"

# ===================== STEP 4: INSTALL NGINX =====================
print_header "STEP 4/9 — Install Nginx"
apt install -y nginx
systemctl start nginx
systemctl enable nginx
print_step "Nginx terinstall"

# ===================== STEP 5: INSTALL NODE.JS =====================
print_header "STEP 5/9 — Install Node.js ${NODE_VERSION}"
curl -fsSL https://deb.nodesource.com/setup_${NODE_VERSION}.x | bash -
apt install -y nodejs
print_step "Node.js $(node -v) terinstall"

# ===================== STEP 6: INSTALL COMPOSER =====================
print_header "STEP 6/9 — Install Composer"
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
chmod +x /usr/local/bin/composer
print_step "Composer $(composer --version --no-ansi 2>/dev/null | head -1) terinstall"

# ===================== STEP 7: DEPLOY PROJECT =====================
print_header "STEP 7/9 — Deploy Project Files"
mkdir -p "${PROJECT_DIR}"

if [ -f "${UPLOAD_DIR}/artisan" ]; then
    print_info "Menyalin file project dari ${UPLOAD_DIR}..."
    rsync -av \
        --exclude='node_modules' \
        --exclude='vendor' \
        --exclude='.git' \
        --exclude='database/database.sqlite' \
        --exclude='storage/logs/*.log' \
        --exclude='.env' \
        "${UPLOAD_DIR}/" "${PROJECT_DIR}/"
else
    print_error "File artisan tidak ditemukan di ${UPLOAD_DIR}!"
    print_info "Pastikan Anda menjalankan script ini dari direktori project Polvent."
    exit 1
fi

cd "${PROJECT_DIR}"

# Buat .env production
print_info "Membuat file .env untuk production..."
cat > "${PROJECT_DIR}/.env" <<ENV_CONF
APP_NAME=Polvent
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=http://${SERVER_IP}

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=${DB_NAME}
DB_USERNAME=${DB_USER}
DB_PASSWORD="${DB_PASS}"

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=${MAIL_USERNAME}
MAIL_PASSWORD=${MAIL_PASSWORD}
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=${MAIL_FROM_ADDRESS}
MAIL_FROM_NAME="Polvent"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

RECAPTCHA_SITE_KEY=${RECAPTCHA_SITE_KEY}
RECAPTCHA_SECRET_KEY=${RECAPTCHA_SECRET_KEY}

# Fonnte WhatsApp OTP
FONNTE_TOKEN=${FONNTE_TOKEN}

VITE_APP_NAME="Polvent"
ENV_CONF

print_step "File .env production dibuat"

# Fix ownership dan permissions
chown -R www-data:www-data "${PROJECT_DIR}"
chmod -R 775 "${PROJECT_DIR}/storage" "${PROJECT_DIR}/bootstrap/cache"
chmod -R 755 "${PROJECT_DIR}/public"
print_step "Permissions dikonfigurasi"

# Install PHP dependencies (composer)
print_info "Menjalankan composer install..."
cd "${PROJECT_DIR}"
sudo -u www-data composer install --no-dev --optimize-autoloader 2>&1 || {
    print_warn "composer install gagal sebagai www-data, mencoba sebagai root..."
    composer install --no-dev --optimize-autoloader
    chown -R www-data:www-data "${PROJECT_DIR}/vendor"
}
print_step "Composer dependencies terinstall"

# Install Node dependencies dan build assets
print_info "Menjalankan npm install & build..."
cd "${PROJECT_DIR}"
npm ci 2>/dev/null || npm install 2>/dev/null || {
    print_warn "npm install gagal, coba lagi..."
    npm install --legacy-peer-deps
}
npm run build
chown -R www-data:www-data "${PROJECT_DIR}/public/build" 2>/dev/null || true
print_step "Frontend assets ter-build"

# Laravel artisan commands
print_info "Menjalankan Laravel artisan commands..."
sudo -u www-data php artisan key:generate --force
sudo -u www-data php artisan optimize:clear || true
sudo -u www-data php artisan storage:link 2>/dev/null || true
sudo -u www-data php artisan migrate --force
sudo -u www-data php artisan db:seed --force 2>/dev/null || {
    print_warn "Seeder gagal (mungkin sudah ada data), melanjutkan..."
}
sudo -u www-data php artisan config:cache
sudo -u www-data php artisan route:cache
sudo -u www-data php artisan view:cache
print_step "Laravel artisan commands selesai"

# Re-fix ownership setelah semua operasi
chown -R www-data:www-data "${PROJECT_DIR}"
chmod -R 775 "${PROJECT_DIR}/storage" "${PROJECT_DIR}/bootstrap/cache"

# ===================== STEP 8: KONFIGURASI NGINX =====================
print_header "STEP 8/9 — Konfigurasi Nginx"
cat > /etc/nginx/sites-available/polvent <<NGINX_CONF
server {
    listen 80;
    server_name ${SERVER_IP};
    root ${PROJECT_DIR}/public;
    index index.php index.html;
    client_max_body_size 64M;

    # Security headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location ~ \.php\$ {
        fastcgi_pass unix:/var/run/php/php${PHP_VERSION}-fpm.sock;
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_read_timeout 300;
        fastcgi_index index.php;
    }

    # Cache static assets (Vite build output)
    location /build/ {
        expires 1y;
        add_header Cache-Control "public, immutable";
        try_files \$uri \$uri/ =404;
    }

    # Cache uploaded images/files
    location /storage/ {
        expires 30d;
        add_header Cache-Control "public";
        try_files \$uri \$uri/ =404;
    }

    location ~* \.(jpg|jpeg|png|gif|ico|css|js|svg|woff2?)$ {
        expires 30d;
        add_header Cache-Control "public";
    }

    # Deny access to hidden files
    location ~ /\. {
        deny all;
    }
}
NGINX_CONF

# Aktifkan site dan nonaktifkan default
ln -sf /etc/nginx/sites-available/polvent /etc/nginx/sites-enabled/
rm -f /etc/nginx/sites-enabled/default

# Test nginx config
nginx -t
systemctl restart nginx
print_step "Nginx dikonfigurasi untuk Polvent"

# ===================== STEP 9: SETUP QUEUE WORKER & FIREWALL =====================
print_header "STEP 9/9 — Setup Queue Worker & Firewall"

# Buat systemd service untuk Laravel queue worker
cat > /etc/systemd/system/polvent-queue.service <<QUEUE_CONF
[Unit]
Description=Polvent Laravel Queue Worker
After=network.target mysql.service

[Service]
User=www-data
Group=www-data
Restart=always
RestartSec=5
WorkingDirectory=${PROJECT_DIR}
ExecStart=/usr/bin/php ${PROJECT_DIR}/artisan queue:work --sleep=3 --tries=3 --max-time=3600

[Install]
WantedBy=multi-user.target
QUEUE_CONF

systemctl daemon-reload
systemctl enable polvent-queue
systemctl start polvent-queue
print_step "Queue worker (polvent-queue) aktif"

# Firewall
print_info "Mengkonfigurasi Firewall (UFW)..."
apt install -y ufw
ufw --force reset
ufw default deny incoming
ufw default allow outgoing
ufw allow 22/tcp    # SSH
ufw allow 80/tcp    # HTTP
ufw allow 443/tcp   # HTTPS
ufw --force enable
print_step "Firewall dikonfigurasi"

# ===================== SELESAI =====================
print_header "🎉 SETUP SELESAI! 🎉"
echo ""
echo -e "${GREEN}╔══════════════════════════════════════════════════════════╗${NC}"
echo -e "${GREEN}║  POLVENT berhasil di-deploy ke Ubuntu Server!           ║${NC}"
echo -e "${GREEN}╚══════════════════════════════════════════════════════════╝${NC}"
echo ""
echo -e "${CYAN}Akses Website:${NC}"
echo -e "  http://${SERVER_IP}"
echo ""
echo -e "${MAGENTA}Info MySQL:${NC}"
echo -e "  Database : ${DB_NAME}"
echo -e "  Username : ${DB_USER}"
echo -e "  Password : ${DB_PASS}"
echo ""
echo -e "${YELLOW}Info Penting:${NC}"
echo -e "  Project Dir  : ${PROJECT_DIR}"
echo -e "  Nginx Config : /etc/nginx/sites-available/polvent"
echo -e "  Queue Worker : systemctl status polvent-queue"
echo -e "  PHP-FPM      : systemctl status php${PHP_VERSION}-fpm"
echo -e "  Laravel Log  : tail -f ${PROJECT_DIR}/storage/logs/laravel.log"
echo ""
echo -e "${YELLOW}Perintah berguna:${NC}"
echo -e "  sudo systemctl status polvent-queue"
echo -e "  sudo systemctl restart nginx"
echo -e "  sudo systemctl restart php${PHP_VERSION}-fpm"
echo -e "  sudo -u www-data php ${PROJECT_DIR}/artisan migrate"
echo ""
echo -e "${RED}⚠  SIMPAN PASSWORD DATABASE DI ATAS!${NC}"
echo -e "${RED}⚠  Password tidak dapat diambil kembali setelah terminal ditutup!${NC}"
echo ""
