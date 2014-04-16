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

$(function(){
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
    $('[name="time_stamp"]').timepicker({
        hourMin: 7,
        hourMax: 22,
        showMinute:false,
        showTime:false,
        showButtonPanel:false
    });
  $('.toggle-login-recovery').click(function(e){
    Admin.toggleLoginRecovery();
    e.preventDefault();
  });

});
var facility_id = $('[name="facility_id"]').val();
$('[name="facility_id"]').change(function() {
    facility_id = $(this).val();
    });
$('[name="authorization_start_time"]').timepicker({
    hourMin: 7,
    hourMax: 22,
    showMinute:false,
    showTime:false,
    showButtonPanel:false,
    onSelect:function(selectedTime) {

    $('[name="authorization_end_time"]').timepicker({
    hourMin:$.datepicker.parseTime('HH:mm',selectedTime)['hour'],
    hourMax: 22,
    showMinute:false,
    showTime:false,
    showButtonPanel:false
    });

}
});
function formattedDate(date) {
    var d = new Date(date || Date.now()),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year,month,day].join('-');
}