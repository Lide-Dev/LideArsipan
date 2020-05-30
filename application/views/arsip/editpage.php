
<div class="container">
    <?php for ($i = 0; $i < $row; $i++) {
        if ($type[$i]!=='textarea'){
            $content ="<input type=' {$type[$i]} ' name= ' {$name[$i]} ' id= ' {$id[$i]} ' class='form-control' placeholder='' aria-describedby='helpId{$i}' value='{$desc[$i]}'>";
        }
        else{
            $content ="<textarea name= ' {$name[$i]} ' id= ' {$id[$i]} ' class='form-control' placeholder='' aria-describedby='helpId{$i}'>{$desc[$i]}</textarea>";
        }
    ?>
        <div class="form-row">
            <div class="form-group col-12">
                <label for="<?= $id[$i] ?>"><?= $label[$i] ?></label>
                <?=$content?>
                <?php if ($helpon[$i]) { ?>
                    <small id="helpId<?= $i ?>" class="text-muted"><?= $help[$i] ?></small>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>