<img src="cid:logo" alt='MadDollTees' name='logo'/>

<h1>Hello!</h1>
<p>Your order has saved. You will get another mail from us, if we sent you, your package.</p>

<h2>Order details:</h2>
<table border="1">
    <tr><td>
            <?php
            echo $order['0']['Order']['first_name'].' '.$order['0']['Order']['last_name'].'<br/>';
            echo $order['0']['Order']['email'].'<br/>';
            echo $order['0']['Order']['phone'].'<br/>';
            echo $order['0']['Order']['address'].'<br/>';
            echo $order['0']['Order']['address2'].'<br/>';
            echo $order['0']['Order']['zip'].'<br/>';
            echo $order['0']['Order']['city'].'<br/>';
            echo $order['0']['Order']['state_province'].'<br/>';
            echo $order['0']['Order']['country'].'<br/>';
            ?>
        </td>
        </tr>
    </table>
<h2>Ordered Products:</h2>
            <table width="500px" border="1">
                <tr>
                    <th>Name</th>
                    <th>Size</th>
                    <th>Count</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
                <?php foreach ($order as $details){ ?>
                <tr>
                    <td><?php echo $details['OrderItem']['name']?></td>
                    <td><?php echo $details['OrderItem']['size']?></td>
                    <td><?php echo $details['OrderItem']['quantity']?></td>
                    <td><?php echo $details['OrderItem']['price']?>&euro;</td>
                    <td><?php echo $details['OrderItem']['subtotal']?>&euro;</td>
                    <?php } ?>
                </tr>
                <tr><th colspan="4">Total:</th>
                    <td><?php echo $order['0']['Order']['total']?>&euro;</td>
                </tr>

            </table>

