<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2 class="title-2">
                    Registration
                </h2>
                <!-- Form -->
                <form class="signup-form" id="user_signup" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" value="" name="UserMaster[first_name]" id="usermaster-first_name" placeholder="First Name*" class="form-control">
                                        <div class="help-block with-errors"></div>
                                    </div>                    
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">                      
                                        <input type="text" value="" name="UserMaster[last_name]" id="usermaster-last_name" placeholder="Last Name*" class="form-control" autocomplete="off">
                                <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">                      
                                        <input type="text" value="" name="UserMaster[email]" id="usermaster-email" placeholder="Email*" class="form-control" autocomplete="off">
                                <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group"> 
                                       <input type="password" value="" name="UserMaster[password]" id="usermaster-password" placeholder="Password*" class="form-control"  autocomplete="off">
                                <div class="help-block"></div>
                                    </div>
                                </div> 
                                <div class="col-md-12">
                                    <div class="form-group"> 
                                       <input type="password" value="" name="UserMaster[cnf_password]" id="usermaster-cnf_password" placeholder="Confirm Password*" class="form-control"  autocomplete="off">
                                <div class="help-block"></div>
                                    </div>
                                </div> 
                                <div class="col-md-12">
                                    <div class="radio text-right radio-inline mt-0">
                                    <label>
                                        <input value="1" name="userGender" type="radio" onclick="$('#usermaster-gender').val(this.value)">
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        <em style="font-style:normal;">Male</em>
                                    </label>
                                </div>
                                <div class="radio text-right radio-inline mt-0">
                                    <label>
                                        <input value="2" name="userGender" type="radio" onclick="$('#usermaster-gender').val(this.value)">
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        <em style="font-style:normal;">Female</em>
                                    </label>
                                </div>
                                <input type="hidden" name="UserMaster[gender]" id="usermaster-gender" value=""/>
                                <div class="help-block"></div>
                                </div>

                            </div>
                        </div>    
                        <div class="col-md-12">
                            <button type="submit" id="submit" class="btn btn-common">Submit</button>
                            <div id="msgSubmit" class="h3 text-center hidden"></div> 
                            <div class="clearfix"></div>   
                        </div>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</section>

<div id="fb-root"></div>
<script>(function(d, s, id) {
 var js, fjs = d.getElementsByTagName(s)[0];
 if (d.getElementById(id)) return;
 js = d.createElement(s); js.id = id;
// js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId=1674014756173171";
 js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId=1929815600569700";
 fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>