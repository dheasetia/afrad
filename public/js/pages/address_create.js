var AddressCreate = function() {

    var handleValidation = function() {
        var form = $('#form_create_address');

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input
            rules: {
                city_id: {
                    required: true
                }
            },
            messages: {
                city_id: {
                    required: 'إلزامي'
                }
            },

            errorPlacement: function(error, element) {
                if (element.is(':checkbox')) {
                    error.insertAfter(element.closest(".md-checkbox-list, .md-checkbox-inline, .checkbox-list, .checkbox-inline"));
                } else if (element.is(':radio')) {
                    error.insertAfter(element.closest(".md-radio-list, .md-radio-inline, .radio-list,.radio-inline"));
                } else {
                    error.insertAfter(element); // for other inputs, just perform default behavior
                }
            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function(element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function(form) {
                form.submit();
            }
        });
    };

    var addCity = function () {
        var modal = $('#modal_add_city');
        var input = modal.find("#form_add_city #city_add_input");
        var select = modal.find("#form_add_city #city_id");

        modal.on('shown.bs.modal', function () {
            input.focus();
        });

        $('#btn_add_city').on('click', function () {
            input.val('');
            select.val('');
            modal.modal();
        });

        input.on('keydown', function (event) {
            if(event.keyCode === 13) {
                event.preventDefault();
            }
        });

        select.on('keydown', function (event) {
            if(event.keyCode === 13) {
                event.preventDefault();
            }
        });

        modal.find('#btn_save_add_city').on('click', function () {
            postCity();
        });
        function postCity() {
            if (input.val() === '' || select.val() === '') {
                return false;
            }
            var city = $('#form_add_city').find('#city_add_input').val(),
                area_id = $('#form_add_city').find('#area_id').val(),
                select_city = $('#city_id');

            modal.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/cities',
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    city: city,
                    area_id: area_id
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var option = $('<option>');
                        option.val(data.city.id);
                        option.text(data.city.city);
                        select_city.append(option);
                        select_city.val(data.city.id);
                        $('#province').text(data.city.area);
                        modal.unblock();
                        $.toast({
                            heading: 'إضافة مدينة ',
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'success',
                            hideAfter: 3500,
                            textAlign: 'right',
                            stack: 6
                        });
                        modal.modal('hide');
                    } else {
                        modal.unblock();
                        $.toast({
                            heading: 'إضافة مدينة',
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 3500,
                            textAlign: 'right',
                            stack: 6
                        });
                    }
                    return false;
                },
                error: function () {
                    modal.unblock();
                    modal.modal('hide');
                    $.toast({
                        heading: 'إضافة مدينة',
                        text: 'تعذرت عملية إضافة مدينة',
                        position: 'top-right',
                        loaderBg:'#ff6849',
                        icon: 'error',
                        hideAfter: 3500,
                        textAlign: 'right',
                        stack: 6
                    });
                }
            })
        }
    };

    var addArea = function () {
        var modal = $('#modal_add_area');
        var input = modal.find("#form_add_area #area_add_input");
        var select = modal.find("#form_add_area #area_id");

        modal.on('shown.bs.modal', function () {
            input.focus();
        });

        $('#btn_add_area_modal').on('click', function () {
            input.val('');
            select.val('');
            modal.modal();
        });

        input.on('keydown', function (event) {
            if(event.keyCode === 13) {
                event.preventDefault();
            }
        });

        select.on('keydown', function (event) {
            if(event.keyCode === 13) {
                event.preventDefault();
            }
        });

        modal.find('#btn_save_add_area').on('click', function () {
            postArea();
        });

        function postArea() {
            if (input.val() === '' || select.val() === '') {
                return false;
            }
            var area = $('#form_add_area').find('#area_add_input').val(),
                select_area = $('#area_id');

            modal.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/areas',
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    area: area
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var option = $('<option>');
                        option.val(data.area.id);
                        option.text(data.area.area);
                        select_area.append(option);
                        select_area.val(data.area.id);
                        modal.unblock();
                        $.toast({
                            heading: 'إضافة منطقة ',
                            text: data.message,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'success',
                            hideAfter: 3500,
                            textAlign: 'right',
                            stack: 6
                        });
                        modal.modal('hide');
                    } else {
                        modal.unblock();
                        $.toast({
                            heading: 'إضافة منطقة',
                            text: data.message,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'error',
                            hideAfter: 3500,
                            textAlign: 'right',
                            stack: 6
                        });
                    }
                    return false;
                },
                error: function () {
                    modal.unblock();
                    modal.modal('hide');
                    $.toast({
                        heading: 'إضافة منطقة',
                        text: 'تعذرت عملية إضافة مطقة',
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3500,
                        textAlign: 'right',
                        stack: 6
                    });
                }
            })
        }
    };


    var getCityArea = function () {
        $('#city_id').change(function () {
            $.ajax({
                url: '/ajax/cityarea',
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    city_id: $(this).val()
                },
                success: function (data) {
                    $('#province').text(data);
                }
            });
        });
    };

    var handleAddressMap = function () {
        var map;
        var myPos = new google.maps.LatLng({
            lat: 26.437214,
            lng: 50.110941
        });

        var coordinate = $('#coordinate').val();
        if (coordinate.length > 0) {
            var temp = coordinate.split(', ');
            var lat = temp[0];
            var lng = temp[1];
            myPos = new google.maps.LatLng({
                lat: parseFloat(lat),
                lng: parseFloat(lng)
            });
        }

        function initMap() {
            map = new google.maps.Map(document.getElementById('office_map'), {
                center: myPos,
                zoom: 16,
                mapTypeId: google.maps.MapTypeId.HYBRID
            });

            var marker = new google.maps.Marker({
                position: myPos,
                animation: google.maps.Animation.DROP,
                map: map,
                draggable: true
            });

            google.maps.event.addListener(marker, 'dragend', function() {
                document.getElementById('coordinate').value = marker.position.lat() + ', ' + marker.position.lng();
            });


            // var geocoder = new google.maps.Geocoder();

            // document.getElementById('city_id').addEventListener('change', function() {
            //     geocodeAddress(geocoder, map);
            // });

        }

        function geocodeAddress(geocoder, resultsMap) {
            var city_select = document.getElementById('city_id');
            if (city_select.value != '') {
                address = city_select.options[city_select.selectedIndex].text;
            } else {
                address = 'المملكة العربية السعودية';
            }
            geocoder.geocode({'address': address}, function(results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    resultsMap.setCenter(results[0].geometry.location);
                    var marker = new google.maps.Marker({
                        position: results[0].geometry.location,
                        animation: google.maps.Animation.DROP,
                        map: resultsMap,
                        draggable: true
                    });

                    google.maps.event.addListener(marker, 'dragend', function() {
                        document.getElementById('coordinate').value = marker.position.lat() + ', ' + marker.position.lng();
                    });

                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });
        }


        return initMap();
    };

    return {
        init: function() {
            handleValidation();
            addCity();
            handleAddressMap();
            getCityArea();
            addArea();
        }
    };
}();

jQuery(document).ready(function() {
    AddressCreate.init();
});