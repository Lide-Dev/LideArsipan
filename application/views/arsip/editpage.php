
<div class="container">
    <?php for ($i = 0; $i < $row; $i++) {
        if ($type[$i]!=='textarea'){
            $content ="<input type='".$this->security->xss_clean($type[$i])."' name= '".$this->security->xss_clean($name[$i])."' id= '".$this->security->xss_clean($id[$i])."' class='form-control' placeholder='' aria-describedby='helpId".$this->security->xss_clean($i)."' value='".$this->security->xss_clean($desc[$i])."'>";
        }
        else{
            $content ="<textarea name= '".$this->security->xss_clean($name[$i])." ' id= '".$this->security->xss_clean($id[$i])."' class='form-control' placeholder='' aria-describedby='helpId".$this->security->xss_clean($i)."'>".$this->security->xss_clean($desc[$i])."</textarea>";
        }
    ?>
        <div class="form-row">
            <div class="form-group col-12">
                <label for="<?= $this->security->xss_clean($id[$i]) ?>"><?= $this->security->xss_clean($label[$i]) ?></label>
                <?=$content?>
                <?php if ($helpon[$i]) { ?>
                    <small id="helpId<?= $this->security->xss_clean($i) ?>" class="text-muted"><?= $this->security->xss_clean($help[$i]) ?></small>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>