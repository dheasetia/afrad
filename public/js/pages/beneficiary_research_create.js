var ResearchCreate = function () {

    var hijriToGreg = function (delimiter, hijriString) {
        var gc = $.calendars.instance(),
            uc = $.calendars.instance('ummalqura', 'ar');

        var numbers = hijriString.split(delimiter),
            day     = parseInt(numbers[0]),
            month   = parseInt(numbers[1]),
            year    = parseInt(numbers[2]);
        if (uc.isValid(year, month, day)) {
            var JD = uc.newDate(year, month, day).toJD();
            gregDate = gc.fromJD(JD);
            return gc.formatDate('dd/ mm/ yyyy', gregDate);
        } else {
            alert('التاريخ الهجري غير صحيح')
            return '';
        }
    };

    var handleHijri = function() {
        var hijriInput = document.getElementById('hijri_research_date'),
            gregInput = document.getElementById('research_date'),
            uqc = $.calendars.instance('ummalqura', 'ar'),
            todayHijri = uqc.today();

        if (hijriInput.value = uqc.formatDate('dd/ mm/ yyyy', todayHijri)) {
            gregInput.value = hijriToGreg('/ ', hijriInput.value);
        }

        hijriInput.addEventListener('blur', function () {
            gregInput.value = hijriToGreg('/ ', hijriInput.value);
        });

    };

    var handleSelect = function () {
        $('#beneficiary_id').val("");
        $('#research_kind_id').val("");
    };

    var handleIncomes = function () {
        var incomeList = $('#income_list');
        var selectIncome = $('#select_income');
        selectIncome.val('');
        selectIncome.on('change', function () {
            var income_input_length = ($('.income_input').length) + 1;
            var income_id = $(this).val();
            if (income_id === '') {
                return false;
            }
            var income_text = $(this).find('option:selected').html();

            var temp_id = $('button#btn_delete_income_' + income_id);
            if (temp_id.length > 0) {
                $.toast({
                    heading: ' إضافة مصدر دخل ',
                    text: 'مصدر الدخل "' + income_text + '" موجود',
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: 'error',
                    hideAfter: 3500,
                    textAlign: 'right',
                    stack: 6
                });
                return false;
            }

            var component = $('<div class="col-md-6 income_input_group">');
            var inputGroup = $('<div class="col-xs-9 ">');
            var deleteGroup = $('<div class="col-xs-3 delete-group">');

            var formGroup = $('<div class="form-group">');
            var label = $('<label for="income_amount_' + income_input_length + '" class="control-label">').text(income_text);
            var input = $('<input type="text" name="income_amount_' + income_id + '" id="income_amount_' + income_input_length + '" class="form-control income_input">');

            var deleteBtn = $('<button type="button" class="btn btn-danger waves-effect waves-light btn-delete btn_delete_income" id="btn_delete_income_' + income_id + '" tabindex="-1"><i class="fa fa-trash"></i></button>');
            deleteBtn.attr('data-id', income_id);
            formGroup.append(label).append(input);
            deleteGroup.append(deleteBtn);

            inputGroup.append(formGroup);
            component.append(inputGroup).append(deleteGroup);
            component.appendTo('#income_list').slideDown('slow');
        });

        // update percentage on input blur
        incomeList.on('keyup', '.income_input', function(){
            updatePercentage();
        });

        incomeList.on('focus', '.income_input', function(){
            $(this).select();
        });

        // remove element
        incomeList.on('click', '.btn_delete_income', function(){
            $(this).closest('.income_input_group').slideUp('slow', function () {
                $(this).remove();
                updatePercentage();
            });
        });

    };

    var handleExpenses = function () {
        var expenseList = $('#expense_list'),
            selectExpense = $('#select_expense');

        selectExpense.val('');

        selectExpense.on('change', function () {
            var expense_input_length = ($('.expense_input').length) + 1;
            var expense_id = $(this).val();

            if (expense_id === '') {
                return false;
            }
            var expense_text = $(this).find('option:selected').html();
            var temp_id = $('button#btn_delete_expense_' + expense_id);
            if (temp_id.length > 0) {
                $.toast({
                    heading: ' إضافة مصروف ',
                    text: 'مصروف "' + expense_text + '" موجود',
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: 'error',
                    hideAfter: 3500,
                    textAlign: 'right',
                    stack: 6
                });
                return false;
            }

            var component = $('<div class="col-md-6 expense_input_group">');
            var inputGroup = $('<div class="col-xs-9">');
            var deleteGroup = $('<div class="col-xs-3">');

            var formGroup = $('<div class="form-group">');
            var label = $('<label for="expense_amount_' + expense_input_length + '" class="control-label">').text(expense_text);
            var input = $('<input type="text" name="expense_amount_' + expense_id + '" id="expense_amount_' + expense_input_length + '" class="form-control expense_input">');

            var deleteBtn = $('<button type="button" class="btn btn-danger waves-effect waves-light btn-delete btn_delete_expense" id="btn_delete_expense_' + expense_id + '" tabindex="-1"><i class="fa fa-trash"></i></button>');
            deleteBtn.attr('data-id', expense_id);
            formGroup.append(label).append(input);
            deleteGroup.append(deleteBtn);

            inputGroup.append(formGroup);
            component.append(inputGroup).append(deleteGroup);
            component.appendTo('#expense_list').slideDown('slow');

        });

        // update percentage on input blur
        expenseList.on('keyup', '.expense_input', function(){
            updatePercentage();
        });

        expenseList.on('focus', '.expense_input', function(){
            $(this).select();
        });

        // remove element
        expenseList.on('click', '.btn_delete_expense', function(){
            $(this).closest('.expense_input_group').slideUp('slow', function () {
                $(this).remove();
                updatePercentage();
            });
        });

    };

    var handleMoneyNeeds = function () {
        var moneyNeedList = $('#money_need_list'),
            selectMoneyNeed = $('#select_money_need');

        selectMoneyNeed.val('');

        selectMoneyNeed.on('change', function () {
            var money_need_input_length = $('.money_need_input').length + 1;

            var money_need_id = $(this).val();

            if (money_need_id === '') {
                return false;
            }
            var money_need_text = $(this).find('option:selected').html();

            var temp_id = $('button#btn_delete_money_need_' + money_need_id);
            if (temp_id.length > 0) {
                $.toast({
                    heading: ' إضافة احتياج عيني ',
                    text: 'احتياج عيني "' + money_need_text + '" موجود',
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: 'error',
                    hideAfter: 3500,
                    textAlign: 'right',
                    stack: 6
                });
                return false;
            }

            var component = $('<div class="money_need_input_group">');
            var inputGroup = $('<div class="col-xs-9">');
            var deleteGroup = $('<div class="col-xs-3">');

            var formGroup = $('<div class="form-group">');
            var label = $('<label for="money_need_amount_' + money_need_input_length + '" class="control-label">').text(money_need_text);
            var input = $('<input type="text" name="money_need_amount_' + money_need_id + '" id="money_need_amount_' + money_need_input_length + '" class="form-control money_need_input">');

            var deleteBtn = $('<button type="button" class="btn btn-danger waves-effect waves-light btn-delete btn_delete_money_need" id="btn_delete_money_need_' + money_need_id + '" tabindex="-1"><i class="fa fa-trash"></i></button>');
            deleteBtn.attr('data-id', money_need_id);
            formGroup.append(label).append(input);
            deleteGroup.append(deleteBtn);

            inputGroup.append(formGroup);
            component.append(inputGroup).append(deleteGroup);
            component.appendTo('#money_need_list').slideDown('slow');
            $('#money_need_list').append(component);

        });

        // update need on input blur
        moneyNeedList.on('keyup', '.money_need_input', function(){
            updateNeed();
        });

        moneyNeedList.on('focus', '.money_need_input', function(){
            $(this).select();
        });


        // remove element
        moneyNeedList.on('click', '.btn_delete_money_need', function(){
            $(this).closest('.money_need_input_group').slideUp('slow', function () {
                $(this).remove();
                updateNeed();
            });
        });

    };

    var handleItemNeeds = function () {
        var itemNeedList = $('#item_need_list'),
            selectItemNeed = $('#select_item_need');

        selectItemNeed.val('');

        selectItemNeed.on('change', function () {
            var item_need_input_length = $('.item_form_group').length + 1;
            var item_need_id = $(this).val();

            if (item_need_id === '') {
                return false;
            }
            var item_need_text = $(this).find('option:selected').html();

            var temp_id = $('button#btn_delete_item_need_' + item_need_id);
            if (temp_id.length > 0) {
                $.toast({
                    heading: ' إضافة احتياج عيني ',
                    text: 'احتياج عيني "' + item_need_text + '" موجود',
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: 'error',
                    hideAfter: 3500,
                    textAlign: 'right',
                    stack: 6
                });
                return false;
            }

            var itemFormGroup = $('<div class="col-md-3 item_form_group" id="item_form_group_' + item_need_input_length +'">');
            var btnDelete = $('<button type="button" class="btn_delete_item_need" id="btn_delete_item_need_' + item_need_id + '"><i class="fa fa-times-circle-o "></i>');
            var boxTitle = $('<h3 class="text-center text-white">').html(item_need_text);
            itemFormGroup.append(btnDelete).append(boxTitle);

            var priceGroup = $('<div class="form-group">');
            var priceLabel = $('<label for="item_need_price_' + item_need_id + '" class="control-label">').text('السعر');
            var priceInput = $('<input type="text" name="item_need_price_' + item_need_id + '" id="item_need_price_' + item_need_id + '" class="form-control item_need_price">');
            priceGroup.append(priceLabel).append(priceInput);

            var quantityGroup = $('<div class="form-group">');
            var quantityLabel = $('<label for="item_need_quantity_' + item_need_id + '" class="control-label">').text('الكمية');
            var quantityInput = $('<input type="text" name="item_need_quantity_' + item_need_id + '" id="item_need_quantity_' + item_need_id + '" class="form-control item_need_quantity">');
            quantityGroup.append(quantityLabel).append(quantityInput);

            var subTotalGroup = $('<div class="form-group">');
            var subTotalLabel = $('<label for="item_need_sub_total_' + item_need_id + '" class="control-label">').text('الإجمالي');
            var subTotalInput = $('<input type="text" name="item_need_sub_total_' + item_need_id + '" id="item_need_sub_total_' + item_need_id + '" class="form-control item_need_sub_total" readonly tabindex="-1">');
            subTotalGroup.append(subTotalLabel).append(subTotalInput);

            itemFormGroup.append(priceGroup).append(quantityGroup).append(subTotalGroup);

            itemFormGroup.appendTo(itemNeedList).slideDown('slow');

        });

        // update need on input blur
        itemNeedList.on('keyup', 'input[type=text]', function(){
            updateNeed();
        });

        itemNeedList.on('focus', 'input[type=text]', function(){
            $(this).select();
        });

        itemNeedList.on('click', 'button.btn_delete_item_need', function () {
            $(this).closest('.item_form_group').slideUp('slow', function () {
                $(this).remove();
                updateNeed();
            })
        })

    };

    var addKind = function () {
        var modal = $('#modal_add_kind');
        var btn_save = modal.find('#btn_save_add_kind');
        var input = modal.find("#form_add_kind input#kind_add_input");

        modal.on('shown.bs.modal', function () {
            input.focus();
        });

        input.on('keydown', function (event) {
            if(event.keyCode === 13) {
                event.preventDefault();
            }
        });

        btn_save.on('click', function () {
            postKind();
        });

        $('#btn_add_kind').on('click', function () {
            input.val('');
            modal.modal();
        });

        function postKind() {
            if (input.val() === '') {
                $.toast({
                    heading: 'إضافة نوع حالة',
                    text: 'فضلا أدخل نوع الحالة',
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: 'error',
                    hideAfter: 3500,
                    textAlign: 'right',
                    stack: 6
                });
                return false;
            }
            var kind = $('#form_add_kind').find('input#kind_add_input').val();
            modal.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري العملية ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/research-kinds',
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    kind: kind
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var option = $('<option>');
                        option.val(data.kind.id);
                        option.text(data.kind.kind);
                        $('#research_kind_id').append(option);
                        modal.unblock();
                        $.toast({
                            heading: 'إضافة نوع الحالة',
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
                            heading: 'إضافة نوع الحالة',
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
                        heading: 'إضافة نوع الحالة',
                        text: 'تعذرت عملية إضافة نوع الحالة',
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

    var addIncome = function () {
        var modal = $('#modal_add_income');
        var btn_save = modal.find('#btn_save_add_income');
        var input = modal.find("#form_add_income input#income_add_input");

        modal.on('shown.bs.modal', function () {
            input.focus();
        });

        input.on('keydown', function (event) {
            if(event.keyCode === 13) {
                event.preventDefault();
            }
        });

        btn_save.on('click', function () {
            postIncome();
        });

        $('#btn_add_income').on('click', function () {
            input.val('');
            modal.modal();
        });

        function postIncome() {
            if (input.val() === '') {
                return false;
            }
            var income = $('#form_add_income').find('input#income_add_input').val();
            modal.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري العملية ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/incomes',
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    income: income
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var option = $('<option>');
                        option.val(data.income.id);
                        option.text(data.income.income);
                        $('#select_income').append(option);
                        modal.unblock();
                        $.toast({
                            heading: 'إضافة مصدر دخل جديد',
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
                            heading: 'إضافة مصدر دخل جديد',
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
                        heading: 'إضافة مصدر دخل',
                        text: 'تعذرت عملية إضافة مصدر دخل',
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

    var addExpense = function () {
        var modal = $('#modal_add_expense');
        var btn_save = modal.find('#btn_save_add_expense');
        var input = modal.find("#form_add_expense input#expense_add_input");

        modal.on('shown.bs.modal', function () {
            input.focus();
        });

        input.on('keydown', function (event) {
            if(event.keyCode === 13) {
                event.preventDefault();
            }
        });

        btn_save.on('click', function () {
            postIncome();
        });

        $('#btn_add_expense').on('click', function () {
            input.val('');
            modal.modal();
        });

        function postIncome() {
            if (input.val() === '') {
                return false;
            }
            var expense = $('#form_add_expense').find('input#expense_add_input').val();
            modal.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري العملية ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/expenses',
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    expense: expense
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var option = $('<option>');
                        option.val(data.expense.id);
                        option.text(data.expense.expense);
                        $('#select_expense').append(option);
                        modal.unblock();
                        $.toast({
                            heading: 'إضافة مصروف جديد',
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
                            heading: 'إضافة مصروف جديد',
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
                        heading: 'إضافة مصروف',
                        text: 'تعذرت عملية إضافة مصروف',
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

    var addMoneyNeed = function () {
        var modal = $('#modal_add_money_need');
        var btn_save = modal.find('#btn_save_add_money_need');
        var input = modal.find("#form_add_money_need input#money_need_add_input");

        modal.on('shown.bs.modal', function () {
            input.focus();
        });

        input.on('keydown', function (event) {
            if(event.keyCode === 13) {
                event.preventDefault();
            }
        });

        btn_save.on('click', function () {
            postIncome();
        });

        $('#btn_add_money_need').on('click', function () {
            input.val('');
            modal.modal();
        });

        function postIncome() {
            if (input.val() === '') {
                return false;
            }
            var money_need = $('#form_add_money_need').find('input#money_need_add_input').val();
            modal.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري العملية ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/money-needs',
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    description: money_need
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var option = $('<option>');
                        option.val(data.need.id);
                        option.text(data.need.description);
                        $('#select_money_need').append(option);
                        modal.unblock();
                        $.toast({
                            heading: 'إضافة احتياج عيني ',
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
                            heading: 'إضافة مصدر احتياج عيني',
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
                        heading: 'إضافة احتياج عيني',
                        text: 'تعذرت عملية إضافة احتياج مالي',
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

    var addItemNeed = function () {
        var modal = $('#modal_add_item_need');
        var btn_save = modal.find('#btn_save_add_item_need');
        var input = modal.find("#form_add_item_need input#item_need_add_input");

        modal.on('shown.bs.modal', function () {
            input.focus();
        });

        input.on('keydown', function (event) {
            if(event.keyCode === 13) {
                event.preventDefault();
            }
        });

        btn_save.on('click', function () {
            postIncome();
        });

        $('#btn_add_item_need').on('click', function () {
            input.val('');
            modal.modal();
        });

        function postIncome() {
            if (input.val() === '') {
                return false;
            }
            var item_need = $('#form_add_item_need').find('input#item_need_add_input').val();
            modal.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري العملية ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/item-needs',
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    item: item_need
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var option = $('<option>');
                        option.val(data.need.id);
                        option.text(data.need.item);
                        $('#select_item_need').append(option);
                        modal.unblock();
                        $.toast({
                            heading: 'إضافة احتياج عيني ',
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
                            heading: 'إضافة مصدر احتياج عيني',
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
                        heading: 'إضافة احتياج عيني',
                        text: 'تعذرت عملية إضافة احتياج عيني',
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

    var getSelectedBen = function() {
        $('#beneficiary_id').on('change', function () {
            var ben_id = $(this).val();

            var national_number = $('#national_number'),
                nationality = $('#nationality'),
                marital_status = $('#marital_status'),
                family_member_count = $('#family_member_count'),
                son_count = $('#son_count'),
                daughter_count = $('#daughter_count'),
                ben_panel = $('#ben_panel');

            var clearBenFields = function () {
                national_number.text('');
                nationality.text('');
                marital_status.text('');
                family_member_count.text('');
                son_count.text('');
                daughter_count.text('');
            };
            if (ben_id === '') {
                clearBenFields();
                return false;
            }

            ben_panel.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري استعلام المستفيد ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });
            $.ajax({
                url         : '/ajax/getbeneficiary',
                type        : 'POST',
                dataType    : 'JSON',
                data        : {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    ben_id: ben_id
                },
                success : function (data) {
                    national_number.text(data.national_number);
                    nationality.text(data.nationality);
                    marital_status.text(data.marital_status);
                    family_member_count.text(data.family_member_count);
                    son_count.text(data.son_count);
                    daughter_count.text(data.daughter_count);
                    ben_panel.unblock();
                },
                error: function () {
                    ben_panel.unblock();
                    $.toast({
                        heading: 'عذرا...',
                        text: 'لم يعثر على بيانات المستفيد',
                        position: 'top-right',
                        loaderBg:'#ff6849',
                        icon: 'error',
                        hideAfter: 3500,
                        textAlign: 'right',
                        stack: 6
                    });
                    clearBenFields();
                }
            });
        });
    };

    var updatePercentage = function () {
        var incomeInputs = $('.income_input_group'),
            expenseInputs = $('.expense_input_group');

        var totalIncomes = 0, totalExpenses = 0, totalDiff, totalPercentage = 0;

        $.each(incomeInputs, function () {
            var incomeInput = $(this).find('.income_input');
            if (incomeInput.val() !== '') {
                if (isNaN(incomeInput.val())) {
                    alert('خطأ في المبلغ');
                    incomeInput.select();
                    return false;
                }
                totalIncomes += parseInt(incomeInput.val());
            }
        });

        $.each(expenseInputs, function () {
            var expenseInput = $(this).find('.expense_input');
            if (expenseInput.val() !== '') {
                if (isNaN(expenseInput.val())) {
                    alert('خطأ في المبلغ');
                    expenseInput.select();
                    return false;
                }
                totalExpenses += parseInt(expenseInput.val());
            }
        });

        totalDiff = totalIncomes - totalExpenses;
        if (totalIncomes !== 0) {
            totalPercentage = Math.floor(100 - (totalExpenses / totalIncomes) * 100);
        }

        $('#total_income').text(new Intl.NumberFormat().format(totalIncomes));
        $('#total_expense').text(new Intl.NumberFormat().format(totalExpenses));
        $('#total_diff').text(new Intl.NumberFormat().format(totalDiff));
        $('#total_percentage').text(totalPercentage + '%');

        if (totalDiff < 0 ) {
            $('#total_diff').closest('.sub-total').removeClass('bg-info').addClass('bg-merah');
        } else {
            $('#total_diff').closest('.sub-total').removeClass('bg-merah').addClass('bg-info');
        }

        if (totalPercentage < 0) {
            $('#total_percentage').closest('.sub-total').removeClass('bg-info').addClass('bg-merah');
        } else {
            $('#total_percentage').closest('.sub-total').removeClass('bg-merah').addClass('bg-info');
        }
    };

    var getSubtotal = function (itemNeedBlock) {
        var inputPrice = itemNeedBlock.find('.item_need_price'),
            price = inputPrice.val(),
            inputCount = itemNeedBlock.find('.item_need_quantity'),
            count = inputCount.val(),
            inputSubTotal = itemNeedBlock.find('.item_need_sub_total');

        if (price !== '') {
            if (isNaN(price)) {
                alert('خطأ في السعر');
                inputPrice.select();
                return false;
            }
        }

        if (count !== '') {
            if (isNaN(count)) {
                alert('خطأ في الكمية');
                inputCount.select();
                return false;
            }
        }
        var subTotal= price * count;

        inputSubTotal.val(new Intl.NumberFormat().format(subTotal));

        return subTotal;
    };

    var updateNeed = function () {
        var money_need_inputs = $('.money_need_input_group'),
            item_need_blocks = $('.item_form_group');

        var totalMoneyNeeds = 0, totalItemNeeds = 0, totalNeeds;

        $.each(money_need_inputs, function () {
            var money_need_input = $(this).find('.money_need_input');
            if (money_need_input.val() !== '') {
                if (isNaN(money_need_input.val())) {
                    alert('خطأ في المبلغ');
                    money_need_input.select();
                    return false;
                }
                totalMoneyNeeds += parseInt(money_need_input.val());
            }
        });

        $('#total_money_need').text(totalMoneyNeeds);


        $.each(item_need_blocks, function () {
            totalItemNeeds += getSubtotal($(this));
        });

        $('#total_item_need').text(new Intl.NumberFormat().format(totalItemNeeds));

        totalNeeds = totalMoneyNeeds + totalItemNeeds;

        $('#total_all_need').text(new Intl.NumberFormat().format(totalNeeds));

    };

    var handleSave = function () {
        var btnSave = $('#btn_save_research');
        btnSave.click(function () {
            var form = $('#form_research_create');
            if (form.valid() && checkRequiredInputs()) {
                 var beneficiaryId = $('input[name="beneficiary_id"]')[0].value;
                 var researchKindId = $('#research_kind_id').val();
                 var incomeList = $('.income_input_group');
                 var expenseList = $('.expense_input_group');

                 var moneyNeedList = $('.money_need_input_group');
                 var itemNeedList = $('.item_form_group');

                 var researchInputs = {};
                 researchInputs._token = $('meta[name="csrf-token"]').attr('content');
                 researchInputs.beneficiary_id = beneficiaryId;
                 researchInputs.research_kind_id = researchKindId;
                 researchInputs.research_date = $('#research_date').val();
                 researchInputs.hijri_research_date = $('#hijri_research_date').val();
                 researchInputs.place = $('#place').val();
                 researchInputs.researcher_id = $('#researcher_id').val();
                 researchInputs.employee_research_name = $('#employee_research_name').val();
                 researchInputs.director_research_name = $('#director_research_name').val();
                 researchInputs.researcher_recommendation = $('#researcher_recommendation').val();

                 $.each(incomeList, function () {
                     var input = $(this).find('.income_input');
                     if (input.val() !== '') {
                         researchInputs[input.attr('name')] = input.val();
                     }
                 });

                 $.each(expenseList, function () {
                     var input = $(this).find('.expense_input');
                     if (input.val() !== '') {
                         researchInputs[input.attr('name')] = input.val();
                     }
                 });

                 $.each(moneyNeedList, function () {
                     var input = $(this).find('.money_need_input');
                     if (input.val() !== '') {
                         researchInputs[input.attr('name')] = input.val();
                     }
                 });

                 $.each(itemNeedList, function () {
                     var inputPrice = $(this).find('.item_need_price');
                     if (inputPrice.val() !== '') {
                         researchInputs[inputPrice.attr('name')] = inputPrice.val();
                     }

                     var inputQuantity = $(this).find('.item_need_quantity');
                     if (inputQuantity.val() !== '') {
                         researchInputs[inputQuantity.attr('name')] = inputQuantity.val();
                     }

                     var inputSubtotal = $(this).find('.item_need_sub_total');
                     if (inputSubtotal.val() !== '' || inputSubtotal.val() !== '0') {
                         researchInputs[inputSubtotal.attr('name')] = inputSubtotal.val();
                     }
                 });

                $.ajax({
                    url: '/ajax/researches',
                    type: 'POST',
                    dataType: 'JSON',
                    data: researchInputs,
                    success: function (data) {
                        if (data.status === 'success') {
                            window.location.replace("/researches/" + data.research.id);
                        } else {
                            $.toast({
                                heading: ' حفظ بيانات دراسة حالة ',
                                text: 'تعذر حفظ البيانات، فضلا أعد المحاولة مرة أخرى',
                                position: 'top-right',
                                loaderBg:'#ff6849',
                                icon: 'error',
                                hideAfter: 5000,
                                textAlign: 'right',
                                stack: 6
                            });
                        }
                    },
                    error: function () {
                        $.toast({
                            heading: ' حفظ بيانات دراسة حالة ',
                            text: 'تعذر حفظ البيانات، فضلا أعد المحاولة مرة أخرى',
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    }
                });
            }
        });
    };

    var checkRequiredInputs = function () {
        var success = true,
            incomeInputs = $('.income_input_group'),
            expenseInputs = $('.expense_input_group'),
            moneyInputs = $('.money_need_input_group'),
            itemInputs = $('.item_form_group'),
            itemNeedPriceInputs = $('.item_need_price'),
            itemNeedQuantityInputs = $('.item_need_quantity'),
            itemNeedSubtotalInputs = $('.item_need_sub_total'),
            incomeSelect = $('#select_income'),
            expenseSelect = $('#select_expense'),
            moneyNeedSelect = $('#select_money_need'),
            itemNeedSelect = $('#select_item_need'),
            incomeGroup = incomeSelect.closest('.form-group'),
            expenseGroup = expenseSelect.closest('.form-group'),
            moneyNeedGroup = moneyNeedSelect.closest('.form-group'),
            itemNeedGroup = itemNeedSelect.closest('.form-group');

        if (incomeInputs.length === 0 || $('#total_income').text() == '0') {
            success = false;
            incomeGroup.addClass('has-error');
            incomeGroup.find('span.help-block').remove();
            $('<span class = "help-block">').html('فضلا أضف مصدر دخل').insertAfter(incomeSelect);
        } else {
            incomeGroup.removeClass('has-error');
            incomeGroup.find('span.help-block').remove();
        }

        if (expenseInputs.length === 0 || $('#total_expense').text() == '0') {
            success = false;
            expenseGroup.addClass('has-error');
            expenseGroup.find('span.help-block').remove();
            $('<span class = "help-block">').html('فضلا أضف مصروف').insertAfter(expenseSelect);
        } else {
            expenseGroup.removeClass('has-error');
            expenseGroup.find('span.help-block').remove();
        }

        if (moneyInputs.length === 0 || $('#total_money_need').text() == '0') {
            success = false;
            moneyNeedGroup.addClass('has-error');
            moneyNeedGroup.find('span.help-block').remove();
            $('<span class = "help-block">').html('فضلا أضف الاحتياجات المالية').insertAfter(moneyNeedSelect);
        } else {
            moneyNeedGroup.removeClass('has-error');
            moneyNeedGroup.find('span.help-block').remove();
        }

        if (itemInputs.length === 0 || $('#total_item_need').text() == '0') {
            success = false;
            itemNeedGroup.addClass('has-error');
            itemNeedGroup.find('span.help-block').remove();
            $('<span class = "help-block">').html('فضلا أضف الاحتياجات العينية').insertAfter(itemNeedSelect);
        }

        $.each(itemNeedPriceInputs, function () {
            if ($(this).val() == '' || $(this).val() == '0') {
                success = false;
                itemNeedGroup.addClass('has-error');
                itemNeedGroup.find('span.help-block').remove();
                $('<span class = "help-block">').html('فضلا أضف السعر بطريقة صحيحة').insertAfter(itemNeedSelect);
            }

        });

        $.each(itemNeedQuantityInputs, function () {
            if ($(this).val() == '' || $(this).val() == '0') {
                success = false;
                itemNeedGroup.addClass('has-error');
                itemNeedGroup.find('span.help-block').remove();
                $('<span class = "help-block">').html('فضلا أضف الكمية بطريقة صحيحة').insertAfter(itemNeedSelect);
            }

        });

        $.each(itemNeedSubtotalInputs, function () {
            if ($(this).val() == '' || $(this).val() == '0') {
                success = false;
                itemNeedGroup.addClass('has-error');
                itemNeedGroup.find('span.help-block').remove();
                $('<span class = "help-block">').html('فضلا أضف المواد بطريقة صحيحة').insertAfter(itemNeedSelect);
            }
        });







        return success;
    };

    jQuery.validator.addMethod("hijri", function(value, element) {
        return this.optional( element ) || /(0[1-9]|[1-2][0-9]|30)\/\s(0[1-9]|1[0-2])\/\s(13[3-9][0-9]|14[0-4][0-9])$/.test( value );
    }, 'تاريخ الهجري غير صحيح');

    jQuery.validator.addMethod("abah_date", function(value, element) {
        return this.optional( element ) || /(0[1-9]|[1-2][0-9]|30|31)\/\s(0[1-9]|1[0-2])\/\s(20[1-3][0-9])$/.test( value );
    }, 'تاريخ الميلادي غير صحيح');

    var handleValidation = function() {
        var form = $('#form_research_create');

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input
            rules: {
                research_kind_id: {
                    required: true
                },
                hijri_research_date: {
                    required: true,
                    hijri: true
                },
                research_date: {
                    required: true,
                    abah_date: true
                },
                place: {
                    required: true
                },
                researcher_name: {
                    required: true
                },
                beneficiary_id: {
                    required: true
                }
            },
            messages: {
                research_kind_id: {
                    required: 'نوع الحالة إلزامي'
                },
                hijri_research_date: {
                    required: 'التاريخ الهجري إلزامي',
                    hijri: 'التاريخ الهجري غير صحيح'
                },
                research_date: {
                    required: 'التاريخ الميلادي إلزامي',
                    abah_date: 'التاريخ الميلادي غير صحيح'
                },
                place: {
                    required: 'مكان عملية دراسة حالة إلزامي'
                },
                researcher_name: {
                    required: 'اسم الباحث إلزامي'
                },
                beneficiary_id: {
                    required: 'اسم المستفيد إلزامي'
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
                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function(element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function(form) {
                //form.submit();
            }
        });
    };

    return {
        init: function () {
            handleHijri();
            handleSelect();
            handleIncomes();
            handleMoneyNeeds();
            handleItemNeeds();
            getSelectedBen();
            handleExpenses();
            addKind();
            addIncome();
            addExpense();
            addMoneyNeed();
            addItemNeed();
            handleSave();
            handleValidation();
        }
    }

}();

jQuery(document).ready(function () {
    var input = $('input[name=beneficiary_id]');
    ResearchCreate.init();
});