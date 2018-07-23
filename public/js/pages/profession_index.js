var ProfessionIndex = function () {

    var deleteProfession = function () {
        $('table#table_professions').delegate('button.btn_delete_profession', 'mouseenter', function () {
            $(this).confirmation({
                rootSelector: '.btn_delete_profession',
                title: 'هل أنت متأكد؟',
                singleton: true,
                popout: true,
                btnOkLabel: 'نعم',
                btnCancelLabel: 'لا',
                onConfirm: function() {
                    var profession_id = $(this).data('id');
                    var panel = $('#panel_profession');
                    panel.block({
                        message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                        css: {
                            border: '1px solid #fff'
                        }
                    });
                    $.ajax({
                        url: '/ajax/professions',
                        type: 'delete',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            profession_id: profession_id
                        },
                        success: function (data) {
                            if (data.status === 'success') {
                                $('table#table_professions tbody').empty();
                                fetchProfessions();
                                panel.unblock();
                                $.toast({
                                    heading: 'حذف مهنة',
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
                                    heading: 'حذف مهنة',
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
                                heading: 'حذف مهنة',
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

    var addProfession = function () {
        var modal = $('#modal_add_profession');
        var btn_save = modal.find('#btn_save_add_profession');
        var input = modal.find("#form_add_profession input#profession_add_input");

        input.on('keydown', function (event) {
            if(event.keyCode === 13) {
                event.preventDefault();
            }
        });

        btn_save.on('click', function () {
            postProfession();
        });

        $('#btn_add_profession').on('click', function () {
            input.val('');
            modal.modal();
        });

        function postProfession() {
            if (input.val() === '') {
                return false;
            }
            var profession = $('#form_add_profession').find('input#profession_add_input').val();
            modal.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/professions',
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    profession: profession
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var table = $('table#table_professions tbody');
                        var tr_length = $('tr.tr_added').length + 1;
                        var tr = $('<tr class="tr_added" data-id="' + data.profession.id + '">');
                        tr.append($('<td class="td_added" data-column="seq">').text(tr_length));
                        tr.append($('<td class="td_profession" data-column="profession">').text(data.profession.profession));

                        var btn = $('<td class="column-action"><button type="button" class="btn btn-danger btn-sm btn_delete_profession" data-id="'
                            + data.profession.id + '"><i class="fa fa-trash"></i></button> </td>');
                        tr.append(btn);
                        tr.hide();
                        table.append(tr);
                        tr.fadeIn();

                        modal.unblock();
                        $.toast({
                            heading: 'إضافة مهنة جديدة',
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
                            heading: 'إضافة مهنة جديدة',
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
                        heading: 'إضافة مهنة',
                        text: 'تعذرت عملية إضافة مهنة',
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


    var fetchProfessions = function () {
        $.ajax({
            url: '/ajax/professions',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) {
                var table = $('table#table_professions tbody');
                if (data.status === 'success') {
                    $.each(data.professions, function (index, value) {
                        var tr = $('<tr class="tr_added" data-id="' + value.id + '">');
                        tr.append($('<td class="td_added" data-column="seq">').text(index + 1));
                        tr.append($('<td class="td_profession" data-column="profession">').text(value.profession));

                        var btn = $('<td class="column-action"><button type="button" class="btn btn-danger btn-sm btn_delete_profession" data-id="' + value.id + '"><i class="fa fa-trash"></i></button> </td>');
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
        var cellForm = $('table#table_professions tbody');
        cellForm.on('click', 'td.td_profession', function () {
            displayForm($(this));
        });

        function displayForm(cell) {
            var profession_id = cell.closest('tr').data('id'),
                prevContent = cell.text(),
                form =  '<form>' +
                    '<input type="text" name="profession" class="form-control" value="' + prevContent + '"/>' +
                    '<input type="hidden" name="profession_id" class="form-control" value="' + profession_id +'"/>' +
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
            $('#panel_profession').block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/professions/edit',
                type: 'post',
                dataType: 'JSON',
                data: post_data,
                success: function (data) {
                    cell.html(data.profession.profession);
                    cell.off('click');
                    $('#panel_profession').unblock();
                    $.toast({
                        heading: 'تعديل مهنة',
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
                    $('#panel_profession').unblock();
                    $.toast({
                        heading: 'تعديل مهنة',
                        text: 'تعذر تعديل المهنة',
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
            fetchProfessions();
            deleteProfession();
            addProfession();
            editItem();
        }
    }
}();

jQuery(document).ready(function () {
    ProfessionIndex.init();
});