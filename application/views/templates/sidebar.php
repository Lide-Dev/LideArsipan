<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand mb-2">
            <a href="#">
                Menu
            </a>
        </li>
        <li>
            <a href="<?=base_url('Home')?>">Dashboard</a>
        </li>
        <li>
            <a href="<?=base_url('Form_Surat')?>">Registrasi Surat</a>
        </li>
        <li>
            <a href="<?=base_url('Arsip')?>">Cari Arsip</a>
        </li>
        <?php if (!empty($accadmin)&&$accadmin==='admin') {?>
        <li>
            <a href="<?=base_url('admin/admhome')?>">Dashboard Admin</a>
        </li>
        <?php  }?>
    </ul>
</div>