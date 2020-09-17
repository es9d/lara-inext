<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $("#customer").select2({
        ajax: { 
            url: "{{ route('ajax.customers') }}",
            type: "get",
            dataType: "json",
            delay: 250,
            data: function (params) {
                return {
                    _token: CSRF_TOKEN,
                    search: params.term
                };
            },
            processResults: function (response) {
                console.log('dfdsaf')
                return {
                    results: response
                };
            },
            cache: true
        },
        templateSelection: function (data, container) {
            $(data.element).attr('data-currency', JSON.stringify(data.currency));
            $(data.element).attr('data-billing_address', data.billing_address);
            $(data.element).attr('data-shipping_address', data.shipping_address);
            return data.text;
        }
    });

    $("#customer").change(function() {
        setupCustomer();            
    });
    @if(isset($current_customer)&&$current_customer)
        setupCustomer();            
    @endif
    $("#add_product_row").click(function() {
        addProductRow();
    });

    $(".save_form_button").click(function() {
        var form = $(this).closest('form');
       
        // Remove price mask from values
        var price_inputs = form.find('.price_input');
        price_inputs.each(function (index, elem) {
            var price_input = $(elem);
            price_input.val(price_input.unmask());
        });

        // remove template from form
        var itemTemplate = $('#product_row_template');
        itemTemplate.remove()

        // replace all name="taxes[]" with name="taxes[rowId][]"
        $('tbody tr').each(function (index, element) {
            var row = $(element);
            var taxesInput = row.find('[name="taxes[]"]');
            taxesInput.attr('name', 'taxes[' + index + '][]');
        });
        
        // Submit form
        form.submit();
    });
    
    function calculatePercent(percent, amount) {
        var factor = Number(percent) / Number(100);
        return Number(amount) * Number(factor);
    }

    function setupCustomer(billing_address, shipping_address) {
        var customer_id = $("#customer").val();
        var currency = $('#customer').find(':selected').data('currency');
        
        // Setup currency
        window.sharedData.company_currency = currency;
        setupPriceInput(window.sharedData.company_currency);

        // Setup Address
        var billing_address = $('#customer').find(':selected').data('billing_address');
        var shipping_address = $('#customer').find(':selected').data('shipping_address');
        $("#billing_address").text(billing_address);
        $("#shipping_address").text(shipping_address);
        $("#address_component").removeClass('d-none');
    }

    function initializeProductSelect2(elem) {
        elem.select2({
            ajax: { 
                url: "{{ route('ajax.products') }}",
                type: "get",
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return {
                        _token: CSRF_TOKEN,
                        search: params.term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            },
            templateSelection: function (data, container) {
                $(data.element).attr('data-taxes', JSON.stringify(data.taxes));
                $(data.element).attr('data-price', data.price);
                return data.text;
            }
        });

        elem.change(function() {
            var element = $(this);
            var selectedOption = element.find(':selected');
            var taxesSelect = element.closest('tr').find('[name="taxes[]"]');
            var priceInput = element.closest('tr').find('.price_input');

            // Set selected taxes from product
            var taxIds = [];
            var taxes = selectedOption.data('taxes');
            taxes.forEach(tax => {
                taxIds.push(tax.tax_type_id);
            });
            taxesSelect.val(taxIds);
            taxesSelect.trigger('change');

            // Set product price for price input
            priceInput.val(selectedOption.data('price'));
            priceInput.focusout();

            calculateRowPrice();
        });
    }

    function initializeTaxSelect2(elem) {
        elem.select2({
            placeholder: "{{ __('messages.select_taxes') }}",
        });
    }

    function calculateRowPrice() {
        var subTotal = 0;
        var taxes = {};

        $('tbody tr').each(function(index, element) {
            var row = $(element);

            // If the row is template just continue
            if(row.attr('id') == 'product_row_template') return;

            // quantity
            var quantity = Number(row.find('[name="quantity[]"]').val());

            // price
            var price = Number(row.find('.price_input').unmask()) / 100;

            // amount
            var amount = (quantity * price);

            // Calculate taxes
            var totalTaxAmount = Number(0);
            var selected_taxes = row.find('[name="taxes[]"]').find(':selected');
            selected_taxes.each(function (index, tax) {
                var percent = $(tax).data('percent');
                var taxAmount = calculatePercent(percent, amount);
                console.log("taxAmount", taxAmount);
                totalTaxAmount += Number(taxAmount);
            });

            // Add tax amount to Item Total
            amount = Number(amount) + Number(totalTaxAmount);

            // discount
            var discount = Number(row.find('[name="discount[]"]').val());

            // calculate discount
            if(!isNaN(discount) && discount != undefined && discount != 0) {
                var discountAmount = calculatePercent(discount, amount);
                amount = Number(amount) - Number(discountAmount);
            }

            // Add Item Total to Sub Total
            subTotal += Number(amount);

            var amountPrice = Number(amount);

            // Set price input value
            row.find('.amount_price').val(amountPrice.toFixed(2));
            row.find('.amount_price').focusout();
        });

        calculateTotalPrice(subTotal, taxes);
    }

    function calculateTotalPrice(subTotal, taxes) {
        // Total value
        total = 0;
        total += subTotal;

        // Set subtotal value
        subtotal = Number(subTotal);
        $('#sub_total').val(subtotal.toFixed(2));

        // total taxes
        var total_taxes = $('#total_taxes').find(':selected');
        total_taxes.each(function (index, tax) {
            var taxName = $(tax).text();
            var percent = $(tax).data('percent');
            var taxAmount = calculatePercent(percent, subTotal);

            // push tax to taxes array
            if(taxes[taxName]) {
                taxes[taxName] += Number(taxAmount);
            } else {
                taxes[taxName] = Number(taxAmount);
            }
        });
 
        // Display total tax list
        $('.total_tax_list').empty();
        for (var [name, amount] of Object.entries(taxes)) {
            var template = '<div class="d-flex align-items-center mb-3">' +
                '<div class="h6 mb-0 w-50">' +
                '    <strong class="text-muted">' + name + '</strong>' +
                '</div>' +
                '<div class="ml-auto h6 mb-0">' +
                '    <input type="text" class="price_input price-text w-100 fs-inherit" value="'+ Number(amount).toFixed(2) +'" disabled>' +
                '</div>' +
            '</div>';

            $('.total_tax_list').append(template);

            total = Number(total) + Number(amount);
        }
 
        // total discount
        var total_discount = $('#total_discount').val();
        if(total_discount != undefined && total_discount != 0) {
            total_discount = parseFloat(total_discount);
            var discountAmount = calculatePercent(total_discount, subTotal)
            total = Number(total) - Number(discountAmount)
        }

        $('#grand_total').val(Number(total).toFixed(2));
        setupPriceInput(window.sharedData.company_currency);
    }

    function initializePriceListener() {
        $(".priceListener").change(function() {
            calculateRowPrice()    
        });
    }

    function addProductRow() {
        var productItems = $('#items');
        var template = $('#product_row_template')
                .clone()
                .removeAttr('id')
                .removeClass('d-none');
        productItems.append(template);

        var product_select = template.find('[name="product[]"]');
        initializeProductSelect2(product_select);

        var tax_select = template.find('[name="taxes[]"]');
        initializeTaxSelect2(tax_select);

        initializePriceListener();
        calculateRowPrice();
    }

    function removeRow(elem) {
        $(elem).closest('tr').remove();
        calculateRowPrice();
    }

    function validateForm() {
        $('tbody tr').each(function(index, element) {
            var row = $(element);
            var product = row.find('[name="product[]"]')
        });
    }
    
</script>