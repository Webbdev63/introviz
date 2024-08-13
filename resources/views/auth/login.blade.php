

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
                                                <h5>Login</h5>
                                            </div>
                                         
                                            @if(session('messageRegister'))
                                                <div class="alert alert-danger errorStyle">
                                                    {{ session('messageRegister') }}
                                                </div>
                                            @endif
                                            @if(session('messageVerify'))
                                                <div class="alert alert-success errorStyle">
                                                    {{ session('messageVerify') }}
                                                </div>
                                            @endif
                                            @if(session('status'))
                                                <div class="alert alert-success errorStyle">
                                                    {{ session('status') }}
                                                </div>
                                            @endif
                                         
                                            <form  method="POST" action="{{ route('login') }}">
                                                @csrf
                                                <div class="mb-3 mt-3 ">
                                                        <div class="khaitan">
                                                            <label for="email" class="form-label">Email:</label>
                                                            <input type="email" class="form-control"  id="email"type="email" name="email" value="{{old('email')}}" required >
                                                           
                                                        </div>
                                                </div>
                                                <div class="mb-3 mt-3 ">
                                                        <div class="khaitan">
                                                            <label for="password" class="form-label">Password:</label>
                                                            <input type="password" class="form-control" id="email" name="password" value="{{old('password')}}" required >
                                                        </div>
                                                        <x-input-error :messages="$errors->get('password')" class="errorFontLogin" />
                                                            <div class="plan">
                                                               <p><a href="{{route('password.request')}}">Forgot Password </a></p> 
                                                            </div>
                                                </div>
                                                <x-input-error :messages="$errors->get('email')" class="errorFontLogin" />
                                                 <div class="beanticion">
                                                    <button type="submit" class="btn btn"> {{ __('Login') }} </button>
                                                </div>
                                            </form>
                                            
                                            <div class="col-xl-10 col-lg-10 col-md-10 col-10">
                                                <div class="parthship">
                                                     <p>Don’t have an account yet?
                                                       <span class="account"><a href="{{route('register')}}">Register now</a></span></p>
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
