@include('layouts.header');

    <body class="bg-primary d-flex justify-content-center align-items-center min-vh-100 p-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-md-5">
                    <div class="card">
                        <div class="card-body p-4">

                            <div class="text-center w-75 mx-auto auth-logo mb-4">
                                <a href="index.html" class="logo-dark">
                                    <span><img src="assets/images/logo-dark.png" alt="" height="22"></span>
                                </a>

                                <a href="index.html" class="logo-light">
                                    <span><img src="assets/images/logo-light.png" alt="" height="22"></span>
                                </a>
                            </div>

                            <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
                       <div class="form-group mb-3">
                                <label class="form-label" for="emailaddress">Email address</label>
                                <input class="form-control" type="email" id="email"type="email" name="email" :value="old('email')" required autofocus autocomplete="username">
                                  <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
      <!--  <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div> -->

        <!-- Password -->

        <div class="form-group mb-3">
                                <a href="" class="text-muted float-end"><small></small></a>
                                <label class="form-label" for="password">Password</label>
                                <input class="form-control" type="password" required="" id="password"   name="password"
                                  required autocomplete="current-password" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
        <!--
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>  -->

        <!-- Remember Me -->
        <!--
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>    -->


        <div class="form-group mb-3">
                                    <div class="">
                                        <input class="form-check-input" type="checkbox" id="remember_me" name="remember" checked>
                                        <label class="form-check-label ms-2" for="checkbox-signin">Remember me</label>
                                    </div>
                                </div>

                                <div class="form-group mb-0 text-center">
                                    <x-primary-button class="btn btn-primary w-100" type="submit"> {{ __('Log in') }} </x-primary-button>
                                </div>

    </form
                    </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="text-white-50"> <a href="pages-register.html" class="text-white-50 ms-1">Forgot your password?</a></p>
                            <p class="text-white-50">Don't have an account? <a href="pages-register.html" class="text-white font-weight-medium ms-1">Sign Up</a></p>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>

        <!-- App js -->
        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/js/app.js"></script>

    </body>

    </html>
