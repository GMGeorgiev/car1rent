$(document).ready(function(){



    $('#createUserForm').submit(function(e){
        var $form = $(this);

        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var url = $form.attr('action');
        var formData = {};
        //submit a POST request with the form data
        $form.find(':input').each(function()
        {
            formData[ $(this).attr('name') ] = $(this).val();

        });

        //submits an array of key-value pairs to the form's action URL
        $.post(url, formData, function(response) {
            //handle successful validation
            if(response.fail){
                associate_errors(response['errors'], $form);
            }else{
                $('.create-item-trigger-clicked').removeClass('create-item-trigger-clicked')
                $('.form-group').removeClass('has-errors').find('.help-text').text('')
                $("#createUserForm").trigger("reset");
                $("#create-modal").modal("hide");
                window.location.reload();
            }
        }).fail(function(response) {

            //handle failed validation

            associate_errors(response['errors'], $form);
        });

    });

    $('#editUserForm').submit(function(e){
        var $form = $(this);

        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var url = $form.attr('action');
        var formData = {};
        //submit a POST request with the form data
        $form.find(':input').each(function()
        {
            formData[ $(this).attr('name') ] = $(this).val();

        });

        //submits an array of key-value pairs to the form's action URL
        $.post(url, formData, function(response) {
            //handle successful validation
            if(response.fail){
                associate_errors(response['errors'], $form);
            }else{
                $('.create-item-trigger-clicked').removeClass('create-item-trigger-clicked')
                $('.form-group').removeClass('has-errors').find('.help-text').text('')
                // $('.message-main').addClass('help-text').find('.help-text-main').text('ddddd')
                $("#createUserForm").trigger("reset");
                $("#create-modal").modal("hide");
                window.location.reload();
            }
        }).fail(function(response) {
            //handle failed validation
            associate_errors(response['errors'], $form);
        });

    });

    $('#deleteUserForm').submit(function(e){
        var $form = $(this);

        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var url = $form.attr('action');
        var formData = {};
        //submit a POST request with the form data
        $form.find(':input').each(function()
        {
            formData[ $(this).attr('name') ] = $(this).val();

        });

        //submits an array of key-value pairs to the form's action URL
        $.post(url, formData, function(response) {
            //handle successful validation
            if(response.fail){
                associate_delete_errors(response['errors'], $form);
            }else{
                $('.delete-item-trigger-clicked').removeClass('delete-item-trigger-clicked')
                $('.form-group').removeClass('has-errors').find('.help-text').text('')
                // $('.message-main').addClass('help-text').find('.help-text-main').text('ddddd')
                $("#deleteUserForm").trigger("reset");
                $("#delete-modal").modal("hide");
                window.location.reload();
            }

        }).fail(function(response) {

            //handle failed validation

            associate_errors(response['errors'], $form);
        });

    });


    /**
     * for showing create item popup
     */

    $(document).on('click', "#create-item", function() {
        $(this).addClass('create-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

        var options = {
            'backdrop': 'static'
        };
        $('#create-modal').modal(options)
    })

    // on modal show
    $('#create-modal').on('show.bs.modal', function() {
        var el = $(".create-item-trigger-clicked"); // See how its usefull right here?

        // var et = document.getElementsByClassName('edit-item-trigger-clicked');
        var row = el.closest(".table-row");
        // var row2 = et.closest(".data-row");

        // console.log(row2);
        // get the data
        var id = el.data('item-id');
        var name = row.children(".name").text();
        var userName = row.children(".user-name").text();
        var email = row.children(".email").text();
        var role = row.children(".role").text();
        var status = row.children(".status").text();

        // fill the data in the input fields
        $("#modal-input-id").val(id);
        $("#modal-input-name").val(name);
        $("#modal-input-username").val(userName);
        $("#modal-input-email").val(email);
        $("#modal-input-role").val(role);
        $("#modal-input-status").val(status);

    })

    // on modal hide
    $('#create-modal').on('hide.bs.modal', function() {
        $('.create-item-trigger-clicked').removeClass('create-item-trigger-clicked')
        $('.form-group').removeClass('has-errors').find('.help-text').text('')
        $("#createUserForm").trigger("reset");
        // $form.find('.form-group').removeClass('has-errors').find('.help-text').text('');
    })

    /**
     * for showing edit item popup
     */

    $(document).on('click', "#edit-item", function() {
        $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

        var options = {
            'backdrop': 'static'
        };
        $('#edit-modal').modal(options)
    })

    // on modal show
    $('#edit-modal').on('show.bs.modal', function() {
        var el = $(".edit-item-trigger-clicked"); // See how its usefull right here?
        // var et = document.getElementsByClassName('edit-item-trigger-clicked');
        var row = el.closest(".table-row");

        // get the data
        var id = el.data('item-id');
        var name = row.children(".name").text();
        var userName = row.children(".user-name").text();
        var email = row.children(".email").text();
        var role = row.children(".role").text();
        var status = row.children(".status").text();

        // fill the data in the input fields
        $("#user-id-create").val(id);
        $("#name-create").val(name);
        $("#username-create").val(userName);
        $("#email-create").val(email);
        if(role === 'Admin'){
            $("#role-create").val(1);
        }else if(role === 'Manager'){
            $("#role-create").val(2);
        }else if(role === 'Reseler'){
            $("#role-create").val(3);
        }else if(role === 'Client'){
            $("#role-create").val(4);
        }

        if(status === 'Active'){
            $("#status-create").val(1);
        }else{
            $("#status-create").val(2);
        }

    })

    // on modal hide
    $('#edit-modal').on('hide.bs.modal', function() {
        $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
        $("#edit-form").trigger("reset");
    })


    /**
     * for showing delete item popup
     */

    $(document).on('click', "#delete-item", function() {
        $(this).addClass('delete-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

        var options = {
            'backdrop': 'static'
        };
        $('#delete-modal').modal(options)
    })

    // on modal show
    $('#delete-modal').on('show.bs.modal', function() {
        var el = $(".delete-item-trigger-clicked"); // See how its usefull right here?
        // var et = document.getElementsByClassName('edit-item-trigger-clicked');
        var row = el.closest(".table-row");
        // get the data
        var id = el.data('item-id');
        var name = row.children(".name").text();
        var userName = row.children(".user-name").text();
        var email = row.children(".email").text();
        var role = row.children(".role").text();
        var status = row.children(".status").text();

        // fill the data in the input fields
        $("#user-id-delete").val(id);
        $("#name-delete").val(name);
        $("#username-delete").val(userName);
        $("#email-delete").val(email);
        $("#role-delete").val(role);
        $("#status-delete").val(status);

    })

    // on modal hide
    $('#edit-modal').on('hide.bs.modal', function() {
        $('.delete-item-trigger-clicked').removeClass('delete-item-trigger-clicked')
        $("#edit-form").trigger("reset");
    })


    // in active Users checkbox

    $('#inActiveUsers').on('click',function(e){

        var check = document.getElementById("inActiveUsers").checked;
        var status = null;

        if (check) {
            status = 1;
            $.post('/admin/all-users', {_token : $('meta[name="csrf-token"]').attr('content'), checked: status}, function (response) {
                if(response){
                      window.location.reload();
                }
            });

        } else {
            status = 0;
            $.post('/admin/all-users', {_token : $('meta[name="csrf-token"]').attr('content'), checked: status}, function (response) {

                if(response){
                      window.location.reload();
                }
            });
        }
    });


    // in active Users checkbox

    $('#inActiveCountries').on('click',function(e){

        var check = document.getElementById("inActiveCountries").checked;
        var status = null;

        if (check) {
            status = 1;
            $.post('/admin/all-countries', {_token : $('meta[name="csrf-token"]').attr('content'), checked: status}, function (response) {
                if(response){
                    window.location.reload();
                }
            });

        } else {
            status = 0;
            $.post('/admin/all-countries', {_token : $('meta[name="csrf-token"]').attr('content'), checked: status}, function (response) {

                if(response){
                    window.location.reload();
                }
            });
        }
    });


    // in active Users checkbox

    $('#inActiveCities').on('click',function(e){

        var check = document.getElementById("inActiveCities").checked;
        var status = null;

        if (check) {
            status = 1;
            $.post('/admin/all-cities', {_token : $('meta[name="csrf-token"]').attr('content'), checked: status}, function (response) {
                if(response){
                    window.location.reload();
                }
            });

        } else {
            status = 0;
            $.post('/admin/all-cities', {_token : $('meta[name="csrf-token"]').attr('content'), checked: status}, function (response) {

                if(response){
                    window.location.reload();
                }
            });
        }
    });

    // end in active Users checkbox

    // in active Fleet checkbox

    $('#inActiveFleet').on('click',function(e){

        var check = document.getElementById("inActiveFleet").checked;
        var status = null;


        if (check) {
            status = 1;
            $.post('/admin/all-fleet', {_token : $('meta[name="csrf-token"]').attr('content'), checked: status}, function (response) {
                if(response){
                    window.location.reload();
                }
            });

        } else {
            status = 0;
            $.post('/admin/all-fleet', {_token : $('meta[name="csrf-token"]').attr('content'), checked: status}, function (response) {

                if(response){
                    window.location.reload();
                }
            });
        }
    });

    // in active Cars checkbox

    $('#inActiveCars').on('click',function(e){

        var check = document.getElementById("inActiveCars").checked;
        var status = null;


        if (check) {
            status = 1;
            $.post('/admin/all-cars', {_token : $('meta[name="csrf-token"]').attr('content'), checked: status}, function (response) {
                if(response){
                    window.location.reload();
                }
            });

        } else {
            status = 0;
            $.post('/admin/all-cars', {_token : $('meta[name="csrf-token"]').attr('content'), checked: status}, function (response) {

                if(response){
                    window.location.reload();
                }
            });
        }
    });

    // in active Fuelst checkbox

    $('#inActiveFuels').on('click',function(e){

        var check = document.getElementById("inActiveFuels").checked;
        var status = null;


        if (check) {
            status = 1;
            $.post('/admin/all-fuels', {_token : $('meta[name="csrf-token"]').attr('content'), checked: status}, function (response) {
                if(response){
                    window.location.reload();
                }
            });

        } else {
            status = 0;
            $.post('/admin/all-fuels', {_token : $('meta[name="csrf-token"]').attr('content'), checked: status}, function (response) {

                if(response){
                    window.location.reload();
                }
            });
        }
    });

    // in active car extras checkbox

    $('#inActiveCarExtras').on('click',function(e){

        var check = document.getElementById("inActiveCarExtras").checked;
        var status = null;


        if (check) {
            status = 1;
            $.post('/admin/all-carextras', {_token : $('meta[name="csrf-token"]').attr('content'), checked: status}, function (response) {
                if(response){
                    window.location.reload();
                }
            });

        } else {
            status = 0;
            $.post('/admin/all-carextras', {_token : $('meta[name="csrf-token"]').attr('content'), checked: status}, function (response) {

                if(response){
                    window.location.reload();
                }
            });
        }
    });

    // in active car extras checkbox

    $('#inActiveCoupes').on('click',function(e){

        var check = document.getElementById("inActiveCoupes").checked;
        var status = null;


        if (check) {
            status = 1;
            $.post('/admin/all-coupes', {_token : $('meta[name="csrf-token"]').attr('content'), checked: status}, function (response) {
                if(response){
                    window.location.reload();
                }
            });

        } else {
            status = 0;
            $.post('/admin/all-coupes', {_token : $('meta[name="csrf-token"]').attr('content'), checked: status}, function (response) {

                if(response){
                    window.location.reload();
                }
            });
        }
    });

    // in active Fleet checkbox

    $('#inActiveModels').on('click',function(e){

        var check = document.getElementById("inActiveModels").checked;
        var status = null;


        if (check) {
            status = 1;
            $.post('/admin/all-models', {_token : $('meta[name="csrf-token"]').attr('content'), checked: status}, function (response) {
                if(response){
                    window.location.reload();
                }
            });

        } else {
            status = 0;
            $.post('/admin/all-models', {_token : $('meta[name="csrf-token"]').attr('content'), checked: status}, function (response) {

                if(response){
                    window.location.reload();
                }
            });
        }
    });

    // in active Fleet checkbox

    $('#inActiveInsurance').on('click',function(e){

        var check = document.getElementById("inActiveInsurance").checked;
        var status = null;


        if (check) {
            status = 1;
            $.post('/admin/all-insurance', {_token : $('meta[name="csrf-token"]').attr('content'), checked: status}, function (response) {
                if(response){
                    window.location.reload();
                }
            });

        } else {
            status = 0;
            $.post('/admin/all-insurance', {_token : $('meta[name="csrf-token"]').attr('content'), checked: status}, function (response) {

                if(response){
                    window.location.reload();
                }
            });
        }
    });

    $('#inActiveRentExtras').on('click',function(e){

        var check = document.getElementById("inActiveRentExtras").checked;
        var status = null;


        if (check) {
            status = 1;
            $.post('/admin/all-rent-extras', {_token : $('meta[name="csrf-token"]').attr('content'), checked: status}, function (response) {
                if(response){
                    window.location.reload();
                }
            });

        } else {
            status = 0;
            $.post('/admin/all-rent-extras', {_token : $('meta[name="csrf-token"]').attr('content'), checked: status}, function (response) {

                if(response){
                    window.location.reload();
                }
            });
        }
    });

    $('#inActiveRules').on('click',function(e){

        var check = document.getElementById("inActiveRules").checked;
        var status = null;


        if (check) {
            status = 1;
            $.post('/admin/all-price-rules', {_token : $('meta[name="csrf-token"]').attr('content'), checked: status}, function (response) {
                if(response){
                    window.location.reload();
                }
            });

        } else {
            status = 0;
            $.post('/admin/all-price-rules', {_token : $('meta[name="csrf-token"]').attr('content'), checked: status}, function (response) {

                if(response){
                    window.location.reload();
                }
            });
        }
    });

    $('#inActivePrices').on('click',function(e){

        var check = document.getElementById("inActivePrices").checked;
        var status = null;


        if (check) {
            status = 1;
            $.post('/admin/all-prices', {_token : $('meta[name="csrf-token"]').attr('content'), checked: status}, function (response) {
                if(response){
                    window.location.reload();
                }
            });

        } else {
            status = 0;
            $.post('/admin/all-prices', {_token : $('meta[name="csrf-token"]').attr('content'), checked: status}, function (response) {

                if(response){
                    window.location.reload();
                }
            });
        }
    });

    $('#inActiveCoupons').on('click',function(e){

        var check = document.getElementById("inActiveCoupons").checked;
        var status = null;


        if (check) {
            status = 1;
            $.post('/admin/all-coupons', {_token : $('meta[name="csrf-token"]').attr('content'), checked: status}, function (response) {
                if(response){
                    window.location.reload();
                }
            });

        } else {
            status = 0;
            $.post('/admin/all-coupons', {_token : $('meta[name="csrf-token"]').attr('content'), checked: status}, function (response) {

                if(response){
                    window.location.reload();
                }
            });
        }
    });

    // end in active Fleet checkbox

    // add maker
    $("#addMaker").click(function() {
        var token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'post',
            url: '/admin/add-maker',
            data: {
                '_token': token,
                'name': $('input[name=name]').val()
            },
            success: function(data) {
                if ((data.errors)) {
                    $('.error').removeClass('hidden');
                    $('.error').text(data.errors.name);
                } else {
                    console.log(data);

                    $('.error').remove();
                    $('#table').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.MakerName + "</td><td><button class='edit-modal-maker btn btn-info' data-id='" + data.id + "' data-name='" + data.MakerName + "'><i class='fa fa-edit'></i> Edit</button> <button class='delete-modal-maker btn btn-danger' data-id='" + data.id + "' data-name='" + data.MakerName + "'><i class='fa fa-trash'></i> Delete</button></td></tr>");
                }
            },
        });
        $('#name').val('');
    });
    //
    //----update maker----
    $(".edit-modal-maker").click(function() {

        $('#footer_action_button').text(" Update");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Edit');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        $('#fid').val($(this).data('id'));
        $('#n').val($(this).data('name'));
        $('#editModal').modal('show');
    });


        $(".delete-modal-maker").click(function() {
        $('#footer_action_button').text(" Delete");
        $('#footer_action_button').removeClass('glyphicon-check');
        $('#footer_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').addClass('delete');
        $('.modal-title').text('Delete');
        $('.did').text($(this).data('id'));
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        $('.dname').html($(this).data('name'));
        $('#editModal').modal('show');
    });


    $('.modal-footer').on('click', '.edit', function() {
        var token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'post',
            url: '/admin/edit-maker',
            data: {
                '_token': token,
                'id': $("#fid").val(),
                'name': $('#n').val()
            },
            success: function(data) {
                $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" + data.MakerName + "</td><td><button class='edit-modal-maker btn btn-info' data-id='" + data.id + "' data-name='" + data.MakerName + "'><i class='fa fa-edit'></i>Edit</button> <button class='delete-modal-maker btn btn-danger' data-id='" + data.id + "' data-name='" + data.MakerName + "' ><i class='fa fa-trash'></i>Delete</button></td></tr>");
            }
        });
    });
    $('.modal-footer').on('click', '.delete', function() {
        var token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'post',
            url: '/admin/delete-maker',
            data: {
                '_token': token,
                'id': $('.did').text()
            },
            success: function(data) {
                $('.item' + $('.did').text()).remove();
            }
        });
    });

    /**
     * for showing create country  popup
     */

    $(document).on('click', "#create-country", function() {
        $(this).addClass('create-item-country-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

        var options = {
            'backdrop': 'static'
        };
        $('#create-modal-country').modal(options)
    })

// on modal show country
    $('#create-modal-country').on('show.bs.modal', function() {
        var el = $(".create-item-country-trigger-clicked"); // See how its usefull right here?
        // var et = document.getElementsByClassName('edit-item-trigger-clicked');
        var row = el.closest(".table-row");

        // get the data
        var id = el.data('item-id');
        var name = row.children(".name").text();
        var userName = row.children(".user-name").text();
        var email = row.children(".email").text();
        var role = row.children(".role").text();
        var status = row.children(".status").text();

        // fill the data in the input fields
        $("#modal-input-id").val(id);
        $("#modal-input-name").val(name);
        $("#modal-input-username").val(userName);
        $("#modal-input-email").val(email);
        $("#modal-input-role").val(role);
        $("#modal-input-status").val(status);

    })

    // on modal hide
    $('#create-modal-country').on('hide.bs.modal', function() {
        $('.create-item-country-trigger-clicked').removeClass('create-item-country-trigger-clicked')
        $("#createCountryForm").trigger("reset");
    })

    /**
     * for showing edit item popup
     */

    $(document).on('click', "#edit-country", function() {
        $(this).addClass('edit-item-country-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

        var options = {
            'backdrop': 'static'
        };
        $('#edit-modal-country').modal(options)
    })

    $('#edit-modal-country').on('show.bs.modal', function() {
        var el = $(".edit-item-country-trigger-clicked"); // See how its usefull right here?
        var row = el.closest(".table-row");

        // get the data
        var id = el.data('item-id');
        var name = row.children(".name").text();
        var prefix = row.children(".prefix").text();
        var status = row.children(".status").text();

        // fill the data in the input fields
        $("#country-id-edit").val(id);
        $("#name-edit").val(name);
        $("#prefix-edit").val(prefix);
        if(status === 'Active'){
            $("#status-edit").val(1);
        }else{
            $("#status-edit").val(2);
        }


    })

    // on modal hide
    $('#edit-modal-country').on('hide.bs.modal', function() {
        $('.edit-item-country-trigger-clicked').removeClass('edit-item-country-trigger-clicked')
        $("#editCountryForm").trigger("reset");
    })

    $('#editCountryForm').submit(function(e){
        var $form = $(this);

        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var url = $form.attr('action');
        var formData = {};

        //submit a POST request with the form data
        $form.find(':input').each(function()
        {
            formData[ $(this).attr('name') ] = $(this).val();

        });

        //submits an array of key-value pairs to the form's action URL
        $.post(url, formData, function(response) {
            //handle successful validation

            if(response.fail){
                associate_errors(response['errors'], $form);
            }else{
                $('.edit-item-country-trigger-clicked').removeClass('edit-item-country-trigger-clicked')
                $('.form-group').removeClass('has-errors').find('.help-text').text('')
                $("#editCountryForm").trigger("reset");
                $("#edit-modal-country").modal("hide");
                window.location.reload();
            }
        }).fail(function(response) {
            //handle failed validation
            associate_errors(response['errors'], $form);
        });
    });

    $('#createCountryForm').submit(function(e){
        var $form = $(this);

        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var url = $form.attr('action');
        var formData = {};

        //submit a POST request with the form data
        $form.find(':input').each(function()
        {
            formData[ $(this).attr('name') ] = $(this).val();

        });
        //submits an array of key-value pairs to the form's action URL
        $.post(url, formData, function(response) {
            //handle successful validation

            if(response.fail){
                associate_errors(response['errors'], $form);
            }else{
                $('.create-item-country-trigger-clicked').removeClass('create-item-country-trigger-clicked')
                $('.form-group').removeClass('has-errors').find('.help-text').text('')
                $("#createCountryForm").trigger("reset");
                $("#create-modal-country").modal("hide");
                window.location.reload();
            }
        }).fail(function(response) {
            //handle failed validation
            associate_errors(response['errors'], $form);
        });
    });


    /**
     * for showing create city transfer popup
     */

    $(document).on('click', "#create-city-transfer", function() {
        $(this).addClass('create-item-city-transfer-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

        var options = {
            'backdrop': 'static'
        };
        $('#create-modal-city-transfer').modal(options)
    })

// on modal show country
    $('#create-modal-city-transfer').on('show.bs.modal', function() {
        var el = $(".create-item-city-transfer-trigger-clicked"); // See how its usefull right here?
        // var et = document.getElementsByClassName('edit-item-trigger-clicked');
        var row = el.closest(".table-row");

    })

    // on modal hide
    $('#create-modal-city-transfer').on('hide.bs.modal', function() {
        $('.create-item-city-transfer-trigger-clicked').removeClass('create-item-city-transfer-trigger-clicked')
        $("#createCityTransferForm").trigger("reset");
    })

    $('#createCityTransferForm').submit(function(e){
        var $form = $(this);

        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var url = $form.attr('action');
        var formData = {};

        //submit a POST request with the form data
        $form.find(':input').each(function()
        {
            formData[ $(this).attr('name') ] = $(this).val();

        });

        //submits an array of key-value pairs to the form's action URL
        $.post(url, formData, function(response) {
            //handle successful validation
            if(response.fail){
                associate_errors(response['errors'], $form);
            }else{
                $('.create-item-city-transfer-trigger-clicked').removeClass('create-item-city-transfer-trigger-clicked')
                $('.form-group').removeClass('has-errors').find('.help-text').text('')
                $("#createCityTransferForm").trigger("reset");
                $("#create-modal-city-transfer").modal("hide");
                window.location.reload();
            }
        }).fail(function(response) {
            //handle failed validation
            associate_errors(response['errors'], $form);
        });
    });

    /**
     * for showing edit item popup
     */

    $(document).on('click', "#edit-city-transfer", function() {
        $(this).addClass('edit-item-city-transfer-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

        var options = {
            'backdrop': 'static'
        };
        $('#edit-modal-city-transfer').modal(options)
    })

    $('#edit-modal-city-transfer').on('show.bs.modal', function() {
        var el = $(".edit-item-city-transfer-trigger-clicked"); // See how its usefull right here?
        var row = el.closest(".table-row");
        // get the data
        var id = el.data('item-id');
        var name1 = row.children(".name1").attr('data-content');;
        var name2 = row.children(".name2").attr('data-content');;
        var price = row.children(".price").attr('data-content');
        var status = row.children(".status").text();

        // fill the data in the input fields
        $("#city-id-edit").val(id);
        $("#cityFrom-id-edit").val(name1);
        $("#cityTo-id-edit").val(name2);
        $("#price-city-edit").val(price);
        if(status === 'Active'){
            $("#status-edit-city").val(1);
        }else{
            $("#status-edit-city").val(2);
        }

    })

    // on modal hide
    $('#edit-modal-city-transfer').on('hide.bs.modal', function() {
        $('.edit-item-city-transfer-trigger-clicked').removeClass('edit-item-city-transfer-trigger-clicked')
        $("#editCityTransferForm").trigger("reset");
    })

    $('#editCityTransferForm').submit(function(e){
        var $form = $(this);

        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var url = $form.attr('action');
        var formData = {};

        //submit a POST request with the form data
        $form.find(':input').each(function()
        {
            formData[ $(this).attr('name') ] = $(this).val();

        });

        //submits an array of key-value pairs to the form's action URL
        $.post(url, formData, function(response) {
            //handle successful validation

            if(response.fail){
                associate_errors(response['errors'], $form);
            }else{
                $('.edit-item-city-transfer-trigger-clicked').removeClass('edit-item-city-transfer-trigger-clicked')
                $('.form-group').removeClass('has-errors').find('.help-text').text('')
                $("#editCityTransferForm").trigger("reset");
                $("#edit-modal-city-transfer").modal("hide");
                window.location.reload();
            }
        }).fail(function(response) {
            //handle failed validation
            associate_errors(response['errors'], $form);
        });
    });


    /**
     * for showing create city  popup
     */

    $(document).on('click', "#create-city", function() {
        $(this).addClass('create-item-country-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

        var options = {
            'backdrop': 'static'
        };
        $('#create-modal-city').modal(options)
    })

// on modal show country
    $('#create-modal-city').on('show.bs.modal', function() {
        var el = $(".create-item-city-trigger-clicked"); // See how its usefull right here?
        // var et = document.getElementsByClassName('edit-item-trigger-clicked');
        var row = el.closest(".table-row");

    })

    // on modal hide
    $('#create-modal-city').on('hide.bs.modal', function() {
        $('.create-item-city-trigger-clicked').removeClass('create-item-country-trigger-clicked')
        $("#createCityForm").trigger("reset");
    })

    $('#createCityForm').submit(function(e){
        var $form = $(this);

        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var url = $form.attr('action');
        var formData = {};

        //submit a POST request with the form data
        $form.find(':input').each(function()
        {
            formData[ $(this).attr('name') ] = $(this).val();

        });

        //submits an array of key-value pairs to the form's action URL
        $.post(url, formData, function(response) {
            //handle successful validation
            if(response.fail){
                associate_errors(response['errors'], $form);
            }else{
                $('.create-item-city-trigger-clicked').removeClass('create-item-city-trigger-clicked')
                $('.form-group').removeClass('has-errors').find('.help-text').text('')
                $("#createCityForm").trigger("reset");
                $("#create-modal-city").modal("hide");
                window.location.reload();
            }
        }).fail(function(response) {
            //handle failed validation
            associate_errors(response['errors'], $form);
        });
    });

    /**
     * for showing edit item popup
     */

    $(document).on('click', "#edit-city", function() {
        $(this).addClass('edit-item-city-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

        var options = {
            'backdrop': 'static'
        };
        $('#edit-modal-city').modal(options)
    })

    $('#edit-modal-city').on('show.bs.modal', function() {
        var el = $(".edit-item-city-trigger-clicked"); // See how its usefull right here?
        var row = el.closest(".table-row");
        // get the data
        var id = el.data('item-id');
        var name = row.children(".name").text();
        var country = row.children(".country").attr('data-content');
        var status = row.children(".status").text();

        // fill the data in the input fields
        $("#city-id-edit").val(id);
        $("#city-name-edit").val(name);
        $("#city-country-id-edit").val(country);
        if(status === 'Active'){
            $("#status-edit-city").val(1);
        }else{
            $("#status-edit-city").val(2);
        }

    })

    // on modal hide
    $('#edit-modal-city').on('hide.bs.modal', function() {
        $('.edit-item-city-trigger-clicked').removeClass('edit-item-city-trigger-clicked')
        $("#editCityForm").trigger("reset");
    })

    $('#editCityForm').submit(function(e){
        var $form = $(this);

        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var url = $form.attr('action');
        var formData = {};

        //submit a POST request with the form data
        $form.find(':input').each(function()
        {
            formData[ $(this).attr('name') ] = $(this).val();

        });

        //submits an array of key-value pairs to the form's action URL
        $.post(url, formData, function(response) {
            //handle successful validation

            if(response.fail){
                associate_errors(response['errors'], $form);
            }else{
                $('.edit-item-city-trigger-clicked').removeClass('edit-item-city-trigger-clicked')
                $('.form-group').removeClass('has-errors').find('.help-text').text('')
                $("#editCityForm").trigger("reset");
                $("#edit-modal-city").modal("hide");
                window.location.reload();
            }
        }).fail(function(response) {
            //handle failed validation
            associate_errors(response['errors'], $form);
        });
    });


    /**
     * for showing create office  popup
     */

    $(document).on('click', "#create-office", function() {
        $(this).addClass('create-item-office-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

        var options = {
            'backdrop': 'static'
        };
        $('#create-modal-office').modal(options)
    })

// on modal show country
    $('#create-modal-office').on('show.bs.modal', function() {
        var el = $(".create-item-office-trigger-clicked"); // See how its usefull right here?
        // var et = document.getElementsByClassName('edit-item-trigger-clicked');
        var row = el.closest(".table-row");

    })

    // on modal hide
    $('#create-modal-office').on('hide.bs.modal', function() {
        $('.create-item-office-trigger-clicked').removeClass('create-item-office-trigger-clicked')
        $("#createCityForm").trigger("reset");
    })

    $('#createOfficeForm').submit(function(e){
        var $form = $(this);

        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var url = $form.attr('action');
        var formData = {};

        //submit a POST request with the form data
        $form.find(':input').each(function()
        {
            formData[ $(this).attr('name') ] = $(this).val();

        });

        //submits an array of key-value pairs to the form's action URL
        $.post(url, formData, function(response) {
            //handle successful validation

            if(response.fail){
                associate_errors(response['errors'], $form);
            }else{
                $('.create-item-office-trigger-clicked').removeClass('create-item-office-trigger-clicked')
                $('.form-group').removeClass('has-errors').find('.help-text').text('')
                $("#createCityForm").trigger("reset");
                $("#create-modal-city").modal("hide");
                window.location.reload();
            }
        }).fail(function(response) {
            //handle failed validation
            associate_errors(response['errors'], $form);
        });
    });

    /**
     * for showing edit item popup
     */

    $(document).on('click', "#edit-office", function() {
        $(this).addClass('edit-item-office-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
        var options = {
            'backdrop': 'static'
        };
        $('#edit-modal-office').modal(options)
    })

    $('#edit-modal-office').on('show.bs.modal', function() {
        var el = $(".edit-item-office-trigger-clicked"); // See how its usefull right here?
        var row = el.closest(".table-row");

        // get the data
        var id = el.data('item-id');
        var name = row.children(".name").text();
        var country = row.children(".country").attr('data-content');
        var city = row.children(".city").attr('data-content');
        var status = row.children(".status").text();
        var phone = row.children(".phone").text();
        var address = row.children(".address").text();
        var email = row.children(".email").text();

        // fill the data in the input fields
        $("#office-id-edit").val(id);
        $("#name-office-edit").val(name);
        $("#country-id-edit").val(country);
        $("#city-id-edit").val(city);
        if(status === 'Active'){
            $("#status-edit-office").val(1);
        }else{
            $("#status-edit-office").val(2);
        }

        $("#phone-office-edit").val(phone);
        $("#address-office-edit").val(address);
        $("#email-office-edit").val(email);

    })

    // on modal hide
    $('#edit-modal-office').on('hide.bs.modal', function() {
        $('.edit-item-office-trigger-clicked').removeClass('edit-item-office-trigger-clicked')
        $("#editOfficeForm").trigger("reset");
    })

    $('#editOfficeForm').submit(function(e){
        var $form = $(this);

        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var url = $form.attr('action');
        var formData = {};

        //submit a POST request with the form data
        $form.find(':input').each(function()
        {
            formData[ $(this).attr('name') ] = $(this).val();

        });

        //submits an array of key-value pairs to the form's action URL
        $.post(url, formData, function(response) {
            //handle successful validation
            if(response.fail){
                associate_errors(response['errors'], $form);
            }else{
                $('.edit-item-office-trigger-clicked').removeClass('edit-item-office-trigger-clicked')
                $('.form-group').removeClass('has-errors').find('.help-text').text('')
                $("#editOfficeForm").trigger("reset");
                $("#edit-modal-office").modal("hide");
                window.location.reload();
            }
        }).fail(function(response) {
            //handle failed validation
            associate_errors(response['errors'], $form);
        });
    });

    /**
     * for showing create fleet  popup
     */

    $(document).on('click', "#create-fleet", function() {
        $(this).addClass('create-item-fleet-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

        var options = {
            'backdrop': 'static'
        };
        $('#create-modal-fleet').modal(options)
    })

    // on modal show Fleet
    $('#create-modal-fleet').on('show.bs.modal', function() {
        var el = $(".create-item-fleet-trigger-clicked"); // See how its usefull right here?
        // var et = document.getElementsByClassName('edit-item-trigger-clicked');
        var row = el.closest(".table-row");

    })

    // on modal hide
    $('#create-modal-fleet').on('hide.bs.modal', function() {
        $('.create-item-fleet-trigger-clicked').removeClass('create-item-fleet-trigger-clicked')
        $("#createFleetForm").trigger("reset");
    })

    $('#createFleetForm').submit(function(e){
        var $form = $(this);

        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var url = $form.attr('action');
        var formData = {};

        //submit a POST request with the form data
        $form.find(':input').each(function()
        {
            formData[ $(this).attr('name') ] = $(this).val();

        });

        //submits an array of key-value pairs to the form's action URL
        $.post(url, formData, function(response) {
            //handle successful validation
            if(response.errors){
                associate_errors(response['errors'], $form);
            }else{
                $('.create-item-fleet-trigger-clicked').removeClass('create-item-fleet-trigger-clicked')
                $('.form-group').removeClass('has-errors').find('.help-text').text('')
                $("#createFleetForm").trigger("reset");
                $("#create-modal-fleet").modal("hide");
                window.location.reload();
            }
        }).fail(function(response) {

            //handle failed validation
            associate_errors(response['errors'], $form);
        });
    });

    /**
     * for showing edit fleet popup
     */

    $(document).on('click', "#edit-fleet", function() {
        $(this).addClass('edit-item-fleet-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
        var options = {
            'backdrop': 'static'
        };
        $('#edit-modal-fleet').modal(options)
    })

    $('#edit-modal-fleet').on('show.bs.modal', function() {
        var el = $(".edit-item-fleet-trigger-clicked"); // See how its usefull right here?
        var row = el.closest(".table-row");
        // get the data
        var id = el.data('item-id');
        var token = $('meta[name="csrf-token"]').attr('content');
        var data = {
                '_token': token,
                'id': id
            };
        var url= '/admin/get-type-fleet';

        // get langs
        $.post(url, data, function(response) {
            //handle successful validation
            if(response.error){

            }else{
                for (var key in response) {
                    var lng = response[key].locale;
                    var name = response[key].DefaultName;

                    $("#name-fleet-"+ lng +"-edit").val(name);
                }
            }
        }).fail(function(response) {
            //handle failed validation
        });

        // fill the data in the input fields
        $("#fleet-id-edit").val(id);
        var status = row.children(".status").attr('data-content');
        $("#status-edit-fleet").val(status);

    })

    // on modal hide
    $('#edit-modal-fleet').on('hide.bs.modal', function() {
        $('.edit-item-fleet-trigger-clicked').removeClass('edit-item-fleet-trigger-clicked')
        $("#editFleetForm").trigger("reset");
    })

    $('#editFleetForm').submit(function(e){
        var $form = $(this);

        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var url = $form.attr('action');
        var formData = {};

        //submit a POST request with the form data
        $form.find(':input').each(function()
        {
            formData[ $(this).attr('name') ] = $(this).val();

        });

        //submits an array of key-value pairs to the form's action URL
        $.post(url, formData, function(response) {
            //handle successful validation
            if(response.fail){
                associate_errors(response['errors'], $form);
            }else{
                $('.edit-item-fleet-trigger-clicked').removeClass('edit-item-fleet-trigger-clicked')
                $('.form-group').removeClass('has-errors').find('.help-text').text('')
                $("#editFleetForm").trigger("reset");
                $("#edit-modal-fleet").modal("hide");
                window.location.reload();
            }
        }).fail(function(response) {
            //handle failed validation
            associate_errors(response['errors'], $form);
        });
    });


    /**
     * for showing create model  popup
     */

    $(document).on('click', "#create-model", function() {
        $(this).addClass('create-item-model-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

        var options = {
            'backdrop': 'static'
        };
        $('#create-modal-model').modal(options)
    })

// on modal show country
    $('#create-modal-model').on('show.bs.modal', function() {
        var el = $(".create-item-model-trigger-clicked"); // See how its usefull right here?
        var row = el.closest(".table-row");

    })

    // on modal hide
    $('#create-modal-model').on('hide.bs.modal', function() {
        $('.create-item-model-trigger-clicked').removeClass('create-item-country-trigger-clicked')
        $("#createModelForm").trigger("reset");
    })

    $('#createModelForm').submit(function(e){
        var $form = $(this);

        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var url = $form.attr('action');
        var formData = {};
        console.log(formData);
        //submit a POST request with the form data
        $form.find(':input').each(function()
        {
            formData[ $(this).attr('name') ] = $(this).val();

        });

        //submits an array of key-value pairs to the form's action URL
        $.post(url, formData, function(response) {
            //handle successful validation

            if(response.fail){
                associate_errors(response['errors'], $form);
            }else{

                $('.create-item-model-trigger-clicked').removeClass('create-item-model-trigger-clicked')
                $('.form-group').removeClass('has-errors').find('.help-text').text('')
                $("#createModelForm").trigger("reset");
                $("#create-modal-model").modal("hide");
                window.location.reload();
            }
        }).fail(function(response) {
            //handle failed validation
            associate_errors(response['errors'], $form);
        });
    });

    $('#upload').click(function(e){
        var $form = $(this);
        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var token = $('meta[name="csrf-token"]').attr('content');
        var files = $('#file')[0].files[0];
        var name = $("#image_name").val();

        var fd = new FormData();
        fd.append('file',files);
        fd.append('_token',token);
        fd.append('name',name);

        $(".progress").show();

       // AJAX request
        $.ajax({
            url: '/admin/temp-upload-image',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                if(response.success){
                    // Show image preview
                    $(".tiw").show();
                    $("#image_name").val(response.name);
                    $('.image-preview').remove();
                    $('#preview-temp').append("<div class='image-preview'><img src='"+response.path+"' width='300' height='200' style='display: inline-block;'></div>");


                }else{
                    $(".tiw").hide();
                    $("#file").replaceWith($("#file").val('').clone(true));
                    $('.image-preview').remove();
                    $(".progress").hide();
                    alert('file not uploaded');
                }
            },
            xhr: function () {
                var xhr = $.ajaxSettings.xhr();
                xhr.upload.onprogress = function (e) {
                    $(".progress-bar").attr("style", "width:" + Math.floor(e.loaded / e.total * 100) + "%");
                    $(".progress-bar").html(Math.floor(e.loaded / e.total * 100) + "%");
                };
                return xhr;
            },
        });
    });

    $('#upload_edit').click(function(e){
        var $form = $(this);
        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form

        var token = $('meta[name="csrf-token"]').attr('content');
        var files = $('#file_edit')[0].files[0];
        var name = $("#image_name_edit").val();

        var fd = new FormData();
        fd.append('file',files);
        fd.append('_token',token);
        fd.append('name',name);

        $(".progress").show();

        // AJAX request
        $.ajax({
            url: '/admin/temp-upload-image',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                if(response.success){
                    // Show image preview
                    $(".image-preview-default").hide();
                    $(".tiw").show();
                    $(".tiw_old").hide();
                    $("#image_name_edit").val(response.name);
                    $('.image-preview').remove();

                    $('#preview-temp-edit').append("<div class='image-preview'><img src='"+response.path+"' width='300' height='200' style='display: inline-block;'></div>");
                }else{
                    $(".tiw").hide();
                    $("#file").replaceWith($("#file").val('').clone(true));
                    $('.image-preview').remove();
                    $(".progress").hide();
                    alert('file not uploaded');
                }
            },
            xhr: function () {
                var xhr = $.ajaxSettings.xhr();
                xhr.upload.onprogress = function (e) {
                    $(".progress-bar").attr("style", "width:" + Math.floor(e.loaded / e.total * 100) + "%");
                    $(".progress-bar").html(Math.floor(e.loaded / e.total * 100) + "%");
                };
                return xhr;
            },
        });

    });

    $('#delete-tmp-image').click(function(e){

        var $form = $(this);
        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var token = $('meta[name="csrf-token"]').attr('content');

        var fd = new FormData();
        fd.append('name', $('#image_name').val());
        fd.append('_token', token);

       // AJAX request
        $.ajax({
            url: '/admin/temp-delete-image',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                if(response != 0){
                    $(".tiw").hide();
                    $("#image_name").val('');
                    $("#file").replaceWith($("#file").val('').clone(true));
                    $('.image-preview').remove();
                    $(".progress").hide();

                }else{

                }
            }
        });

    });
    $('#delete-tmp-image-edit').click(function(e){

        var $form = $(this);
        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var token = $('meta[name="csrf-token"]').attr('content');

        var fd = new FormData();
        fd.append('name',$('#image_name_edit').val());
        fd.append('_token',token);

        // AJAX request
        $.ajax({
            url: '/admin/temp-delete-image',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                if(response != 0){
                    $(".tiw").hide();
                    $("#image_name_edit").val('');
                    $("#file_edit").replaceWith($("#file_edit").val('').clone(true));
                    $('.image-preview').remove();
                    $(".progress").hide();
                    $(".image-preview-default").show();

                }else{

                }
            }
        });

    });

    $('#delete-old-image-edit').click(function(e){
        var $form = $(this);
        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        $("#edit_image_name_delete").val(1);
        $('#preview').hide();

    });

    /**
     * for showing edit item popup
     */

    $(document).on('click', "#edit-model", function() {
        $(this).addClass('edit-item-model-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
        var options = {
            'backdrop': 'static'
        };
        $('#edit-modal-model').modal(options)
    })

    $('#edit-modal-model').on('show.bs.modal', function() {
        var el = $(".edit-item-model-trigger-clicked"); // See how its usefull right here?
        var row = el.closest(".table-row");

        // get the data
        var id = el.data('item-id');
        var name = row.children(".name").text();
        var maker = row.children(".maker").attr('data-content');
        var type = row.children(".type").attr('data-content');
        var status = row.children(".status").text();
        var year = row.children(".year").text();
        var baseprice = row.children(".baseprice").text();
        var image_path = row.children(".photo").attr('data-content');
        var image = row.children(".photo_name").attr('data-content');

        // fill the data in the input fields
        $("#model-id-edit").val(id);
        $("#edit-maker-id").val(maker);
        $("#model-name-edit").val(name);
        $("#edit-model-year").val(year);
        $("#edit-type-id").val(type);
        $("#edit-model-price").val(baseprice);
        if(status === 'Active'){
            $("#status-edit-model").val(1);
        }else{
            $("#status-edit-model").val(2);
        }

        if(image && image !=='')
        {
            $(".tiw_old").show();
            $("#edit-image_name").val(image);
            $('#preview').append("<div id='image-preview-default' class='image-preview-default'><img src='"+image_path+"' width='300' height='200' style='display: inline-block;'></div>");
        }else{
            $("#edit-image_name").val('car.png');
            $('#preview').append("<div id='image-preview-default' class='image-preview-default'><img src='"+image_path + 'car.png' +"' width='300' height='200' style='display: inline-block;'></div>");
        }
        $('#preview').show();

    })

    // on modal hide
    $('#edit-modal-model').on('hide.bs.modal', function() {
        $('.edit-item-model-trigger-clicked').removeClass('edit-item-model-trigger-clicked')
        $('.image-preview-default').remove();
        $("#editModelForm").trigger("reset");
    })

    $('#editModelForm').submit(function(e){
        var $form = $(this);
        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var url = $form.attr('action');
        var formData = {};

        //submit a POST request with the form data
        $form.find(':input').each(function()
        {
            formData[ $(this).attr('name') ] = $(this).val();

        });

       // submits an array of key-value pairs to the form's action URL
        $.post(url, formData, function(response) {
            //handle successful validation

            if(response.fail){
                associate_errors(response['errors'], $form);
            }else{
                $('.edit-item-model-trigger-clicked').removeClass('edit-item-model-trigger-clicked')
                $('.form-group').removeClass('has-errors').find('.help-text').text('')
                $("#editModelForm").trigger("reset");
                $("#edit-modal-model").modal("hide");
                window.location.reload();
            }
        }).fail(function(response) {
            //handle failed validation
            associate_errors(response['errors'], $form);
        });
    });


    /**
     * for showing create fuel  popup
     */

    $(document).on('click', "#create-fuel", function() {
        $(this).addClass('create-item-fuel-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
        var options = {
            'backdrop': 'static'
        };
        $('#create-modal-fuel').modal(options)
    })

    // on modal show Fleet
    $('#create-modal-fuel').on('show.bs.modal', function() {
        var el = $(".create-item-fuel-trigger-clicked"); // See how its usefull right here?
        // var et = document.getElementsByClassName('edit-item-trigger-clicked');
        var row = el.closest(".table-row");

    })

    // on modal hide
    $('#create-modal-fuel').on('hide.bs.modal', function() {
        $('.create-item-fuel-trigger-clicked').removeClass('create-item-fuel-trigger-clicked')
        $("#createFuelForm").trigger("reset");
    })

    $('#createFuelForm').submit(function(e){
        var $form = $(this);

        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var url = $form.attr('action');
        var formData = {};

        //submit a POST request with the form data
        $form.find(':input').each(function()
        {
            formData[ $(this).attr('name') ] = $(this).val();
        });

        //submits an array of key-value pairs to the form's action URL
        $.post(url, formData, function(response) {
            //handle successful validation
            if(response.errors){
                associate_errors(response['errors'], $form);
            }else{
                $('.create-item-fuel-trigger-clicked').removeClass('create-item-fuel-trigger-clicked')
                $('.form-group').removeClass('has-errors').find('.help-text').text('')
                $("#createFuelForm").trigger("reset");
                $("#create-modal-fuel").modal("hide");
                window.location.reload();
            }
        }).fail(function(response) {
            //handle failed validation
            associate_errors(response['errors'], $form);
        });
    });

    /**
     * for showing edit fuel popup
     */

    $(document).on('click', "#edit-fuel", function() {
        $(this).addClass('edit-item-fuel-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

        var options = {
            'backdrop': 'static'
        };
        $('#edit-modal-fuel').modal(options)
    })

    $('#edit-modal-fuel').on('show.bs.modal', function() {
        var el = $(".edit-item-fuel-trigger-clicked"); // See how its usefull right here?
        var row = el.closest(".table-row");

        // get the data
        var id = el.data('item-id');
        var token = $('meta[name="csrf-token"]').attr('content');
        var data = {
            '_token': token,
            'id': id
        };
        var url= '/admin/get-type-fuel';

        // get langs
        $.post(url, data, function(response) {
            //handle successful validation
            if(response.error){

            }else{
                for (var key in response) {
                    var lng = response[key].locale;
                    var name = response[key].Name;

                    $("#name-fuel-"+ lng +"-edit").val(name);
                }
            }
        }).fail(function(response) {
            //handle failed validation
        });

        var status = row.children(".status").attr('data-content');

        // fill the data in the input fields
        $("#fuel-id-edit").val(id);
        $("#status-edit-fuel").val(status);

    })

    // on modal hide
    $('#edit-modal-fuel').on('hide.bs.modal', function() {
        $('.edit-item-fuel-trigger-clicked').removeClass('edit-item-fuel-trigger-clicked')
        $("#editFuelForm").trigger("reset");
    })

    $('#editFuelForm').submit(function(e){
        var $form = $(this);

        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var url = $form.attr('action');
        var formData = {};

        //submit a POST request with the form data
        $form.find(':input').each(function()
        {
            formData[ $(this).attr('name') ] = $(this).val();

        });

        //submits an array of key-value pairs to the form's action URL
        $.post(url, formData, function(response) {
            //handle successful validation

            if(response.fail){
                associate_errors(response['errors'], $form);
            }else{
                $('.edit-item-fuel-trigger-clicked').removeClass('edit-item-fuel-trigger-clicked')
                $('.form-group').removeClass('has-errors').find('.help-text').text('')
                $("#editFuelForm").trigger("reset");
                $("#edit-modal-fuel").modal("hide");
                window.location.reload();
            }
        }).fail(function(response) {

            //handle failed validation
            associate_errors(response['errors'], $form);
        });
    });

    // car extras
    /**
     * for showing create car extras  popup
     */

    $(document).on('click', "#create-carextra", function() {
        $(this).addClass('create-item-carextra-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
        var options = {
            'backdrop': 'static'
        };
        $('#create-modal-carextra').modal(options)
    })

    // on modal show Fleet
    $('#create-modal-carextra').on('show.bs.modal', function() {
        var el = $(".create-item-carextra-trigger-clicked"); // See how its usefull right here?
        // var et = document.getElementsByClassName('edit-item-trigger-clicked');
        var row = el.closest(".table-row");

    })

    // on modal hide
    $('#create-modal-carextra').on('hide.bs.modal', function() {
        $('.create-item-carextra-trigger-clicked').removeClass('create-item-carextra-trigger-clicked')
        $("#createCarExtraForm").trigger("reset");
    })

    $('#createCarExtraForm').submit(function(e){
        var $form = $(this);

        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var url = $form.attr('action');
        var formData = {};

        //submit a POST request with the form data
        $form.find(':input').each(function()
        {
            formData[ $(this).attr('name') ] = $(this).val();
        });

        //submits an array of key-value pairs to the form's action URL
        $.post(url, formData, function(response) {
            //handle successful validation
            if(response.errors){

                associate_errors(response['errors'], $form);
            }else{

                $('.create-item-carextra-trigger-clicked').removeClass('create-item-carextra-trigger-clicked')
                $('.form-group').removeClass('has-errors').find('.help-text').text('')
                $("#createCarExtraForm").trigger("reset");
                $("#create-modal-fuel").modal("hide");
                window.location.reload();
            }
        }).fail(function(response) {

            //handle failed validation
            associate_errors(response['errors'], $form);
        });
    });

    /**
     * for showing edit car extra popup
     */

    $(document).on('click', "#edit-carextra", function() {
        $(this).addClass('edit-item-carextra-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

        var options = {
            'backdrop': 'static'
        };
        $('#edit-modal-carextra').modal(options)
    })

    $('#edit-modal-carextra').on('show.bs.modal', function() {
        var el = $(".edit-item-carextra-trigger-clicked"); // See how its usefull right here?
        var row = el.closest(".table-row");

        // get the data
        var id = el.data('item-id');
        var token = $('meta[name="csrf-token"]').attr('content');
        var data = {
            '_token': token,
            'id': id
        };
        var url= '/admin/get-type-carextra';

        // get langs
        $.post(url, data, function(response) {
            //handle successful validation
            if(response.error){

            }else{
                for (var key in response) {
                    var lng = response[key].locale;
                    var name = response[key].DefaultName;

                    $("#name-carextra-"+ lng +"-edit").val(name);
                }
            }
        }).fail(function(response) {
            //handle failed validation
        });

        var status = row.children(".status").attr('data-content');

        // fill the data in the input fields
        $("#carextra-id-edit").val(id);
        $("#status-edit-carextra").val(status);

    })

    // on modal hide
    $('#edit-modal-carextra').on('hide.bs.modal', function() {
        $('.edit-item-carextra-trigger-clicked').removeClass('edit-item-carextra-trigger-clicked')
        $("#editCarExtraForm").trigger("reset");
    })

    $('#editCarExtraForm').submit(function(e){
        var $form = $(this);

        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var url = $form.attr('action');
        var formData = {};

        //submit a POST request with the form data
        $form.find(':input').each(function()
        {
            formData[ $(this).attr('name') ] = $(this).val();

        });

        //submits an array of key-value pairs to the form's action URL
        $.post(url, formData, function(response) {
            //handle successful validation

            if(response.fail){
                console.log(response);
                associate_errors(response['errors'], $form);
            }else{
                $('.edit-item-carextra-trigger-clicked').removeClass('edit-item-carextra-trigger-clicked')
                $('.form-group').removeClass('has-errors').find('.help-text').text('')
                $("#editCarExtraForm").trigger("reset");
                $("#edit-modal-carextra").modal("hide");
                window.location.reload();
            }
        }).fail(function(response) {
            console.log(response);
            //handle failed validation
            associate_errors(response['errors'], $form);
        });
    });

    // car extras
    /**
     * for showing create car coupes  popup
     */

    $(document).on('click', "#create-coupe", function() {
        $(this).addClass('create-item-coupe-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
        var options = {
            'backdrop': 'static'
        };
        $('#create-modal-coupe').modal(options)
    })

    // on modal show Fleet
    $('#create-modal-coupe').on('show.bs.modal', function() {
        var el = $(".create-item-coupe-trigger-clicked"); // See how its usefull right here?
        // var et = document.getElementsByClassName('edit-item-trigger-clicked');
        var row = el.closest(".table-row");

    })

    // on modal hide
    $('#create-modal-coupe').on('hide.bs.modal', function() {
        $('.create-item-coupe-trigger-clicked').removeClass('create-item-coupe-trigger-clicked')
        $("#createCoupeForm").trigger("reset");
    })

    $('#createCoupeForm').submit(function(e){
        var $form = $(this);

        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var url = $form.attr('action');
        var formData = {};

        //submit a POST request with the form data
        $form.find(':input').each(function()
        {
            formData[ $(this).attr('name') ] = $(this).val();
        });

        //submits an array of key-value pairs to the form's action URL
        $.post(url, formData, function(response) {
            //handle successful validation
            if(response.errors){
                associate_errors(response['errors'], $form);
            }else{
                $('.create-item-coupe-trigger-clicked').removeClass('create-item-coupe-trigger-clicked')
                $('.form-group').removeClass('has-errors').find('.help-text').text('')
                $("#createCoupeForm").trigger("reset");
                $("#create-modal-coupe").modal("hide");
                window.location.reload();
            }
        }).fail(function(response) {
            //handle failed validation
            associate_errors(response['errors'], $form);
        });
    });

    /**
     * for showing edit car extra popup
     */

    $(document).on('click', "#edit-coupe", function() {
        $(this).addClass('edit-item-coupe-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

        var options = {
            'backdrop': 'static'
        };
        $('#edit-modal-coupe').modal(options)
    })

    $('#edit-modal-coupe').on('show.bs.modal', function() {
        var el = $(".edit-item-coupe-trigger-clicked"); // See how its usefull right here?
        var row = el.closest(".table-row");

        // get the data
        var id = el.data('item-id');
        var token = $('meta[name="csrf-token"]').attr('content');
        var data = {
            '_token': token,
            'id': id
        };
        var url= '/admin/get-type-coupe';

        // get langs
        $.post(url, data, function(response) {
            //handle successful validation
            if(response.error){

            }else{
                for (var key in response) {
                    var lng = response[key].locale;
                    var name = response[key].DefaultName;

                    $("#name-coupe-"+ lng +"-edit").val(name);
                }
            }
        }).fail(function(response) {
            //handle failed validation
        });

        var status = row.children(".status").attr('data-content');

        // fill the data in the input fields
        $("#coupe-id-edit").val(id);
        $("#status-edit-coupe").val(status);

    })

    // on modal hide
    $('#edit-modal-coupe').on('hide.bs.modal', function() {
        $('.edit-item-coupe-trigger-clicked').removeClass('edit-item-coupe-trigger-clicked')
        $("#editCoupeForm").trigger("reset");
    })

    $('#editCoupeForm').submit(function(e){
        var $form = $(this);

        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var url = $form.attr('action');
        var formData = {};

        //submit a POST request with the form data
        $form.find(':input').each(function()
        {
            formData[ $(this).attr('name') ] = $(this).val();

        });

        //submits an array of key-value pairs to the form's action URL
        $.post(url, formData, function(response) {
            //handle successful validation

            if(response.fail){
                associate_errors(response['errors'], $form);
            }else{
                $('.edit-item-coupe-trigger-clicked').removeClass('edit-item-coupe-trigger-clicked')
                $('.form-group').removeClass('has-errors').find('.help-text').text('')
                $("#editCoupeForm").trigger("reset");
                $("#edit-modal-coupe").modal("hide");
                window.location.reload();
            }
        }).fail(function(response) {

            //handle failed validation
            associate_errors(response['errors'], $form);
        });
    });

    // cars
    /**
     * for showing create car extras  popup
     */

    $(document).on('click', "#create-car", function() {
        $(this).addClass('create-item-car-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
        var options = {
            'backdrop': 'static'
        };
        $('#create-modal-car').modal(options)
    })

    $(document).on('click', "#copy-car", function() {
        $(this).addClass('copy-item-car-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
        var options = {
            'backdrop': 'static'
        };
        $('#create-modal-car').modal(options)
    })

    // on modal show Fleet
    $('#create-modal-car').on('show.bs.modal', function() {

        if($(".create-item-car-trigger-clicked").length == 1){
            var el = $(".create-item-car-trigger-clicked"); // See how its usefull right here?
            console.log(el);
            // var et = document.getElementsByClassName('edit-item-trigger-clicked');
            var row = el.closest(".table-row");

        }else{
            var el = $(".copy-item-car-trigger-clicked"); // See how its usefull right here?
            console.log(el);
            // var et = document.getElementsByClassName('edit-item-trigger-clicked');
            var row = el.closest(".table-row");

            // get the data
            // var id = el.data('item-id');

            var maker = row.children(".maker").attr('data-content');
            var model = row.children(".model").attr('data-content');
            var fuel = row.children(".fuel").attr('data-content');
            var office = row.children(".office").attr('data-content');
            var coupe = row.children(".coupe").attr('data-content');
            var status = row.children(".status").attr('data-content');
            var ac = row.children(".ac").attr('data-content');
            var gear = row.children(".gear").attr('data-content');
            var years = row.children(".year").text();
            var price = row.children(".price").text();
            var doors = row.children(".doors").text();
            var seats = row.children(".seats").text();
            var tank = row.children(".tank").text();
            var trunk = row.children(".trunk").text();
            var engine = row.children(".engine").text();
            var hp = row.children(".hp").text();

            // fill the data in the input fields
            // $("#car-id-edit").val(id);

            $("#maker-id").val(maker);
            $("#model-id").val(model);
            $("#office-id").val(office);
            $("#fuel-id").val(fuel);
            $("#coupe-id").val(coupe);
            $("#year-car").val(years);
            $("#price-car").val(price);
            $("#doors-car").val(doors);
            $("#seats-car").val(seats);
            $("#ac").val(ac);
            $("#tank").val(tank);
            $("#trunk").val(trunk);
            $("#engine").val(engine);
            $("#gear").val(gear);
            $("#hp").val(hp);
            $("#status").val(status);

        }


    })

    // on modal hide
    $('#create-modal-car').on('hide.bs.modal', function() {
        $('.create-item-car-trigger-clicked').removeClass('create-item-car-trigger-clicked');
        $('.copy-item-car-trigger-clicked').removeClass('copy-item-car-trigger-clicked');
        $("#createCarForm").trigger("reset");
    })

    $('#createCarForm').submit(function(e){
        var $form = $(this);

        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var url = $form.attr('action');
        var formData = {};

        //submit a POST request with the form data
        $form.find(':input').each(function()
        {
            formData[ $(this).attr('name') ] = $(this).val();
        });

        //submits an array of key-value pairs to the form's action URL
        $.post(url, formData, function(response) {
            //handle successful validation
            if(response.errors){
                associate_errors(response['errors'], $form);
            }else{

                $('.create-item-car-trigger-clicked').removeClass('create-item-car-trigger-clicked');
                $('.copy-item-car-trigger-clicked').removeClass('copy-item-car-trigger-clicked');
                $('.form-group').removeClass('has-errors').find('.help-text').text('');
                $("#createCarForm").trigger("reset");
                $("#create-modal-car").modal("hide");
                window.location.reload();
            }
        }).fail(function(response) {
            //handle failed validation
            associate_errors(response['errors'], $form);
        });
    });

    /**
     * for showing edit car popup
     */

    $(document).on('click', "#edit-car", function() {
        $(this).addClass('edit-item-car-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
        var options = {
            'backdrop': 'static'
        };
        $('#edit-modal-car').modal(options)
    })

    $('#edit-modal-car').on('show.bs.modal', function() {
        var el = $(".edit-item-car-trigger-clicked"); // See how its usefull right here?
        var row = el.closest(".table-row");

        // get the data
        var id = el.data('item-id');
        var number = row.children(".number").text();
        var maker = row.children(".maker").attr('data-content');
        var model = row.children(".model").attr('data-content');
        var fuel = row.children(".fuel").attr('data-content');
        var office = row.children(".office").attr('data-content');
        var coupe = row.children(".coupe").attr('data-content');
        var status = row.children(".status").attr('data-content');
        var ac = row.children(".ac").attr('data-content');
        var gear = row.children(".gear").attr('data-content');
        var years = row.children(".year").text();
        var price = row.children(".price").text();
        var doors = row.children(".doors").text();
        var seats = row.children(".seats").text();
        var tank = row.children(".tank").text();
        var trunk = row.children(".trunk").text();
        var engine = row.children(".engine").text();
        var hp = row.children(".hp").text();
        var sipp = row.children(".sipp").text();

        var sipp1 = row.children(".sipp1").text();
        var sipp2 = row.children(".sipp2").text();
        var sipp3 = row.children(".sipp3").text();
        var sipp4 = row.children(".sipp4").text();

        // fill the data in the input fields
        $("#car-id-edit").val(id);
        $("#edit-number-car").val(number);
        $("#edit-maker-id").val(maker);
        $("#edit-model-id").val(model);
        $("#edit-office-id").val(office);
        $("#edit-fuel-id").val(fuel);
        $("#edit-coupe-id").val(coupe);
        $("#edit-year-car").val(years);
        $("#edit-price-car").val(price);
        $("#edit-doors-car").val(doors);
        $("#edit-seats-car").val(seats);
        $("#edit-ac").val(ac);
        $("#edit-tank").val(tank);
        $("#edit-trunk").val(trunk);
        $("#edit-engine").val(engine);
        $("#edit-gear").val(gear);
        $("#edit-hp").val(hp);
        $("#current-sipp").val(sipp);
        $("#edit-status").val(status);

        for (var i = 0; i < sipp.length; i++) {
            var ind = i + 1;
            if(ind === 1){
                $("#edit-sipp-" + ind ).val(sipp1 + "|" + sipp.charAt(i));
            }else if(ind === 2){
                $("#edit-sipp-" + ind ).val(sipp2 + "|" + sipp.charAt(i));
            }else if(ind === 3){
                $("#edit-sipp-" + ind ).val(sipp3 + "|" + sipp.charAt(i));
            }else if(ind === 4){
                $("#edit-sipp-" + ind ).val(sipp4 + "|" + sipp.charAt(i));
            }

        }

    })

    // on modal hide
    $('#edit-modal-car').on('hide.bs.modal', function() {
        $('.edit-item-car-trigger-clicked').removeClass('edit-item-car-trigger-clicked')
        $("#editCarForm").trigger("reset");
    })

    $('#editCarForm').submit(function(e){
        var $form = $(this);

        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var url = $form.attr('action');
        var formData = {};

        //submit a POST request with the form data
        $form.find(':input').each(function()
        {
            formData[ $(this).attr('name') ] = $(this).val();

        });

        //submits an array of key-value pairs to the form's action URL
        $.post(url, formData, function(response) {
            //handle successful validation
            if(response.fail){
                console.log(response);
                associate_errors(response['errors'], $form);
            }else{
                console.log(response);
                $('.edit-item-car-trigger-clicked').removeClass('edit-item-car-trigger-clicked')
                $('.form-group').removeClass('has-errors').find('.help-text').text('')
                $("#editCarForm").trigger("reset");
                $("#edit-modal-car").modal("hide");
                window.location.reload();
            }
        }).fail(function(response) {
            console.log(response);
            //handle failed validation
            associate_errors(response['errors'], $form);
        });
    });

    //info car

    /**
     * for showing info car popup
     */

    $(document).on('click', "#info-car", function() {
        $(this).addClass('info-item-car-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
        var options = {
            'backdrop': 'static'
        };
        $('#info-modal-car').modal(options)
    })

    $('#info-modal-car').on('show.bs.modal', function() {
        var el = $(".info-item-car-trigger-clicked"); // See how its usefull right here?
        var row = el.closest(".table-row");

        // get the data
        var id = el.data('item-id');
        var number = row.children(".number").text();
        var maker = row.children(".maker").text();
        var model = row.children(".model").text();
        var fuel = row.children(".fuel").text();
        var office = row.children(".office").text();
        var coupe = row.children(".coupe").text();
        var status = row.children(".status").text();
        var ac = row.children(".ac").text();
        var gear = row.children(".gear").text();
        var years = row.children(".years").text();
        var price = row.children(".price").text();
        var doors = row.children(".doors").text();
        var seats = row.children(".seats").text();
        var tank = row.children(".tank").text();
        var trunk = row.children(".trunk").text();
        var engine = row.children(".engine").text();
        var hp = row.children(".hp").text();
        var sipp = row.children(".sipp").text();

        var sipp1 = row.children(".sipp1").text();
        var sipp2 = row.children(".sipp2").text();
        var sipp3 = row.children(".sipp3").text();
        var sipp4 = row.children(".sipp4").text();

        // fill the data in the input fields
        $("#info-car-id-edit").val(id);
        $("#info-number-car").val(number);
        $("#info-maker-id").val(maker);
        $("#info-model-id").val(model);
        $("#info-office-id").val(office);
        $("#info-fuel-id").val(fuel);
        $("#info-coupe-id").val(coupe);
        $("#info-year-car").val(years);
        $("#info-price-car").val(price);
        $("#info-doors-car").val(doors);
        $("#info-seats-car").val(seats);
        $("#info-ac").val(ac);
        $("#info-tank").val(tank);
        $("#info-trunk").val(trunk);
        $("#info-engine").val(engine);
        $("#info-gear").val(gear);
        $("#info-hp").val(hp);
        $("#info-current-sipp").val(sipp);
        $("#info-status").val(status);

        for (var i = 0; i < sipp.length; i++) {
            var ind = i + 1;
            if(ind === 1){
                $("#edit-sipp-" + ind ).val(sipp1 + "|" + sipp.charAt(i));
            }else if(ind === 2){
                $("#edit-sipp-" + ind ).val(sipp2 + "|" + sipp.charAt(i));
            }else if(ind === 3){
                $("#edit-sipp-" + ind ).val(sipp3 + "|" + sipp.charAt(i));
            }else if(ind === 4){
                $("#edit-sipp-" + ind ).val(sipp4 + "|" + sipp.charAt(i));
            }

        }

    })

    // on modal hide
    $('#info-modal-car').on('hide.bs.modal', function() {
        $('.info-item-car-trigger-clicked').removeClass('info-item-car-trigger-clicked')
        $("#infoCarForm").trigger("reset");
    })

    // price
    /**
     * for showing create price  popup
     */

    $(document).on('click', "#create-price", function() {
        $(this).addClass('create-item-price-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
        var options = {
            'backdrop': 'static'
        };
        $('#create-modal-price').modal(options)
    })

    // on modal show Fleet
    $('#create-modal-price').on('show.bs.modal', function() {
        var el = $(".create-item-price-trigger-clicked"); // See how its usefull right here?
        // var et = document.getElementsByClassName('edit-item-trigger-clicked');
        var row = el.closest(".table-row");

    })

    // on modal hide
    $('#create-modal-price').on('hide.bs.modal', function() {
        $('.create-item-price-trigger-clicked').removeClass('create-item-price-trigger-clicked')
        $("#createPriceForm").trigger("reset");
    })

    $('#createPriceForm').submit(function(e){
        var $form = $(this);

        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var url = $form.attr('action');
        var formData = {};

        //submit a POST request with the form data
        $form.find(':input').each(function()
        {
            formData[ $(this).attr('name') ] = $(this).val();
        });

        //submits an array of key-value pairs to the form's action URL
        $.post(url, formData, function(response) {
            //handle successful validation
            if(response.errors){
                associate_errors(response['errors'], $form);
            }else{
                $('.create-item-price-trigger-clicked').removeClass('create-item-price-trigger-clicked')
                $('.form-group').removeClass('has-errors').find('.help-text').text('')
                $("#createPriceForm").trigger("reset");
                $("#create-modal-price").modal("hide");
                window.location.reload();
            }
        }).fail(function(response) {
            //handle failed validation
            associate_errors(response['errors'], $form);
        });
    });

    /**
     * for showing edit price popup
     */

    $(document).on('click', "#edit-price", function() {
        $(this).addClass('edit-item-price-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

        var options = {
            'backdrop': 'static'
        };
        $('#edit-modal-price').modal(options)
    })

    $('#edit-modal-price').on('shown.bs.modal', function() {
        var el = $(".edit-item-price-trigger-clicked"); // See how its usefull right here?
        var row = el.closest(".table-row");

        // get the data
        var id = el.data('item-id');
        var token = $('meta[name="csrf-token"]').attr('content');
        var data = {
            '_token': token,
            'id': id
        };
        var url= '/admin/get-price-languages';

        // get langs
        $.post(url, data, function(response) {
            //handle successful validation
            if(response.error){

            }else{
                for (var key in response) {
                    var lng = response[key].locale;
                    var name = response[key].Name;

                    $("#name-price-"+ lng +"-edit").val(name);
                }
            }
        }).fail(function(response) {
            //handle failed validation
        });

        var status = row.children(".status").attr('data-content');

        // fill the data in the input fields
        $("#price-id-edit").val(id);
        $("#status-edit-price").val(status);

    })

    // on modal hide
    $('#edit-modal-price').on('hide.bs.modal', function() {
        $('.edit-item-price-trigger-clicked').removeClass('edit-item-price-trigger-clicked')
        $("#editPriceForm").trigger("reset");
    })

    $('#editPriceForm').submit(function(e){
        var $form = $(this);

        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var url = $form.attr('action');
        var formData = {};

        //submit a POST request with the form data
        $form.find(':input').each(function()
        {
            formData[ $(this).attr('name') ] = $(this).val();

        });

        //submits an array of key-value pairs to the form's action URL
        $.post(url, formData, function(response) {
            //handle successful validation

            if(response.fail){

                associate_errors(response['errors'], $form);
            }else{
                $('.edit-item-price-trigger-clicked').removeClass('edit-item-price-trigger-clicked')
                $('.form-group').removeClass('has-errors').find('.help-text').text('')
                $("#editPriceForm").trigger("reset");
                $("#edit-modal-price").modal("hide");
                window.location.reload();
            }
        }).fail(function(response) {

            //handle failed validation
            associate_errors(response['errors'], $form);
        });
    });

    // price
    /**
     * for showing create price-rule  popup
     */

    $(document).on('click', "#create-price-rule", function() {
        $(this).addClass('create-item-price-rule-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
        var options = {
            'backdrop': 'static'
        };
        $('#create-modal-price-rule').modal(options)
    })

    // on modal show Fleet
    $('#create-modal-price-rule').on('shown.bs.modal', function() {
        var el = $(".create-item-price-rule-trigger-clicked"); // See how its usefull right here?
        // var et = document.getElementsByClassName('edit-item-trigger-clicked');
        var row = el.closest(".table-row");

    })

    // on modal hide
    $('#create-modal-price-rule').on('hide.bs.modal', function() {
        $('.create-modal-price-rule').removeClass('create-item-price-price-rule-trigger-clicked')
        $("#createPriceForm").trigger("reset");
    })

    $('#createPriceRuleForm').submit(function(e){
         var $form = $(this);
        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form

                        if ($form[0].checkValidity() === false) {

                        }else{

                            var url = $form.attr('action');
                            var formData = {};

                            //submit a POST request with the form data
                            $form.find(':input').each(function()
                            {
                                formData[ $(this).attr('name') ] = $(this).val();
                            });
                            // check for rule
                            var url_chek= '/admin/check-rule';

                            // get langs
                            $.post(url_chek, formData, function(response) {
                                //handle successful validation
                                if(response.error){

                                }else{
                                    if(response.hasRule){
                                        var message ='Има правила със същите параметри за:';
                                        message += "<br/>";

                                        Object.keys(response.hasRule).forEach(function (value, index) {
                                            message += 'Модел:' + response.hasRule[value].ModelName + '  Година:' + response.hasRule[value].ModelYear + ' Цена:' + response.hasRule[value].Name + ' Валидно от:' + response.hasRule[value].start_date + ' до:' + response.hasRule[value].end_date + ';'  ;
                                            message += "<br/>";
                                        });

                                        $form.find('.error-message').show().html(message);

                                    }else{
                                       // submits an array of key-value pairs to the form's action URL
                                        $.post(url, formData, function(response) {
                                            //handle successful validation
                                            if(response.errors){
                                                console.log(response);
                                                associate_errors(response['errors'], $form);
                                            }else{
                                                console.log(response);
                                                $('.create-item-price-price-rule-trigger-clicked').removeClass('create-item-price-price-rule-trigger-clicked')
                                                $('.form-group').removeClass('has-errors').find('.help-text').text('')
                                                $("#createPriceRuleForm").trigger("reset");
                                                $("#create-modal-price-rule").modal("hide");
                                                window.location.reload();
                                            }
                                        }).fail(function(response) {
                                            console.log(response);
                                            //handle failed validation
                                            associate_errors(response['errors'], $form);
                                        });
                                    }
                                }
                            }).fail(function(response) {
                                console.log(response);
                                //handle failed validation
                            });

                            //submits an array of key-value pairs to the form's action URL
                            // $.post(url, formData, function(response) {
                            //     //handle successful validation
                            //     if(response.errors){
                            //         console.log(response);
                            //         associate_errors(response['errors'], $form);
                            //     }else{
                            //         console.log(response);
                            //         // $('.create-item-price-price-rule-trigger-clicked').removeClass('create-item-price-price-rule-trigger-clicked')
                            //         // $('.form-group').removeClass('has-errors').find('.help-text').text('')
                            //         // $("#createPriceRuleForm").trigger("reset");
                            //         // $("#create-modal-price-rule").modal("hide");
                            //         // window.location.reload();
                            //     }
                            // }).fail(function(response) {
                            //     console.log(response);
                            //     //handle failed validation
                            //     associate_errors(response['errors'], $form);
                            // });

                        }


        // }, false);







    });

    /**
     * for showing edit car popup
     */

    $(document).on('click', "#edit-price-rule", function() {
        $(this).addClass('edit-item-price-rule-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
        var options = {
            'backdrop': 'static'
        };
        $('#edit-modal-price-rule').modal(options)
    })

    $('#edit-modal-price-rule').on('show.bs.modal', function() {
        var el = $(".edit-item-price-rule-trigger-clicked"); // See how its usefull right here?
        var row = el.closest(".table-row");

        // get the data
        var id = el.data('item-id');
        var name = row.children(".name").attr('data-content');
        var model = row.children(".model").attr('data-content');
        var fuel = row.children(".fuel").attr('data-content');
        var office = row.children(".office").attr('data-content');
        var discount = row.children(".discount").text();
        var status = row.children(".status").attr('data-content');
        var ac = row.children(".ac").attr('data-content');
        var gear = row.children(".gear").attr('data-content');
        var dateFrom = row.children(".date_from").text();
        var dateTo = row.children(".date_to").text();
        var price = row.children(".price").text();
        var price1 = row.children(".price1").text();
        var price2_4 = row.children(".price2_4").text();
        var price5_7 = row.children(".price5_7").text();
        var price8_15 = row.children(".price8_15").text();
        var price16_30 = row.children(".price16_30").text();
        var price31 = row.children(".price31").text();
        var price_weekend = row.children(".price_weekend").text();
        var seats = row.children(".seats").text();
        var tank = row.children(".tank").text();
        var trunk = row.children(".trunk").text();
        var engine = row.children(".engine").text();
        var hp = row.children(".hp").text();
        var sipp = row.children(".sipp").text();

        var sipp1 = row.children(".sipp1").text();
        var sipp2 = row.children(".sipp2").text();
        var sipp3 = row.children(".sipp3").text();
        var sipp4 = row.children(".sipp4").text();

        // fill the data in the input fields
        $("#price-rule-id-edit").val(id);
        $("#edit-price-rule-id").val(name);
        // $("#edit-maker-id").val(maker);
        $("#edit-price-rule-model-id").val(model);
        // $("#edit-office-id").val(office);
        // $("#edit-fuel-id").val(fuel);
        // $("#edit-coupe-id").val(coupe);
        // $("#edit-year-car").val(years);
        $("#edit-price-rule-price").val(price);
        $("#edit-price-rule-price1").val(price1);
        $("#edit-price-rule-price2_4").val(price2_4);
        $("#edit-price-rule-price5_7").val(price5_7);
        $("#edit-price-rule-price8_15").val(price8_15);
        $("#edit-price-rule-price16_30").val(price16_30);
        $("#edit-price-rule-price_weekend").val(price_weekend);
        $("#edit-price-rule-price31").val(price31);
        $("#edit-price-rule-discount").val(discount);
        $("#edit-date_start").val(dateFrom);
        $("#edit-date_end").val(dateTo);
        $("#edit-ac").val(ac);


        // $("#edit-tank").val(tank);
        // $("#edit-trunk").val(trunk);
        // $("#edit-engine").val(engine);
        $("#edit-gear").val(gear);
        $("#edit-hp").val(hp);
        // $("#current-sipp").val(sipp);
        $("#edit-price-rule-status").val(status);

        // for (var i = 0; i < sipp.length; i++) {
        //     var ind = i + 1;
        //     if(ind === 1){
        //         $("#edit-sipp-" + ind ).val(sipp1 + "|" + sipp.charAt(i));
        //     }else if(ind === 2){
        //         $("#edit-sipp-" + ind ).val(sipp2 + "|" + sipp.charAt(i));
        //     }else if(ind === 3){
        //         $("#edit-sipp-" + ind ).val(sipp3 + "|" + sipp.charAt(i));
        //     }else if(ind === 4){
        //         $("#edit-sipp-" + ind ).val(sipp4 + "|" + sipp.charAt(i));
        //     }
        //
        // }

    })

    // on modal hide
    $('#edit-modal-price-rule').on('hide.bs.modal', function() {
        $('.edit-item-price-rule-trigger-clicked').removeClass('edit-item-price-rule-trigger-clicked')
        $("#editPriceRuleForm").trigger("reset");
    })

    $('#editPriceRuleForm').submit(function(e){
        var $form = $(this);
        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form

        if ($form[0].checkValidity() === false) {

        }else{

            var url = $form.attr('action');
            var formData = {};

            //submit a POST request with the form data
            $form.find(':input').each(function()
            {
                formData[ $(this).attr('name') ] = $(this).val();
            });

            // check for rule
            var url_chek= '/admin/check-rule';

            // get langs

            $.post(url_chek, formData, function(response) {
                //handle successful validation

                if(response.error){

                }else{

                    if(response.hasRule){
                        var message ='Има правила със същите параметри за:';
                        message += "<br/>";

                        Object.keys(response.hasRule).forEach(function (value, index) {
                            message += 'Модел:' + response.hasRule[value].ModelName + '  Година:' + response.hasRule[value].ModelYear + ' Цена:' + response.hasRule[value].Name + ' Валидно от:' + response.hasRule[value].start_date + ' до:' + response.hasRule[value].end_date + ';'  ;
                            message += "<br/>";
                        });

                        $form.find('.error-message').show().html(message);

                    }else{

                        //submits an array of key-value pairs to the form's action URL
                        $.post(url, formData, function(response) {
                            //handle successful validation
                            if(response.error){

                                var message ='Има правила със същите параметри за:';
                                message += "<br/>";

                                Object.keys(response.has_rules).forEach(function (value, index) {
                                    message += 'Модел:' + response.hasRule[value].ModelName + '  Година:' + response.hasRule[value].ModelYear + ' Цена:' + response.hasRule[value].Name + ' Валидно от:' + response.hasRule[value].start_date + ' до:' + response.hasRule[value].end_date + ';'  ;
                                    message += "<br/>";
                                });

                                $form.find('.error-message').show().html(message);

                            }else{
                                console.log(response);
                                $('.edit-item-price-rule-trigger-clicked').removeClass('edit-item-price-rule-trigger-clicked')
                                $('.form-group').removeClass('has-errors').find('.help-text').text('')
                                $("#editPriceRuleForm").trigger("reset");
                                $("#edit-modal-price-rule").modal("hide");
                                window.location.reload();
                            }
                        }).fail(function(response) {
                            //handle failed validation
                            associate_errors(response['errors'], $form);
                        });
                    }
                }
            }).fail(function(response) {
                console.log(response);
                //handle failed validation
            });

        }

    });

    /**
     * for showing info car popup
     */

    $(document).on('click', "#info-price-rule", function() {
        $(this).addClass('info-item-price-rule-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
        var options = {
            'backdrop': 'static'
        };
        $('#info-modal-price-rule').modal(options)
    })

    $('#info-modal-price-rule').on('show.bs.modal', function() {
        var el = $(".info-item-price-rule-trigger-clicked"); // See how its usefull right here?
        var row = el.closest(".table-row");

        var name = row.children(".name").text();
        var model = row.children(".model").text();
        var status = row.children(".status").text();
        var year = row.children(".year").text();
        var gear = row.children(".gear").text();
        var dateFrom = row.children(".date_from").text();
        var discount = row.children(".discount").text();
        var dateTo = row.children(".date_to").text();
        var price = row.children(".price").text();
        var price1 = row.children(".price1").text();
        var price2_4 = row.children(".price2_4").text();
        var price5_7 = row.children(".price5_7").text();
        var price8_15 = row.children(".price8_15").text();
        var price16_30 = row.children(".price16_30").text();
        var price31 = row.children(".price31").text();
        var price_weekend = row.children(".price_weekend").text();
        var used = row.children(".used").text();

        // fill the data in the input fields
        // $("#info-rule-id-edit").val(id);
        $("#info-name-rule").val(name);
        // $("#edit-maker-id").val(maker);
        $("#info-model-rule").val(model);

        $("#info-price-rule-price").val(price);
        $("#info-price-rule-price1").val(price1);
        $("#info-price-rule-price2_4").val(price2_4);
        $("#info-price-rule-price5_7").val(price5_7);
        $("#info-price-rule-price8_15").val(price8_15);
        $("#info-price-rule-price16_30").val(price16_30);
        $("#info-price-rule-price_weekend").val(price_weekend);
        $("#info-price-rule-price31").val(price31);
        $("#info-date_from-rule").val(dateFrom);
        $("#info-date_to-rule").val(dateTo);
        $("#info-price-rule-discount").val(discount);
        $("#info-year").val(year);
        $("#info-gear").val(gear);
        $("#info-status").val(status);
        $("#info-used").val(used);

    })

    // on modal hide
    $('#info-modal-price-rule').on('hide.bs.modal', function() {
        $('.info-item-price-rule-trigger-clicked').removeClass('info-item-price-rule-trigger-clicked')
        $("#infoInfoRuleForm").trigger("reset");
    })


    /**
     * for showing edit car popup
     */

    $(document).on('click', "#create-rent-extras", function() {
        $(this).addClass('create-item-rent-extras-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
        var options = {
            'backdrop': 'static'
        };
        $('#create-modal-rent-extra').modal(options)
    })


    // on modal show rent extras
    $('#create-modal-rent-extra').on('show.bs.modal', function() {
        var el = $(".create-item-rent-extras-trigger-clicked"); // See how its usefull right here?
        var row = el.closest(".table-row");

    })

    // on modal hide
    $('#create-modal-rent-extra').on('hide.bs.modal', function() {
        $('.create-item-rent-extras-trigger-clicked').removeClass('create-item-country-trigger-clicked')
        $("#createRentExtraForm").trigger("reset");
    })

    $('#createRentExtraForm').submit(function(e){
        var $form = $(this);

        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        if ($form[0].checkValidity() === false) {

        }else {
            var url = $form.attr('action');
            var formData = {};
            //submit a POST request with the form data
            $form.find(':input').each(function () {
                if($(this).attr('name') == 'check_number'){
                    var check = document.getElementById("check_number").checked;
                    if (check) {
                        formData[$(this).attr('name')] = $(this).val();
                    }
                }else{
                    formData[$(this).attr('name')] = $(this).val();
                }

            });

            //submits an array of key-value pairs to the form's action URL
            $.post(url, formData, function (response) {
                //handle successful validation


                if (response.fail) {
                    associate_errors(response['errors'], $form);
                } else {

                    $('.create-item-rent-extras-trigger-clicked').removeClass('create-item-rent-extras-trigger-clicked')
                    $('.form-group').removeClass('has-errors').find('.help-text').text('')
                    $("#createRentExtraForm").trigger("reset");
                    $("#create-modal-rent-extra").modal("hide");
                    window.location.reload();
                }
            }).fail(function (response) {


                //handle failed validation
                associate_errors(response['errors'], $form);
            });
        }
    });

    /**
     * for showing edit rent extra popup
     */

    $(document).on('click', "#edit-rent-extra", function() {
        $(this).addClass('edit-item-rent-extra-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

        var options = {
            'backdrop': 'static'
        };
        $('#edit-modal-rent-extra').modal(options)
    })

    $('#edit-modal-rent-extra').on('shown.bs.modal', function() {
        var el = $(".edit-item-rent-extra-trigger-clicked"); // See how its usefull right here?
        var row = el.closest(".table-row");

        // get the data
        var id = el.data('item-id');
        var token = $('meta[name="csrf-token"]').attr('content');
        var data = {
            '_token': token,
            'id': id
        };
        var url= '/admin/get-rent-extras-languages';

        // get langs
        $.post(url, data, function(response) {
            //handle successful validation
            if(response.error){

            }else{
                for (var key in response) {
                    var lng = response[key].locale;
                    var name = response[key].RentExtraName;

                    $("#name-rent-extra-"+ lng +"-edit").val(name);
                }
            }
        }).fail(function(response) {
            //handle failed validation
        });

        var status = row.children(".status").attr('data-content');
        var price = row.children(".price").text();
        var price_max = row.children(".price_max").text();
        var description = row.children(".description").text();
        var image_path = row.children(".photo").attr('data-content');
        var image = row.children(".photo_name").attr('data-content');
        var allow_choice = row.children(".allow_choice").attr('data-content');
        var number_choice = row.children(".allow_choice").attr('data-number');

        // fill the data in the input fields
        $("#rent-extra-id-edit").val(id);
        $("#status-edit-rent-extra").val(status);
        $("#rent-extra-price-edit").val(price);
        $("#rent-extra-max_price-edit").val(price_max);
        $("#description-edit").val(description);



        if(allow_choice != 0){
            $("#check_number_edit").prop("checked", true);
            $('#count_number_edit').removeAttr('disabled');
        }
        $("#count_number_edit").val(number_choice);


        if(image && image !=='')
        {
            $(".tiw_old").show();
            $("#edit-image_name").val(image);
            $('#preview').append("<div id='image-preview-default' class='image-preview-default'><img src='"+image_path+"' width='300' height='200' style='display: inline-block;'></div>");
        }else{
            $("#edit-image_name").val('car.png');
            $('#preview').append("<div id='image-preview-default' class='image-preview-default'><img src='"+image_path + 'car.png' +"' width='300' height='200' style='display: inline-block;'></div>");
        }
        $('#preview').show();

    })

    // on modal hide
    $('#edit-modal-rent-extra').on('hide.bs.modal', function() {
        $('.edit-item-rent-extra-trigger-clicked').removeClass('edit-item-rent-extra-trigger-clicked')
        $('.image-preview-default').remove();
        $("#editRentExtraForm").trigger("reset");
    })

    $('#editRentExtraForm').submit(function(e){
        var $form = $(this);

        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var url = $form.attr('action');
        var formData = {};

        //submit a POST request with the form data
        $form.find(':input').each(function()
        {
            if($(this).attr('name') == 'check_number'){
                var check = document.getElementById("check_number_edit").checked;
                if (check) {
                    formData[$(this).attr('name')] = $(this).val();
                }
            }else{
                formData[$(this).attr('name')] = $(this).val();
            }


        });

        //submits an array of key-value pairs to the form's action URL
        $.post(url, formData, function(response) {
            //handle successful validation

            if(response.fail){

                associate_errors(response['errors'], $form);
            }else{
                console.log(response);
                $('.edit-item-rent-extra-trigger-clicked').removeClass('edit-item-rent-extra-trigger-clicked')
                $('.form-group').removeClass('has-errors').find('.help-text').text('')
                $("#editRentExtraForm").trigger("reset");
                $("#edit-modal-rent-extra").modal("hide");
                window.location.reload();
            }
        }).fail(function(response) {

            //handle failed validation
            associate_errors(response['errors'], $form);
        });
    });

    $('#check_number').on('click',function(e){

        var check = document.getElementById("check_number").checked;

        if (check) {
            $('#count_number').removeAttr('disabled');
            // number.removeAttr('disabled');

        } else {
            $('#count_number').attr({
                'disabled': 'disabled'
            });
        }
    });
    $('#check_number_edit').on('click',function(e){

        var check = document.getElementById("check_number_edit").checked;

        if (check) {
            $('#count_number_edit').removeAttr('disabled');
            // number.removeAttr('disabled');

        } else {
            $('#count_number_edit').attr({
                'disabled': 'disabled'
            });
        }
    });

    /**
     * for showing create coupon  popup
     */

    $(document).on('click', "#create-coupon", function() {
        $(this).addClass('create-item-coupon-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
        var options = {
            'backdrop': 'static'
        };
        $('#create-modal-coupon').modal(options)
    })

    // on modal show Fleet
    $('#create-modal-coupon').on('show.bs.modal', function() {
        var el = $(".create-item-coupon-trigger-clicked"); // See how its usefull right here?
        // var et = document.getElementsByClassName('edit-item-trigger-clicked');
        var row = el.closest(".table-row");

    })

    // on modal hide
    $('#create-modal-coupon').on('hide.bs.modal', function() {
        $('.create-item-coupon-trigger-clicked').removeClass('create-item-coupon-trigger-clicked')
        $("#createCouponForm").trigger("reset");
    })

    $('#createCouponForm').submit(function(e){
        var $form = $(this);

        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var url = $form.attr('action');
        var formData = {};

        //submit a POST request with the form data
        $form.find(':input').each(function()
        {
            if($(this).attr('name') == 'percent'){
                var check = document.getElementById("check_percent").checked;
                if (check) {
                    formData[$(this).attr('name')] = 1;
                }
            }else if($(this).attr('name') == 'once'){
                var check = document.getElementById("check_once").checked;
                if (check) {
                    formData[$(this).attr('name')] = 1;
                }

            }else{
                formData[$(this).attr('name')] = $(this).val();
            }

        });

        //submits an array of key-value pairs to the form's action URL
        $.post(url, formData, function(response) {
            //handle successful validation
            if(response.errors){
                associate_errors(response['errors'], $form);
            }else{

                $('.create-item-coupon-trigger-clicked').removeClass('create-item-coupon-trigger-clicked')
                $('.form-group').removeClass('has-errors').find('.help-text').text('')
                $("#createCouponForm").trigger("reset");
                $("#create-modal-coupon").modal("hide");
                window.location.reload();
            }
        }).fail(function(response) {
            //handle failed validation
            associate_errors(response['errors'], $form);
        });
    });

    /**
     * for showing edit car popup
     */

    $(document).on('click', "#edit-coupon", function() {
        $(this).addClass('edit-item-coupon-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
        var options = {
            'backdrop': 'static'
        };
        $('#edit-modal-coupon').modal(options)
    })

    $('#edit-modal-coupon').on('show.bs.modal', function() {
        var el = $(".edit-item-coupon-trigger-clicked"); // See how its usefull right here?
        var row = el.closest(".table-row");

        // get the data
        var id = el.data('item-id');

        var name = row.children(".name").text();
        var status = row.children(".status").attr('data-content');
        var price = row.children(".price").text();
        var from = row.children(".from").text();
        var to = row.children(".to").text();
        var description = row.children(".description").text();
        var once = row.children(".once").attr('data-content');
        var percent = row.children(".percent").attr('data-content');


        // fill the data in the input fields
        $("#coupon-id-edit").val(id);
        $("#name-edit-coupon").val(name);
        $("#price-edit-coupon").val(price);
        $("#edit-date_start").val(from);
        $("#edit-date_end").val(to);
        $("#description-edit-coupon").val(description);
        if(once == 1){
            $("#check_once-edit-coupon").prop('checked', true);
        }
        if(percent == 1) {
            $("#check_percent-edit-coupon").prop('checked', true);
        }

        $("#status-edit-coupon").val(status);


    })

    // on modal hide
    $('#edit-modal-coupon').on('hide.bs.modal', function() {
        $('.edit-item-coupon-trigger-clicked').removeClass('edit-item-coupon-trigger-clicked')
        $("#editCouponForm").trigger("reset");
    })

    $('#editCouponForm').submit(function(e){
        var $form = $(this);

        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var url = $form.attr('action');
        var formData = {};

        //submit a POST request with the form data
        $form.find(':input').each(function()
        {
            if($(this).attr('name') == 'percent'){
                var check = document.getElementById("check_percent-edit-coupon").checked;
                if (check) {
                    formData[$(this).attr('name')] = 1;
                }
            }else if($(this).attr('name') == 'once'){
                var check = document.getElementById("check_once-edit-coupon").checked;
                if (check) {
                    formData[$(this).attr('name')] = 1;
        }

        }else{
            formData[$(this).attr('name')] = $(this).val();
        }


        });
        console.log(formData);
        //submits an array of key-value pairs to the form's action URL
        $.post(url, formData, function(response) {
            //handle successful validation
            if(response.fail){

                associate_errors(response['errors'], $form);
            }else{

                $('.edit-item-coupon-trigger-clicked').removeClass('edit-item-coupon-trigger-clicked')
                $('.form-group').removeClass('has-errors').find('.help-text').text('')
                $("#editCouponForm").trigger("reset");
                $("#edit-modal-car").modal("hide");
                window.location.reload();
            }
        }).fail(function(response) {
            console.log(response);
            //handle failed validation
            associate_errors(response['errors'], $form);
        });
    });


    // Insurance
    /**
     * for showing create price-rule  popup
     */

    $(document).on('click', "#create-insurance", function() {
        $(this).addClass('create-item-insurance-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
        var options = {
            'backdrop': 'static'
        };
        $('#create-modal-insurance').modal(options)
    })

    // on modal show Fleet
    $('#create-modal-insurance').on('shown.bs.modal', function() {
        var el = $(".create-item-insurance-trigger-clicked"); // See how its usefull right here?
        // var et = document.getElementsByClassName('edit-item-trigger-clicked');
        var row = el.closest(".table-row");

    })

    // on modal hide
    $('#create-modal-insurance').on('hide.bs.modal', function() {
        $('.create-modal-insurance').removeClass('create-item-price-insurance-trigger-clicked')
        $("#createInsuranceForm").trigger("reset");
    })

    $('#createInsuranceForm').submit(function(e){
        var $form = $(this);

        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var url = $form.attr('action');
        var formData = {};

        //submit a POST request with the form data
        $form.find(':input').each(function()
        {
            if($(this).attr('name') == 'default'){
                var check = document.getElementById("default").checked;
                if (check) {
                    formData[$(this).attr('name')] = 1;
                }
            }else{
                formData[$(this).attr('name')] = $(this).val();
            }

        });

        //submits an array of key-value pairs to the form's action URL
        $.post(url, formData, function(response) {
            //handle successful validation
            if(response.errors){
                associate_errors(response['errors'], $form);
            }else{

                $('.create-item-insurance-trigger-clicked').removeClass('create-item-insurance-trigger-clicked')
                $('.form-group').removeClass('has-errors').find('.help-text').text('')
                $("#createInsuranceForm").trigger("reset");
                $("#create-modal-insurance").modal("hide");
                window.location.reload();
            }
        }).fail(function(response) {
            //handle failed validation
            associate_errors(response['errors'], $form);
        });
    });

    /**
     * for showing edit insurance popup
     */

    $(document).on('click', "#edit-insurance", function() {
        $(this).addClass('edit-item-insurance-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

        var options = {
            'backdrop': 'static'
        };
        $('#edit-modal-insurance').modal(options)
    })

    $('#edit-modal-insurance').on('shown.bs.modal', function() {
        var el = $(".edit-item-insurance-trigger-clicked"); // See how its usefull right here?
        var row = el.closest(".table-row");

        // get the data
        var id = el.data('item-id');
        var token = $('meta[name="csrf-token"]').attr('content');
        var data = {
            '_token': token,
            'id': id
        };
        var url= '/admin/get-insurance-languages';

        // get langs
        $.post(url, data, function(response) {
            //handle successful validation
            if(response.error){
            }else{
                console.log(response);

                for (var key in response) {
                    var lng = response[key].locale;
                    var name = response[key].insuranceName;
                    var description_lang = response[key].insuranceDescription;

                    $("#edit-name-insurance-"+ lng).val(name);
                    $("#edit-description-insurance-"+ lng).val(description_lang);
                }
            }
        }).fail(function(response) {
            //handle failed validation
        });

        var status = row.children(".status").attr('data-content');
        var price = row.children(".price").text();
        var description = row.children(".description").text();
        var default_val = row.children(".default").attr('data-content');

        // fill the data in the input fields
        $("#insurance-id-edit").val(id);
        $("#status-edit-insurance").val(status);
        $("#edit-insurance-price").val(price);

        if(default_val != 0){
            $("#edit-default").prop("checked", true);
        }

    })

    // on modal hide
    $('#edit-modal-insurance').on('hide.bs.modal', function() {
        $('.edit-item-insurance-trigger-clicked').removeClass('edit-item-insurance-trigger-clicked')
        $("#editInsuranceForm").trigger("reset");
    })

    $('#editInsuranceForm').submit(function(e){
        var $form = $(this);

        e.preventDefault(); //keeps the form from behaving like a normal (non-ajax) html form
        var url = $form.attr('action');
        var formData = {};

        //submit a POST request with the form data
        $form.find(':input').each(function()
        {
            if($(this).attr('name') == 'default'){
                var check = document.getElementById("edit-default").checked;
                if (check) {
                    formData[$(this).attr('name')] = 1;
                }
            }else{
                formData[$(this).attr('name')] = $(this).val();
            }

        });

        //submits an array of key-value pairs to the form's action URL
        $.post(url, formData, function(response) {
            //handle successful validation

            if(response.fail){

                associate_errors(response['errors'], $form);
            }else{
                console.log(response);
                $('.edit-item-insurance-trigger-clicked').removeClass('edit-item-insurance-trigger-clicked')
                $('.form-group').removeClass('has-errors').find('.help-text').text('')
                $("#editInsuranceForm").trigger("reset");
                $("#edit-modal-insurance").modal("hide");
                window.location.reload();
            }
        }).fail(function(response) {

            //handle failed validation
            associate_errors(response['errors'], $form);
        });
    });




});


function associate_errors(errors, $form) {
    //remove existing error classes and error messages from form groups
    $form.find('.form-group').removeClass('has-errors').find('.help-text').text('');

    Object.keys(errors).forEach(function (value, index) {
        //find each form group, which is given a unique id based on the form field's name
        var $group = $form.find('#' + value + '-group');
        //add the error class and set the error text
        $group.addClass('has-errors').find('.help-text').text(errors[value]);
    });
}

function associate_delete_errors(errors, $form) {
    //remove existing error classes and error messages from form groups
    $form.find('.delete-text').removeClass('has-errors').find('.help-text').text('');

    Object.keys(errors).forEach(function (value, index) {
        //find each form group, which is given a unique id based on the form field's name
        var $group = $form.find('#delete-text');
        //add the error class and set the error text

        $group.addClass('has-errors').find('.help-text').text(errors[value]);
    });
}