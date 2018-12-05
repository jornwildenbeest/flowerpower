<?php   
error_reporting(-1);

require_once "assets/incl/header.php";
require_once "classes/product.php";
require_once "classes/deal.php";

$product = new product();
$deal = new deal();
$products = $product->find_all();
$deal_products = $product->find_by_sql("SELECT * FROM Products WHERE deal_ID=5 LIMIT 3");
// deal id.
$deals = $deal->find_by_id(5);

$deal_percentage = $deals[0]->percentage; 

?>
<div class="alert alert-success"  id="success-alert" style="display: none;">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>Success! </strong>
    Het product is toegevoegd aan het Winkelmandje.
</div>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Aanbiedingen</h1>
            <h4><?php echo $deals[0]->name; ?></h4>
        </div>
    </div>
    <div class="row">
    <?php
        foreach($deal_products as $deal_product):
            // calculate discount.
            $discount = $deal_product->price / 100 * $deal_percentage;
            $new_price = $deal_product->price - $discount;
            
            echo '<div class="col-md-4">';
                echo '<a href="index.php"><div class="homepage_product" style="background-image: url('.$deal_product->image_url.');"></div></a>';
                echo '<div class="product_info">';
                    echo '<a href=""><h2>'.$deal_product->name .'</h2></a>';
                    echo '<p class="product_price"><s>€'.$deal_product->price.'</s><span> €'. number_format($new_price, 2) .'</span></p>';
                    echo '<form method="POST" action="assets/intoCart.php" class="addToCartForm">';
                        echo '<input type="hidden" name="newprice" value="'.number_format($new_price, 2).'"/>';
                        echo '<input type="hidden" name="productID" value="'.$deal_product->ID.'"/>';
                        echo '<select name="amount" class="item_value">';
                            for ($i=1; $i < 11; $i++) {
                            echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                        echo '</select>';
                        echo '<button type="submit" class="cart_submit_button" name="submit">';
                            echo '<i class="fa fa-cart-plus add_button"></i>';
                        echo '</button>';
                    echo '</form>';
                echo '</div>';
            echo '</div>';
        endforeach;
    ?>
    </div>
</div>
<div class="intro_container">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="intro">
                    <h2>Onze winkel</h2>
                    <div class="table-responsive table-borderless">
                        <table class="table table-bordered table-sm">
                            <tbody>
                                <tr>
                                    <td>Openingstijden:</td>
                                    <td>Maandag tot vrijdag: 08:30 - 17:00<br>Zaterdag: 10:00 - 15:00<br>Zondag: Gesloten<br></td>
                                </tr>
                                <tr>
                                    <td>Adres<br></td>
                                    <td>Flowerpowerstraat 5<br>1234AB<br>Flowerpowerplaats</td>
                                </tr>
                                <tr>
                                    <td>Telefoon<br></td>
                                    <td>0612345678</td>
                                </tr>
                                <tr>
                                    <td>E-mail<br></td>
                                    <td>info@powerflower.nl</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-5"><img src="http://jorn-wildenbeest.gcmediavormgeving.nl/flowerpower/bloemenzaak.jpg"></div>
        </div>
    </div>
</div>
<div class="gallery_container">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Gallerij</h1>
            </div>
        </div>
        <div class="row">
            <?php 
                foreach($products as $product):
                    if($product->deal_ID > 1){
                        // calculate discount.
                        $deals = $deal->find_by_id($product->deal_ID);
                        $deal_percentage = $deals[0]->percentage; 

                        $discount = $product->price / 100 * $deal_percentage;
                        $new_price = $product->price - $discount;

                        echo '<div class="col-md-4">';
                            echo '<a href="index.php"><div class="homepage_product" style="background-image: url('.$product->image_url.');"></div></a>';
                            echo '<div class="product_info">';
                                echo '<a href=""><h2>'.$product->name.'</h2></a>';
                                echo '<p class="product_price"><s>€'.$product->price.'</s><span> €'. number_format($new_price, 2) .'</span></p>';
                                echo '<form method="POST" action="assets/intoCart.php" class="addToCartForm">';
                                    echo '<input type="hidden" name="productID" value="'.$product->ID.'"/>';
                                    echo '<input type="hidden" name="newprice" value="'.number_format($new_price, 2).'"/>';
                                    echo '<select name="amount" class="item_value">';
                                        for ($i=1; $i < 11; $i++) {
                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                    echo '</select>';
                                    echo '<button type="submit" class="cart_submit_button" name="submit">';
                                        echo '<i class="fa fa-cart-plus add_button"></i>';
                                    echo '</button>';
                                echo '</form>';
                            
                            echo '</div>';
                        echo '</div>';
                    } else {
                        echo '<div class="col-md-4">';
                            echo '<a href="index.php"><div class="homepage_product" style="background-image: url('.$product->image_url.');"></div></a>';
                            echo '<div class="product_info">';
                                echo '<a href=""><h2>'.$product->name.'</h2></a>';
                                echo '<p class="product_price"><span> €'. $product->price .'</span></p>';                        
                                echo '<form method="POST" action="assets/intoCart.php" class="addToCartForm">';
                                    echo '<input type="hidden" name="productID" value="'.$product->ID.'"/>';
                                    echo '<select name="amount" class="item_value">';
                                        for ($i=1; $i < 11; $i++) {
                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                    echo '</select>';
                                    echo '<button type="submit" class="cart_submit_button" name="submit">';
                                        echo '<i class="fa fa-cart-plus add_button"></i>';
                                    echo '</button>';
                                echo '</form>';
                            
                            echo '</div>';
                        echo '</div>';
                    }
                endforeach;
            ?>
        </div>
    </div>
</div>

<?php require_once "assets/incl/footer.php"; ?>

<script>
    $(".add_button").click(function showAlert() {
        reloadPage();
    });


  function succesAlert() {
    console.log("test");
        $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
            $("#success-alert").slideUp(1000);
        });
  }

  window.onload = function() {
    var reloading = sessionStorage.getItem("reloading");
    if (reloading) {
        sessionStorage.removeItem("reloading");
        succesAlert();
    }
  }

  function reloadPage() {
    sessionStorage.setItem("reloading", "true");
    document.location.reload();
  }

</script>