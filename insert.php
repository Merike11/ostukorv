<?php

if(isset($_POST['submit'])){
    require "./config.php";
    require "./common.php";

    try{
        $connection = new PDO($dsn, $username, $password, $options);
        
        $new_product =array(
            "id" => $_POST['id'],
            "name" => $_POST['name'],
            "code" => $_POST['code'],
            "image" => $_POST['image'],
            "price" => $_POST['price'],
            );
        $sql = sprintf(
    "INSERT INTO %s (%s) values (%s)",
    "shopping.product",
    implode(", ", array_keys($new_product)),
    ":" . implode(", :", array_keys($new_product))
        );
        $statement = $connection->prepare($sql);
        $statement->execute($new_product);

        } catch(PDOException $error) {
        echo $sql ."<br>" . $error->getMessage();
    }
}
?>
<?php require "templates/header.php";?>

<?php if (isset($_POST['submit']) && $statement) { ?>
  <?php echo escape($_POST['name']); ?> successfully added.
<?php } ?> 
<div class="formarea ml-3" >
    <h2>Lisa toode nimistusse</h2>

    <form method="POST">
        <label for="name">nr:</label>
        <input type="text" name="id" id="id">
        <label for="name">nimetus:</label>
        <input type="text" name="name" id="name">
        <label for="name">kood:</label>
        <input type="text" name="code" id="code"> 
        <label for="name">pilt:</label>
        <input type="text" name="image" id="image">
        <label for="name">hind:</label>
        <input type="text" name="price" id="price">
        <input type="submit" name="submit" value="Kinnita">
    </form>
    <br>
    <a href="index.php">Tagasi algusesse</a>
</div>
<?php require "templates/footer.php";?>