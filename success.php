<?php 
session_start();

require "templates/header.php";
?>
<div class="order_id">
    Tellimus koodiga: <?php echo $_SESSION["order_id"];?> vastu võetud ja edastatakse Teile esimesel võimalusel!
</div>
<a href="index.php" class="btn btn-primary mt-4">Uuesti tellima</a>
<?php 
session_destroy();
require "templates/footer.php"; 
?>

