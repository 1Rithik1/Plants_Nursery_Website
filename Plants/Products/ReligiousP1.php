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
                echo '<script>alert("Product Added to Cart")</script>';
                echo '<script>window.location="ReligiousP1.php"</script>';
            }else{
                echo '<script>alert("Product is already Added to Cart")</script>';
                echo '<script>window.location="ReligiousP1.php"</script>';
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
                    echo '<script>window.location="add2cart.php"</script>';
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
    <link rel="stylesheet" href="product1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    <header>
        <div class="navbar">
            <div class="title">
                <a href="../Homepage.html">Plants Nursery</a>
            </div>
            <nav>
                <ul>
                    <li><a href="../Homepage.html">Home</a></li>
                    <li><a href="../Shop.html">Shop</a></li>
                    <li><a href="../Handover.html">Handover</a></li>
                    <li><a href="../AddToCart.html"><i class="fa fa-shopping-cart fa-lg"></i></a></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <br>
    
        <?php
            $query = "SELECT * FROM product where id = 19 ";
            $result = mysqli_query($con,$query);
            if(mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_array($result)) {

                    ?>
                        <form method="post" action="ReligiousP1.php?action=add&id=<?php echo $row["id"]; ?>">
                            
                            <section>

                                    <div class="img">
                                        <img src="<?php echo $row["image"]; ?>" width="500" height="500" >
                                    </div>

                                    <div class="details">
                                        <span class="new"> NEW </span>
                                        <span class="product-name"><?php echo $row["pname"]; ?></span>
                                        <span class="product-price">&#8377; <?php echo $row["price"]; ?></span>
                                        <div class="product-rating">
                                            <span style="color: gold;"><i class = "fa fa-star"></i></span>
                                            <span style="color: gold;"><i class = "fa fa-star"></i></span>
                                            <span style="color: gold;"><i class = "fa fa-star"></i></span>
                                            <span style="color: gold;"><i class = "fa fa-star"></i></span>
                                            <span style="color: gold;"><i class = "fa fa-star-half-o"></i></span>
                                        </div>
                                        <br>

                                        <div class="quantity" style="margin-top: 10px;padding: 5px;width: 50%;">
                                            <label style="font-size: 20px;">Quantity : </label>
                                            <input type="text" name="quantity" style="padding: 5px; width: 55%;border: none;font-size: 16px;border-bottom: 2px solid rgba(0,0,0, 0.12);" required>
                                        </div>

                                        <span class="about" style="margin-top: 10px;">About</span>
                                        <p class="product-description">
                                            <?php echo $row["description"]; ?>
                                        </p>

                                        <input type="hidden" name="hidden_name" value="<?php echo $row["pname"]; ?>">
                                        <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">

                                        <div class="btn-groups" >
                                            <button type="submit" name="add" style="background-color: #FF9F00;border: 2px solid #FF9F00;margin-right: 8px;"
                                            accept="add2cart.php" ><i class="fa fa-shopping-cart">&nbsp;</i>Add to Cart</button>
                                        </div>

                                    </div>

                                </section>
                        </form>
                   
                    <?php
                }
            }
        ?> 
        
        <br>
        <div class="selling-title">
            <b>Related Products</b>
        </div>
        <div class="selling">
            <div class="products">
                        <a href="ReligiousP1.php">
                        <div class="img">
                           <img src="ReligiousP1.jpg">
                        </div>
                        <div class="content">
                            <h6><del>&#8377; 299</del></h6>
                            <h3>&#8377; 199</h3>
                            <h4><a href="ReligiousP1.php">Krishna Tulsi Plant - Plant</a></h4>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </div>
                        </a>
                    </div>
                    <div class="products">
                        <a href="ReligiousP2.php">
                        <div class="img">
                           <img src="ReligiousP2.jpg">
                        </div>
                        <div class="content">
                            <h6><del>&#8377; 399</del></h6>
                            <h3>&#8377; 299</h3>
                            <h4><a href="ReligiousP2.php">Jasminum sambac, Mogra - Plant</a></h4>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        </a>
                    </div>
                    <div class="products">
                        <a href="ReligiousP3.php">
                        <div class="img">
                           <img src="ReligiousP3.jpg">
                        </div>
                        <div class="content">
                            <h6><del>&#8377; 399</del></h6>
                            <h3>&#8377; 299</h3>
                            <h4><a href="ReligiousP3.php">Money Plant - Plant</a></h4>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </div>
                        </a>
                    </div>
                    <div class="products">
                        <a href="ReligiousP1.php">
                        <div class="img">
                           <img src="ReligiousP1.jpg">
                        </div>
                        <div class="content">
                            <h6><del>&#8377; 299</del></h6>
                            <h3>&#8377; 199</h3>
                            <h4><a href="ReligiousP1.php">Krishna Tulsi Plant - Plant</a></h4>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </div>
                        </a>
                    </div>
                    <div class="products">
                        <a href="ReligiousP2.php">
                        <div class="img">
                           <img src="ReligiousP2.jpg">
                        </div>
                        <div class="content">
                            <h6><del>&#8377; 399</del></h6>
                            <h3>&#8377; 299</h3>
                            <h4><a href="ReligiousP2.php">Jasminum sambac, Mogra - Plant</a></h4>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        </a>
                    </div>        
        </div>
      
        <br>
</body>
</html>
