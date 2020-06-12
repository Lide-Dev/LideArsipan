<?php

?>
<div class="container text-center my-3" >
    <i id="info_Iconf" class="fas fa-times fa-6x text-danger"></i>
    <p id="info_Statusf" class="text-center font-weight-bold mt-3"><?=$this->security->xss_clean($title)?></p>
    <p id="info_Descf" class="text-center"><?=$this->security->xss_clean($desc)?></p>
</div>