<?php 
session_start();
//session_destroy();

?>
<?php 
require "templates/header.php"; 

?>
<div class="container float-left" >
      <div class="cart">
        <h4>Ostukorv:</h4>
        <?php
          if(!empty($_SESSION['cart_item'])){
              
            $total_quantity = 0;
            $total_price = 0;
        ?>
        <div class="row mb-1"> 
          <div class="col">Nimetus</div>
          <div class="col">Kood</div>
          <div class="col">Kogus</div>
          <div class="col">Ühiku hind</div>
          <div class="col">Kokku hind</div>
          <div class="col">Eemalda</div>
        </div>	
      <?php	

      foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["amount"]*$item["price"];
      ?>
      <div class="row mt-2">
        <div class="col"><?php echo $item["order_item_name"]; ?></div>
        <div class="col"><?php echo $item["order_item_code"]; ?></div>
        <div class="col"><?php echo $item["amount"]; ?></div>
        <div class="col"><?php echo number_format($item["order_item_price"], 2); ?> € </div>
        <div class="col"><?php echo number_format($item["order_item_price"] * $item["amount"], 2); ?> € </div>
        <div class="col"><a href="/remove-from-order.php?code=<?php echo $item["order_item_code"]; ?>" class="btn btn-danger">Eemalda</a></div>
      </div>

      <?php
      $total_quantity += $item["amount"];
      $total_price += ($item["order_item_price"]*$item["amount"]);
      }
      ?>
      <div class="row">Kokku: <?php echo $total_quantity; ?> toodet</div>
      <div class="row"><strong>Hind kokku: <?php echo number_format($total_price, 2); ?> € </strong></div>
      <br>
      
    </div>
  </div>		
<?php
$_SESSION['total_price']= $total_price;
} else {
?>
<div class="no-records">Sinu ostukorv on veel tühi</div>
<?php 
}
if(!empty($_SESSION['cart_item'])){


?>
<div class="container float-left" >
<h4>Tellimuse vormistamine:</h4>

<div class="order_id">Tellimuse kood: <?php echo $_SESSION["order_id"];?></div>

<form method='POST' action="payment_redirect.php">
    <div class="form-group row">
        <label for="firstname" class="col-sm-2 col-form-label">Eesnimi</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="firstname">
        </div>
    </div>
    <div class="form-group row">
        <label for="lastname" class="col-sm-2 col-form-label">Perenimi</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="lastname">
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email" placeholder="Email">
        </div>
    </div>
    <div class="form-group row">
        <label for="phone" class="col-sm-2 col-form-label">Telefon</label>
        <div class="col-sm-10">
            <input type="phone" class="form-control" id="phone" placeholder="Telefoni number">
        </div>
    </div>
    <fieldset class="form-group">
        <div class="row">
            <legend class="col-form-label col-sm-2 pt-0">Makseviis</legend>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" id="seb-radio" value="SEB" checked>
                    <label class="form-check-label" for="seb-radio">
                        SEB makselink
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" id="swedbank-radio" value="Swedbank">
                    <label class="form-check-label" for="swedbank-radio">
                        Swedbank makselink
                    </label>
                </div>
            </div>
        </div>
    </fieldset>
    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Vormista tellimus</button>
        </div>
    </div>
</form>
<?php 
}
?>