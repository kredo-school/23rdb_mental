<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<nav class="navbar navbar-dark navbar-expand-md sticky-top">
  <!-- Left Side Of Navbar -->
    <a class="navbar-brand ms-5 justify-content-center" href="{{ route('home') }}">
      <img src="{{ asset('images/main/logo_sm.png') }}" alt="logo">
    </a>
  <!-- Toggler button for narrow view -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
  <!-- Right Side Of Navbar -->
    <div class="collapse navbar-collapse d-flex justify-content-end">
      <a href="{{ route('register') }}">
        <button class="btn-register">Register</button>
      </a>
    </div>
</nav>