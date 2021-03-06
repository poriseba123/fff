<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;
use app\models\MetaLocation;
use yii\helpers\ArrayHelper;
?> 
<div class="col-sm-3 page-sidebar">
            <aside>
              <div class="inner-box">
                <div class="categories">
                  <div class="widget-title">
                    <i class="fa fa-align-justify"></i>
                    <h4>All Categories</h4>
                  </div>
                  <div class="categories-list">
                    <ul>
                      <li>
                        <a href="#">
                          <i class="fa fa-desktop"></i>
                          Electronics <span class="category-counter">(9)</span>
                        </a>
                      </li>
                      
                      <li>
                        <a href="#">
                          <i class="fa fa-wrench"></i>
                          Services <span class="category-counter">(8)</span>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-github-alt"></i>
                          Pets <span class="category-counter">(2)</span>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-leaf"></i>
                          Fashion <span class="category-counter">(3)</span>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-home"></i>
                          Real Estate <span class="category-counter">(4)</span>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-black-tie"></i>
                          Jobs <span class="category-counter">(5)</span>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-cutlery"></i>
                          Hotel & Travels <span class="category-counter">(5)</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="inner-box">
                <div class="widget-title">
                  <h4>Premium Ads</h4>
                </div>
                <div class="advimg">
                  <ul class="featured-list">
                    <li>
                      <img alt="" src="assets/img/featured/img1.jpg">
                      <div class="hover">
                        <a href="#"><span>$49</span></a>
                      </div>
                    </li>
                    <li>
                      <img alt="" src="assets/img/featured/img2.jpg">
                      <div class="hover">
                        <a href="#"><span>$49</span></a>
                      </div>
                    </li>
                    <li>
                      <img alt="" src="assets/img/featured/img3.jpg">
                      <div class="hover">
                        <a href="#"><span>$49</span></a>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>

              <div class="inner-box">
                <div class="widget-title">
                  <h4>Advertisement</h4>
                </div>
                <img src="assets/img/img1.jpg" alt="">
              </div>
            </aside>
          </div>   