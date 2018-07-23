var AreaIndex = function () {

    var deleteArea = function () {
        $('table#table_areas').delegate('button.btn_delete_area', 'mouseenter', function () {
            $(this).confirmation({
                rootSelector: '.btn_delete_area',
                title: 'هل أنت متأكد؟',
                singleton: true,
                popout: true,
                btnOkLabel: 'نعم',
                btnCancelLabel: 'لا',
                onConfirm: function() {
                    var tr = $(this).closest('tr');
                    var area_id = $(this).data('id');
                    var panel = $('#panel_area');
                    panel.block({
                        message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                        css: {
                            border: '1px solid #fff'
                        }
                    });
                    $.ajax({
                        url: '/ajax/areas',
                        type: 'delete',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            area_id: area_id
                        },
                        success: function (data) {
                            if (data.status === 'success') {
                                $('table#table_areas tbody').empty();
                                fetchAreas();
                                panel.unblock();
                                $.toast({
                                    heading: 'حذف منطقة',
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
                                    heading: 'حذف منطقة',
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
                                heading: 'حذف منطقة',
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

    var addArea = function () {
        var modal = $('#modal_add_area');
        var btn_save = modal.find('#btn_save_add_area');
        var input = modal.find("#form_add_area input#area_add_input");

        modal.on('shown.bs.modal', function () {
            input.focus();
        });

        input.on('keydown', function (event) {
            if(event.keyCode === 13) {
                event.preventDefault();
            }
        });

        btn_save.on('click', function () {
            postArea();
        });

        $('#btn_add_area').on('click', function () {
            input.val('');
            modal.modal();
        });

        function postArea() {
            if (input.val() === '') {
                return false;
            }
            var area = $('#form_add_area').find('input#area_add_input').val();
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
                        var table = $('table#table_areas tbody');
                        var tr_length = $('tr.tr_added').length + 1;
                        var tr = $('<tr class="tr_added" data-id="' + data.area.id + '">');
                        tr.append($('<td class="td_added" data-column="seq">').text(tr_length));
                        tr.append($('<td class="td_area" data-column="area">').text(data.area.area));

                        var btn = $('<td class="column-action"><button type="button" class="btn btn-danger btn-sm btn_delete_area" data-id="'
                            + data.area.id + '"><i class="fa fa-trash"></i></button> </td>');
                        tr.append(btn);
                        tr.hide();
                        table.append(tr);
                        tr.fadeIn();

                        modal.unblock();
                        $.toast({
                            heading: 'إضافة منطقة جديدة',
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
                            heading: 'إضافة منطقة جديدة',
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
                        heading: 'إضافة منطقة',
                        text: 'تعذرت عملية إضافة منطقة',
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


    var fetchAreas = function () {
        $.ajax({
            url: '/ajax/areas',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) {
                var table = $('table#table_areas tbody');
                if (data.status === 'success') {
                    $.each(data.areas, function (index, value) {
                        var tr = $('<tr class="tr_added" data-id="' + value.id + '">');
                        tr.append($('<td class="td_added" data-column="seq">').text(index + 1));
                        tr.append($('<td class="td_area" data-column="area">').text(value.area));

                        var btn = $('<td class="column-action"><button type="button" class="btn btn-danger btn-sm btn_delete_area" data-id="' + value.id + '"><i class="fa fa-trash"></i></button> </td>');
                        tr.append(btn);
                        table.append(tr);
                        tr.hide();
                        tr.fadeIn();
                    });
                }
            }
        });
    };

    var editItem = function () {
        var cellForm = $('table#table_areas tbody');
        cellForm.on('click', 'td.td_area', function () {
            displayForm($(this));
        });

        function displayForm(cell) {
            var area_id = cell.closest('tr').data('id'),
                prevContent = cell.text(),
                form =  '<form>' +
                    '<input type="text" name="area" class="form-control" value="' + prevContent + '"/>' +
                    '<input type="hidden" name="area_id" class="form-control" value="' + area_id +'"/>' +
                    '<input type="hidden" name="_token" class="form-control" value="' + $('meta[name="csrf-token"]').attr('content') + '"/>' +
                    '</form>';
            cell.html(form).find('input[type=text]').focus();
            cell.on('click', function () {
                return false;
            });
            cell.on('focusout', function () {
                cell.text(prevContent);
                cell.off('click');
            });

            cell.on('keydown', function (e) {
                if (e.keyCode === 13) {
                    e.preventDefault();
                    changeField(cell, prevContent);
                } else if (e.keyCode === 27) {
                    cell.text(prevContent);
                    cell.off('click');
                }
            });
        }

        function changeField(cell, prevContent) {
            cell.off('keydown');
            var post_data = cell.find('form').serialize();
            $('#panel_area').block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/areas/edit',
                type: 'post',
                dataType: 'JSON',
                data: post_data,
                success: function (data) {
                    cell.html(data.area.area);
                    cell.off('click');
                    $('#panel_area').unblock();
                    $.toast({
                        heading: 'تعديل منطقة',
                        text: data.message,
                        position: 'top-right',
                        loaderBg:'#ff6849',
                        icon: 'success',
                        hideAfter: 3500,
                        textAlign: 'right',
                        stack: 6
                    });
                },
                error: function (err) {
                    cell.html(prevContent);
                    cell.off('click');
                    $('#panel_area').unblock();
                    $.toast({
                        heading: 'تعديل منظقة',
                        text: 'تعذر تعديل المنطقة',
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
    };

    return {
        init: function () {
            fetchAreas();
            deleteArea();
            addArea();
            editItem();
        }
    }
}();

jQuery(document).ready(function () {
    AreaIndex.init();
});