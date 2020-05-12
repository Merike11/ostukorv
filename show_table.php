<?php
session_start();
//session_destroy();
if(!isset($_SESSION['cart_item'])){
  $_SESSION['cart_item']= [];
} 

try {
  require "./config.php";
  require "./common.php";

  $connection = new PDO($dsn, $username, $password, $options);
  $sql = "SELECT * FROM shopping.product";
       
  $statement = $connection->prepare($sql);
  $statement->execute();
  
  $result = $statement->fetchAll();
  } catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>

<?php require "templates/header.php"; ?>

  <h2>Tooted:</h2>

  <div class="container float-left">
    <div class="row mb-2">
      <div class="col">Nr</div>
      <div class="col">Nimi</div>
      <div class="col">Kood</div>
      <div class="col">Pilt</div>
      <div class="col">Hind</div>
      <div class="col">Osta</div>
    </div>
    <?php foreach ($result as $row) : ?>
      <div class="row">
        <div class="col"><?php echo escape($row["id"]); ?></div>
          <div class="col"><?php echo escape($row["name"]); ?></div>
          <div class="col"><?php echo escape($row["code"]); ?></div>
          <div class="col"><img src="<?php echo $row["image"]; ?>" alt="" width="auto" height="50" class="img-responsive" /></div>
          <div class="col"><?php echo escape($row["price"]); ?> € </div>
          <div class="col"><a href="/add-to-order.php?code=<?php echo $row["code"]; ?>" class="btn btn-primary">Osta</a></div>
        </div>
    <?php endforeach; ?>
  </div>

  

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
      <div class="row"><a href="/order.php" class="btn btn-success">Maksma</a></div>
      
    </div>
  </div>		
<?php
} else {
?>
<div class="no-records">Sinu ostukorv on veel tühi</div>
<?php 
}
?>



<?php require "templates/footer.php"; ?>