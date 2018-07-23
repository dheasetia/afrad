var CityIndex = function () {

    var fetchCities = function () {
        $.ajax({
            url: '/ajax/cities',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) {
                var table = $('table#table_cities tbody');
                if (data.status === 'success') {
                    $.each(data.cities, function (index, value) {
                        var tr = $('<tr class="tr_added" data-id="' + value.id + '">');
                        tr.append($('<td class="td_added" data-column="seq">').text(index + 1));
                        tr.append($('<td class="td_city" data-column="city">').text(value.city));
                        tr.append($('<td class="td_area" data-column="area">').text(value.area));
                        var btns = $('<td><button type="button" class="btn btn-sm btn-warning btn_edit_city" data-id="' + value.id +'"><i class="fa fa-pencil"></i></button> <button type="button" class="btn btn-danger btn-sm btn_delete_city" data-id="'
                            + value.id + '"><i class="fa fa-trash"></i></button> </td>');
                        tr.append(btns);
                        tr.hide();
                        table.append(tr);
                        tr.fadeIn();
                    });
                }
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
            postCity(modal);
        });

        function postCity() {
            if (input.val() === '' || select.val() === '') {
                return false;
            }
            var city = $('#form_add_city').find('#city_add_input').val(),
                area_id = $('#form_add_city').find('#city_id').val();

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
                        var table = $('table#table_cities tbody');
                        var tr_length = $('tr.tr_added').length + 1;
                        var tr = $('<tr class="tr_added" data-id="' + data.city.id + '">');
                        tr.append($('<td class="td_added" data-column="seq">').text(tr_length));
                        tr.append($('<td class="td_city" data-column="city">').text(data.city.city));
                        tr.append($('<td class="td_area" data-column="area">').text(data.city.area));
                        var btns = $('<td><button type="button" class="btn btn-sm btn-warning btn_edit_city" data-id="' + data.city.id +'"><i class="fa fa-pencil"></i></button> <button type="button" class="btn btn-danger btn-sm btn_delete_city" data-id="'
                            + data.city.id + '"><i class="fa fa-trash"></i></button> </td>');
                        tr.append(btns);
                        tr.hide();
                        table.append(tr);
                        tr.fadeIn();

                        modal.unblock();

                        modal.modal('hide');

                        $.toast({
                            heading: 'إضافة مدينة جديدة',
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'success',
                            hideAfter: 3500,
                            textAlign: 'right',
                            stack: 6
                        });
                    } else {
                        modal.unblock();
                        $.toast({
                            heading: 'إضافة مدينة جديدة',
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 3500,
                            textAlign: 'right',
                            stack: 6
                        });
                    }

                },
                error: function () {
                    modal.unblock();
                    modal.modal('hide');
                    $.toast({
                        heading: 'حذف مدينة',
                        text: 'تعذرت عملية إضافة المدينة',
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

    var editItem = function () {
        $('table#table_cities').delegate('.btn_edit_city', 'mouseenter', function () {
            var button = $(this);
            button.on('click', function () {
                var cell = $(this).closest('tr').find('td.td_city');
                var prevContent = cell.text();
                $('table#table_cities .btn_edit_city').on('click', function () {
                    return false;
                });
                displayForm(cell, prevContent);
            });

            function displayForm(cell, prevContent) {
                var city_id     = cell.closest('tr').data('id'),
                    form        =   '<form action="javascript: this.preventDefault()" autocomplete="off">' +
                        '<input type="text" name="city" class="form-control" value="' + prevContent + '" autocomplete="off"/>' +
                        '<input type="hidden" name="id" value="' + city_id + '"/>' +
                        '<input type="hidden" name="_token" value="' + $('meta[name="csrf-token"]').attr('content') + '"/>' +
                        '</form>';
                cell.html(form).find('input[type=text]').focus();



                cell.on('focusout', function () {
                    cell.text(prevContent);
                    button.off('click');
                });

                cell.on('keydown', function (e) {
                    if (e.keyCode === 13) {
                        e.preventDefault();
                        changeField(cell, prevContent);
                    } else if (e.keyCode === 27) {
                        cell.text(prevContent);
                        button.off('click');
                        return false;
                    }
                });
            }

            function changeField(cell, prevContent) {
                cell.off('keydown');
                var post_data = cell.find('form').serialize();
                $('#panel_city').block({
                    message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                    css: {
                        border: '1px solid #fff'
                    }
                });

                $.ajax({
                    url: '/ajax/cities/edit',
                    type: 'post',
                    dataType: 'JSON',
                    data: post_data,
                    success: function (data) {
                        button.off('click');
                        cell.html(data.city.city);
                        $('#panel_city').unblock();
                        $.toast({
                            heading: 'تعديل إدارة',
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'success',
                            hideAfter: 3500,
                            textAlign: 'right',
                            stack: 6
                        });
                        return false;
                    },
                    error: function () {
                        cell.html(prevContent);
                        button.off('click');
                        $('#panel_city').unblock();
                        $.toast({
                            heading: 'تعديل منظقة',
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 3500,
                            textAlign: 'right',
                            stack: 6
                        });
                    }
                });
            }
        });

    };

    var deleteCity = function () {
        $('table#table_cities').delegate('.btn_delete_city', 'mouseenter', function () {
            $(this).confirmation({
                rootSelector: '.btn_delete_city',
                title: 'هل أنت متأكد؟',
                singleton: true,
                popout: true,
                btnOkLabel: 'نعم',
                btnCancelLabel: 'لا',
                onConfirm: function() {
                    var tr = $(this).closest('tr');
                    var city_id = $(this).data('id');
                    var panel = $('#panel_city');
                    panel.block({
                        message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                        css: {
                            border: '1px solid #fff'
                        }
                    });
                    $.ajax({
                        url: '/ajax/cities',
                        type: 'delete',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            city_id: city_id
                        },
                        success: function (data) {
                            if (data.status === 'success') {
                                $('table#table_cities tbody').empty();
                                fetchCities();
                                panel.unblock();
                                $.toast({
                                    heading: 'حذف إدارة',
                                    text: data.message,
                                    position: 'top-right',
                                    loaderBg:'#ff6849',
                                    icon: 'success',
                                    hideAfter: 3500,
                                    textAlign: 'right',
                                    stack: 6
                                });
                            } else {
                                panel.unblock();
                                $.toast({
                                    heading: 'حذف إدارة',
                                    text: data.message,
                                    position: 'top-right',
                                    loaderBg:'#ff6849',
                                    icon: 'error',
                                    hideAfter: 3500,
                                    textAlign: 'right',
                                    stack: 6
                                });
                            }

                        },
                        error: function () {
                            panel.unblock();
                            $.toast({
                                heading: 'حذف إدارة',
                                text: 'تعذرت عملية الحذف',
                                position: 'top-right',
                                loaderBg:'#ff6849',
                                icon: 'error',
                                hideAfter: 3500,
                                textAlign: 'right',
                                stack: 6
                            });
                        }
                    });
                }
            });
        });
    };

    return {
        init: function () {
            fetchCities();
            deleteCity();
            addCity();
            editItem();
        }
    }
}();

jQuery(document).ready(function () {
    CityIndex.init();
});