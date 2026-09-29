<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Kathirazhaki Boutique</title>
    
    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --brand-primary: #2e102f;
            --brand-secondary: #d4af37;
            --brand-text: #242424;
            --brand-background: #faf9f7;
        }

        body, html {
            height: 100%;
            margin: 0;
            font-family: 'DM Sans', sans-serif;
            background-color: var(--brand-background);
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background-image: radial-gradient(circle at top right, rgba(212, 175, 55, 0.05), transparent 40%),
                              radial-gradient(circle at bottom left, rgba(46, 16, 47, 0.05), transparent 40%);
        }

        .login-card {
            display: flex;
            width: 100%;
            max-width: 1000px;
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(46, 16, 47, 0.15);
        }

        .login-image-section {
            flex: 1;
            background: linear-gradient(to right, rgba(46, 16, 47, 0.8), rgba(46, 16, 47, 0.4)), url('https://images.unsplash.com/photo-1490481651871-ab68de25d43d?auto=format&fit=crop&w=1000&q=80') center/cover;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 4rem;
            color: #fff;
            position: relative;
        }

        .login-image-section h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            position: relative;
            z-index: 2;
        }

        .login-image-section p {
            font-size: 1.1rem;
            opacity: 0.9;
            position: relative;
            z-index: 2;
            line-height: 1.6;
        }

        .login-form-section {
            flex: 1;
            padding: 4rem 3.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #fff;
        }

        .brand-logo {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--brand-primary);
            text-align: center;
            margin-bottom: 0.25rem;
            letter-spacing: 2px;
        }

        .brand-subtitle {
            text-align: center;
            color: #777;
            font-size: 0.85rem;
            margin-bottom: 3rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 600;
        }

        .form-floating {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border: none;
            border-bottom: 2px solid #eaeaea;
            border-radius: 0;
            padding: 0.75rem 0;
            font-size: 1rem;
            background: transparent;
            box-shadow: none !important;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--brand-secondary);
        }

        .form-floating label {
            padding: 0.75rem 0;
            color: #999;
        }

        .btn-login {
            background: var(--brand-primary);
            color: var(--brand-secondary);
            border: none;
            border-radius: 30px;
            padding: 1rem 2rem;
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            width: 100%;
            margin-top: 2rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(46, 16, 47, 0.15);
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .btn-login:hover {
            background: var(--brand-secondary);
            color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.3);
        }

        .login-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
            font-size: 0.9rem;
        }

        .login-options a {
            color: var(--brand-primary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .login-options a:hover {
            color: var(--brand-secondary);
        }

        .form-check-input:checked {
            background-color: var(--brand-secondary);
            border-color: var(--brand-secondary);
        }

        @media (max-width: 991px) {
            .login-card {
                flex-direction: column;
            }
            .login-image-section {
                padding: 3rem 2rem;
                min-height: 250px;
            }
            .login-form-section {
                padding: 3rem 2rem;
            }
        }
    </style>
</head>
<body>

    <div class="login-wrapper">
        <div class="login-card">
            
            <div class="login-image-section">
                <h2>Admin Portal</h2>
                <p>Manage your boutique's inventory, track orders, and connect with your customers seamlessly.</p>
            </div>

            <div class="login-form-section">
                <div class="brand-logo">KATHIRAZHAKI</div>
                <div class="brand-subtitle">Administration</div>

                @if(session('error'))
                    <div class="alert alert-danger" style="border-radius: 10px; font-size: 0.9rem;">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('admin.login.submit') }}" method="POST">
                    @csrf
                    
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required value="admin@kathirazhaki.com">
                        <label for="email">Email Address</label>
                    </div>

                    <div class="form-floating">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required value="password">
                        <label for="password">Password</label>
                    </div>

                    <div class="login-options">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="rememberMe" checked>
                            <label class="form-check-label text-muted" for="rememberMe">
                                Remember me
                            </label>
                        </div>
                        <a href="#">Forgot password?</a>
                    </div>

                    <button type="submit" class="btn-login">
                        Sign In <i class="bi bi-arrow-right"></i>
                    </button>
                </form>
            </div>

        </div>
    </div>

</body>
</html>
