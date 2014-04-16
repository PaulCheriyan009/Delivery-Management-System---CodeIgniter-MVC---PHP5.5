var facility_id,date, delivery_id, time;
$(function(){
    $('#timeslot_results').hide();
    $('.datepicker').datepicker({
        dateFormat:"dd-mm-yy",
        yearRange: '1910:2010',
        changeYear: true,
        onSelect: function(date,inst) {
            $('#date_hdn').val(date);
        }
    });
    $('.datepicker-booking').datepicker({
        dateFormat:"dd-mm-yy",
        minDate: 1
    });
    $('div.results').on('click','button', function(){
        if (!confirm("Is this the time you want to book?")){
            return false;
        } else {
            time = $(this).text();
            delivery_id = $('input[name="delivery_id"]').val();
            $.ajax({
               type:'POST',
               context:this,
               url:'http://localhost/add-timeslot/' + delivery_id + '/' + facility_id + '/' + date + '/' + time,
               success: function() {
                   $(this).parent().hide('fade',300);
                   $('.alert').hide('fade',600);
                   setTimeout(function() {
                       location.reload(true);
                   }, 600);
               }
             });
        }
    });
});
