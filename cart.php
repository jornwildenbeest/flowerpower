<?php require_once "assets/incl/header.php"; 
    $cookie_name = 'cart';
    if(isset($_COOKIE[$cookie_name])) {
    $cookievalue = json_decode(stripslashes($_COOKIE[$cookie_name]));
    } else {
    $cookievalue = array();
    }
?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Winkelmand</h1>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Afbeelding</th>
                            <th>Naam</th>
                            <th>Aantal</th>
                            <th>Prijs per stuk</th>
                            <th>Totaal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($cookievalue as $item):
                                echo '<tr>';
                                    echo '<td>';
                                        echo '<a href="assets/deleteFromCart.php?productId= '. $item->ID . ' "> <i class="fa fa-trash-o delete_button"></i></a>';
                                    echo '</td>';
                                    echo '<td>';
                                        echo '<img style="height: 110px;" src="'. $item->image_url.'">';
                                    echo '</td>';
                                    echo '<td>'. $item->name .'</td>';
                                    echo '<td>';
                                        echo '<input type="number" class="product_amount" name="aantalartikel" value="'.$item->amount.'" min="1">';
                                    echo '</td>';
                                        if(empty($item->newprice)):
                                            echo '<td>€ <span class="product_price">'.$item->price.'</span></td>';
                                        else:
                                                echo '<td>€ <span class="product_price">'.$item->newprice.'</span></td>';
                                        endif;
                                        echo '<td class="last_td">Subtotaal: € <span class="subtotal">15.95</span>';
                                    echo '</td>';
                                echo '</tr>';
                            endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
            <hr>
        </div>
    </div>
</div>
<?php require_once "assets/incl/footer.php"; ?>