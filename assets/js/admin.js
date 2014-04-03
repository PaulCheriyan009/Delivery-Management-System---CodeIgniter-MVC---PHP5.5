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
    initialize();
    $('.hidden-slide-down').hide();
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
    var component_form = {
        'street_number': 'short_name',
        'route': 'long_name',
        'locality': 'long_name',
        'postal_code': 'short_name'
    };

    function initialize() {
        autocomplete = new google.maps.places.Autocomplete(document.getElementById('autocomplete'), { types: [ 'geocode' ] });
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            fillInAddress();
        });
    }
    $("#autocomplete").keyup(function() {

        if (!this.value) {
            $('.hidden-slide-down').hide('slide',500);
        }

    });
    function fillInAddress() {
        var place = autocomplete.getPlace();

        for (var component in component_form) {
            document.getElementById(component).value = "";
            document.getElementById(component).disabled = false;
        }

        for (var j = 0; j < place.address_components.length; j++) {
            var att = place.address_components[j].types[0];
            if (component_form[att]) {
                var val = place.address_components[j][component_form[att]];
                document.getElementById(att).value = val;
            }
        }
        $('.hidden-slide-down').show('slide',500);
    }
});
