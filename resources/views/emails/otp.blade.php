<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kode OTP Login Anda</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }
        .header {
            background-color: #0056B3;
            color: white;
            padding: 24px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }
        .content {
            padding: 32px 24px;
            text-align: center;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
            color: #475569;
            margin-bottom: 24px;
        }
        .otp-box {
            background-color: #f1f5f9;
            border: 2px dashed #cbd5e1;
            border-radius: 8px;
            padding: 16px;
            margin: 24px auto;
            max-width: 250px;
        }
        .otp-code {
            font-size: 32px;
            font-weight: 800;
            color: #0056B3;
            letter-spacing: 4px;
            margin: 0;
        }
        .footer {
            background-color: #f8fafc;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
        }
        .warning {
            font-size: 14px;
            color: #ef4444;
            margin-top: 24px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Verifikasi Login POLVENT</h1>
        </div>
        <div class="content">
            <p>Halo,</p>
            <p>Anda menerima email ini karena ada percobaan login ke akun POLVENT Anda. Silakan gunakan kode OTP di bawah ini untuk melanjutkan proses login.</p>
            
            <div class="otp-box">
                <p class="otp-code">{{ $otpCode }}</p>
            </div>
            
            <p>Kode ini hanya berlaku selama <strong>10 menit</strong>.</p>
            
            <p class="warning">JANGAN BERIKAN KODE INI KEPADA SIAPAPUN. Tim POLVENT tidak pernah meminta kode OTP Anda.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} POLVENT - Politeknik Negeri Bengkalis. Semua Hak Dilindungi.
        </div>
    </div>
</body>
</html>
