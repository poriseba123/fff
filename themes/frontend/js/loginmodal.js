/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    $('.modal-dialog').addClass('modal-sm');
    $('.modal-dialog').removeClass('modal-lg');
    var rotateEvery = 20; //seconds
    var images = [
        "http://www.s-bit.nl/wp-content/uploads/2015/03/Consultancy.jpeg",
        "http://www.lander.edu/images/default-source/news-releases-images/hands-art.jpg?sfvrsn=2",
        "https://d2v9y0dukr6mq2.cloudfront.net/video/thumbnail/N8fwUuSulijjlinqs/connecting-people-business-network-social-media-service_v_ow1rqug__F0004.png"];
    function run(interval, frames) {
        var int = 1;

        function func() {
            $(".section-intro").attr('id', "img" + int);
            int++;
            if (int === frames) {
                int = 1;
            }
        }

        var swap = window.setInterval(func, interval);
    }

    run(5000, 5); //milliseconds, frames
    $("#login").click(function () {
        $('.modal-dialog').addClass('modal-sm').css('max-width', '100%');
        $('.modal-dialog').removeClass('modal-lg');
        $(".login-div").css('display', 'block');
        $("#registerform").css('display', 'none');

        $("#myModal").modal('show');
    })
    $(".forgot").click(function () {
        $('.modal-dialog').addClass('modal-sm');
        $('.modal-dialog').removeClass('modal-lg');
        $(".forgot-div").css('display', 'block');
        $(".login-div").css('display', 'none');
    })
    $('.back-login').click(function () {
        $('.modal-dialog').addClass('modal-sm');
        $('.modal-dialog').removeClass('modal-lg');
        $(".forgot-div").css('display', 'none');
        $(".login-div").css('display', 'block');
    })
    $("#signup").click(function () {
        signup()
    })
    $('#blooddonation').click(function () {
        if ($('#blooddonation').is(":checked") == true) {
            $("#blood").show();
        } else
            $("#blood").hide();
    })

})
function signup() {
    $('.modal-dialog').removeClass('modal-sm');
    if ($(window).width() < 600) {       // if width is less than 600px
        $('.modal-dialog').addClass('modal-lg').css('max-width', '100%');                // execute mobile function
    } else {                              // if width is more than 600px
        $('.modal-dialog').addClass('modal-lg').css('max-width', '35%');                  // execute desktop function
    }

    $(".login-div").css('display', 'none');
    $(".forgot-div").css('display', 'none');
    $("#registerform").css('display', 'block');
    $("#myModal").modal('show');
}


