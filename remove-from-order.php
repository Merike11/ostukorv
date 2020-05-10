<?php
session_start();

if (!isset($_SESSION["cart_item"])){
    echo "Session not set";
} else {
    if(!isset($_GET["code"])){
        echo "Code not set";
    } else{
        foreach($_SESSION["cart_item"] as $key => $value) {
            if ($value['order_item_code']==$_GET["code"]) {
                if($_SESSION["cart_item"][$key]["amount"] === 1){
                    unset($_SESSION["cart_item"][$key]);
                } else {
                    $_SESSION["cart_item"][$key]["amount"] -= 1;
                }
                

                header("Location: {$_SERVER["HTTP_REFERER"]}");
            }
          }
    }
}
?>