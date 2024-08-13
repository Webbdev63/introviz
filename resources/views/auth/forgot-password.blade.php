
@include('front.header')
<style>
    .errorStyle{
    width: 74%;
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
                                <h5>Forgot Password</h5>
                            </div>
                            @if(session('status'))
                                <div class="alert alert-success errorStyle">
                                    {{ session('status') }}
                                </div>
                            @endif
                            
                            @if($errors->get('email'))
                                <div class="alert alert-danger errorStyle">
                                    {{ $errors->get('email')[0] }}
                                </div>
                            @endif
                            
                            <form  method="POST" action="{{ route('password.email') }}">
                                @csrf
                              
                                <div class="mb-3 mt-3 ">
                                    <div class="khaitan">
                                        <label for="email" class="form-label">Email:</label>
                                        <input type="email" class="form-control" id="email" type="email" name="email" value="{{old('email')}}" required>
                                        <!-- <x-input-error :messages="$errors->get('email')" class="errorFontLogin" /> -->
                                    </div>
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

