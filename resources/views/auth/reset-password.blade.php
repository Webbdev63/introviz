
@include('front.header')
@php
$emial = $request->email;

@endphp   

<section class="agrement">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                <div class="row">
                
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                        <div class="diffretiation">
                            <div class="trademarke">
                                <h5>Reset Password</h5>
                            </div>
                            <form method="POST" action="{{ route('password.store') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                <div class="mb-3 mt-3 ">
                                    <div class="khaitan">
                                        <label for="email" class="form-label">Email:</label>
                                        <input type="email" class="form-control" id="email" type="email" name="email" value="{{$emial}}" readonly required>
                                        <x-input-error :messages="$errors->get('email')" class="errorFontLogin" />

                                    </div>
                                </div>
                                <div class="mb-3 mt-3 ">
                                    <div class="khaitan">
                                        <label for="password" class="form-label">Password:</label>
                                        <input type="password" class="form-control" id="email" name="password" value="{{old('password')}}" required>
                                    </div>
                                    <x-input-error :messages="$errors->get('password')" class="errorFontLogin" />

                                </div>
                                <div class="mb-3 mt-3 ">
                                    <div class="khaitan">
                                        <label for="password" class="form-label">Password Confirm</label>
                                        <input type="password" class="form-control" id="email" name="password_confirmation" value="{{old('password_confirmation')}}" required>
                                    </div>
                                    <x-input-error :messages="$errors->get('password')" class="errorFontLogin" />

                                </div>

                                <div class="beanticion">
                                    <button type="submit" class="btn btn"> {{ __('Reset Password') }} </button>
                                </div>
                            </form>

                            <div class="col-xl-10 col-lg-10 col-md-10 col-10">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





@include('front.footer')