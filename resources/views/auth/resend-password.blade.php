

@include('front.header')

<section class="agrement">
        <div class="container">
                <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                                <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                                                <div class="diffretiation">
                                            <div class="trademarke">
                                                <h5>Resnd Email</h5>
                                            </div>
                                            <form  method="POST" action="{{ route('password.email') }}">
                                                @csrf
                                                <div class="mb-3 mt-3 ">
                                                        <div class="khaitan">

                                                            <x-input-label for="email" :value="__('Email')" />
                                                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                        </div>

                                                </div>
                                               
                                                <div class="flex items-center justify-end mt-4">
                                                <x-primary-button>
                                                    {{ __('resend Email Verification') }}
                                                </x-primary-button>
                                            </div>
                                                                                    
                                            </form>
                                            
                                           
                                        </div>
                                    </div>
                                 </div>
                         </div>
                </div>
         </div>       
</section>
