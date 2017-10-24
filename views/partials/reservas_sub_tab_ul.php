<ul class="nav nav-tabs">
    <li class="<?= (Yii::$app->controller->id == "reservation" && Yii::$app->controller->action->id == "booked") ? "active" : "" ?>"><a href="<?= Yii::$app->urlManager->createUrl("reservation/booked") ?>">Reserva Reservada</a></li>
    <li class="<?= (Yii::$app->controller->id == "reservation" && Yii::$app->controller->action->id == "alreadycancelled") ? "active" : "" ?>"><a href="<?= Yii::$app->urlManager->createUrl("reservation/alreadycancelled") ?>">Viaje Cancelado</a></li>
    <li class="<?= (Yii::$app->controller->id == "reservation" && Yii::$app->controller->action->id == "completedtrip") ? "active" : "" ?>"><a href="<?= Yii::$app->urlManager->createUrl("reservation/completedtrip") ?>">Viaje Completo</a></li>
</ul>