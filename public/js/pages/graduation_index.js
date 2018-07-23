var GraduationIndex = function () {

    var deleteGraduation = function () {
        $('table#table_graduations').delegate('button.btn_delete_graduation', 'mouseenter', function () {
            $(this).confirmation({
                rootSelector: '.btn_delete_graduation',
                title: 'هل أنت متأكد؟',
                singleton: true,
                popout: true,
                btnOkLabel: 'نعم',
                btnCancelLabel: 'لا',
                onConfirm: function() {
                    var tr = $(this).closest('tr');
                    var graduation_id = $(this).data('id');
                    var panel = $('#panel_graduation');
                    panel.block({
                        message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                        css: {
                            border: '1px solid #fff'
                        }
                    });
                    $.ajax({
                        url: '/ajax/graduations',
                        type: 'delete',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            graduation_id: graduation_id
                        },
                        success: function (data) {
                            if (data.status === 'success') {
                                $('table#table_graduations tbody').empty();
                                fetchGraduations();
                                panel.unblock();
                                $.toast({
                                    heading: 'حذف مؤهل دراسي',
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
                                    heading: 'حذف مؤهل دراسي',
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
                                heading: 'حذف مؤهل دراسي',
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

    var addGraduation = function () {
        var modal = $('#modal_add_graduation');
        var btn_save = modal.find('#btn_save_add_graduation');
        var input = modal.find("#form_add_graduation input#graduation_add_input");

        input.on('keydown', function (event) {
            if(event.keyCode === 13) {
                event.preventDefault();
            }
        });

        btn_save.on('click', function () {
            postGraduation();
        });

        $('#btn_add_graduation').on('click', function () {
            input.val('');
            modal.modal();
        });

        function postGraduation() {
            if (input.val() === '') {
                return false;
            }
            var graduation = $('#form_add_graduation').find('input#graduation_add_input').val();
            modal.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/graduations',
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    graduation: graduation
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var table = $('table#table_graduations tbody');
                        var tr_length = $('tr.tr_added').length + 1;
                        var tr = $('<tr class="tr_added" data-id="' + data.graduation.id + '">');
                        tr.append($('<td class="td_added" data-column="seq">').text(tr_length));
                        tr.append($('<td class="td_graduation" data-column="graduation">').text(data.graduation.graduation));

                        var btn = $('<td class="column-action"><button type="button" class="btn btn-danger btn-sm btn_delete_graduation" data-id="'
                            + data.graduation.id + '"><i class="fa fa-trash"></i></button> </td>');
                        tr.append(btn);
                        tr.hide();
                        table.append(tr);
                        tr.fadeIn();

                        modal.unblock();
                        $.toast({
                            heading: 'إضافة مؤهل دراسي جديدة',
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
                            heading: 'إضافة مؤهل دراسي جديدة',
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
                        heading: 'إضافة مؤهل دراسي',
                        text: 'تعذرت عملية إضافة مؤهل دراسي',
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


    var fetchGraduations = function () {
        $.ajax({
            url: '/ajax/graduations',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) {
                var table = $('table#table_graduations tbody');
                if (data.status === 'success') {
                    $.each(data.graduations, function (index, value) {
                        var tr = $('<tr class="tr_added" data-id="' + value.id + '">');
                        tr.append($('<td class="td_added" data-column="seq">').text(index + 1));
                        tr.append($('<td class="td_graduation" data-column="graduation">').text(value.graduation));

                        var btn = $('<td class="column-action"><button type="button" class="btn btn-danger btn-sm btn_delete_graduation" data-id="' + value.id + '"><i class="fa fa-trash"></i></button> </td>');
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
        var cellForm = $('table#table_graduations tbody');
        cellForm.on('click', 'td.td_graduation', function () {
            displayForm($(this));
        });

        function displayForm(cell) {
            var graduation_id = cell.closest('tr').data('id'),
                prevContent = cell.text(),
                form =  '<form>' +
                    '<input type="text" name="graduation" class="form-control" value="' + prevContent + '"/>' +
                    '<input type="hidden" name="graduation_id" class="form-control" value="' + graduation_id +'"/>' +
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
            $('#panel_graduation').block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/graduations/edit',
                type: 'post',
                dataType: 'JSON',
                data: post_data,
                success: function (data) {
                    cell.html(data.graduation.graduation);
                    cell.off('click');
                    $('#panel_graduation').unblock();
                    $.toast({
                        heading: 'تعديل مؤهل دراسي',
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
                    $('#panel_graduation').unblock();
                    $.toast({
                        heading: 'تعديل منظقة',
                        text: 'تعذر تعديل المؤهل دراسي',
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
            fetchGraduations();
            deleteGraduation();
            addGraduation();
            editItem();
        }
    }
}();

jQuery(document).ready(function () {
    GraduationIndex.init();
});