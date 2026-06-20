<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; background-color: #f4f7f6; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 30px auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .header { background: linear-gradient(135deg, #0056B3, #003d80); color: #ffffff; padding: 30px 20px; text-align: center; }
        .header h1 { margin: 0; font-size: 24px; font-weight: 700; }
        .content { padding: 30px 20px; }
        .content p { margin: 0 0 15px; font-size: 16px; }
        .credentials { background: #f8f9fa; border-left: 4px solid #0056B3; padding: 15px; margin: 20px 0; border-radius: 4px; }
        .credentials p { margin: 5px 0; font-size: 15px; }
        .btn { display: inline-block; padding: 12px 25px; background-color: #0056B3; color: #ffffff; text-decoration: none; border-radius: 5px; font-weight: bold; margin-top: 15px; text-align: center; }
        .footer { background: #f1f1f1; padding: 15px 20px; text-align: center; font-size: 13px; color: #777; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Selamat Datang di Polvent! 🎉</h1>
        </div>
        <div class="content">
            <p>Halo <strong>{{ $name }}</strong>,</p>
            <p>Akun Kepanitiaan (Admin Organisasi/UKM/HMJ) Anda telah berhasil dibuat oleh Admin Kampus.</p>
            <p>Berikut adalah informasi login Anda yang dapat digunakan untuk masuk ke Sistem Manajemen Event Polbeng (Polvent):</p>
            
            <div class="credentials">
                <p><strong>Email Login:</strong> {{ $email }}</p>
                <p><strong>Kata Sandi:</strong> {{ $password }}</p>
            </div>
            
            <p style="color: #d9534f; font-size: 14px; margin-bottom: 25px;"><em>Penting: Harap segera ubah kata sandi Anda di menu Profil setelah berhasil login untuk keamanan akun Anda.</em></p>
            
            <div style="text-align: center;">
                <a href="{{ route('login') }}" class="btn">Login Sekarang</a>
            </div>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Polvent - Politeknik Negeri Bengkalis. Hak Cipta Dilindungi.</p>
            <p>Email ini dikirim secara otomatis. Mohon tidak membalas email ini.</p>
        </div>
    </div>
</body>
</html>
