@extends('larapass::layout')

@section('title', __('Authenticator registration'))

@section('body')
    <form id="register-form">
        <h2 class="card-title h5 text-center">{{ __('Please register your WebAuthn credentials') }}</h2>
        <hr>
        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg">
                {{ __('Register') }}
            </button>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('vendor/larapass/js/larapass.js') }}"></script>

    <!-- Registering credentials -->
    <script>
        const register = (event) => {
            event.preventDefault()
            new Larapass({
                register: '{{ route('webauthn.register') }}',
                registerOptions: '{{ route('webauthn.register.options') }}'
            }).register()
                .then(response => {
                    alert('Registration successful!');
                    window.location.href = "{{ route('user.show', ['username' => Auth::user()->username]) }}";
                })
                .catch(response => {
                    alert('Something went wrong, try again!');
                    console.error('Registration unsuccessful.', response);
                });
        }

        document.getElementById('register-form').addEventListener('submit', register)
    </script>
@endpush
