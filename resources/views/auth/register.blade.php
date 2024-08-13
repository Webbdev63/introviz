@include('front.header')
<style>
    .errorStyle{
    width: 83%;
    }
</style>
<section class="agrement">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                <div class="row">
                
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                        <div class="diffretiation">
                            <div class="trademarke">
                                <h5>Register</h5>
                            </div>
                            @if(session('messageRegisterVerification'))
                                <div class="alert alert-success errorStyle">
                                    {{ session('messageRegisterVerification') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-5 col-lg-5 col-md-6 col-12">
                                        <div class="optimization">
                                            <label for="first_name">First Name</label>
                                            <input class="form-control" type="text" id="first_name" type="text"
                                                value="{{old('first_name')}}" autofocus autocomplete="first_name"
                                                class="form-control" placeholder="First Name" name="first_name">
                                            <x-input-error :messages="$errors->get('first_name')"  class=" errorFont" />
                                        </div>
                                    </div>
                                    <div class="col-xl-5 col-lg-5 col-md-6 col-12">
                                        <div class="optimization">
                                            <label for="last_name">Last Name</label>
                                            <input class="form-control" type="text" id="last_name" type="text"
                                                value="{{old('last_name')}}" autofocus autocomplete="last_name"
                                                class="form-control" placeholder="Last Name" name="last_name">
                                            <x-input-error :messages="$errors->get('last_name')"  class=" errorFont"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-5 col-lg-5 col-md-6 col-12">
                                        <div class="optimization">
                                            <label for="email">E-mail Address</label>
                                            <input type="email" class="form-control" value="{{old('email')}}"
                                                autocomplete="email" placeholder="username@gmail.com" name="email"
                                                id="email">
                                                <x-input-error :messages="$errors->get('email')" class=" errorFont" />
                                        </div>
                                    </div>
                                    <div class="col-xl-5 col-lg-5 col-md-6 col-12">
                                        <div class="optimization">
                                            <label for="phone_number">Phone Number</label>
                                            <input type="text" class="form-control" value="{{old('phone_number')}}"
                                             autocomplete="phone_number" placeholder="" name="phone_number">
                                                <x-input-error :messages="$errors->get('phone_number')" class=" errorFont" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-5 col-lg-5 col-md-6 col-12">
                                        <div class="optimization">
                                            <label for="Password">Password</label>
                                            <input type="password" class="form-control" id="password" value="{{old('password')}}"
                                                 placeholder="Password" name="password">
                                            <x-input-error :messages="$errors->get('password')" class="errorFont" />
                                        </div>
                                    </div>
                                    <div class="col-xl-5 col-lg-5 col-md-6 col-12">
                                        <div class="optimization">
                                            <label for="comment">Confirm Password</label>
                                            <input type="password" class="form-control" value="{{old('password_confirmation')}}" name="password_confirmation"
                                              placeholder="Confirm Password">
                                            <x-input-error :messages="$errors->get('password_confirmation')" class="errorFont" />
                                        </div>
                                    </div>
                                </div>
                                <div class="beanticion">
                                    <button type="submit" class="btn btn"> {{ __('Register') }} </button>
                                </div>
                            </form>

                            <div class="col-xl-10 col-lg-10 col-md-10 col-10">
                                <div class="parthship">
                                    <p>Already have an account?
                                        <span class="account"><a href="{{ route('login') }}"> Login now</a></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('front.footer')
