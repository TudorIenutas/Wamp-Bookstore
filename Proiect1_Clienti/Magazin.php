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
                echo "<a class="."'nav_link'"." href='Profile.php?id=".$_SESSION['id']."'><i class="."'fas fa-clipboard'"."></i>Profil |</a>"; 
                }
             ?>
            <a class="nav_link" href="Magazin.php"><i class="fas fa-book"></i>Magazin |</a>
            <?php 
            
            if (isset($_SESSION['loggedin'])) {
                echo "<a class="."'nav_link'"." href='Logout.php'><i class='fas fa-user'></i>Logout</a>";
            }
            else {
                echo "<a class="."'nav_link'"." href='Index.html'><i class='fas fa-user'></i>Login |</a>";
                echo "<a class="."'nav_link'"." href='Registration.html'><i class='fas fa-sign-outalt'></i> Register</a>";
            }
            ?>
        </div>
    </nav>
    <div id="product-grid">
        <div class="txt-heading"><div class="txt-headinglabel">Carti</div></div>
        <?php
        $shoppingCart = new ShoppingCart();
        //$query = "SELECT * FROM tbl_product";
        $product_array = $shoppingCart->getAllProduct();
        if (! empty($product_array)) {
        foreach ($product_array as $key => $value) {
        ?>
        <div class="product-item">
        <form method="post" action="cos.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
        <div class="product-image">
        <img src="style\images\<?php echo $product_array[$key]["image"]; ?>"  height='200'>
        </div>
        <div>
        <a href="DescriereProdus.php?code=<?php echo $product_array[$key]["code"]; ?>"><strong><?php echo $product_array[$key]["name"]; ?></strong></a>
        </div>
        <div class="product-price"><?php echo $product_array[$key]["price"]." Lei"; ?></div>
        <div>
           <input class="quantity" type="text" name="quantity" value="1" size="2" />
           <input class="add_cart_btn" type="submit" value="Add to cart" class="btnAddAction" />
        </div>
        </form>
        </div>
        <?php
        }
        }
        ?>
    </div>
</BODY>
</HTML>
