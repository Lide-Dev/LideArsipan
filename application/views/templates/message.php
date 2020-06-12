<div class="container rounded my-2 <?= $this->security->xss_clean($colormessage) ?> <?= $this->security->xss_clean($tcolormessage) ?> text-center">
    <p><?=$this->security->xss_clean($messagepage)?></p>
</div>