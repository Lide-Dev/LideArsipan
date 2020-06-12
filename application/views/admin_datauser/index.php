<?php
$csrf = array(
    'name' => $this->security->get_csrf_token_name(),
    'hash' => $this->security->get_csrf_hash()
)
?>

<div class="container" style="margin-top:30vh; margin-bottom:20vh">
    <?= !empty($_SESSION['message']) ? $_SESSION['message'] : "" ?>
    <div class="row mb-5">
        <div class="col-md-6">
            <label class="px-4" for="">Pencarian Data User</label>
            <div class="input-group px-4">
                <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3"><i class="fas fa-search fa-sm  "></i></span>
                </div>
                <input type="text" class="form-control" name="search" id="ad_search" aria-describedby="HelpPencarianUser" placeholder="Mencari Data...">
                <small id='HelpPencarianUser' class="text-muted">Pencarian akan dilakukan jika melebihi 2 karakter huruf di kolom pencarian.<br>Kosongkan kolom pencarian jika ingin melihat semua arsip.</small>
            </div>
        </div>
        <div class="col-md-6 align-self-center d-flex justify-content-start px-2">
            <button type="button" id="ad_btnsearch" class="btn btn-primary">Mencari</button>
            <button type="button" id="ad_add" class="btn btn-success mx-2"><i class="fas fa-plus-square fa-sm "></i></button>
            <button type="button" id="ad_banmode" class="btn btn-outline-darkpriwinkle">Blacklist Mode</button>
        </div>
    </div>
    <div class="row">
    </div>


    <div class="row">
        <!-- End of Menu Surat -->
        <!--Tabel-->

        <?php if (empty($tablerow) || $tablerow === 0) { ?>
            <div class="container mt-5">
                <p class="text-center">
                    Tidak terdapat user disini. Silahkan di isi terlebih dahulu untuk melihat tabel data user!
                </p>
            </div>
        <?php } else { ?>
            <div class="container table-responsive">
                <table class="table table-striped table-bordered" id="tabel_user" style="width: 100%">
                    <thead class="">
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                </table>
            </div>
        <?php } ?>

    </div>
</div>