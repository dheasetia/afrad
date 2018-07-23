var EducationSpecialtyIndex = function () {

    var deleteEducationSpecialty = function () {
        $('table#table_specialties').delegate('button.btn_delete_specialty', 'mouseenter', function () {
            $(this).confirmation({
                rootSelector: '.btn_delete_specialty',
                title: 'هل أنت متأكد؟',
                singleton: true,
                popout: true,
                btnOkLabel: 'نعم',
                btnCancelLabel: 'لا',
                onConfirm: function() {
                    var tr = $(this).closest('tr');
                    var specialty_id = $(this).data('id');
                    var panel = $('#panel_specialty');
                    panel.block({
                        message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                        css: {
                            border: '1px solid #fff'
                        }
                    });
                    $.ajax({
                        url: '/ajax/education-specialties',
                        type: 'delete',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            specialty_id: specialty_id
                        },
                        success: function (data) {
                            if (data.status === 'success') {
                                $('table#table_specialties tbody').empty();
                                fetchEducationSpecialties();
                                panel.unblock();
                                $.toast({
                                    heading: 'حذف تخصص دراسي',
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
                                    heading: 'حذف تخصص دراسي',
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
                                heading: 'حذف تخصص دراسي',
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

    var addEducationSpecialty = function () {
        var modal = $('#modal_add_specialty');
        var btn_save = modal.find('#btn_save_add_specialty');
        var input = modal.find("#form_add_specialty input#specialty_add_input");

        input.on('keydown', function (event) {
            if(event.keyCode === 13) {
                event.preventDefault();
            }
        });

        btn_save.on('click', function () {
            postEducationSpecialty();
        });

        $('#btn_add_specialty').on('click', function () {
            input.val('');
            modal.modal();
        });

        function postEducationSpecialty() {
            if (input.val() === '') {
                return false;
            }
            var specialty = $('#form_add_specialty').find('input#specialty_add_input').val();
            modal.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/education-specialties',
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    specialty: specialty
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var table = $('table#table_specialties tbody');
                        var tr_length = $('tr.tr_added').length + 1;
                        var tr = $('<tr class="tr_added" data-id="' + data.specialty.id + '">');
                        tr.append($('<td class="td_added" data-column="seq">').text(tr_length));
                        tr.append($('<td class="td_specialty" data-column="specialty">').text(data.specialty.specialty));

                        var btn = $('<td class="column-action"><button type="button" class="btn btn-danger btn-sm btn_delete_specialty" data-id="'
                            + data.specialty.id + '"><i class="fa fa-trash"></i></button> </td>');
                        tr.append(btn);
                        tr.hide();
                        table.append(tr);
                        tr.fadeIn();

                        modal.unblock();
                        $.toast({
                            heading: 'إضافة تخصص دراسي جديدة',
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
                            heading: 'إضافة تخصص دراسي جديدة',
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
                        heading: 'إضافة تخصص دراسي',
                        text: 'تعذرت عملية إضافة تخصص دراسي',
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


    var fetchEducationSpecialties = function () {
        $.ajax({
            url: '/ajax/education-specialties',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) {
                var table = $('table#table_specialties tbody');
                if (data.status === 'success') {
                    $.each(data.specialties, function (index, value) {
                        var tr = $('<tr class="tr_added" data-id="' + value.id + '">');
                        tr.append($('<td class="td_added" data-column="seq">').text(index + 1));
                        tr.append($('<td class="td_specialty" data-column="specialty">').text(value.specialty));

                        var btn = $('<td class="column-action"><button type="button" class="btn btn-danger btn-sm btn_delete_specialty" data-id="' + value.id + '"><i class="fa fa-trash"></i></button> </td>');
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
        var cellForm = $('table#table_specialties tbody');
        cellForm.on('click', 'td.td_specialty', function () {
            displayForm($(this));
        });

        function displayForm(cell) {
            var specialty_id = cell.closest('tr').data('id'),
                prevContent = cell.text(),
                form =  '<form>' +
                    '<input type="text" name="specialty" class="form-control" value="' + prevContent + '"/>' +
                    '<input type="hidden" name="specialty_id" class="form-control" value="' + specialty_id +'"/>' +
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
            $('#panel_specialty').block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/education-specialties/edit',
                type: 'post',
                dataType: 'JSON',
                data: post_data,
                success: function (data) {
                    cell.html(data.specialty.specialty);
                    cell.off('click');
                    $('#panel_specialty').unblock();
                    $.toast({
                        heading: 'تعديل تخصص دراسي',
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
                    $('#panel_specialty').unblock();
                    $.toast({
                        heading: 'تعديل التخصص الدراسي',
                        text: 'تعذر تعديل التخصص الدراسي',
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
            fetchEducationSpecialties();
            deleteEducationSpecialty();
            addEducationSpecialty();
            editItem();
        }
    }
}();

jQuery(document).ready(function () {
    EducationSpecialtyIndex.init();
});