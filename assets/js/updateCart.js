$(document).ready(function () {

    cookie = JSON.parse(Cookies.get('cart'));
    var cookie_name = 'cart';
    console.log(cookie);

    var product_price = 0;
    var subtotal = 0;
    var total = 0;
    $('.product_amount').each(function (i, obj) {
        // define product.
        var product = $(obj);

        function updateCookie() {
            // update amount value.
            cookie[i].amount = product.val();
            // get array back to std object for php.
            var cookie_value = JSON.stringify(cookie);
            console.log(cookie_value);
            // update cookie.
            Cookies.set(cookie_name, cookie_value);
        }

        // create function for calculation subtotal.
        function countSubtotal() {
            $('.subtotal').each(function (ar, obj) {
                //define subtotal.
                if (i == ar) {
                    product_price = $('.product_price')[i]['innerHTML'].replace(/[^0-9\.]/g, '');
                    var productVal = product.val();
                    subtotal = product.val() * product_price
                    $(obj).text(subtotal.toFixed(2));
                }
            });
        }

        // run function.
        countSubtotal();

        // update subtotal after changes are made to amount.
        product.bind("keyup change", function (e) {
            updateCookie();
            countSubtotal();
            countTotal();
        });
    });

    // count total
    function countTotal() {
        var total = 0
        $('.subtotal').each(function () {
            // count total price.
            total += parseInt($(this).text().replace(/[^0-9\.]/g, ''));
        });
        $('.total_div').remove();
        last_td = $('.last_td').last().append('<div class="total_div"><br> <hr>\
          <p>Totaal: € '+total+' </p>\
           <a class="btn btn-primary" role="button" href="" style="background - color: rgb(169, 169, 169); color: #fff;">Doorgaan naar afrekenen</a></div>');
        console.log(last_td); 
    }
    countTotal();
});

    // <td>Totaal artikelen : € 15.95<br>Verzendkosten : &nbsp;€ 6.95
    // <hr>
    // <p>Totaal : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;€ 22.90</p>
    // <a class="btn btn-primary" role="button" href="gegevens.html" style="background-color:rgb(169,169,169);color:#fff;">Doorgaan naar afrekenen</a>