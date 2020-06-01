<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand mb-2">
            <a style="display: none;" href="#">
             Menu
            </a>
        </li>
        <li>
            <a href="<?=base_url('dashboard')?>"><i class="fas fa-home"></i><span style="margin-left: 10px;">Dashboard</span></a>
        </li>
        <li>
            <a href="<?=base_url('registrasi_surat')?>"><i class="fas fa-save"></i><span style="margin-left: 12.7px;">Registrasi Surat</span></a>
        </li>
        <li>
            <a href="<?=base_url('Arsip')?>"><i class="fas fa-search"></i><span style="margin-left: 11.5px;">Cari Arsip</span></a>
        </li>
        <?php if (!empty($accadmin)&&$accadmin==='admin') {?>
        <li>
            <a href="<?=base_url('admin/dashboard')?>"><i class="fas fa-users-cog"></i><span style="margin-left: 9px;">Dashboard Admin</span></a>
        </li>
        <?php  }?>
    </ul>
</div>