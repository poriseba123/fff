<?php
$user = $this->context->getUserDetails(Yii::$app->user->id);
if (count($user) > 0) {
    $userName = $user->first_name . " " . $user->last_name;
} else {
    $userName = "Anónimo";
}
?>
<div class="top-area clearfix">
    <div class="col-md-4 col-sm-4 no-pad-left_1 text-right align-for-mobile">
        <div class="media">
            <div class="media-left">
                <img src="<?= $this->context->getUserProfileImage() ?>" class="media-object img-circle" style="width:37px; height:37px;">
            </div>
            <div class="media-body">
                <h4 class="media-heading"><?= $userName ?></h4>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-sm-8 prof-nav">
        <ul class="nav nav-tabs">
            <li class="<?= (Yii::$app->controller->id == "user" || Yii::$app->controller->id == "vehicle") ? "active" : "" ?>"><a href="<?= Yii::$app->urlManager->createUrl("user/profile")?>">Perfil</a></li>
            <li class="<?= (Yii::$app->controller->id == "advertisements") ? "active" : "" ?>"><a href="<?= Yii::$app->urlManager->createUrl("advertisements/index")?>">Reservas</a></li>
            <li class="<?= (Yii::$app->controller->id == "reservation") ? "active" : "" ?>"><a href="<?= Yii::$app->urlManager->createUrl("reservation/index") ?>">Publicaciones</a></li>
           <li class="<?= (Yii::$app->controller->id == "message") ? "active" : "" ?>"><a href="<?= Yii::$app->urlManager->createUrl("message/index")?>">Mensajes</a></li>
            <li class="<?= (Yii::$app->controller->id == "money") ? "active" : "" ?>"><a href="<?= Yii::$app->urlManager->createUrl("money/index")?>">Dinero</a></li>
        </ul>
    </div>
</div>