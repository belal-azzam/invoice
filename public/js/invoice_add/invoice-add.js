$(document).ready(function () {

    $repeater = $('.repeater').repeater({
        // (Optional)
        // start with an empty list of repeaters. Set your first (and only)
        // "data-repeater-item" with style="display:none;" and pass the
        // following configuration flag
//                initEmpty: true,
        // (Optional)
        // "defaultValues" sets the values of added items.  The keys of
        // defaultValues refer to the value of the input's name attribute.
        // If a default value is not specified for an input, then it will
        // have its value cleared.
        defaultValues: {
            'text-input': 'foo'
        },
        // (Optional)
        // "show" is called just after an item is added.  The item is hidden
        // at this point.  If a show callback is not given the item will
        // have $(this).show() called on it.
        show: function () {
            console.log('1233');
            index = $('.invoice-item').length;
            $(this).find('input,select').each(function () {
                newId = $(this).data('id') + '-' + index;
                while ($('#'+newId).length > 0)
                {
                    newId = $(this).data('id') + '-' + index;
                    index++;
                }
                $(this).attr('id', newId);
            });
            $(this).slideDown();
        },
        // (Optional)
        // "hide" is called when a user clicks on a data-repeater-delete
        // element.  The item is still visible.  "hide" is passed a function
        // as its first argument which will properly remove the item.
        // "hide" allows for a confirmation step, to send a delete request
        // to the server, etc.  If a hide callback is not given the item
        // will be deleted.
        hide: function (deleteElement) {
            if(confirm('Are you sure you want to delete this element?')) {
                $(this).slideUp(deleteElement);
            }
        },
        // (Optional)
        // You can use this if you need to manually re-index the list
        // for example if you are using a drag and drop library to reorder
        // list items.
        ready: function (setIndexes) {
            console.log(setIndexes);
        },
        // (Optional)
        // Removes the delete button from the first list item,
        // defaults to false.
        isFirstItemUndeletable: true
    })

    function calculateTotals()
    {
        total = 0;
        $('.invoice-item').each(function () {
            itemPrice = $(this).find('.invoice-item__price').val();
            itemQunatity = $(this).find('.invoice-item__qunatity').val();
            if(itemPrice && itemQunatity)
            {
                itemSubtotal = itemPrice * itemQunatity;
                total += itemSubtotal;
                $(this).find('.invoice-item__subtotal').val(itemSubtotal);
            }
        })
        $('#total').val(total);
    }

    $('body').on('change', '.invoice-item__price,.invoice-item__qunatity', calculateTotals);

    // $('form').parsley();
//
//            $repeater.setList(
//                [
//                    {
//                        product_id: 1,
//                        quantity: 2,
//                        subtotal: 15,
//                        price: 10,
//                    }
//                ]
//            )
});
$(function () {
    $.datetimepicker.setLocale('en');

    $('#date').datetimepicker();
})
