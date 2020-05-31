<nav class="navbar navbar-expand-md navbar-dark bg-blackpearl">
    <?php if ($sidebar){?>
        <i class='glyphicon glyphicon-play whiteText' data-toggle='tooltip' data-placement='top' title='MENU' aria-hidden='true'><i id="sidetoggle" class="nav-item fas fa-bars" style="color: #d2dae2;"></i></i>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <!-- span class="navbar-toggler-icon"></span -->
        <i class="nav-item fas fa-angle-double-down" style="color: #d2dae2;"></i>
    </button>
    <?php } ?>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-3 mr-auto">
        <a class="navbar-brand d-none d-md-block" href="<?= base_url('dashboard') ?>">
          <img src=<?=base_url(PATHIMG.'Logo_Navbar.svg')?> alt="Sleman">
        </a>
        </div>
        <div class="navbar-nav mr-md-5">
            <?=
            empty($_SESSION['idlogin'])
            ? "<a class='nav-item nav-link' href='".base_url('Login')."'><i class='glyphicon glyphicon-play whiteText' data-toggle='tooltip' data-placement='top' title='MASUK' aria-hidden='true'><i class='fas fa-sign-in-alt'></i></i></a>"
            : "<a class='nav-item nav-link' href='".base_url('go/logout')."'><i class='glyphicon glyphicon-play whiteText' data-toggle='tooltip' data-placement='top' title='KELUAR' aria-hidden='true'><i class='fas fa-sign-out-alt white'></i></i></a>";
            ?>
        </div>
    </div>
</nav>