<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

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
    </style>
</head>
<body>

    <div class="login-form-container">
        <h4 class="form-header">Reset Password</h4>
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form role="form" method="POST" action="{{ url('/reset-password/' . $token) }}">
            @csrf


            <!-- Password Field -->
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" id="floatingPassword"
                    placeholder="Password" required>
                <label for="floatingPassword">Password</label>
                @error('password')
                    <p class="text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password_confirmation" id="floatingPassword"
                    placeholder="Password" required>
                <label for="floatingPassword">Confirm Password</label>
                @error('password')
                    <p class="text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-secondary">Reset Password</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
