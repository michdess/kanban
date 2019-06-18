<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tasks</title>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            .brand-color{
                background: #380089;
            }
        </style>
    </head>
    <body class="h-screen brand-color flex items-center justify-center">
        <div class="max-w-xs w-full overflow-hidden bg-white shadow-lg -mt-32 z-10">
            <div class="py-6 px-6">
              <h2 class="text-left text-lg font-normal mb-2 text-gray-800">Register Now!</h2>
              <div class="text-sm">
                   <form method="POST" action="{{ route('register') }}">
                        @csrf
                                <input id="name" type="text" class="w-full block rounded border px-4 py-2 mb-4 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input id="email" type="email" class="w-full block rounded border px-4 py-2 mb-4 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input id="password" type="password" class="w-full block rounded border px-4 py-2 mb-4 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input id="password-confirm" type="password" class="w-full block rounded border px-4 py-2 mb-4" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                                <button type="submit" class="bg-indigo-500 block text-white font-normal w-full px-4 py-2 rounded">
                                    {{ __('Register') }}
                                </button>
                        </div>
                    </form>
              </div>
            </div>
        </div>
        <img class="fixed bottom-0 right-0" src="https://www.donut.com/wp-content/uploads/2017/08/banner-home-1.svg?v=1" class="donut-page-banner__image">
    </body>
</html>
