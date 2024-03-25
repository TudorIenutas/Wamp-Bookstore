<?php
require_once "ShoppingCart.php";
session_start();
// Daca utilizatorul nu este conectat => redirectioneaza la pagina de autentificare 
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
// pt membrii inregistrati
$member_id=$_SESSION['id'];
//se creeaza un cos
$shoppingCart = new ShoppingCart();
if (! empty($_GET["action"])) {
 switch ($_GET["action"]) {
 case "add":
    if (! empty($_POST["quantity"])) {

        $productResult = $shoppingCart->getProductByCode($_GET["code"]);
       
        $cartResult = $shoppingCart->getCartItemByProduct($productResult[0]["id"], $member_id);
       
        if (! empty($cartResult)) {
        // Modificare cantitate in cos
        $newQuantity = $cartResult[0]["quantity"] + $_POST["quantity"];
        $shoppingCart->updateCartQuantity($newQuantity, $cartResult[0]["id"]);
        } else {
        // Adaugare in tabelul cos
        $shoppingCart->addToCart($productResult[0]["id"], $_POST["quantity"], $member_id);
        }
        }
        break;
case "remove":
        // Sterg o sg inregistrare
        $shoppingCart->deleteCartItem($_GET["id"]);
        break;
case "empty":
        // Sterg cosul
        $shoppingCart->emptyCart($member_id);
        break;
        }
    }
?>

<HTML>
    <HEAD>
       <TITLE>creare cos permament in PHP</TITLE>
       <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
       <link href="style\style.css" type="text/css" rel="stylesheet" />
    </HEAD>
<BODY>
    <!-- Logo magazin -->
    <div class="logo">
        <img src="style\images\LOGO.png" height="50" ><br/>
    </div>
    <div id="shopping-cart">
    <div class="txt-heading">
        <h3>Cos Cumparaturi</h3> 
        <div class="txt-heading-icon-delete"> 
            <a id="btnEmpty" href="cos.php?action=empty"><img src="style\images\empty_cart.png" alt="empty-cart" title="Empty Cart" height="20px" /></a>
        </div>
    </div>
<?php
    $cartItem = $shoppingCart->getMemberCartItem($member_id);
    if (! empty($cartItem)) {
        $item_total = 0;
?>
    <table class="cos" cellpadding="10" cellspacing="1">
    <tbody>
    <tr>
    <th style="text-align: left;"><strong>Name</strong></th>
    <th style="text-align: left;"><strong>Code</strong></th>
    <th style="text-align: right;"><strong>Quantity</strong></th>
    <th style="text-align: right;"><strong>Price</strong></th>
    <th style="text-align: center;"><strong>Action</strong></th>
    </tr>
<?php
    foreach ($cartItem as $item) {
 ?>
    <tr>
    <td style="text-align: left; border-bottom: #F0F0F0 1px solid;"><strong><?php echo $item["name"]; ?></strong></td>
    <td style="text-align: left; border-bottom: #F0F0F0 1px solid;"><?php echo $item["code"]; ?></td>
    <td style="text-align: right; border-bottom: #F0F0F0 1px solid;"><?php echo $item["quantity"]; ?></td>
    <td style="text-align: right; border-bottom: #F0F0F0 1px solid;"><?php echo $item["price"]." Lei"; ?></td>
    <td style="text-align: center; border-bottom: #F0F0F0 1px solid;" ><a href="cos.php?action=remove&id=<?php echo $item["cart_id"]; ?>" class="btnRemoveAction"><img height="18px" src="style\images\icon_delete.png" alt="icon-delete" title="Remove Item" /></a></td>
    </tr>
<?php
    $item_total += ($item["price"] * $item["quantity"]);
 }
 ?>
<tr class="total">
 <td  colspan="3" align=right><strong>Total:</strong></td>
 <td align=right><?php echo $item_total." Lei"; ?></td>
 <td></td>
 </tr>
 </tbody>
 </table>
 <?php
}
?>
</div>
<div><a href="magazin.php">Alegeti alt produs</a></div>
<div><a href="logout.php">Abandonati sesiunea de cumparare</a></div>
<div><a href="FinalizareCos.php">Finalizati cumparaturile</a></div>
<?php //require_once "product-list.php"; ?>

</BODY>
</HTML>
