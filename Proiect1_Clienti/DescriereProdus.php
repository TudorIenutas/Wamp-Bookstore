<?php
require_once "ShoppingCart.php";?>
<HTML>
<HEAD>
    <TITLE>Creare cos cumparaturi </TITLE>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="style\style.css">
</HEAD>
<BODY>
    <!-- Logo magazin -->
    <div class="logo">
        <img src="style\images\LOGO.png" height="50" ><br/>
    </div>
    <!-- Bara de navigare -->
    <nav class="navtop">
        <div>
            <?php 
                session_start();
                if (isset($_SESSION['loggedin'])){
                echo "<a href='Profile.php?id=".$_SESSION['id']."'><i class="."'fas fa-clipboard'"."></i>Profile |</a>"; 
                }
             ?>
            <a href="Magazin.php"><i class="fas fa-book"></i>Magazin |</a>
            <?php 
            
            if (isset($_SESSION['loggedin'])) {
                echo "<a href='Logout.php'><i class='fas fa-user'></i>Logout</a>";
            }
            else {
                echo "<a href='Index.html'><i class='fas fa-user'></i>Login |</a>";
                echo "<a href='Register.html'><i class='fas fa-sign-outalt'></i> Register</a>";
            }
            ?>
        </div>
    </nav>
    
    <div class="desc-produs" style="width: 100%;"></div>
        <?php
        $shoppingCart = new ShoppingCart();
        $product_array = $shoppingCart->getProductByCode($_GET['code']);
        if (! empty($product_array)) {
        foreach ($product_array as $key => $value) {
        ?>
        <div class="product-item" style="width: 100%;">
        <form method="post" action="cos.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
        <div class="product-image">
        <img src="style\images\<?php echo $product_array[$key]["image"]; ?>"  height='300'>
        </div>
        <div>
        <a href="DescriereProdus.php?code=<?php echo $product_array[$key]["code"]; ?>"><strong><?php echo $product_array[$key]["name"]; ?></strong></a>
        </div>
        <div class="product-price"><?php echo $product_array[$key]["price"]."Lei"; ?></div>
        <div>
        <div class="product-desc-txt"><?php echo $product_array[$key]["description"]; ?></div>
        <div>
        <input type="text" name="quantity" value="1" size="2" style="width: 30%;"/>
        <input type="submit" value="Add to cart" class="btnAddAction"  style="width: 60%;"/>
        </div>
        </form>
        </div>
        <?php
        }
        
        }
        ?>
    
</BODY>
</HTML>