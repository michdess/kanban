<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tasks</title>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
        <style>
            .brand-color{
                background: #380089;
            }
        </style>
    </head>
    <body class="h-screen brand-color flex items-center justify-center">
        <div class="max-w-xs w-full overflow-hidden bg-white shadow-lg -mt-32 z-10">
            <div class="py-6 px-6">
              <h2 class="text-left text-lg font-normal mb-2 text-gray-800">Welcome back!</h2>
              <div class="text-sm">
                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                @csrf
                <input id="email" type="email" class="w-full block rounded border px-4 py-2 mb-4 {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email Address" required autofocus>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif

                <input id="password" type="password" class="w-full block rounded border px-4 py-2 mb-4 {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif        
                <div class="flex justify-between mb-4">
                  <label class="text-sm text-gray-600">
                    <input class="mr-1" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    Remember me
                  </label>
                  <a href="{{ route('password.request') }}" class="ml-1 text-sm no-underline font-normal text-gray-800 hover:underline">Forgot password?</a>
                </div>
                <button type="submit" class="bg-indigo-500 block text-white font-normal w-full px-4 py-2 rounded">Sign in</button>
                </form>
              </div>
            </div>
            <div class="bg-gray-300 text-gray-600 text-sm text-center p-4">
              No account? <a href="/register" class="no-underline text-gray-800 hover:underline font-normal">Register now!</a>
            </div>
        </div>
        <img class="fixed bottom-0 right-0" src="https://www.donut.com/wp-content/uploads/2017/08/banner-home-1.svg?v=1" class="donut-page-banner__image">
    </body>
</html>
