

$(document).ready(function(){
    var $filterCheckboxes = $("#sidebar-filter :checkbox");
    $filterCheckboxes.on('change', function() {

        var selectedFilters = {};

        $filterCheckboxes.filter(':checked').each(function() {

            if (!selectedFilters.hasOwnProperty(this.name)) {
                selectedFilters[this.name] = [];
            }

            selectedFilters[this.name].push(this.value);

        });

        // create a collection containing all of the filterable elements
        var $filteredResults = $('.single-car-wrap');

        // loop over the selected filter name -> (array) values pairs
        $.each(selectedFilters, function(name, filterValues) {

            // filter each .flower element
            $filteredResults = $filteredResults.filter(function() {

                var matched = false,
                    currentFilterValues = $(this).data('category').split(' ');

                // loop over each category value in the current .flower's data-category
                $.each(currentFilterValues, function(_, currentFilterValue) {

                    // if the current category exists in the selected filters array
                    // set matched to true, and stop looping. as we're ORing in each
                    // set of filters, we only need to match once

                    if ($.inArray(currentFilterValue, filterValues) != -1) {
                        matched = true;
                        return false;
                    }
                });

                // if matched is true the current .flower element is returned
                return matched;

            });
        });

        $('.single-car-wrap').hide().filter($filteredResults).show();

    });

    $('#gear').tooltip({ boundary: 'window' })

    $('[data-toggle="tooltip"]').tooltip();

    $(document).on('click', '.button-coupon', function(e) {
        // var today = new Date();
        // var date = today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear();
        // var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        // var dateTime = date+' '+time;
        var controlForm = $(this).parents('.single-car-wrap'),
            currentEntry = controlForm.find('.car-list-info');

        var date_from = $("#date_from").attr('data-content');
        var time_from = $("#time_from").attr('data-content');
        var date_to = $("#date_to").attr('data-content');
        var time_to = $("#time_to").attr('data-content');
        var city_from = $("#city_from").attr('data-content');
        var city_to = $("#city_to").attr('data-content');
        var office_id = $(currentEntry).find('.office-value').attr('data-id');
        var gear = $(currentEntry).find('.list-gear').attr('data-content');
        var model = $(currentEntry).find('.cars-tittle').attr('data-id');

            $("#dateFrom").val(date_from);
            $("#dateTo").val(date_to);
            $("#timeFrom").val(time_from);
            $("#timeTo").val(time_to);
            $("#officeID").val(office_id);
            $("#cityFrom").val(city_from);
            $("#cityTo").val(city_to);
            $("#gear").val(gear);
            $("#modelID").val(model);

        $("#bookingForm").submit();

//         var token = $('meta[name="csrf-token"]').attr('content');
//
//         var fd = new FormData();
//         fd.append('_token', token);
//         fd.append('dateFrom', date_from);
//         fd.append('dateTo', date_to);
//         fd.append('timeFrom', time_from);
//         fd.append('timeTo', time_to);
//         fd.append('officeID', office_id);
//         fd.append('cityFrom', city_from);
//         fd.append('cityTo', city_to);
//         fd.append('gear', gear);
//         fd.append('modelID', model);
//
//         // AJAX request
//         $.ajax({
//             url: '/booking',
//             type: 'post',
//             data: fd,
//             contentType: false,
//             processData: false,
//             success: function(response){
//                 if(response != 0){
// console.log(response)
//                 }else{
//                     console.log(response)
//                 }
//             }
//         });



    });


});


