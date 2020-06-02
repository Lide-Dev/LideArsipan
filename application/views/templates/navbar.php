<nav class="navbar navbar-expand-md navbar-dark bg-blackpearl">
    <?php if ($sidebar) { ?>
        <div class="d-none d-md-block">
            <i class='glyphicon glyphicon-play whiteText' data-toggle='tooltip' data-placement='top' title='MENU' aria-hidden='true'><i id="sidetoggle" class="nav-item fas fa-bars" style="color: #d2dae2;"></i></i>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">

            <!-- span class="navbar-toggler-icon"></span -->
            <i class="nav-item fas fa-angle-double-down" style="color: #d2dae2;"></i>
        </button>

    <?php } ?>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-3 mr-auto">
            <a class="navbar-brand d-none d-md-block" href="<?= base_url('dashboard') ?>">
                <img src=<?= base_url(PATHIMG . 'Logo_Navbar.svg') ?> alt="Sleman">
            </a>
        </div>
        <div class="navbar-nav mr-md-5">
            <div class=" d-md-none">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="<?= base_url('dashboard') ?>"><i class="fas fa-home"></i><span style="margin-left: 10px;">Dashboard</span></a>
                    </li>
                    <li class="list-group-item">
                        <a href="<?= base_url('registrasi_surat') ?>"><i class="fas fa-save"></i><span style="margin-left: 12.7px;">Registrasi Surat</span></a>
                    </li>
                    <li class="list-group-item">
                        <a href="<?= base_url('Arsip') ?>"><i class="fas fa-search"></i><span style="margin-left: 11.5px;">Cari Arsip</span></a>
                    </li>
                    <?php if (!empty($accadmin) && $accadmin === 'admin') { ?>
                        <li class="list-group-item">
                            <a href="<?= base_url('admin/dashboard') ?>"><i class="fas fa-users-cog"></i><span style="margin-left: 9px;">Dashboard Admin</span></a>
                        </li>
                    <?php  } ?>
                </ul>
            </div>
            <?=
                empty($_SESSION['idlogin'])
                    ? "<a class='nav-item nav-link' href='" . base_url('Login') . "'><i class='glyphicon glyphicon-play whiteText' data-toggle='tooltip' data-placement='top' title='MASUK' aria-hidden='true'><i class='fas fa-sign-in-alt'></i></i><span class='ml-2 d-md-none'>Login</span></a>"
                    : "<a class='nav-item nav-link' href='" . base_url('go/logout') . "'><i class='glyphicon glyphicon-play whiteText' data-toggle='tooltip' data-placement='top' title='KELUAR' aria-hidden='true'><i class='fas fa-sign-out-alt white'></i></i></i><span class='ml-2 d-md-none'>Logout</span></a>";
            ?>
        </div>
    </div>
</nav>