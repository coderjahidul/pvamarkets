(function ($) {
    'use strict';
    $('.sinekAddNewBtn').click(function () {
        var html = `
        <tr>
                <th></th>
                <td>
                    <input type="text" name="woocommerce_sinek_payment_domains[]" value="" /> <button type="button" style="cursor: pointer;
        background: #d50505;
        border: none;
        color: #fff;
        height: 30px;
        width: 30px;
        line-height: 28px;
        border-radius: 2px;" class="sinekRemoveBtn">x</button>
                </td>
            </tr>
        `;

        $('.sinek-form-table').append(html);
    });

    $(document).on('click','.sinekRemoveBtn',function() {
        $(this).closest('tr').remove();
    })
})(jQuery)