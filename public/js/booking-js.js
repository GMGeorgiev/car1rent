
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();


    $(document).on('click', '.extra-input-checkbox', function(e) {
        var days = parseInt($('.car-info-list-book').attr('data-content'));

        var currentEntry = $(this).parents('.custom-checkbox');

        var select_options = currentEntry.find('.extra_count');
        var extra_count = 1;
        if (typeof select_options.val() !== 'undefined' &&  select_options.val() !== '') {
            extra_count = parseInt(select_options.val());
        }

       var id_extra =  $(this).attr('data-ids');
        var id =  $(this).attr('id');
        var check = document.getElementById(id).checked;
        var status = null;

        var $form = $('#list');
        var $formTotal = $('#list-total');
        // e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form

        $.post('/booking/get-ajax-extras', {_token: $('meta[name="csrf-token"]').attr('content')}, function (response) {
            if (response.success) {
                if (check) {
                    status = 1;
                    if (typeof response.success['extras'][id_extra] !== 'undefined') {
                        var extra_data = response.success['extras'][id_extra];
                        var price = extra_data.RentExtraPrice;
                        var max = null;
                        var calc = 0.00;
                        var sum = price * days;

                        if (extra_data.MaxPrice && extra_data.MaxPrice !== '0.00') {
                            max = extra_data.MaxPrice;
                            if (sum > max) {
                                calc = max;
                            } else {
                                calc = sum;
                            }

                        } else {
                            calc = sum;
                        }
                        var paset_sum = calc.toFixed(2);


                        $.post('/booking/ajax-extras-add-remove', {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            checked: status,
                            value_count: extra_count,
                            extra_id: id_extra,
                            value_price: paset_sum,
                            days: days
                        }, function (responseEdit) {
                            if (responseEdit.success) {
                                var total = responseEdit.success['Total'];
                                if (extra_count) {
                                    $form.find('#ïtem_extra_' + id_extra).find('.middle').text('x ' + extra_count);
                                }

                                $form.find('#ïtem_extra_' + id_extra).find('.item-price').text(paset_sum);
                                // console.log($form.find('#ïtem_extra_' + id_extra).find('.item-price').text());
                                $form.find('#ïtem_extra_' + id_extra).show();


                                $formTotal.find('.total-euro').text(total)
                                $formTotal.find('.bgn-value').text((total * 1.95583).toFixed(2))
                            }else {
                                                         }

                        });
                    }
                } else {
                    status = 0;
                    if (typeof response.success['extras'][id_extra] !== 'undefined') {
                        var extra_data = response.success['extras'][id_extra];
                        var price = extra_data.RentExtraPrice;
                        var max = null;
                        var calc = 0.00;
                        var sum = price * days;

                        if (extra_data.MaxPrice && extra_data.MaxPrice !== '0.00') {
                            max = extra_data.MaxPrice;
                            if (sum > max) {
                                calc = max;
                            } else {
                                calc = sum;
                            }

                        } else {
                            calc = sum;
                        }
                        var paset_sum = calc.toFixed(2);


                        $.post('/booking/ajax-extras-add-remove', {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            checked: status,
                            value_count: extra_count,
                            extra_id: id_extra,
                            value_price: paset_sum,
                            days: days,
                            select_count : 0
                        }, function (responseEdit) {
                            if (responseEdit.success) {
                                var total =  responseEdit.success['Total'];
                                $form.find('#ïtem_extra_' + id_extra).hide();
                                $formTotal.find('.total-euro').text(total);
                                $formTotal.find('.bgn-value').text((total * 1.95583).toFixed(2))

                            }else {

                            }
                        });

                    }

                }


            } else {

            }

        });






    });

    $(document).on('change', '.extra_count', function(e) {
        var days = parseInt($('.car-info-list-book').attr('data-content'));
        var currentEntry = $(this).parents('.custom-checkbox');
        var extra_count =  $(this).val();
        var id_extra =  $(this).attr('data-ids');

        var check = document.getElementById('extra_checkbox_' + id_extra).checked;
        if(check){

            var $form = $('#list');
            var $formTotal = $('#list-total');
            // e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form

            $.post('/booking/get-ajax-extras', {_token: $('meta[name="csrf-token"]').attr('content')}, function (response) {
                if (response.success) {
                    if (check) {
                        status = 1;
                        if (typeof response.success['extras'][id_extra] !== 'undefined') {
                            var extra_data = response.success['extras'][id_extra];
                            var price = extra_data.RentExtraPrice;
                            var max = null;
                            var calc = 0.00;
                            var sum = price * days;

                            if (extra_data.MaxPrice && extra_data.MaxPrice !== '0.00') {
                                max = extra_data.MaxPrice;
                                if (sum > max) {
                                    calc = max;
                                } else {
                                    calc = sum;
                                }

                            } else {
                                calc = sum;
                            }
                            var paset_sum = calc.toFixed(2);


                            $.post('/booking/ajax-extras-add-remove', {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                checked: status,
                                value_count: extra_count,
                                extra_id: id_extra,
                                value_price: paset_sum,
                                days: days,
                                select_count : 1
                            }, function (responseEdit) {
                                if (responseEdit.success) {
                                    console.log(responseEdit);
                                    var total = responseEdit.success['Total'];
                                    if (extra_count) {
                                        $form.find('#ïtem_extra_' + id_extra).find('.middle').text('x ' + extra_count);
                                    }

                                    $form.find('#ïtem_extra_' + id_extra).find('.item-price').text(paset_sum);
                                    // console.log($form.find('#ïtem_extra_' + id_extra).find('.item-price').text());
                                    $form.find('#ïtem_extra_' + id_extra).show();

                                    $formTotal.find('.total-euro').text(total);
                                    $formTotal.find('#bgn-value').text((total * 1.95583).toFixed(2))
                                }else {
                                }

                            });
                        }
                    }

                } else {

                }

            });

        }
    });
//     $('#enterCouponForm').submit(function(e){
//     var $form = $(this);
//     e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
//
//     if ($form[0].checkValidity() === false) {
//         console.log($form[0].checkValidity());
//     }else{
// console.log($form[0].checkValidity());
//     }
//     });
    // Setup form validation on the #register-form element


    $(document).on('click', '.button-coupon', function(e) {
        var $form = $('#list');
        var $formTotal = $('#list-total');
        $('#invalid_cupon_code').hide();

        var coupon_not_trim = $('#cupon_code').val();
        var coupon = coupon_not_trim.trim();

        if (coupon !== '') {
            $('#cupon_code').css("border-color", "#EEEEEE");
            $('#invalid_cupon_code').hide();
            var token = $('meta[name="csrf-token"]').attr('content');

            $.post('/booking/ajax-enter-coupon', {
                _token: token,
                coupon : coupon
            }, function (responseCoupon) {
                if (responseCoupon.success) {
                    var paset_sum = 0.00;
                    var coupon_data = responseCoupon.success['coupon'];
                    $form.find('#coupon_list').find('.middle').text('- ');
                    if(coupon_data){
                        if(coupon_data['percent'] == 0){
                            paset_sum = coupon_data['value'].toFixed(2);
                            $form.find('#coupon_list').find('.item-price').text(paset_sum);

                        }else{
                            paset_sum = coupon_data['value'];
                            $form.find('#coupon_list').find('.item-price').text(paset_sum + '%');
                            $form.find('#euro-symbol-coupon').hide();
                        }
                        $form.find('#coupon_list').show();
                        var total = responseCoupon.success['Total'];

                        $formTotal.find('.total-euro').text(total);
                        $formTotal.find('#bgn-value').text((total * 1.95583).toFixed(2))
                    }

                }else {

                    $('#cupon_code').css("border-color", "#e3342f");
                     $('#invalid_cupon_code').html('Invalid Coupon');
                    $('#invalid_cupon_code').show();
                }

            }).fail(function(responseCoupon) {
                //handle failed validation
            });;


            // If the form is invalid, submit it. The form won't actually submit;
            // this will just cause the browser to display the native HTML5 error messages.
            // $myForm.find(':submit').click();
        } else {
            $('#cupon_code').css("border-color", "#e3342f");
            $('#invalid_cupon_code').show();

        }

    });

    $(document).on('click', '.insurance-input-checkbox', function(e) {
        var days = parseInt($('.car-info-list-book').attr('data-content'));

        var currentEntry = $(this).parents('.custom-checkbox');

        // var select_options = currentEntry.find('.extra_count');
        // var extra_count = 1;
        // if (typeof select_options.val() !== 'undefined' &&  select_options.val() !== '') {
        //     extra_count = parseInt(select_options.val());
        // }
        var id_extra =  $(this).attr('data-ids');
        var id =  $(this).attr('id');
        var check = document.getElementById(id).checked;
        var status = null;

        var $form = $('#list');
        var $formTotal = $('#list-total');
        // e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        $.post('/booking/get-ajax-insurance', {_token: $('meta[name="csrf-token"]').attr('content')}, function (response) {
            if (response.success) {
                if (check) {
                    status = 1;

                    if (typeof response.success['insurance'][id_extra] !== 'undefined') {
                        var extra_data = response.success['insurance'][id_extra];
                        var price = extra_data.insurancePrice;
                        var max = null;
                        var calc = 0.00;

                        console.log(check);

                        $.post('/booking/ajax-insurance-add-remove', {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            checked: status,
                            // value_count: extra_count,
                            extra_id: id_extra,
                            value_price: price
                            // days: days
                        }, function (responseEdit) {
                            if (responseEdit.success) {
                                var total = responseEdit.success['Total'].toFixed(2);
                                // if (extra_count) {
                                $form.find('#ïtem_insurance_' + id_extra).find('.middle').text('x 1');
                                // }

                                $form.find('#ïtem_insurance_' + id_extra).find('.item-price').text(price);
                                // console.log($form.find('#ïtem_extra_' + id_extra).find('.item-price').text());
                                $form.find('#ïtem_insurance_' + id_extra).show();


                                $formTotal.find('.total-euro').text(total)
                                $formTotal.find('.bgn-value').text((total * 1.95583).toFixed(2))
                            } else {
                            }
                            //
                        });
                      }
                    } else {
                        status = 0;
                        if (typeof response.success['insurance'][id_extra] !== 'undefined') {
                            var extra_data = response.success['insurance'][id_extra];
                            var price = extra_data.insurancePrice;
                            // var max = null;
                            // var calc = 0.00;
                            // var sum = price * days;

                            // if (extra_data.MaxPrice && extra_data.MaxPrice !== '0.00') {
                            //     max = extra_data.MaxPrice;
                            //     if (sum > max) {
                            //         calc = max;
                            //     } else {
                            //         calc = sum;
                            //     }
                            //
                            // } else {
                            //     calc = sum;
                            // }
                            // var paset_sum = calc.toFixed(2);


                            $.post('/booking/ajax-insurance-add-remove', {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                checked: status,
                                // value_count: extra_count,
                                extra_id: id_extra,
                                value_price: price
                                // days: days,
                                // select_count : 0
                            }, function (responseEdit) {
                                if (responseEdit.success) {
                                    console.log(responseEdit);
                                    var total = responseEdit.success['Total'].toFixed(2);
                                    $form.find('#ïtem_insurance_' + id_extra).hide();
                                    $formTotal.find('.total-euro').text(total);
                                    $formTotal.find('.bgn-value').text((total * 1.95583).toFixed(2))

                                } else {

                                }
                            });

                        }
                        //
                    }


                } else {

                }


        });

    });

    // Setup form validation on the #register-form element





});


