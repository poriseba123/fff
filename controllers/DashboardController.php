<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
use yii\helpers\Url;
use yii\data\Pagination;
use app\models\UserMaster;
use app\models\LikeMaster;
use app\models\CommentLike;
use app\models\AnalysisLike;
use app\models\AnalysisComments;
use app\models\UserAnalysisMaster;
use app\components\FrontendController;

class DashboardController extends FrontendController {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['analysisdetails'],
                        'allow' => true,
                    ],
                // ...
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex() {
        $listingLimit = 5;
        $userAnalySis = UserAnalysisMaster::find()
                ->from(UserAnalysisMaster::tableName() . ' t')
                ->joinWith(['followingUsers as flowing', "userDetails as ud"])
                ->where('(t.user_id =:userId OR t.user_id = flowing.following_id) AND  ud.status =:status', [':userId' => Yii::$app->user->id, ":status" => 1])
                ->orderBy('t.addded_date DESC')
                ->limit($listingLimit)
                ->all();

        $totalAnalysisRecord = UserAnalysisMaster::find()
                ->from(UserAnalysisMaster::tableName() . ' t')
                ->joinWith(['followingUsers as flowing', "userDetails as ud"])
                ->where('(t.user_id =:userId OR t.user_id = flowing.following_id) AND  ud.status =:status', [':userId' => Yii::$app->user->id, ":status" => 1])
                ->orderBy('t.addded_date DESC')
                ->count();

        $user = UserMaster::find()->where(['id' => Yii::$app->user->id])->one();

        $data['userAnalySis'] = $userAnalySis;
        $data['totalAnalysisRecord'] = $totalAnalysisRecord;
        $data['model'] = $user;
        $data['listingLimit'] = $listingLimit;
        return $this->render('dashboard', $data);
    }

    public function actionLoadanalysisdata() {
        if (Yii::$app->request->isAjax) {
            $dataType = $_REQUEST['dataType'];
            $listingLimit = 5;
            if ($dataType == "soccer_analysis") {
                $userAnalySis = UserAnalysisMaster::find()
                        ->from(UserAnalysisMaster::tableName() . ' t')
                        ->joinWith(['followingUsers as flowing', "userDetails as ud"])
                        ->where('(t.user_id =:userId OR t.user_id = flowing.following_id) AND  ud.status =:status AND t.game_category=:gameCategory', [':userId' => Yii::$app->user->id, ":status" => 1, "gameCategory" => 1])
                        ->orderBy('t.addded_date DESC')
                        ->limit($listingLimit)
                        ->all();

                $totalAnalysisRecord = UserAnalysisMaster::find()
                        ->from(UserAnalysisMaster::tableName() . ' t')
                        ->joinWith(['followingUsers as flowing', "userDetails as ud"])
                        ->where('(t.user_id =:userId OR t.user_id = flowing.following_id) AND  ud.status =:status AND t.game_category=:gameCategory', [':userId' => Yii::$app->user->id, ":status" => 1, "gameCategory" => 1])
                        ->orderBy('t.addded_date DESC')
                        ->count();
            } elseif ($dataType == "nfl_ncaafb_analysis") {
                $userAnalySis = UserAnalysisMaster::find()
                        ->from(UserAnalysisMaster::tableName() . ' t')
                        ->joinWith(['followingUsers as flowing', "userDetails as ud"])
                        ->where('(t.user_id =:userId OR t.user_id = flowing.following_id) AND  ud.status =:status AND (t.game_category=:gameCategory OR t.game_category=:gameCategory1)', [':userId' => Yii::$app->user->id, ":status" => 1, ":gameCategory" => 4, ":gameCategory1" => 5])
                        ->orderBy('t.addded_date DESC')
                        ->limit($listingLimit)
                        ->all();

                $totalAnalysisRecord = UserAnalysisMaster::find()
                        ->from(UserAnalysisMaster::tableName() . ' t')
                        ->joinWith(['followingUsers as flowing', "userDetails as ud"])
                        ->where('(t.user_id =:userId OR t.user_id = flowing.following_id) AND  ud.status =:status AND (t.game_category=:gameCategory OR t.game_category=:gameCategory1)', [':userId' => Yii::$app->user->id, ":status" => 1, ":gameCategory" => 4, ":gameCategory1" => 5])
                        ->orderBy('t.addded_date DESC')
                        ->count();
            } elseif ($dataType == "nba_ncaamb_analysis") {
                $userAnalySis = UserAnalysisMaster::find()
                        ->from(UserAnalysisMaster::tableName() . ' t')
                        ->joinWith(['followingUsers as flowing', "userDetails as ud"])
                        ->where('(t.user_id =:userId OR t.user_id = flowing.following_id) AND  ud.status =:status AND (t.game_category=:gameCategory OR t.game_category=:gameCategory1)', [':userId' => Yii::$app->user->id, ":status" => 1, ":gameCategory" => 2, ":gameCategory1" => 3])
                        ->orderBy('t.addded_date DESC')
                        ->limit($listingLimit)
                        ->all();

                $totalAnalysisRecord = UserAnalysisMaster::find()
                        ->from(UserAnalysisMaster::tableName() . ' t')
                        ->joinWith(['followingUsers as flowing', "userDetails as ud"])
                        ->where('(t.user_id =:userId OR t.user_id = flowing.following_id) AND  ud.status =:status AND (t.game_category=:gameCategory OR t.game_category=:gameCategory1)', [':userId' => Yii::$app->user->id, ":status" => 1, ":gameCategory" => 2, ":gameCategory1" => 3])
                        ->orderBy('t.addded_date DESC')
                        ->count();
            } elseif ($dataType == "analysis") {

                $userAnalySis = UserAnalysisMaster::find()
                        ->from(UserAnalysisMaster::tableName() . ' t')
                        ->joinWith(['followingUsers as flowing', "userDetails as ud"])
                        ->where('(t.user_id =:userId OR t.user_id = flowing.following_id) AND  ud.status =:status', [':userId' => Yii::$app->user->id, ":status" => 1])
                        ->orderBy('t.addded_date DESC')
                        ->limit($listingLimit)
                        ->all();

                $totalAnalysisRecord = UserAnalysisMaster::find()
                        ->from(UserAnalysisMaster::tableName() . ' t')
                        ->joinWith(['followingUsers as flowing', "userDetails as ud"])
                        ->where('(t.user_id =:userId OR t.user_id = flowing.following_id) AND  ud.status =:status', [':userId' => Yii::$app->user->id, ":status" => 1])
                        ->orderBy('t.addded_date DESC')
                        ->count();
            }

            $user = UserMaster::find()->where(['id' => Yii::$app->user->id])->one();

            $data['userAnalySis'] = $userAnalySis;
            $data['totalAnalysisRecord'] = $totalAnalysisRecord;
            $data['model'] = $user;

            $htmlData = $this->renderPartial("_partial_analysis_list", $data, true);

            $data['listingLimit'] = $listingLimit;
            $data['htmlData'] = $htmlData;
            echo json_encode($data);
            exit;
        }
    }

    public function actionLoadmoreanalysis() {
        if (Yii::$app->request->isAjax) {
            $resp = [];
            $limit = $_REQUEST['limit'];
            $offset = $_REQUEST['offset'];
            $dataType = $_REQUEST['dataType'];

            if ($dataType == "soccer_analysis") {
                $userAnalySis = UserAnalysisMaster::find()
                        ->from(UserAnalysisMaster::tableName() . ' t')
                        ->joinWith(['followingUsers as flowing', "userDetails as ud"])
                        ->where('(t.user_id =:userId OR t.user_id = flowing.following_id) AND  ud.status =:status AND t.game_category=:gameCategory', [':userId' => Yii::$app->user->id, ":status" => 1, "gameCategory" => 1])
                        ->orderBy('t.addded_date DESC')
                        ->limit($limit)
                        ->offset($offset)
                        ->all();
            } elseif ($dataType == "nfl_ncaafb_analysis") {
                $userAnalySis = UserAnalysisMaster::find()
                        ->from(UserAnalysisMaster::tableName() . ' t')
                        ->joinWith(['followingUsers as flowing', "userDetails as ud"])
                        ->where('(t.user_id =:userId OR t.user_id = flowing.following_id) AND  ud.status =:status AND (t.game_category=:gameCategory OR t.game_category=:gameCategory1)', [':userId' => Yii::$app->user->id, ":status" => 1, ":gameCategory" => 4, ":gameCategory1" => 5])
                        ->orderBy('t.addded_date DESC')
                        ->limit($limit)
                        ->offset($offset)
                        ->all();
            } elseif ($dataType == "nba_ncaamb_analysis") {
                $userAnalySis = UserAnalysisMaster::find()
                        ->from(UserAnalysisMaster::tableName() . ' t')
                        ->joinWith(['followingUsers as flowing', "userDetails as ud"])
                        ->where('(t.user_id =:userId OR t.user_id = flowing.following_id) AND  ud.status =:status AND (t.game_category=:gameCategory OR t.game_category=:gameCategory1)', [':userId' => Yii::$app->user->id, ":status" => 1, ":gameCategory" => 2, ":gameCategory1" => 3])
                        ->orderBy('t.addded_date DESC')
                        ->limit($limit)
                        ->offset($offset)
                        ->all();
            } elseif ($dataType == "analysis") {

                $userAnalySis = UserAnalysisMaster::find()
                        ->from(UserAnalysisMaster::tableName() . ' t')
                        ->joinWith(['followingUsers as flowing', "userDetails as ud"])
                        ->where('(t.user_id =:userId OR t.user_id = flowing.following_id) AND  ud.status =:status', [':userId' => Yii::$app->user->id, ":status" => 1])
                        ->orderBy('t.addded_date DESC')
                        ->limit($limit)
                        ->offset($offset)
                        ->all();
            }

            $user = UserMaster::find()->where(['id' => Yii::$app->user->id])->one();
            $data['userAnalySis'] = $userAnalySis;
            $data['model'] = $user;

            $html = $this->renderPartial("_partial_analysis_list", $data, true);

            $resp['html'] = $html;
            $resp['offset'] = $offset + $limit;
            echo json_encode($resp);
            exit;
        }
    }

    public function actionAnalysisdetails() {
        $anaLysisTrackId = $_REQUEST['trackId'];

        $findAnalysis = UserAnalysisMaster::find()
                ->where("trackId='$anaLysisTrackId'")
                ->one();
        \Yii::$app->view->registerMetaTag([
            'property' => "og:title",
            'content' => $this->getProjectName() . " - Analysis",
        ]);
        \Yii::$app->view->registerMetaTag([
            'property' => "og:type",
            'content' => "Website",
        ]);
        \Yii::$app->view->registerMetaTag([
            'property' => "og:url",
            'content' => Yii::$app->urlManager->createAbsoluteUrl(["dashboard/analysisdetails", "trackId" => $findAnalysis->trackId])
        ]);
        \Yii::$app->view->registerMetaTag([
            'property' => "og:image",
            'content' => Yii::$app->urlManager->createAbsoluteUrl("/") . "themes/frontend/images/dash_board_inner_img-1.png"
        ]);
        return $this->render("analysis_details", ['userAnalySis' => $findAnalysis]);
    }

    public function actionAnalysislike() {
        $resp['flag'] = false;
        if (Yii::$app->request->isAjax) {
            $userId = Yii::$app->user->id;
            $analysisId = $_REQUEST['analysisId'];
            $analysisVsId = $_REQUEST['analysisVsId'];

            $isLiked = AnalysisLike::find()
                    ->where("analysis_id=:analysisId AND user_id=:userId AND vs_id =:vsId", [":analysisId" => $analysisId, ":userId" => $userId, ":vsId" => $analysisVsId])
                    ->one();
            if (count($isLiked) == 1) {
                if ($isLiked->status == 1) {
                    $isLiked->status = 3;
                    $resp['msg'] = Yii::t('app', "You have not like this analysis");
                } elseif ($isLiked->status == 3) {
                    $isLiked->status = 1;
                    $resp['flag'] = true;
                    $resp['msg'] = Yii::t('app', "You have liked this analysis");
                }
                $isLiked->save(false);
            } else {
                $liked = new AnalysisLike();
                $liked->isNewRecord = true;
                $liked->id = null;
                $liked->analysis_id = $analysisId;
                $liked->vs_id = $analysisVsId;
                $liked->user_id = $userId;
                $liked->status = 1;
                $liked->added_date = date('Y-m-d H:i:s');
                $liked->updated_date = date('Y-m-d H:i:s');
                $liked->save();
                $resp['flag'] = true;
                $resp['msg'] = Yii::t('app', "You have liked this analysis");
            }

            $resp['totalLike'] = $this->countAnalysisLiked($analysisId, $analysisVsId);
            echo json_encode($resp);
            exit;
        }
    }

    public function actionAnalysiscommentlike() {
        $resp['flag'] = false;
        if (Yii::$app->request->isAjax) {
            $userId = Yii::$app->user->id;
            $commentId = $_REQUEST['commentId'];

            $likeRecord = AnalysisComments::findOne($commentId);

            $isLiked = CommentLike::find()
                    ->where("comment_id=:commentId AND user_id=:userId", [":commentId" => $commentId, ":userId" => $userId])
                    ->one();
            if (count($isLiked) == 1) {
                if ($isLiked->status == 1) {
                    $isLiked->status = 3;
                    $likeRecord->like_total -=1;
                    $resp['msg'] = Yii::t('app', "You have not like this comment");
                } elseif ($isLiked->status == 3) {
                    $isLiked->status = 1;
                    $likeRecord->like_total +=1;
                    $resp['flag'] = true;
                    $resp['msg'] = Yii::t('app', "You have liked this comment");
                }
                $isLiked->save(false);
                $likeRecord->save(false);
            } else {
                $liked = new CommentLike();
                $liked->isNewRecord = true;
                $liked->id = null;
                $liked->comment_id = $commentId;
                $liked->user_id = $userId;
                $liked->status = 1;
                $liked->added_date = date('Y-m-d H:i:s');
                $liked->updated_date = date('Y-m-d H:i:s');
                $liked->save();
                $likeRecord->like_total +=1;
                $likeRecord->save(false);
                $resp['flag'] = true;
                $resp['msg'] = Yii::t('app', "You have liked this comment");
            }
            $resp['totalLike'] = $likeRecord->like_total;
            echo json_encode($resp);
            exit;
        }
    }

    public function checkAnalysisLiked($analysisId, $vsId = 0) {
        if (!Yii::$app->user->isGuest) {
            $searchLike = AnalysisLike::find()
                    ->where("user_id=:userId AND vs_id=:vsId AND status=:status AND analysis_id=:analysisId", [":userId" => Yii::$app->user->id, ":vsId" => $vsId, ":status" => 1, ":analysisId" => $analysisId])
                    ->count();
            if ($searchLike > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function checkAnalysisCommentLiked($commentId) {
        if (!Yii::$app->user->isGuest) {
            $searchLike = CommentLike::find()
                    ->where("user_id=:userId AND status=:status AND comment_id=:commentId", [":userId" => Yii::$app->user->id, ":status" => 1, ":commentId" => $commentId])
                    ->count();
            if ($searchLike > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function actionGetallcomments() {
        if (Yii::$app->request->isAjax) {
            $analysisId = $_REQUEST['analysisId'];
            $findComment = AnalysisComments::find()
                    ->from(AnalysisComments::tableName() . ' t')
                    ->joinWith(["userDetails as ud"])
                    ->where('t.analysis_id =:analysisId AND t.parent_id = 0 AND ud.status =:status', [":analysisId" => $analysisId, ":status" => 1])
                    ->orderBy('t.added_date ASC')
                    ->all();

            $totalComment = count($findComment);
            $commentHtml = $this->renderPartial("_partialsCommentData", ["allComments" => $findComment], true);

            $resp['totalComment'] = $totalComment;
            $resp['commentHtml'] = $commentHtml;
            echo json_encode($resp);
            exit;
        }
    }

    public function actionAnalysiscommentsubmit() {
        if (Yii::$app->request->isAjax) {
            $resp = [];
            $resp['flag'] = false;

            $anaLysisId = $_REQUEST['commentAnalysisId'];
            $comment = $_REQUEST['useranalysisComment'];

            $commentModel = new AnalysisComments;
            $commentModel->scenario = "create_comment";
            $commentModel->isNewRecord = true;
            $commentModel->id = null;
            $commentModel->parent_id = 0;
            $commentModel->user_id = Yii::$app->user->id;
            $commentModel->analysis_id = $anaLysisId;
            $commentModel->comment = $comment;
            $commentModel->like_total = 0;
            $commentModel->replyed = 0;
            $commentModel->status = 1;
            $commentModel->added_date = date("Y-m-d H:i:s");
            $commentModel->update_date = date("Y-m-d H:i:s");
            if ($commentModel->validate() && $commentModel->save()) {
                $analysis = UserAnalysisMaster::findOne($anaLysisId);
                $analysis->comment_total += 1;
                $analysis->save(false);
                $commentHtml = $this->renderPartial("_partialsCommentData", ['model' => $commentModel], true);

                $type = ($analysis->vs_id == 0) ? 1 : 2;

                $commentHtmlForMain = $this->renderPartial("_partialsCommentData", ['model' => $commentModel, 'htmlfor' => 'dashboard', "type" => $type], true);
                $resp['flag'] = true;
                $resp['comment'] = $commentHtml;
                $resp['commentedHtml'] = $commentHtmlForMain;
                $resp['totalComment'] = $analysis->comment_total;
                $resp['analysisId'] = $anaLysisId;
                $resp['msg'] = Yii::t('app', "comment have been added successfully");
            } else {
                $errors = $commentModel->getErrors();
                $resp['msg'] = $errors['comment'][0];
            }
            echo json_encode($resp);
            exit;
        }
    }

    public function actionCommentreply() {
        if (Yii::$app->request->isAjax) {
            $resp = [];
            $resp['flag'] = false;

//            echo "<pre>";
//            print_r($_POST);
//            echo "</pre>";
//            exit;
            $commentId = $_REQUEST['replycommentId'];
            $replyedMsg = $_REQUEST['replyed_msg'];
            $analysisId = $_REQUEST['analysisId'];

            $replyed = new AnalysisComments;
            $replyed->scenario = "reply";
            $replyed->isNewRecord = true;
            $replyed->id = null;
            $replyed->parent_id = $commentId;
            $replyed->user_id = Yii::$app->user->id;
            $replyed->analysis_id = $analysisId;
            $replyed->comment = $replyedMsg;
            $replyed->like_total = 0;
            $replyed->replyed = 0;
            $replyed->status = 1;
            $replyed->added_date = date("Y-m-d H:i:s");
            $replyed->update_date = date("Y-m-d H:i:s");
            if ($replyed->validate() && $replyed->save()) {
                $comments = AnalysisComments::findOne($commentId);
                $comments->replyed += 1;
                $comments->save(false);
                $resp['flag'] = true;
                $repliHtml = $this->renderPartial("_partialsCommentData", ['model' => $replyed], true);
                if ($comments->replyed == 0) {
                    $replyText = Yii::t('app', "Reply");
                } elseif ($comments->replyed == 1) {
                    $replyText = $comments->replyed . " " . Yii::t('app', "Reply");
                } elseif ($comments->replyed > 1) {
                    $replyText = $comments->replyed . " " . Yii::t('app', "Replys");
                }
                $resp['replyHtml'] = $repliHtml;
                $resp['replyed'] = $replyText;
                $resp['analysisId'] = $analysisId;
                $resp['msg'] = Yii::t('app', "Reply have been added successfully");
            } else {
                $errors = $replyed->getErrors();
                if (isset($errors['comment'][0]) && $errors['comment'][0] != "") {
                    $resp['msg'] = Yii::t('app', "Reply Message can not be blank.");
                }
            }
            echo json_encode($resp);
            exit;
        }
    }

    public function actionCreateanalysistrackid() {
        $analysis = UserAnalysisMaster::find()->all();
        foreach ($analysis as $v) {
            $v->trackId = $this->createAnalysisUniqueId();
            $v->save(false);
        }
    }

    public function actionCreateshareablelink() {
        if (Yii::$app->request->isAjax) {
            $trackId = $_REQUEST['analysisTrackId'];
            $data["facebookLink"] = "https://www.facebook.com/sharer.php?u=" . Yii::$app->urlManager->createAbsoluteUrl(["dashboard/analysisdetails", "trackId" => $trackId]);
            $data["twitterLink"] = "https://twitter.com/share?url=" . Yii::$app->urlManager->createAbsoluteUrl(["dashboard/analysisdetails", "trackId" => $trackId]);
//            $instagramLink = "https://twitter.com/share?url=".Yii::$app->urlManager->createAbsoluteUrl(["dashboard/analysisdetails", "trackId" => $trackId]);
            echo json_encode($data);
            exit;
        }
    }

    public function getAnalysisComments($analysisId, $limit = "") {
        return AnalysisComments::find()
                        ->where("analysis_id=:analysisId AND parent_id=:parentId AND status=:status", [":analysisId" => $analysisId, ":parentId" => 0, ":status" => 1])
                        ->orderBy('id DESC')
                        ->limit($limit)
                        ->all();
    }

}
