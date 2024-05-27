<!DOCTYPE html>
<html>
<head>
<title> introviz</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="{{ asset('public/front/css/font-awesome.min.css') }}">
<link href="{{ asset('public/front/css/bootstrap.min.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('public/front/css/style.css') }}">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
</body>
<section class="hardest">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
          <a class="navbar-brand" href="#"><img src="{{ asset('public/front/image/logo.png') }}" class="img-fluid"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Servies</a>
              </li>
            <form class="d-flex">
                <div class="sucess">
                 
                <a href="{{ route('login') }}"><button type="button" class="btn">Login </button></a>
                
                    <a href="{{ route('register') }}"> <button type="button" class=" winner">Register</button> </a>
                  
                </div>
            </form>
          </div>
        </div>
      </nav>
</section>