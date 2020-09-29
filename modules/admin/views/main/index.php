<?php

?>


<h1 class="text-center d-block">Admin Chat Moderate</h1>

<div class="block block-rounded block-themed">
    <!-- Chat Header -->

    <div class="block-options">
        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle"
                data-action-mode="demo">
            <i class="si si-refresh"></i>
        </button>
    </div>

</div>
<!-- END Chat Header -->

<!-- Messages (demonstration messages are added with JS code at the bottom of this page) -->
<div class="js-chat-talk block-content block-content-full text-wrap-break-word overflow-y-auto"
     style="height: 500px;" id="chat-box">

</div>

<!-- Chat Input -->
<div class="js-chat-form block-content block-content-full block-content-sm bg-body-light">

    <?php if (!Yii::$app->user->isGuest) : ?>
        <input class="js-chat-input form-control" type="text" id="chat-input"
               placeholder="Type your message and hit enter..">
    <?php endif ?>


</div>
    <!-- END Chat Input -->
<?php $this->registerJsFile('@web/js/admin-chat.js');
