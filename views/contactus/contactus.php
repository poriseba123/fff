<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

$content = \app\models\Contactinformation::find()->where(['id' => '2'])->all();
?>
<!-- Start Contact Us Section -->
<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2 class="title-2">
                    Love to hear from you
                </h2>
                <!-- Form -->
                <form id="contactForm" class="contact-form" data-toggle="validator">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" name="ContactUs[name]" placeholder="Full Name" required data-error="Please enter your name">
                                        <div class="help-block with-errors"></div>
                                    </div>                    
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">                      
                                        <input type="email" class="form-control" id="email" placeholder="you@yoursite.com" name="ContactUs[email]" required data-error="Please enter your email">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group"> 
                                        <input type="text" class="form-control" id="subject" name="ContactUs[subject]" placeholder="Subject" required data-error="Please enter your subject">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div> 

                            </div>
                        </div>    
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group"> 
                                        <textarea class="form-control" placeholder="Massage" rows="10" data-error="Write your message" required name="ContactUs[message]"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" id="submit" class="btn btn-common">Send Your Message</button>
                            <div id="msgSubmit" class="h3 text-center hidden"></div> 
                            <div class="clearfix"></div>   
                        </div>

                    </div> 
                </form>
            </div>
            <div class="col-md-4">
                <h2 class="title-2">
                    Contact Information
                </h2>
                <div class="information">
                    <div class="contact-datails">
                        <div class="icon">
                            <i class="fa fa-map-marker icon-radius"></i>
                        </div>
                        <div class="info">
                            <h3>Address</h3>
                            <span class="detail"> <?= isset($content[0]->text1) ? $content[0]->text1 : ''; ?></span>
                            
                        </div>
                    </div>                
                    <div class="contact-datails">
                        <div class="icon">
                            <i class="fa fa-phone icon-radius"></i>
                        </div>
                        <div class="info">
                            <h3>Phone Numbers</h3>
                            <span class="detail"> <?= isset($content[0]->text2) ? $content[0]->text2 : ''; ?></span>
                        </div>
                    </div>
                    <div class="contact-datails">
                        <div class="icon">
                            <i class="fa fa-location-arrow icon-radius"></i>
                        </div>
                        <div class="info">
                            <h3>Email Address</h3>
                            <span class="detail"> <?= isset($content[0]->text3) ? $content[0]->text3 : ''; ?></span>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Contact Us Section  -->    

<div id="google-map" style="height: 500px;"></div>
<!-- End Map Section -->
<!-- Google Maps API -->
<!--<script src="https://maps.googleapis.com/maps/api/js?v=3.&key=AIzaSyBOtvKwP4T1s3wOZ5h9QjDP2dSrly-SJXA&libraries=places&region=in&language=enexpsensor=false">
</script>-->
<!-- Google Maps JS Only for Contact Pages -->


