<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Accounts - Masuk ke POLVENT</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
        }
        body {
            background-color: #f0f4f9;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 1rem;
        }
        .container {
            background: white;
            border-radius: 1.5rem;
            width: 100%;
            max-width: 450px;
            padding: 2.5rem;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
            border: 1px solid #e0e0e0;
        }
        .logo-wrapper {
            display: flex;
            justify-content: center;
            margin-bottom: 1.5rem;
        }
        .google-logo {
            width: 75px;
            height: auto;
        }
        .title {
            font-size: 1.5rem;
            font-weight: 400;
            color: #1f1f1f;
            text-align: center;
            margin-bottom: 0.5rem;
        }
        .subtitle {
            font-size: 1rem;
            color: #444746;
            text-align: center;
            margin-bottom: 2rem;
        }
        .account-list {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .account-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            border: 1px solid #e0e0e0;
            border-radius: 0.75rem;
            cursor: pointer;
            transition: background-color 0.2s, border-color 0.2s;
            background: none;
            text-align: left;
            width: 100%;
        }
        .account-item:hover {
            background-color: #f7f9fc;
            border-color: #c2e7ff;
        }
        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: #0f285c;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            font-size: 1.1rem;
            margin-right: 1rem;
        }
        .account-info {
            flex: 1;
        }
        .account-name {
            font-size: 0.95rem;
            font-weight: 500;
            color: #1f1f1f;
        }
        .account-email {
            font-size: 0.85rem;
            color: #5f6368;
        }
        .other-account-btn {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            border: 1px dashed #cccccc;
            border-radius: 0.75rem;
            cursor: pointer;
            transition: all 0.2s;
            background: none;
            text-align: left;
            width: 100%;
            color: #0b57d0;
            font-weight: 500;
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }
        .other-account-btn:hover {
            background-color: #f0f4f9;
            border-color: #0b57d0;
        }
        .custom-form {
            display: none;
            flex-direction: column;
            gap: 1rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #eeeeee;
        }
        .input-group {
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }
        .input-label {
            font-size: 0.85rem;
            font-weight: 500;
            color: #444746;
        }
        .text-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #747775;
            border-radius: 0.5rem;
            font-size: 0.95rem;
            outline: none;
        }
        .text-input:focus {
            border-color: #0b57d0;
            box-shadow: 0 0 0 2px rgba(11, 87, 208, 0.2);
        }
        .btn-submit {
            background-color: #0b57d0;
            color: white;
            border: none;
            border-radius: 9999px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            font-size: 0.95rem;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-top: 0.5rem;
        }
        .btn-submit:hover {
            background-color: #0a4ebd;
        }
        .footer {
            margin-top: 2rem;
            display: flex;
            justify-content: space-between;
            font-size: 0.75rem;
            color: #5f6368;
        }
        .footer a {
            color: #5f6368;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo-wrapper">
            <!-- Official google color logo SVG -->
            <svg class="google-logo" viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg">
                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z" fill="#FBBC05"/>
                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z" fill="#EA4335"/>
            </svg>
        </div>
        <h1 class="title">Pilih akun</h1>
        <p class="subtitle">untuk melanjutkan ke POLVENT (Demo Mode)</p>

        <form id="login-form" method="POST" action="{{ route('login.google.mock.post') }}">
            @csrf
            <input type="hidden" name="email" id="selected-email">
            <input type="hidden" name="name" id="selected-name">

            <div class="account-list">
                @foreach($mahasiswas as $mhs)
                    <button type="button" class="account-item" onclick="selectAccount('{{ $mhs->email }}', '{{ $mhs->name }}')">
                        <div class="avatar">
                            {{ strtoupper(substr($mhs->name, 0, 1)) }}
                        </div>
                        <div class="account-info">
                            <div class="account-name">{{ $mhs->name }}</div>
                            <div class="account-email">{{ $mhs->email }}</div>
                        </div>
                    </button>
                @endforeach
            </div>

            <button type="button" class="other-account-btn" onclick="toggleCustomForm()">
                <span style="font-size: 1.25rem; margin-right: 1rem; display: flex; align-items: center; justify-content: center; width: 36px; height: 36px; border: 1px dashed #0b57d0; border-radius: 50%;">+</span>
                Gunakan akun lain
            </button>

            <div class="custom-form" id="custom-form">
                <div class="input-group">
                    <label class="input-label" for="custom-name">Nama Lengkap</label>
                    <input type="text" id="custom-name" placeholder="Nama Lengkap" class="text-input">
                </div>
                <div class="input-group">
                    <label class="input-label" for="custom-email">Alamat Email Google</label>
                    <input type="email" id="custom-email" placeholder="contoh@gmail.com" class="text-input">
                </div>
                <button type="button" class="btn-submit" onclick="submitCustomAccount()">Lanjutkan</button>
            </div>
        </form>

        <div class="footer">
            <span>Indonesia</span>
            <div style="display: flex; gap: 0.5rem;">
                <a href="#">Bantuan</a>
                <a href="#">Privasi</a>
                <a href="#">Ketentuan</a>
            </div>
        </div>
    </div>

    <script>
        function selectAccount(email, name) {
            document.getElementById('selected-email').value = email;
            document.getElementById('selected-name').value = name;
            document.getElementById('login-form').submit();
        }

        function toggleCustomForm() {
            const form = document.getElementById('custom-form');
            if (form.style.display === 'flex') {
                form.style.display = 'none';
            } else {
                form.style.display = 'flex';
                document.getElementById('custom-name').focus();
            }
        }

        function submitCustomAccount() {
            const email = document.getElementById('custom-email').value;
            const name = document.getElementById('custom-name').value;
            
            if (!email || !email.includes('@')) {
                alert('Silakan masukkan email yang valid.');
                return;
            }

            selectAccount(email, name);
        }
    </script>
</body>
</html>
