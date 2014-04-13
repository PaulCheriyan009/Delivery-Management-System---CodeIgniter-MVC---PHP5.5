var facility_id,date, delivery_id, time;
delivery_id = $('input[name="delivery_id"]').val();
$(function(){
    $('#multipage').multipage({
        'stayLinkable':true,
        'submitLabel':'Register!'
    });
    $('#timeslot_results').hide();
    $('.datepicker').datepicker({
        dateFormat:"dd-mm-yy",
        yearRange: '1910:2010',
        changeYear: true
    });
    $('div.results').on('click','button', function(){
        if (!confirm("Is this the time you want to book?")){
            return false;
        } else {
            time = $(this).text();
            $.ajax({
               type:'POST',
               context:this,
               url:'http://localhost/add-timeslot/' + delivery_id + '/' + facility_id + '/' + date + '/' + time,
               success: function() {
                   $(this).parent().hide('fade',300);
               }
             });
        }
    });
});
$('[name=facility_id]').ddslick({
    width:300,
    selectText:"Please select",
    onSelected: function(data) {
        facility_id = data.selectedData.value;
        date = $('input[name="date_stamp"]').val();
        $.ajax({
            type:'POST',
            url:'http://localhost/get-facility-timeslots/' + facility_id + '/' + date,
            dataType: 'json',
            beforeSend: function() {
                $('.loading').show();
                $('#timeslot_results').focus().slideDown();
                $('.result_inner ul').remove();
            },
            success: function(data) {
                setTimeout(function() {
                    $('.loading').hide();
                    $('#timeslot_results div.result_inner').append('<ul>');
                    $.each(data, function() {
                        $.each(this, function(k, v) {
                            $('#timeslot_results div.result_inner ul').append('<li><button class="btn btn-primary btn-lg">' + v + '</button></li>');
                        });
                    });
                    $('#timeslot_results div.result_inner').append('</ul>');
                }, 1000);
            }
        })
    }
});