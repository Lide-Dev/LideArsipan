<nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="<?=base_url('admin/admhome')?>">Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </i>
                        Menu
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?=base_url('Admin_Dashboard')?>">Bantuan</a>
                        <a class="dropdown-item" href="<?=base_url('admin/admdatauser')?>">Data User</a>
                        <a class="dropdown-item" href="<?=base_url('admin_Registrasi_User')?>">Registrasi</a>
                        <a class="dropdown-item" href="<?=base_url('Home')?>">Dashboard User</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>