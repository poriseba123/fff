<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\Settings;
use yii\widgets\LinkPager;

$kmprice = Settings::find()
        ->where(['slug' => 'km_price'])
        ->one();
?>
<section class="publicar-top">
    <div class="container">
        <div class="publicar-top-wrap">
            <h2 class="publicar-title">Todos los viajes<a href="<?= Url::toRoute(['post/create']); ?>" class="btn btn-success pull-right"> + Publicar un anuncio</a></h2>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Descripción</th>
                                <th>Ubicación inicial</th>
                                <th>End Ubicación</th>
                                <th>Tiempo de empezar</th>
                                <th>Hora de finalización</th>
                                <th>Comportamiento</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            if (isset($model) && count($model) > 0) {
                                foreach ($model as $row) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?= $row->title ?>
                                        </td>
                                        <td>
                                            <?= $row->description; ?>
                                        </td>
                                        <td> <?= $row->starting_location ?></td>
                                        <td> <?= $row->end_location ?></td>
                                        <td> <?= date('d/m/Y h:i A', strtotime($row->start_time)) ?></td>
                                        <td> <?= date('d/m/Y h:i A', strtotime($row->end_time)) ?></td>

                                        <td>
                                            <a title="Edit" data-toggle="tooltip" href="<?= Url::toRoute(['search/postdetail', 'id' => $row->id ]); ?>"  class="">
                                                <i class="fa fa-eye" aria-hidden="true"></i> 
                                            </a>
                                            <a title="Edit" data-toggle="tooltip" href="<?= Url::toRoute(['post/postedit', 'id' => $row->id]); ?>"  class="">
                                                <i class="fa fa-edit" aria-hidden="true"></i> 
                                            </a>
                                            <a title="Delete" data-toggle="tooltip" href="javascript:;" onclick="showModal(this)" data-val="<?= $row->id; ?>" class="">
                                                <i class="fa fa-trash" aria-hidden="true"></i> 
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="7">
                                        ningún record fue encontrado
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                    <div class="text-right">
                        <?php
                        echo LinkPager::widget([
                            'pagination' => $pages,
                        ]);
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">¿Eliminar el anuncio?</h4>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de eliminar el anuncio?</p>
            </div>
            <div class="modal-footer">
                <input type='hidden' id='post_id' value=''>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <a href="javascript:void(0);" onclick="deletePost()" class="btn btn-primary">Sí</a>
            </div>
        </div>

    </div>
</div>

<script>
    function showModal(obj) {
        var id = $(obj).attr('data-val');
        $('#post_id').val(id);
        $('#deleteModal').modal('show');
    }
</script>