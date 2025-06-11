<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-form-container {
            max-width: 400px;
            margin: 80px auto;
            padding: 40px;
            border-radius: 15px;
            background-color: #ffffff;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .form-floating label {
            color: #6c757d;
        }

        .form-control:focus {
            border-color: #6c757d;
            box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.25);
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .text-danger {
            font-size: 0.875rem;
        }

        .form-header {
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
            color: #343a40;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        }
    </style>
</head>

<body>

    <div class="login-form-container">
        <h4 class="form-header">Sign In to Your Account</h4>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div id="loginForm">
            <form role="form" method="POST" action="{{ url('session') }}">
                @csrf

                <!-- Email / Username Field -->
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" name="email" id="floatingInput"
                        placeholder="Email address / Username" required>
                    <label for="floatingInput">Email address / Username</label>
                    @error('email')
                        <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field with Show/Hide Toggle -->
                <div class="mb-3 position-relative">
                    <div class="form-floating">
                        <input type="password" class="form-control" name="password" id="passwordInput"
                            placeholder="Password" required>
                        <label for="passwordInput">Password</label>
                        <i class="fa-solid fa-eye password-toggle" id="togglePassword" onclick="togglePassword()"></i>
                    </div>
                    @error('password')
                        <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <a href="javascript:void(0);" onclick="toggleForms()">Forgot Password?</a>

                <!-- Submit Button -->
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-secondary">Sign In</button>
                </div>
            </form>
        </div>

        <!-- Forgot Password Form -->
        <div id="forgotForm" style="display: none;">
            <form role="form" method="POST" action="{{ url('forgot-password') }}">
                @csrf

                <!-- Email Field -->
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" name="email" id="forgotEmail"
                        placeholder="Enter your email" required>
                    <label for="forgotEmail">Enter your email</label>
                    @error('email')
                        <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <a href="javascript:void(0);" onclick="toggleForms()">Back to Login</a>

                <!-- Submit Button -->
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary">Send Reset Link</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        function toggleForms() {
            const loginForm = document.getElementById('loginForm');
            const forgotForm = document.getElementById('forgotForm');
            loginForm.style.display = loginForm.style.display === 'none' ? 'block' : 'none';
            forgotForm.style.display = forgotForm.style.display === 'none' ? 'block' : 'none';
        }

        function togglePassword() {
            const passwordInput = document.getElementById('passwordInput');
            const eyeIcon = document.getElementById('togglePassword');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>
