<?php

if (Yii::$app->controller->id == 'auth') {
    $this->layout = "LoginLayout";
} else if (Yii::$app->controller->id == 'dashboard') {
    $this->layout = "DashboardLayout";
} else {
    $this->layout = "MainLayout";
}
