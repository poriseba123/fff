<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\ArrayHelper;
?>

<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-3 page-sideabr">
                <aside>
                    <div class="inner-box">
                        <div class="user-panel-sidebar">
                            <div class="collapse-box">
                                <h5 class="collapset-title no-border">Search Radious <a aria-expanded="true" class="pull-right" data-toggle="collapse" href="#myclassified"><i class="fa fa-angle-down"></i></a></h5>
                                <div aria-expanded="true" id="myclassified" class="panel-collapse collapse in">
                                    <ul class="acc-list">
                                        <li>
                                            <div class="slider"></div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="collapse-box">
                                <h5 class="collapset-title">My Search <a aria-expanded="true" class="pull-right" data-toggle="collapse" href="#myads"><i class="fa fa-angle-down"></i></a></h5>
                                <div aria-expanded="true" id="myads" class="panel-collapse collapse in">
                                    <ul class="acc-list">
                                        <li>
                                            <a href="javascript:void(0);">
                                                <div class="row">
                                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                                        <div class="checkbox" style="margin-top:0px !important;">
                                                            <label>
                                                                <input type="checkbox">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                                        <i class="fa fa-ambulance fa-fw"></i> Ambulance <span class="badge">44</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <div class="row">
                                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                                        <div class="checkbox" style="margin-top:0px !important;">
                                                            <label>
                                                                <input type="checkbox">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                                        <i class="fa fa-hospital-o fa-fw"></i>Hospital<span class="badge">19</span>
                                                    </div>
                                                </div>
                                            </a>

                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <div class="row">
                                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                                        <div class="checkbox" style="margin-top:0px !important;">
                                                            <label>
                                                                <input type="checkbox">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                                        <i class="fa fa-tint fa-fw"></i>Blood Bank<span class="badge">13</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <div class="row">
                                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                                        <div class="checkbox" style="margin-top:0px !important;">
                                                            <label>
                                                                <input type="checkbox">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                                        <i class="fa fa-medkit fa-fwcolor-3"></i> Medical Shop <span class="badge">49</span>
                                                    </div>
                                                </div>
                                            </a>

                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <div class="collapse-box">

                                <div aria-expanded="true" id="close" class="panel-collapse collapse in">

                                    <button class="btn btn-common btn-search btn-block"><strong>Search</strong></button>

                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
            <div class="col-sm-9 page-content">
                <div class="inner-box">
                    <h2 class="title-2"><i class="fa fa-globe fa-spin fa-1x fa-fw"></i>Emergency service map view</h2>
                    <div class="table-responsive">
                        <div class="table-action">
                            <div class="checkbox">
                                <label for="checkAll">
                                    <input id="checkAll" onclick="checkAll(this)" type="checkbox">
                                    Select: All 
                                </label>
                            </div>
                            <div class="table-search pull-right col-xs-7">
                                <div class="form-group">
                                    <label class="col-xs-5 control-label text-right">Search <br>
                                        <a title="clear filter" class="clear-filter" href="javascript:void(0)"></a> 
                                    </label>

                                </div>
                            </div>
                        </div>
                        <!----<table class="table table-striped table-bordered add-manage-table">--->
                        <div class="table table-striped table-bordered add-manage-table" id="map" style="height:500px;"></div>

                    </div>               
                </div>
            </div>
        </div>  
    </div>      
</div>
<script>

    window.onload = function init() {
        //alert();
        var
                contentCenter = '<span class="infowin">Center Marker (draggable)</span>',
                contentA = '<span class="infowin">Marker A (draggable)</span>',
                contentB = '<span class="infowin">Marker B (draggable)</span>';
        var
                latLngCenter = new google.maps.LatLng(37.081476, -94.510574),
                latLngCMarker = new google.maps.LatLng(37.0814, -94.5105),
                latLngA = new google.maps.LatLng(37.2, -94.1),
                latLngB = new google.maps.LatLng(38, -93),
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 7,
                    center: latLngCenter,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    mapTypeControl: false,
                    scrollwheel: false
                }),
                markerCenter = new google.maps.Marker({
                    position: latLngCMarker,
                    title: 'Location',
                    map: map,
                    draggable: true
                }),
                infoCenter = new google.maps.InfoWindow({
                    content: contentCenter
                }),
                markerA = new google.maps.Marker({
                    position: latLngA,
                    title: 'Location',
                    map: map,
                    draggable: true
                }),
                infoA = new google.maps.InfoWindow({
                    content: contentA
                }),
                markerB = new google.maps.Marker({
                    position: latLngB,
                    title: 'Location',
                    map: map,
                    draggable: true
                }),
                infoB = new google.maps.InfoWindow({
                    content: contentB
                })
                // exemplary setup: 
                // Assumes that your map is signed to the var "map"
                // Also assumes that your marker is named "marker"
                ,
                circle = new google.maps.Circle({
                    map: map,
                    clickable: false,
                    // metres
                    radius: 100000,
                    fillColor: '#f8c2be',
                    fillOpacity: .4,
                    strokeColor: '#313131',
                    strokeOpacity: .4,
                    strokeWeight: .2
                });
        // attach circle to marker
        circle.bindTo('center', markerCenter, 'position');

        var
                // get the Bounds of the circle
                bounds = circle.getBounds()
                // Note spans
                ,
                noteA = jQuery('.bool#a'),
                noteB = jQuery('.bool#b');

        noteA.text(bounds.contains(latLngA));
        noteB.text(bounds.contains(latLngB));

        // get some latLng object and Question if it's contained in the circle:
        google.maps.event.addListener(markerCenter, 'dragend', function () {
            latLngCenter = new google.maps.LatLng(markerCenter.position.lat(), markerCenter.position.lng());
            bounds = circle.getBounds();
            noteA.text(bounds.contains(latLngA));
            noteB.text(bounds.contains(latLngB));
        });

        google.maps.event.addListener(markerA, 'dragend', function () {
            latLngA = new google.maps.LatLng(markerA.position.lat(), markerA.position.lng());
            noteA.text(bounds.contains(latLngA));
        });

        google.maps.event.addListener(markerB, 'dragend', function () {
            latLngB = new google.maps.LatLng(markerB.position.lat(), markerB.position.lng());
            noteB.text(bounds.contains(latLngB));
        });

        google.maps.event.addListener(markerCenter, 'click', function () {
            infoCenter.open(map, markerCenter);
        });

        google.maps.event.addListener(markerA, 'click', function () {
            infoA.open(map, markerA);
        });

        google.maps.event.addListener(markerB, 'click', function () {
            infoB.open(map, markerB);
        });

        google.maps.event.addListener(markerCenter, 'drag', function () {
            infoCenter.close();
            noteA.html("draggin&hellip;");
            noteB.html("draggin&hellip;");
        });

        google.maps.event.addListener(markerA, 'drag', function () {
            infoA.close();
            noteA.html("draggin&hellip;");
        });

        google.maps.event.addListener(markerB, 'drag', function () {
            infoB.close();
            noteB.html("draggin&hellip;");
        });
    };


</script>