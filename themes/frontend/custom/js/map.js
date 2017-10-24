$(document).ready(function(){
    
    $('body').on('submit', '#postAdForm', function (e) {
   e.preventDefault();
   loader_start();
   var _this = $(this);

   _this.find(".has-error").removeClass("has-error");
   _this.find(".help-block").html("");
   
   var validation=true;
   var percentage=$('#percentage').val();
   var manual_price=$('#manual_price').val();
   if(manual_price!=''){
       if(percentage<0){
           $('#percentage-help-block').text('No se puede dar un valor menor que el valor real');
           loader_stop();
           return false;
       }
   }

   var data = _this.serialize();
   formData = new FormData($(this)[0]);
   formData.append("percentage", $('#percentage').val());
   formData.append("total_cost_old", $('#span_google_price').html());   
   var url = full_path + "post/addpost";

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
                    $('#publicar-btm').hide();
                    $('#step2').show();
                    $('#post_id').val(resp.post_id);
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

$('body').on('submit', '#postEditForm', function (e) {
   e.preventDefault();
   loader_start();
   var _this = $(this);

   _this.find(".has-error").removeClass("has-error");
   _this.find(".help-block").html("");

   var data = _this.serialize();
   formData = new FormData($(this)[0]);
   formData.append("percentage", $('#percentage').val());
   var url = full_path + "post/editpost";

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
                    $('#publicar-btm').hide();
                    $('#step2').show();
                    $('#post_id').val(resp.post_id);
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

$('body').on('submit', '#step2_form', function (e) {
   e.preventDefault();
   loader_start();
   var _this = $(this);

   _this.find(".has-error").removeClass("has-error");
   _this.find(".help-block").html("");

   var data = _this.serialize();
   formData = new FormData($(this)[0]);
   var url = full_path + "post/step2";
   var total_seat=$('#total_seat').val();
   var description=$('#description').val();
//   var title=$('#title').val();
   var isflexible=$('#isflexible').val();
   var booking_process=$('#booking_process').val();
   var validation=true;
   if(!$('#terms_conditions').is(':checked')){
       validation=false;
       $('#terms_conditions_help_block').html('Tienes que estar de acuerdo con los términos y condiciones');
   }
   if(total_seat==""){
       validation=false;
        $('#total_seat').parent("div").find('.help-block').html('Número de asientos debe ser superior a 0');
   }
   if(booking_process==""){
       validation=false;
        $('#booking_process').parent("div").find('.help-block').html('Seleccione un proceso de reserva');
   }
   if(isflexible==""){
       validation=false;
        $('#isflexible').parent("div").find('.help-block').html('Por favor seleccione una opción');
   }
   if(description==""){
       validation=false;
        $('#description').parent("div").find('.help-block').html('La descripción no puede ser nula');
   }
//   if(title==""){
//       validation=false;
//        $('#title').parent("div").find('.help-block').html('El título no puede estar en blanco');
//   }
   if(!validation){
       loader_stop();
       return;
   }
   
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

    
   var date = new Date();
//  date.setDate(date.getDate()-1); 
  console.log('date');
  console.log(date);
  $(".form_datetime").datetimepicker({
        format: "yyyy-mm-dd hh:ii",
        autoclose: true,
        todayBtn: true,
        pickerPosition: "bottom-left",
        language: 'es',
        startDate: date
//    Default: true
    });  
});
setTimeout(function(){$("#editsubmit").click()}, 2000);

$(document).on('keyup mouseup', '.manual_price', function() { 
    $(".help-block").html("");
    var google_total_price=$('#span_google_price').html();
    var original_value=parseInt(google_total_price);
    var new_value=this.value;
    var percentage=(((new_value-original_value)/original_value)*100).toFixed(2);
    window.console.log(percentage);
    if(this.value==''){
       var val=parseFloat(0); 
    }else if(percentage>30){
        $('#manual_price').val('');
        $('#percentage').val('');
        $('#percentage-help-block').text('El valor máximo debe ser 30');
    var val=parseInt(0);
    
    }
//    else if(percentage<0){
//        $('#manual_price').val('');
//        $('#percentage').val('');
//        $('#percentage-help-block').text('No se puede dar un valor menor que el valor real');
//    }
    else{
      var val=parseFloat(percentage);  
      $('#percentage').val(percentage);
    }
    var inps = document.getElementsByName('old_final_price[]');
    for (var i = 0; i <inps.length; i++) {
    var inp=inps[i];
//        alert("final_price["+i+"].value="+inp.value);
        var old_price=parseFloat(inp.value);
        var new_price=Math.round(old_price+((old_price*val)/100));
        $('#new_final_price_'+i).val(new_price);
        $('#price_'+i).html(' price <i class="fa fa-long-arrow-right fa-fw" aria-hidden="true"></i> <i class="fa fa-usd" aria-hidden="true"></i> '+new_price+'');
    }
});
$(document).on('keyup mouseup', '.percentage1111', function() { 
    $(".help-block").html("");
    if(this.value==''){
       var val=parseFloat(0); 
    }else if(this.value>30){
        $('#percentage').val(0);
        $('#percentage-help-block').text('El valor máximo debe ser 30');
    var val=parseFloat(0);
    }else{
      var val=parseFloat(this.value);  
    }
    var inps = document.getElementsByName('old_final_price[]');
    for (var i = 0; i <inps.length; i++) {
    var inp=inps[i];
//        alert("final_price["+i+"].value="+inp.value);
        var old_price=parseFloat(inp.value);
        var new_price=Math.round(old_price+((old_price*val)/100));
        $('#new_final_price_'+i).val(Math.round(new_price));
        $('#price_'+i).html(' price <i class="fa fa-long-arrow-right fa-fw" aria-hidden="true"></i> <i class="fa fa-usd" aria-hidden="true"></i> '+Math.round(new_price)+'');
    }
});
$(document).on('keyup mouseup', '.editmanual_price', function() { 
    $(".help-block").html("");
    var google_total_price=$('#span_google_price').html();
    var original_value=parseInt(google_total_price);
    var new_value=this.value;
    var percentage=(((new_value-original_value)/original_value)*100).toFixed(2);
    window.console.log(percentage);
    if(this.value==''){
       var val=parseFloat(0); 
    }else if(percentage>30){
        $('#manual_price').val('');
        $('#percentage').val('');
        $('#percentage-help-block').text('El valor máximo debe ser 30');
    var val=parseInt(0);
    
    }else{
      var val=parseFloat(percentage);  
      $('#percentage').val(percentage); 
    }
    var old_value=$(this).attr('old-value');
    var inps = document.getElementsByName('old_final_price[]');
    for (var i = 0; i <inps.length; i++) {
    var inp=inps[i];
//        alert("final_price["+i+"].value="+inp.value);
        var old_price=parseFloat(inp.value);
        var new_price=Math.round(old_price+((old_price*val)/100));
        $('#new_final_price_'+i).val(new_price);
        $('#price_'+i).html(' price <i class="fa fa-long-arrow-right fa-fw" aria-hidden="true"></i> <i class="fa fa-usd" aria-hidden="true"></i> '+new_price+'');
    }
});
$(document).on('keyup mouseup', '.editpercentage1111', function() { 
    $(".help-block").html("");
    if(this.value==''){
       var val=parseFloat(0); 
    }else if(this.value>30){
        $('#percentage').val(0);
        $('#percentage-help-block').text('El valor máximo debe ser 30');
    var val=parseFloat(0);
    }else{
      var val=parseFloat(this.value);  
    }
    var old_value=$(this).attr('old-value');
    var inps = document.getElementsByName('old_final_price[]');
    for (var i = 0; i <inps.length; i++) {
    var inp=inps[i];
//        alert("final_price["+i+"].value="+inp.value);
        var old_price=parseFloat(inp.value);
        var new_price=old_price+((old_price*val)/100);
        $('#new_final_price_'+i).val(new_price.toFixed(2));
        $('#price_'+i).html(' price <i class="fa fa-long-arrow-right fa-fw" aria-hidden="true"></i> <i class="fa fa-usd" aria-hidden="true"></i> '+new_price.toFixed(2)+'');
    }
});
$(document).on('keyup mouseup', '.halt', function() { 
    var i=$(this).attr('i-value');
    var nxt = parseInt(i)+1;
    var datetime=$('#old_datetime_'+nxt).val();
//    alert(nxt);
    window.console.log(datetime);
    var dateString = datetime,
    dateTimeParts = dateString.split(' '),
    timeParts = dateTimeParts[1].split(':'),
    dateParts = dateTimeParts[0].split('-'),
    date;
    var old_date = new Date(dateParts[0], dateParts[1], dateParts[2], timeParts[0], timeParts[1]);
    if(this.value==''){
       var halt_val=parseInt(0); 
    }else{
    var halt_val=parseInt(this.value);
    }
    var r=old_date.setMinutes(old_date.getMinutes() + halt_val);
    var newdate = new Date(r);
    if(newdate.getHours()<10){
        var hour='0'+newdate.getHours();
    }else{
       var hour=newdate.getHours(); 
    }
    if(newdate.getMinutes()<10){
        var mins='0'+newdate.getMinutes();
    }else{
       var mins=newdate.getMinutes(); 
    }
    var new_time=newdate.getFullYear()+'-'+newdate.getMonth()+'-'+newdate.getDate()+' '+hour+':'+mins;
    window.console.log(new_time);
    $(this).parents('.result_row').nextAll('.result_row:first').find('.form_datetime').val(new_time);
});
$(document).on('keyup mouseup', '.edithalt', function() { 
    var i=$(this).attr('i-value');
    var old_value=$(this).attr('old-value');
    var nxt = parseInt(i)+1;
    var datetime=$('#old_dep_datetime_'+nxt).val();
    window.console.log('nxt');
    window.console.log(datetime);
    var dateString = datetime,
    dateTimeParts = dateString.split(' '),
    timeParts = dateTimeParts[1].split(':'),
    dateParts = dateTimeParts[0].split('-'),
    date;
    var old_date = new Date(dateParts[0], dateParts[1], dateParts[2], timeParts[0], timeParts[1]);
//    var halt_val=parseInt(this.value);
    if(this.value==''){
       var halt_val=parseInt(0); 
    }else{
    var halt_val=parseInt(this.value);
    }
    var r=old_date.setMinutes(old_date.getMinutes() + halt_val - old_value);
    var newdate = new Date(r);
    if(newdate.getHours()<10){
        var hour='0'+newdate.getHours();
    }else{
       var hour=newdate.getHours(); 
    }
    if(newdate.getMinutes()<10){
        var mins='0'+newdate.getMinutes();
    }else{
       var mins=newdate.getMinutes(); 
    }
    var new_time=newdate.getFullYear()+'-'+newdate.getMonth()+'-'+newdate.getDate()+' '+hour+':'+mins;
    window.console.log(new_time);
    $(this).parents('.result_row').nextAll('.result_row:first').find('.form_datetime').val(new_time);
});

function removeOptionRow(id){
    $('.stopage_' + id).remove();
}