<?php
    session_start();
    $database_name = "Plants nursery";
    $con = mysqli_connect("localhost","root","Rithik3010",$database_name);

    if (isset($_POST["add"])){
        if (isset($_SESSION["cart"])){
            $item_array_id = array_column($_SESSION["cart"],"product_id");
            if (!in_array($_GET["id"],$item_array_id)){
                $count = count($_SESSION["cart"]);
                $item_array = array(
                    'product_id' => $_GET["id"],
                    'item_name' => $_POST["hidden_name"],
                    'item_description' => $_POST["hidden_description"],
                    'product_price' => $_POST["hidden_price"],
                    'item_quantity' => $_POST["quantity"],
                );
                $_SESSION["cart"][$count] = $item_array;
                echo '<script>window.location="IndoorP1.php"</script>';
            }else{
                echo '<script>alert("Product is already Added to Cart")</script>';
                echo '<script>window.location="IndoorP1.php"</script>';
            }
        }else{
            $item_array = array(
                'product_id' => $_GET["id"],
                'item_name' => $_POST["hidden_name"],
                'item_description' => $_POST["hidden_description"],
                'product_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"],
            );
            $_SESSION["cart"][0] = $item_array;
        }
    }

    if (isset($_GET["action"])){
        if ($_GET["action"] == "delete"){
            foreach ($_SESSION["cart"] as $keys => $value){
                if ($value["product_id"] == $_GET["id"]){
                    unset($_SESSION["cart"][$keys]);
                    echo '<script>alert("Product has been Removed from the Cart!")</script>';
                    echo '<script>window.location="Checkout.php"</script>';
                }
            }
        }
    }
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Plants Nursery</title>
    <link rel="stylesheet" type="text/css" href="../AddToCart.css">
    <link rel="stylesheet" href="Checkout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <style>
        h1{
            color: green;
            background-color: cyan;
            text-align: center;
            margin-top: 20px;
            margin: 10px;
            padding: 40px;
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.1);

        }
        table, th, tr, td{
            margin: 10px;
            padding: 10px;
            text-align: center;
        }
        .title2{
            margin-top: 20px;
            margin-right: 10px;
            margin-left: 10px;
            text-align: center;
            font-size: 25px;
            color: green;
            background-color: lightgreen;
            padding: 2%;
        }
        table th{  
            background: lightgreen;
            font-size: 20px;
            margin-bottom: 10px;
        }
        table tr{  
            margin:10px;
            padding: 10px;
            font-size: 20px;
        }
        table td{
            border: solid;
            border-style: outset;
        }
        .remove{
            color: red;
        }
        .remove:hover{
            color: green;
        }
    </style>
</head>
<body>
    <h1>Checkout</h1>  
    <div style="clear: both"></div>
        <h3 class="title2">Shopping Cart Details</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
            <tr>
                <th width="1000px">Product Name</th>
                <th width="200px">Quantity</th>
                <th width="200px">Price Details</th>
                <th width="250px">Total Price</th>
                <th width="300px">Remove Item</th>
            </tr>

            <?php
                if(!empty($_SESSION["cart"])){
                    $total = 0;
                    foreach ($_SESSION["cart"] as $key => $value) {
                        ?>
                        <tr>
                            <td><?php echo $value["item_name"]; ?></td>
                            <td><?php echo $value["item_quantity"]; ?></td>
                            <td>&#8377; <?php echo $value["product_price"]; ?></td>
                            <td>
                                &#8377; <?php echo number_format($value["item_quantity"] * $value["product_price"], 2); ?></td>
                            <td><a href="IndoorP1.php?action=delete&id=<?php echo $value["product_id"]; ?>"><span
                                        class="remove">Remove Item</span></a></td>

                        </tr>
                        <?php
                        $total = $total + ($value["item_quantity"] * $value["product_price"]);
                    }
                        ?>
                        <tr>
                            <td colspan="3" align="right"><b>TOTAL</b></td>
                            <th align="right">&#8377; <?php echo number_format($total, 2); ?></th>
                            <td></td>
                        </tr>

                        <?php
                    }
                ?>
            </table>
        </div>
    </div>
    <br>

        <div class="row">
        <div class="col-75">
        <div class="container">
            <form id="validate" method="POST" action="payment.php">
                <div class="row">
                    <div class="col-50">
                        <h3>Billing Address</h3>
                        <br>
                        <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                        <input type="text" id="fname" name="fullname" placeholder="Enter Full Name" required>
                        <label for="email"><i class="fa fa-envelope"></i> Email</label>
                        <input type="text" id="email" name="email" placeholder="Enter Email" required>
                        <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                        <input type="text" id="adr" name="address" placeholder="Enter Address" required>
                        <label for="city"><i class="fa fa-institution"></i> City</label>
                        <input type="text" id="city" name="city" placeholder="Enter City" required>

                        <div class="row">
                            <div class="col-50">
                                <label for="state">State</label>
                                <input type="text" id="state" name="state" placeholder="Enter State"required>
                            </div>
                            <div class="col-50">
                                <label for="zip">Zip Code</label>
                                <input type="text" id="zip" name="zip" placeholder="Zip code"required>
                            </div>
                        </div>
                    </div>

                    <div class="col-50">
                        <h3>Payment</h3>
                        <br>
                        <label for="fname">Accepted Cards</label>
                        <div class="icon-container">
                            <i class="fa fa-cc-visa" style="color:navy;"></i>
                            <i class="fa fa-cc-amex" style="color:blue;"></i>
                            <i class="fa fa-cc-mastercard" style="color:red;"></i>
                            <i class="fa fa-cc-discover" style="color:orange;"></i>
                        </div>

                        <label for="cname">Name on Card</label>
                        <input type="text" id="cname" name="cardname" placeholder="Enter Name on Card"required>
                        <label for="ccnum">Credit card number</label>
                        <input type="text" id="ccnum" name="cardnumber" placeholder="Enter Credit card number"required>
                        <label for="expmonth">Exp Month</label>
                        <input type="text" id="expmonth" name="expmonth" placeholder="Enter Exp Month"required>
                        <div class="row">
                            <div class="col-50">
                                <label for="expyear">Exp Year</label>
                                <input type="text" id="expyear" name="expyear" placeholder="Enter Exp Year"required>
                            </div>
                            <div class="col-50">
                                <label for="cvv">CVV</label>
                                <input type="text" id="cvv" name="cvv" placeholder="Enter CVV number"required>
                            </div>
                        </div>
                    </div>

                </div>
                <input type="submit" value="Make Payment" class="btn">
            </form>
        </div>
    </div>
</div>

<script>
    $('#validate').validate({
        roles: {
            fullname: {
                required: true,
            },
            email: {
                required: true,
            },
            address: {
                required: true,
            },
            city: {
                required: true,
            },
            state: {
                required: true,
            },
            zip: {
                required: true,
            },
            cardname: {
                required: true,
            },
            cardnumber: {
                required: true,
            },
            expmonth: {
                required: true,
            },
            expyear: {
                required: true,
            },
            cvv: {
                required: true,
            },
           
        },
        messages: {
            fullname:"Please Enter your Full Name",
            email:"Please Enter Email",
            city:"Please Enter City",
            address:"Please Enter Address",
            state:"Please Enter State",
            zip:"Please Enter zip code",
            cardname:"Please Enter card name",
            cardnumber:"Please Enter card number",
            expmonth:"Please Enter exp month",
            expyear:"Please Enter exp year",
            cvv:"Please Enter cvv",
        },
    });
</script>
        
</body>
</html>
