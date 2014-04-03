var Admin = {

  toggleLoginRecovery: function(){
    var is_login_visible = $('#modal-login').is(':visible');
    (is_login_visible ? $('#modal-login') : $('#modal-recovery')).slideUp(300, function(){
      (is_login_visible ? $('#modal-recovery') : $('#modal-login')).slideDown(300, function(){
        $(this).find('input:text:first').focus();
      });
    });
  }
   
};
var selectedID = $('#selectedID');

$('#close-fancybox').click(function(e) {
    parent.$.fancybox.close();
});
$(function(){
    // enable areyousure for all form elements
    $('form').areYouSure({
        'message':'You have entered information that will be lost if you continue.'
    });
    $('#deliverytime').valid8({
        'regularExpressions': [
            { expression: /^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/, errormessage: 'Please enter the time in the HH:MM format.'}
]
    });
    $('button[type="reset"]').click(function(e){
        e.preventDefault();

    });
    $('#deliveryid').val($('#selectedID',window.parent.document).val());
    $('.fancybox').click(function(e){
        selectedID.val($(this).parent().find('input[type="hidden"]').val());

    });
    $('.fancybox').fancybox({
        type:'iframe',
        iframe:{
            scrolling:'auto',
            preload:true
        },
        closeBtn:false,
        modal:true,
        closeClick:false,
        width:500,
        padding:0,
//        height: 'auto',
        autoHeight:true,
        fitToView:true,
        padding:20
    });

    // date pick on fields
    $('.datepicker').datepicker({
        dateFormat:"dd-mm-yy",
        showOptions: {
            direction:"up"
        },
        autoSize:true,
        defaultDate:+1,
        minDate:"+1d",
        maxDate: "+1m"
    });
  $('.toggle-login-recovery').click(function(e){
    Admin.toggleLoginRecovery();
    e.preventDefault();
  });
    $('#lookup_postcode').click(function(e){
        e.preventDefault();
        // ajax stuff here to fill address fields
        var postcode = $('#facility_postcode').val();
    });
  // navbar stuff
//    //store the element
//    var $cache = $('header');
//    //store the initial position of the element
//    var vTop = $cache.offset().top - parseFloat($cache.css('margin-top').replace(/auto/, 0));
//    $(window).scroll(function (event) {
//        // what the y position of the scroll is
//        var y = $(this).scrollTop();
//
//        // whether that's below the form
//        if (y >= vTop) {
//            // if so, ad the fixed class
//            $cache.addClass('stuck');
//        } else {
//            // otherwise remove it
//            $cache.removeClass('stuck');
//        }
//    });
});
