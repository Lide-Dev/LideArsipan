<?php
$title = $modal["title"];
$dialogpos = $modal["dialog_center"];
$databody = $modal["body"];

$modalID = $modal["id"]["modal"];
$formID = $modal["id"]["form"];
$okID = $modal["id"]["ok"];
$cancelID = $modal["id"]["cancel"];
$option3ID = $modal["id"]["option3"];

$textOK = $modal["text"]["ok"];
$textCancel = $modal["text"]["cancel"];
$textOption3 = $modal["text"]["option3"];

$stateForm = $modal["show"]["form"];
$stateOK = $modal["show"]["ok"];
$stateCancel = $modal["show"]["cancel"];
$stateOption3 = $modal["show"]["option3"];

$colorOK = $modal["color"]["ok"];
$colorCancel = $modal["color"]["cancel"];
$colorOption3 = $modal["color"]["option3"];

?>


<!-- Modal -->
<?php echo $stateForm ? "<form id='{$formID}' >" : "" // ?>
  <div class="modal fade" id=<?= $modalID ?> tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog <?= $dialogpos ?>" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabel"><?= $title ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="overflow-x: auto;">
          <div id='color_message' class='mb-5 px-3'>
              <h3 id='text_message'></h3>
          </div>
          <?=
            $databody
          ?>
        </div>
        <div class="modal-footer">
          <div id="modal_footer">
            <?php
            if ($stateOK)
              echo "<input id='{$okID}' type='submit' class='btn {$colorOK} mx-1' value='{$textOK}'>  ";

            if ($stateCancel)
              echo "<button id='{$cancelID}' type='button' class='btn {$colorCancel} mx-1' data-dismiss='modal'> {$textCancel} </button>";

            if ($stateOption3)
              echo "<button id='{$option3ID}' type='button' class='btn {$colorOption3} mx-1'> {$textOption3} </button>";
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php echo $stateForm ? "</form>" : ""?>