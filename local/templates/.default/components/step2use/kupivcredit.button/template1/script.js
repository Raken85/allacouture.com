BX.ready(function() {
    var orderButton = {
        title: BX.message('S2U_COMP_KUPIVCREDIT_WIN_ORDER_BUTTON_TEXT'),
        id: 'order-btn',
        name: 'order-btn',
        className: BX.browser.IsIE() && BX.browser.IsDoctype() && !BX.browser.IsIE10() ? '' : 'adm-btn-save',
        action: function () {
            BX('s2u-order-credit-form').submit();
        }
    };
    var creditPopup = new BX.CDialog({
        title: BX.message('S2U_COMP_KUPIVCREDIT_WIN_TITLE'),
        content: BX('s2u-credit-window-text').innerHTML,
        draggable: false,
        resizable: false,
        buttons: [/*orderButton, */BX.CDialog.btnClose]
    });
    BX.bind(BX('s2u-open-credit-button'), 'click', function() {
        creditPopup.Show();
    });
});