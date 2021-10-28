<x-guest-layout>
    <x-auth-card  id="app">
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form id="login-form" method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <div class="grid grid-cols-5 gap-4 content-center">
                    <div class="col-span-4">
                        <x-input id="password" class="block mt-1 w-full"
                                 type="password"
                                 name="password"
                                 autocomplete="current-password" />
                    </div>
                    <div class="col-span-1 flex justify-center">
                        <button id="submit-with-webauthn" class="flex flex-grow justify-center items-center
                        bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase
                        tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900
                        focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6.625 2.655A9 9 0 0119 11a1 1 0 11-2 0 7 7 0 00-9.625-6.492 1 1 0 11-.75-1.853zM4.662 4.959A1 1 0 014.75 6.37 6.97 6.97 0 003 11a1 1 0 11-2 0 8.97 8.97 0 012.25-5.953 1 1 0 011.412-.088z" clip-rule="evenodd" />
                                <path fill-rule="evenodd" d="M5 11a5 5 0 1110 0 1 1 0 11-2 0 3 3 0 10-6 0c0 1.677-.345 3.276-.968 4.729a1 1 0 11-1.838-.789A9.964 9.964 0 005 11zm8.921 2.012a1 1 0 01.831 1.145 19.86 19.86 0 01-.545 2.436 1 1 0 11-1.92-.558c.207-.713.371-1.445.49-2.192a1 1 0 011.144-.83z" clip-rule="evenodd" />
                                <path fill-rule="evenodd" d="M10 10a1 1 0 011 1c0 2.236-.46 4.368-1.29 6.304a1 1 0 01-1.838-.789A13.952 13.952 0 009 11a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>

        @if (Route::has('register'))
            <div class="block mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                    {{ __("Don't have an account? Register now!") }}
                </a>
            </div>
        @endif
    </x-auth-card>
    <script src="{{ asset('vendor/larapass/js/larapass.js') }}"></script>

    <!-- Registering credentials -->
    <script>
        const login = (event) => {

            let emailInput = document.getElementById('email');
            emailInput.checkValidity();

            if(validateEmail(emailInput.value) === false) {
                return;
            }

            event.preventDefault();
            new Larapass({
                login: '{{ route('webauthn.login') }}',
                loginOptions: '{{ route('webauthn.login.options') }}'
            }).login({
                email: emailInput.value
            })
            .then(response => {
                alert('Authentication successful!');
                window.location.replace('{{ redirect()->intended(route('welcome.index'))->getTargetUrl() }}');
            })
            .catch(error => {
                alert('WebAuthn Login unsuccessful. Please check your email and try again!');
                console.error('Login unsuccessful.', error);
                console.error(error);
            })
        }

        function validateEmail(email) {
            const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }

        document.getElementById('submit-with-webauthn').addEventListener('click', login)
    </script>
</x-guest-layout>
