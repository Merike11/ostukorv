<?php 
session_start();
//session_destroy();

if (!isset($_SESSION["order_id"])){
    $_SESSION["order_id"]= generateRandomString();
}
if (isset($_GET["code"])){
    try {
        require "./config.php";
        require "./common.php";
      
        $connection = new PDO($dsn, $username, $password, $options);
        $sql = "SELECT * FROM shopping.product WHERE code=:code";
             
        $statement = $connection->prepare($sql);
        $statement->execute(["code"=>$_GET["code"]]);
                
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        
        if (empty($_SESSION["cart_item"]) or empty(filter_by_code($_GET["code"]))){
            $order_item = array("order_id"=>$_SESSION["order_id"], "order_item_code"=>$_GET["code"], "order_item_price"=>$result["price"], "order_item_name"=>$result["name"], "amount"=>1);
            $_SESSION["cart_item"][]=$order_item;        
        } else {
            foreach ($_SESSION["cart_item"] as $key => $value) {
                if ($value["order_item_code"]==$_GET["code"]) {
                    $_SESSION["cart_item"][$key]["amount"] += 1;
                }
            }
        }
        
        header("Location: {$_SERVER["HTTP_REFERER"]}");
        } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
      }
}else{
    echo "Code not set";
}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function filter_by_code($filter_code) {
    return array_merge(...array_filter($_SESSION["cart_item"], function($var) use ($filter_code){
        return ($var["order_item_code"] == $filter_code);
        }));            
}

?>