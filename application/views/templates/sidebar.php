<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand mb-2">
            <a href="#">
                Menu
            </a>
        </li>
        <li>
            <a href="<?=base_url('dashboard')?>">Dashboard</a>
        </li>
        <li>
            <a href="<?=base_url('registrasi_surat')?>">Registrasi Surat</a>
        </li>
        <li>
            <a href="<?=base_url('Arsip')?>">Cari Arsip</a>
        </li>
        <?php if (!empty($accadmin)&&$accadmin==='admin') {?>
        <li>
            <a href="<?=base_url('admin/dashboard')?>">Dashboard Admin</a>
        </li>
        <?php  }?>
    </ul>
</div>