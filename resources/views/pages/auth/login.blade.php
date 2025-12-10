<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posyandu - Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* [TEMA POSYANDU - GRADASI UNGU-BIRU] */
        :root {
            --gradient-primary: linear-gradient(to right, #6a11cb 0%, #2575fc 100%); 
            --primary-color: #2575fc;       
            --primary-color-dark: #1a5bca;  
            --card-background: #ffffff;
            --border-color: #e5e7eb;
            --text-color: #111827;          
            --text-light: #ffffff;
            --text-muted: #6b7280;
            --danger-bg: #fef2f2;
            --danger-text: #991b1b;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 1rem;
            box-sizing: border-box;

            /* --- PENGATURAN BACKGROUND --- */
            /* 1. Layer pertama: Linear Gradient transparan (Ungu ke Biru) untuk memberi nuansa warna
               2. Layer kedua: URL Gambar (Ganti URL ini dengan foto kegiatan Posyandu asli Anda jika ada)
            */
            background-image: 
                linear-gradient(rgba(106, 17, 203, 0.85), rgba(37, 117, 252, 0.8)),
                url('https://apik.pontianak.go.id/assets/img/videoplay.jpg');
            
            background-size: cover;       /* Agar gambar memenuhi layar */
            background-position: center;  /* Agar fokus gambar di tengah */
            background-repeat: no-repeat;
            background-attachment: fixed; /* Agar background diam saat scroll */
        }

        .login-container {
            display: flex;
            width: 100%;
            max-width: 900px;
            background: var(--card-background);
            border-radius: 20px;
            /* Memberikan shadow lebih tebal agar card "pop up" dari background foto */
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); 
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2); /* Border halus */
            position: relative;
            z-index: 10;
        }

        .login-form-panel {
            flex: 1;
            padding: 4rem 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: left;
        }

        .login-overlay-panel {
            flex: 1;
            background: var(--gradient-primary);
            clip-path: polygon(10% 0, 100% 0, 100% 100%, 0% 100%); 
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem;
            text-align: center;
            color: var(--text-light);
            position: relative;
        }

        .login-header { margin-bottom: 2.5rem; }

        .login-logo-container {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            background-color: #f0f4ff;
            border-radius: 12px;
            margin-bottom: 1.5rem;
        }

        .login-logo {
            color: var(--primary-color); 
            width: 32px;
            height: 32px;
        }

        h2 {
            font-weight: 800;
            color: var(--text-color);
            margin: 0;
            font-size: 1.875rem;
            letter-spacing: -0.025em;
        }

        .login-overlay-panel h2 {
            color: var(--text-light);
            font-size: 2.25rem;
            margin-bottom: 1rem;
        }

        p.subtitle {
            font-size: 1rem;
            color: var(--text-muted);
            margin-top: 0.75rem;
            line-height: 1.5;
        }

        .login-overlay-panel p {
            font-size: 1.1rem;
            line-height: 1.6;
            max-width: 80%;
            opacity: 0.9;
        }

        .form-group { margin-bottom: 1.5rem; }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text-color);
            font-size: 0.925rem;
        }

        input.form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            box-sizing: border-box;
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
            background: var(--card-background);
            color: var(--text-color);
            transition: all 0.2s;
        }

        input.form-control:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 4px rgba(37, 117, 252, 0.15); 
        }

        button[type="submit"] {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            width: 100%;
            padding: 0.875rem;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            background: var(--gradient-primary); 
            color: #fff;
            border: none;
            box-shadow: 0 4px 12px rgba(37, 117, 252, 0.3); 
            transition: all 0.2s;
            margin-top: 1rem;
        }

        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(37, 117, 252, 0.4);
            filter: brightness(1.1);
        }

        .login-footer {
            margin-top: 2rem;
            text-align: center;
            color: var(--text-muted);
            font-size: 0.875em;
        }

        .overlay-illustration {
            background: rgba(255,255,255,0.15);
            width: 120px;
            height: 120px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
        }
        
        .overlay-illustration svg {
            width: 60px;
            height: 60px;
            color: white;
            stroke-width: 2.5; 
        }

        @media (max-width: 850px) {
            .login-container {
                flex-direction: column;
                max-width: 450px;
            }
            .login-form-panel {
                padding: 3rem 2rem;
                order: 2;
            }
            .login-overlay-panel {
                order: 1;
                clip-path: none;
                padding: 3rem 2rem;
                border-radius: 0 0 0 0;
            }
            .login-overlay-panel h2 {
                font-size: 1.75rem;
            }
        }

        /* Styling sederhana untuk pesan error inline */
        .text-error {
            color: #b91c1c;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        /* ========== TOAST / POPUP ========== */
        .toast-wrap {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            pointer-events: none;
        }

        .toast {
            pointer-events: auto;
            min-width: 260px;
            max-width: 360px;
            padding: 0.85rem 1rem;
            border-radius: 10px;
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.12);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            transform: translateY(-10px);
            opacity: 0;
            transition: transform 220ms ease, opacity 220ms ease;
        }

        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        .toast .msg {
            flex: 1;
            font-size: 0.95rem;
            line-height: 1.2;
        }

        .toast .close {
            background: transparent;
            border: 0;
            color: rgba(255,255,255,0.9);
            font-weight: 700;
            cursor: pointer;
            font-size: 1.05rem;
            padding: 0 0.25rem;
        }
        .overlay-illustration {
    width: 120px;           /* Ukuran Lingkaran */
    height: 120px;
    border-radius: 50%;     /* Membuat jadi bulat */
    margin-bottom: 2rem;
    
    /* PENTING AGAR GAMBAR SIMETRIS */
    padding: 0;             /* Hapus padding agar gambar full */
    overflow: hidden;       /* Memotong sudut gambar keluar */
    display: flex;          /* Menjaga posisi di tengah */
    align-items: center;
    justify-content: center;

    /* Style Visual (Glassmorphism) tetap dipertahankan */
    background: rgba(255, 255, 255, 0.9); /* Background putih transparan agar logo jelas */
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.5); /* Border dipertegas sedikit */
    box-shadow: 0 4px 15px rgba(0,0,0,0.1); /* Shadow halus */
}

.overlay-illustration img {
    width: 100%;
    height: 100%;
    object-fit: cover;      /* KUNCI: Agar gambar mengisi lingkaran proporsional */
    object-position: center;/* Memastikan fokus gambar tepat di tengah */
    display: block;
}

        .toast.error { background: #dc2626; } /* red-600 */
        .toast.success { background: #16a34a; } /* green-600 */
        @media (max-width: 420px) {
            .toast-wrap { left: 1rem; right: 1rem; top: 0.75rem; }
        }
    </style>
</head>
<body>

    <div class="login-container">

        <div class="login-form-panel">
            <div class="login-header">
                <div class="login-logo-container">
                    <svg class="login-logo" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </div>
                <h2>Login Admin</h2>
                <p class="subtitle">Selamat datang kembali! Silakan masukkan akun Admin Posyandu Anda.</p>
            </div>

            <form action="{{ route('login') }}" method="POST" autocomplete="off">
                @csrf
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Contoh: clea@gmail.com" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan kata sandi" required>
                    @error('password')
                        <div class="text-error">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit">
                    <span>Masuk Aplikasi</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </button>
            </form>

            <div class="login-footer">
                <span>&copy; 2025 Sistem Informasi Posyandu Digital</span>
            </div>
        </div>

        <div class="login-overlay-panel">
            <div class="overlay-illustration">
    <img src="{{ asset('assets-admin/img/team/logo.jpg') }}" alt="Logo Posyandu" >
</div>

            <h2>Posyandu</h2>
            <p>
                <strong>Aplikasi Layanan Kesehatan Masyarakat</strong>
                <br><br>
                Memudahkan pemantauan tumbuh kembang anak, imunisasi, dan kesehatan ibu hamil secara digital dan terintegrasi.
            </p>
        </div>

    </div>

    <div class="toast-wrap" id="toastWrap" aria-live="polite" aria-atomic="true"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toastWrap = document.getElementById('toastWrap');

            function createToast(type, message, timeout = 4000) {
                const t = document.createElement('div');
                t.className = 'toast ' + (type === 'error' ? 'error' : 'success');
                t.innerHTML = '<div class="msg"></div><button class="close" aria-label="close">&times;</button>';
                t.querySelector('.msg').textContent = message;

                const btnClose = t.querySelector('.close');
                btnClose.addEventListener('click', () => hideToast(t));

                toastWrap.appendChild(t);

                // allow CSS transition
                requestAnimationFrame(() => t.classList.add('show'));

                const hideAfter = setTimeout(() => hideToast(t), timeout);

                function hideToast(node) {
                    node.classList.remove('show');
                    node.addEventListener('transitionend', () => {
                        if (node.parentNode) node.parentNode.removeChild(node);
                    });
                    clearTimeout(hideAfter);
                }
            }

            // Jika server mengirim error validasi, tampilkan pesan pertama
            @if ($errors->any())
                // Ambil pesan pertama (safe JSON encode)
                createToast('error', {!! json_encode($errors->first()) !!});
            @endif

            // Jika ada session success (mis. logout berhasil atau login redirect), tampilkan
            @if (session('success'))
                createToast('success', {!! json_encode(session('success')) !!});
            @endif
        });
    </script>

</body>
</html>