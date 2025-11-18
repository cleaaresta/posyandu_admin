<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posyandu - Login Petugas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* [TEMA POSYANDU - GRADASI UNGU-BIRU] */
        :root {
            /* Warna Gradasi Utama (Mirip Gambar Referensi) */
            --gradient-primary: linear-gradient(to right, #6a11cb 0%, #2575fc 100%); 
            
            /* Warna Solid Pendukung (Ambil dari salah satu warna gradasi) */
            --primary-color: #2575fc;       
            --primary-color-dark: #1a5bca;  
            
            --background-dark: #f3f4f6;     
            --card-background: #ffffff;
            --border-color: #e5e7eb;
            --text-color: #111827;          
            --text-light: #ffffff;
            --text-muted: #6b7280;
            --danger-bg: #fef2f2;
            --danger-text: #991b1b;
            --danger-border: #fecaca;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background-dark);
            /* Background pattern halus */
            background-image: radial-gradient(#e5e7eb 1px, transparent 1px);
            background-size: 20px 20px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 1rem;
            box-sizing: border-box;
        }

        /* Wrapper utama */
        .login-container {
            display: flex;
            width: 100%;
            max-width: 900px;
            background: var(--card-background);
            border-radius: 20px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        /* Panel Kiri (Form) */
        .login-form-panel {
            flex: 1;
            padding: 4rem 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: left;
        }

        /* Panel Kanan (Overlay Gradasi) */
        .login-overlay-panel {
            flex: 1;
            /* Terapkan Gradasi di sini */
            background: var(--gradient-primary);
            
            /* Lengkungan unik di kiri panel */
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

        /* Header di Form */
        .login-header {
            margin-bottom: 2.5rem;
        }

        .login-logo-container {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            background-color: #f0f4ff; /* Biru sangat muda agar pas dengan ungu */
            border-radius: 12px;
            margin-bottom: 1.5rem;
        }

        /* Perbaikan: Warna ikon di panel kiri kini mengikuti primary-color (biru) */
        .login-logo {
            color: var(--primary-color); 
            width: 32px;
            height: 32px;
        }
        
        /* Jika menggunakan gambar PNG/JPG untuk logo */
        .login-logo-img {
            width: 40px; /* Sesuaikan ukuran gambar logo */
            height: auto;
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

        /* Form styling */
        .form-group {
            margin-bottom: 1.5rem;
        }

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
            /* Shadow focus mengikuti warna utama */
            box-shadow: 0 0 0 4px rgba(37, 117, 252, 0.15); 
        }

        /* Tombol Submit dengan Gradasi */
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
            
            /* Background Gradasi pada Tombol */
            background: var(--gradient-primary); 
            
            color: #fff;
            border: none;
            /* Shadow ungu/biru */
            box-shadow: 0 4px 12px rgba(37, 117, 252, 0.3); 
            transition: all 0.2s;
            margin-top: 1rem;
        }

        button[type="submit"]:hover {
            /* Efek hover sedikit mengangkat dan menambah shadow */
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(37, 117, 252, 0.4);
            /* Opsional: filter brightness untuk efek hover pada gradasi */
            filter: brightness(1.1);
        }

        button[type="submit"]:active {
            transform: translateY(0);
        }

        .login-footer {
            margin-top: 2rem;
            text-align: center;
            color: var(--text-muted);
            font-size: 0.875em;
        }

        /* Hiasan di Overlay (Ikon Kesehatan Putih) */
        .overlay-illustration {
            background: rgba(255,255,255,0.15); /* Transparansi sedikit lebih terang */
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
            /* Menyesuaikan stroke-width agar lebih tebal dan terlihat */
            stroke-width: 2.5; 
        }

        /* Responsif */
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
    </style>
</head>
<body>

    <div class="login-container">

        <!-- PANEL KIRI (FORM) -->
        <div class="login-form-panel">
            <div class="login-header">
                <div class="login-logo-container">
                    <!-- Ikon Petugas (User) - Sesuai konteks login petugas -->
                    <svg class="login-logo" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </div>
                <h2>Login Admin</h2>
                <p class="subtitle">Selamat datang kembali! Silakan masukkan akun Admin Posyandu Anda.</p>
            </div>

            <form action="#" method="POST" autocomplete="off">
                
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Contoh: clea@gmail.com">
                </div>
                
                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan kata sandi">
                </div>

                <button type="submit">
                    <span>Masuk Aplikasi</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </button>
            </form>

            <div class="login-footer">
                <span>&copy; 2025 Sistem Informasi Posyandu Digital.</span>
            </div>
        </div>

        <!-- PANEL KANAN (OVERLAY BIRU) -->
        <div class="login-overlay-panel">
            <div class="overlay-illustration">
                <!-- [DIUBAH] Ikon Posyandu (Palang Kesehatan di dalam Lingkaran) -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-3-3v6M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Z" />
                </svg>
            </div>

            <h2>Posyandu</h2>
            <p>
                <strong>Aplikasi Layanan Kesehatan Masyarakat</strong>
                <br><br>
                Memudahkan pemantauan tumbuh kembang anak, imunisasi, dan kesehatan ibu hamil secara digital dan terintegrasi.
            </p>
        </div>

    </div>

</body>
</html>