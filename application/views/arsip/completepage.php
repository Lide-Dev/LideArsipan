<div id="ar_success" class="container text-center my-3">
    <i id="info_Icon" class="fas fa-check fa-6x text-success"></i>
    <p id="info_Status" class="text-center font-weight-bold mt-3"><?=$this->security->xss_clean($title)?></p>
    <p id="info_Desc" class="text-center"><?=$this->security->xss_clean($desc)?></p>
</div>