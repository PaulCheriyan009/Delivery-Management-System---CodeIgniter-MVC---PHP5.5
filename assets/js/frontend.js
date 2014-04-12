var facility_id,date;
$(function(){
    $('#date_panel').hide();
    $('#timeslot_results').hide();
    $('.datepicker').datepicker({
        dateFormat:"dd-mm-yy",
        yearRange: '1910:2010',
        changeYear: true
    });
    $('.dd-selected-value').change(function() {
        $('[name="date_stamp"]').datepicker('setDate', null);
    });
    $('[name=date_stamp]').datepicker({
       dateFormat:'dd-mm-yy',
       onSelect:function() {
           date = $(this).val();
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
    $('div.results').on('click','button', function(){
        if (!confirm("Is this the time you want to book?")){
            return false;
        }
    });
});
$('[name=facility_id]').ddslick({
    width:300,
    selectText:"Please select",
    onSelected: function(data) {
        facility_id = data.selectedData.value;
        $('#date_panel').show('slide',500);
    }
});