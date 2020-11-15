<?php
$label = ['Perihal', $typearsip == 'sm' ? 'Dituju Kepada' : 'Pengiriman', 'Pengirim', 'Isi Disposisi'];
$id = ['id_perihal', $typearsip == 'sm' ? 'id_dituju' : 'id_kirim', 'id_pengirim', 'id_isi'];
$name = ['perihal', $typearsip == 'sm' ? 'dituju' : 'kirim', 'pengirim', 'isi'];
$type = ['text', 'select', 'text', 'textarea'];
$button = (empty($desc[1])&&empty($desc[2]));
$helpon = [false, false, false, false];
$disable = [true, false, false, false];
$row = 4;
?>


<div class="container">
    <h5>Status:</h5>
    <div class="btn-group btn-group-toggle mb-4" data-toggle="buttons">
        <label class="btn btn-outline-info <?= $button ?'active':''?>" for="id_deactive">
            <input class="select-process" type="radio" name="active" value="noprocess" id="id_deactive" <?= $button ? 'checked' :''?>> <b>Arsipkan</b>
        </label>
        <label class="btn btn-outline-info <?= !$button ?'active':''?>" for="id_active">
            <input class="select-process" type="radio" name="active" value="process" id="id_active" <?= !$button ? 'checked':'' ?>> <b>Diproses</b>
        </label>
    </div>
    <div class="container" id="inputform" style="<?= $button ? 'display:none;' : '' ?>">
        <?php for ($i = 0; $i < $row; $i++) : ?>
            <div class="form-row">
                <div class="form-group col-12">
                    <label for="<?= $this->security->xss_clean($id[$i]) ?>"><?= $this->security->xss_clean($label[$i]) ?></label>
                    <?php if ($type[$i] == 'text') : ?>
                        <input <?= $disable[$i] ? 'disabled' : '' ?> type="<?= $this->security->xss_clean($type[$i]) ?>" name="<?= $this->security->xss_clean($name[$i]) ?>" id="<?= $this->security->xss_clean($id[$i]) ?>" class='form-control' placeholder='' aria-describedby="helpId<?= $this->security->xss_clean($i) ?>" value="<?= $this->security->xss_clean($desc[$i]) ?>">
                    <?php elseif ($type[$i] == 'select') : ?>
                        <select <?= $disable[$i] ? 'disabled' : '' ?> name="<?= $this->security->xss_clean($name[$i]) ?>" id="<?= $this->security->xss_clean($id[$i]) ?>" class='form-control' placeholder='' aria-describedby="helpId<?= $this->security->xss_clean($i) ?>">
                            <?php foreach ($option[$i] as $key => $value) : ?>
                                <option value="<?= $name[$i]=='dituju'?$value->id_jabatan:$value->id_metode ?>" <?= ($name[$i]=='dituju'?$value->id_jabatan:$value->id_metode) == $desc[$i] ? 'selected' : '' ?>> <?=$value->nama?></option>
                            <?php endforeach ?>
                        </select>
                    <?php else : ?>
                        <textarea name="<?= $this->security->xss_clean($name[$i]) ?>" id="<?= $this->security->xss_clean($id[$i]) ?>" class='form-control' placeholder='' aria-describedby="helpId<?= $this->security->xss_clean($i) ?>"><?= $this->security->xss_clean($desc[$i]) ?></textarea>
                    <?php endif; ?>
                    <?php if ($helpon[$i]) { ?>
                        <small id="helpId<?= $this->security->xss_clean($i) ?>" class="text-muted"><?= $this->security->xss_clean($help[$i]) ?></small>
                    <?php } ?>
                </div>
            </div>
        <?php endfor; ?>
    </div>
</div>