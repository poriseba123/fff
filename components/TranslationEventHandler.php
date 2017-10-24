<?php

namespace app\components;

use Yii;
use yii\i18n\MissingTranslationEvent;
use app\models\Message;
use app\models\SourceMessage;

class TranslationEventHandler
{
    public static function handleMissingTranslation(MissingTranslationEvent $event)
    {
        if ($event->message == '') {
            
        } else {
            $source = SourceMessage::find()->where(['message'=>$event->message, 'category'=>$event->category])->one();
            if (!$source) {
                $model = new SourceMessage;

                $model->category = $event->category;
                $model->message = $event->message;
                $model->save();

                $lastID = Yii::$app->db->lastInsertID;
                $id_sourceMessage = $lastID;
            } else {
                $id_sourceMessage = $source->id;
            }

            if ($event->language != Yii::$app->sourceLanguage) {

                $translation = Message::find()->where(['language'=>$event->language, 'id'=>$id_sourceMessage])->one();
                if (!$translation) {
                    $source = SourceMessage::find()->where(['message'=>$event->message, 'category'=>$event->category])->one();
                    $model = new Message;

                    $model->id = $source->id;
                    $model->language = $event->language;
                    $model->translation = ucwords(strtolower(str_replace('_', ' ', $event->message)));
                    $model->save();
                    $event->translatedMessage = $model->translation;
                }else{
                    $event->translatedMessage = $translation->translation;
                }
            }
        }
//        $event->translatedMessage = "@MISSING: {$event->category}.{$event->message} FOR LANGUAGE {$event->language} @";
    }
}

