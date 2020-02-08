<nav class="navbar navbar-expand-md navbar-dark bg-blackpearl">
    <i id="sidetoggle" class="nav-item fas fa-bars" style="color: #d2dae2;"></i>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-3 mr-auto">
        <a class="navbar-brand" href="#">
          <img src="<?=PATHIMG?>Logo_Navbar.svg" alt="Sleman">
        </a>
            <a class="nav-item nav-link mt-auto mb-auto" href="<?=base_url('Home')?>">Dashboard</a>
        </div>
        <div class="navbar-nav mr-5">
            <a class="nav-item nav-link" href="<?=base_url('Login')?>">Login</a>
        </div>
    </div>
</nav>