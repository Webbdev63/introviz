<!DOCTYPE html>
<html>
   <head>
      <title> Trucker Leads</title>
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="/front/css/font-awesome.min.css">
      <link href="/front/css/bootstrap.min.css" rel="stylesheet">
      <link rel="icon" type="image/png" href="front/image/favicon.png">
      <link rel="stylesheet" type="text/css" href="/front/css/style.css">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
   </head>
   <body></body>
   <section class="hardest">
      <nav class="navbar navbar-expand-lg navbar-light">
         <div class="container">
            <a class="navbar-brand" href="/"><img src="{{asset('front/image/logo.png')}}"
               class="img-fluid"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
               data-bs-target="#" aria-controls="navbarSupportedContent" aria-expanded="false"
               aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100">
                  <li class="nav-item">
                     <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="https://introviz.com/contact-us/" target="_blank">Contact Us</a>
                  </li>
                  <!-- <li class="nav-item">
                     <a class="nav-link" href="mailto:sales@introviz.com">Support</a>
                  </li> -->
                  <li class="nav-item">
                     <a class="nav-link" href="{{ route('packagePrice') }}">Price</a>
                  </li>
                  <!-- <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle showfilter " href="#" id="navbarDropdown"
                         role="button" data-bs-toggle="dropdown">
                         Filter
                     </a>
                     <ul class="dropdown-menu closefilter" aria-labelledby="navbarDropdown">
                         <li><a class="nav-sidbar" aria-current="page" href="/">Census</a></li>
                     </ul>
                     </li> -->
               </ul>
               <div class="beantion d-flex">
                  @auth
                  <form method="POST" action="{{ route('logout') }}">
                     @csrf
                     <!--   <a href="{{ route('logout') }}"> <button type="button" class=" winner">
                        {{ __('Log Out') }}</button> </a>  -->
                     <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                        this.closest('form').submit();">
                        <button type="button" class="winner logotcs">
                        {{ __('Log Out') }}</button>
                     </x-responsive-nav-link>
                  </form>
                  @else
                  <form class="d-flex">
                     <div class="sucess d-flex">
                        <a href="{{ route('login') }}"><button type="button" class="btn">Login </button></a>
                        <a href="{{ route('register') }}"> <button type="button" class=" winner">Register</button>
                        </a>
                     </div>
                  </form>
                  @endauth
               </div>
            </div>
         </div>
      </nav>
   </section>
   <script>
      $(document).ready(function() {
          $(".showfilter").click(function() {
              $(".closefilter")
          .toggle(); // You can replace toggle() with slideToggle() for a smooth effect
          });
      });
      
      $(document).ready(function() {
          $(".navbar-toggler").click(function() {
              const btntgl = $('#navbarSupportedContent');
              if (btntgl.hasClass('show')) {
                  console.log('exists');
                  btntgl.removeClass('show');
              } else {
                  console.log('not exists');
                  btntgl.addClass('show');
              }
          });
      });
      
      
   </script>