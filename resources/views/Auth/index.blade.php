<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/auth/auth.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form method="POST" action="{{ route('auth.register') }}">
                @csrf
                <h1>Create Account</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your email for registration</span>
                <input name="name" type="text" placeholder="Name" />
                @error('name')
                    <p class="text-red-500 text-xs mt-1"> {{ $message }} </p>
                @enderror
                <input name="email" type="email" placeholder="Email" />
                @error('email')
                    <p class="text-red-500 text-xs mt-1"> {{ $message }} </p>
                @enderror
                <input name="password" type="password" placeholder="Password" />
                @error('password')
                    <p class="text-red-500 text-xs mt-1"> {{ $message }} </p>
                @enderror
                <button type="submit">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form method="POST" action="{{ route('auth.login') }}">
                @csrf
                <h1>Sign in</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your account</span>
                <input name="email" type="email" placeholder="Email" />
                @error('email')
                    <p class="text-red-500 text-xs mt-1"> {{ $message }} </p>
                @enderror
                <input name="password" type="password" placeholder="Password" />
                @error('password')
                    <p class="text-red-500 text-xs mt-1"> {{ $message }} </p>
                @enderror
                <a href="#">Forgot your password?</a>
                <button type="submit">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                    <a href="{{ route('index') }}"><button class="ghost" id="signIn">Home</button></a>

                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                    <a href="{{ route('index') }}"><button class="ghost" id="signIn">Home</button></a>

                </div>
            </div>
        </div>
    </div>




    <script src="/auth/main.js"></script>
</body>

</html>
