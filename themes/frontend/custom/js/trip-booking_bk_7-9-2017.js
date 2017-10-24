$('body').on('submit', '#report_msg_form_step1', function (e) {
     e.preventDefault();
     loader_start();
     var _this = $(this);
var step=$('#step').val();
   _this.find(".has-error").removeClass("has-error");
   _this.find(".help-block").html("");
     
     var validation=false;
     if(step==5){
        if($('#msg').val()!=''){
            validation=true;
        } 
     }else{
     $('#report_msg_form_step1 .step'+step+ ' input[type=radio]:checked').each(function(){
            var val = this.value;
            if(!validation){
            validation=true;
        }
    });
     }
    
     if(!validation){
         loader_stop();
         if(step==5){
       $('#step1_help_block').text('El campo no puede estar en blanco');
   }else{
      $('#step1_help_block').text('Por favor, seleccione uno'); 
   }
       return false;
   }else{
       if(step!=5){
       loader_stop();
      $('.step'+step).hide();
       step=parseInt(step)+parseInt(1);
      $('#step').val(step);
      $('.step'+step).show();
      return false;
  }
   }
   if(step==5){
         formData = new FormData($(this)[0]);
   var url = full_path + "message/reportmessagestep1";

    $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (resp) {
                if (resp.flag == true) {
                    success_msg(resp.msg);
                    setTimeout(function () {
                        window.location.reload();
                    }, '1000');
                }else{
                   error_msg(resp.msg);
                    setTimeout(function () {
                        window.location.reload();
                    }, '1000');
                }
                loader_stop();
            },
            error: function (data) {
                loader_stop();
            },
            complete: function (data) {
                loader_stop();
            }
        });
    }
});
$('body').on('submit', '#report_msg_form_step5', function (e) {
     e.preventDefault();
     loader_start();
     var _this = $(this);

   _this.find(".has-error").removeClass("has-error");
   _this.find(".help-block").html("");
     
     if($('#msg').val()==''){
         loader_stop();
       $('#msg_help_block').text('El campo no puede estar en blanco');
       return false;
   }
         formData = new FormData($(this)[0]);
   var url = full_path + "message/reportmessagestep5";

    $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (resp) {

                
                if (resp.flag == true) {
                    success_msg(resp.msg);
                    setTimeout(function () {
                        window.location.reload();
                    }, '1000');
                }else{
                   error_msg(resp.msg);
                    setTimeout(function () {
                        window.location.reload();
                    }, '1000');
                }
                loader_stop();
            },
            error: function (data) {
                loader_stop();
            },
            complete: function (data) {
                loader_stop();
            }
        });
});
$('body').on('submit', '#report_profile_form', function (e) {
     e.preventDefault();
     loader_start();
     var _this = $(this);

   _this.find(".has-error").removeClass("has-error");
   _this.find(".help-block").html("");
     
     var reason=$('#reason').val();
     var validation=true;
     
     if(reason==''){
         $('#reason-help-block').text('El campo no puede estar en blanco');
         validation=false;
     }
     if(!validation){
         loader_stop();
         return false;
     }
         formData = new FormData($(this)[0]);
   var url = full_path + "publicprofile/submitreport";

    $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (resp) {

                
                if (resp.flag == true) {
                    success_msg(resp.msg);
                    setTimeout(function () {
                        window.location.reload();
                    }, '1000');
                }else{
                   error_msg(resp.msg);
                    setTimeout(function () {
                        window.location.reload();
                    }, '1000');
                }
                loader_stop();
            },
            error: function (data) {
                loader_stop();
            },
            complete: function (data) {
                loader_stop();
            }
        });
});

$('body').on('submit', '#create-bank-detail-form', function (e) {
     e.preventDefault();
     loader_start();
     var _this = $(this);

   _this.find(".has-error").removeClass("has-error");
   _this.find(".help-block").html("");
     
     var owner_name=$('#owner_name').val();
     var banknote_number=$('#banknote_number').val();
     var bank_name=$('#bank_name').val();
     var account_number=$('#account_number').val();
     var account_type=$('#account_type').val();
     var validation=true;
     if(owner_name==""){
         
         $('#owner_name-help-block').text('El campo no puede estar en blanco');
         validation=false;
     }
     if(banknote_number==''){
         $('#banknote_number-help-block').text('El campo no puede estar en blanco');
         validation=false;
     }
     if(bank_name==''){
         $('#bank_name-help-block').text('El campo no puede estar en blanco');
         validation=false;
     }
     if(account_number==''){
         $('#account_number-help-block').text('El campo no puede estar en blanco');
         validation=false;
     }
     if(account_type==''){
         $('#account_type-help-block').text('El campo no puede estar en blanco');
         validation=false;
     }
     if(!validation){
         loader_stop();
         return false;
     }
         formData = new FormData($(this)[0]);
   var url = full_path + "money/createbankdetails";

    $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (resp) {

                
                if (resp.flag == true) {
                    success_msg(resp.msg);
                    setTimeout(function () {
                        window.location.reload();
                    }, '1000');
                }else{
                   error_msg(resp.msg);
                    setTimeout(function () {
                        window.location.reload();
                    }, '1000');
                }
                loader_stop();
            },
            error: function (data) {
                loader_stop();
            },
            complete: function (data) {
                loader_stop();
            }
        });
});
$('body').on('submit', '#message-form', function (e) {
     e.preventDefault();
     loader_start();
     var _this = $(this);

   _this.find(".has-error").removeClass("has-error");
   _this.find(".help-block").html("");
     
     var to_id=$('#to_id').val();
     var message=$('#message').val();
     var validation=true;
     if(checkIfEmailInString(message)){
         $('#message-help-block').text('No puede utilizar el correo electrónico en el mensaje');
         validation=false;
     }
     if(to_id==""){
         
         $('#message-help-block').text('El campo no puede estar en blanco');
         validation=false;
     }
     if(message==''){
         $('#message-help-block').text('El campo no puede estar en blanco');
         validation=false;
     }
     if(!validation){
         loader_stop();
         return false;
     }
         formData = new FormData($(this)[0]);
   var url = full_path + "message/submitmessage";

    $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (resp) {

                
                if (resp.flag == true) {
                    success_msg(resp.msg);
                    setTimeout(function () {
                        window.location.reload();
                    }, '1000');
                }else{
                   error_msg(resp.msg);
                    setTimeout(function () {
                        window.location.reload();
                    }, '1000');
                }
//                loader_stop();
            },
            error: function (data) {
                loader_stop();
            },
            complete: function (data) {
                loader_stop();
            }
        });
});
$('body').on('submit', '#give_rating_form', function (e) {
     e.preventDefault();
     loader_start();
     var _this = $(this);

   _this.find(".has-error").removeClass("has-error");
   _this.find(".help-block").html("");
     
     var rating=$('#rating').val();
     var review=$('#review').val();
     var validation=true;
     if(rating < 1){
         
         $('#rating-help-block').text('Por favor dé una calificación');
         validation=false;
     }
     if(review==''){
         $('#review-help-block').text('El campo no puede estar en blanco');
         validation=false;
     }
     if(!validation){
         loader_stop();
         return false;
     }
         formData = new FormData($(this)[0]);
   var url = full_path + "reservation/submitrating";

    $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (resp) {

                
                if (resp.flag == true) {
                    success_msg(resp.msg);
                    setTimeout(function () {
                        window.location.reload();
                    }, '1000');
                }else{
                   error_msg(resp.msg);
                    setTimeout(function () {
                        window.location.reload();
                    }, '1000');
                }
                loader_stop();
            },
            error: function (data) {
                loader_stop();
            },
            complete: function (data) {
                loader_stop();
            }
        });
});
$('body').on('submit', '#tripReservationform', function (e) {
     e.preventDefault();
     loader_start();
     var booking_process=$('#bookingmaster-booking_process').val();
     if(booking_process==1){
        setTimeout(function(){
        loader_stop();
        $('#payulatamform').submit();
    }, 2000); 
     }else{
         formData = new FormData($(this)[0]);
   var url = full_path + "book/manualbooking";

    $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (resp) {

                
                if (resp.flag == true) {
                    success_msg(resp.msg);
                    setTimeout(function () {
                        window.location.href = resp.redirectUrl;
                    }, '3000');
                }else{
                   error_msg(resp.msg);
                    setTimeout(function () {
                        window.location.href = resp.redirectUrl;
                    }, '3000');
                }
                loader_stop();
            },
            error: function (data) {
                loader_stop();
            },
            complete: function (data) {
                loader_stop();
            }
        });
     }
});
$('body').on('submit', '#tripReservationform-not-instant', function (e) {
     e.preventDefault();
     loader_start();
        setTimeout(function(){
        loader_stop();
        $('#payulatamform-not-instant').submit();
    }, 2000); 
     
});
$('body').on('submit', '#accept_by_driver_form', function (e) {
     e.preventDefault();
   loader_start();
   var _this = $(this);

   _this.find(".has-error").removeClass("has-error");
   _this.find(".help-block").html("");
  
   formData = new FormData($(this)[0]);
   var url = full_path + "book/accept_req_from_driver";
   $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (resp) {

                
                if (resp.flag == true) {
                success_msg(resp.msg);
                setTimeout(function () {
                        window.location.href = resp.redirectUrl;
                    }, '3000');
                }else{
                  error_msg(resp.msg);
                setTimeout(function () {
                        window.location.href = resp.redirectUrl;
                    }, '3000');  
                }
                loader_stop();
            },
            error: function (data) {
                loader_stop();
            },
            complete: function (data) {
                loader_stop();
            }
        });
});
$('body').on('submit', '#cancel_by_driver_form', function (e) {
     e.preventDefault();
   loader_start();
   var _this = $(this);

   _this.find(".has-error").removeClass("has-error");
   _this.find(".help-block").html("");
   var validation=true;
   if($('#reason_category').val()==''){
       loader_stop();
       $('#reason_category-help-block').text('Por favor elija una razón');
         validation=false;
   }
   if($('#reason').val()==''){
       loader_stop();
       $('#reason-help-block').text('El campo no puede estar en blanco');
        validation=false;
   }
   if(!validation){
       return false;
   }
   formData = new FormData($(this)[0]);
   var url = full_path + "book/reject_req_from_driver";
   $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (resp) {

                
                if (resp.flag == true) {
                success_msg(resp.msg);
                setTimeout(function () {
                        window.location.href = resp.redirectUrl;
                    }, '3000');
                }else{
                  error_msg(resp.msg);
                setTimeout(function () {
                        window.location.href = resp.redirectUrl;
                    }, '3000');  
                }
                loader_stop();
            },
            error: function (data) {
                loader_stop();
            },
            complete: function (data) {
                loader_stop();
            }
        });
});
$('body').on('submit', '#cancel_by_user_form', function (e) {
     e.preventDefault();
   loader_start();
   var _this = $(this);

   _this.find(".has-error").removeClass("has-error");
   _this.find(".help-block").html("");
   var validation=true;
   if($('#reason_category').val()==''){
       loader_stop();
       $('#reason_category-help-block').text('Por favor elija una razón');
         validation=false;
   }
   if($('#reason').val()==''){
       loader_stop();
       $('#reason-help-block').text('El campo no puede estar en blanco');
        validation=false;
   }
   if(!validation){
       return false;
   }
   formData = new FormData($(this)[0]);
   var url = full_path + "book/reject_req_from_user";
   $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (resp) {

                
                if (resp.flag == true) {
                success_msg(resp.msg);
                setTimeout(function () {
                        window.location.href = resp.redirectUrl;
                    }, '3000');
                }else{
                  error_msg(resp.msg);
                setTimeout(function () {
                        window.location.href = resp.redirectUrl;
                    }, '3000');  
                }
                loader_stop();
            },
            error: function (data) {
                loader_stop();
            },
            complete: function (data) {
                loader_stop();
            }
        });
});
$('body').on('submit', '#claim_by_user_form', function (e) {
     e.preventDefault();
   loader_start();
   var _this = $(this);

   _this.find(".has-error").removeClass("has-error");
   _this.find(".help-block").html("");
   var validation=true;
   if($('#claim_reason_category').val()==''){
       loader_stop();
       $('#claim_reason_category-help-block').text('Por favor elija una razón');
         validation=false;
   }
   if($('#claim_reason').val()==''){
       loader_stop();
       $('#claim_reason-help-block').text('El campo no puede estar en blanco');
        validation=false;
   }
   if(!validation){
       return false;
   }
   formData = new FormData($(this)[0]);
   var url = full_path + "book/claim_req_from_user";
   $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (resp) {

                
                if (resp.flag == true) {
                success_msg(resp.msg);
                setTimeout(function () {
                        window.location.href = resp.redirectUrl;
                    }, '3000');
                }else{
                  error_msg(resp.msg);
                setTimeout(function () {
                        window.location.href = resp.redirectUrl;
                    }, '3000');  
                }
                loader_stop();
            },
            error: function (data) {
                loader_stop();
            },
            complete: function (data) {
                loader_stop();
            }
        });
});
$('body').on('submit', '#bookingform', function (e) {
    
   e.preventDefault();
   var isGuest=$('#isGuest').val();
   if(isGuest==0){
       window.location.href = full_path + "site/login?redirect="+window.location.href;
   }else{
   loader_start();
   var _this = $(this);

   _this.find(".has-error").removeClass("has-error");
   _this.find(".help-block").html("");
   if(!$('#terms_conditions').is(':checked')){
       loader_stop();
       $('#terms_conditions_help_block').html('Tienes que estar de acuerdo con los términos y condiciones');
       return false;
   }
   var data = _this.serialize();
   formData = new FormData($(this)[0]);
   var url = full_path + "book/checktrip";

    $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (resp) {

                
                if (resp.flag == true) {
                $('#bookingmaster-total_price').val(resp.final_price);
                $('#modal_total_price').text(resp.final_price);
                $('#bookingmaster-seat').val(resp.total_seat);
                $('#bookingmaster-booking_process').val(resp.booking_process);
                $('#referenceCode').val(resp.referenceCode);
                $('#signature').val(resp.signature);
                $('#amount').val(resp.final_price);
                if(resp.booking_process==1){
                $('#reservationmodal_submit').val('RESERVAR');
            }else{
                $('#reservationmodal_submit').val('Solicitud de reserva');
            }
                $('#reservationmodal').modal('show');
                }else{
                    $('#requested_seat_help-block').text(resp.msg);
                }
                loader_stop();
            },
            error: function (data) {
                loader_stop();
            },
            complete: function (data) {
                loader_stop();
            }
        });
    }
});

 function checkIfEmailInString(text) { 
        var re = /(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))/;
        return re.test(text);
    }
