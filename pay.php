<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Example payment usage - <?php echo $_post['payment_method']; ?>- Pangalink-net</title>
    </head>
    <body>
<?php

// THIS IS AUTO GENERATED SCRIPT
// (c) 2011-2020 Kreata OÜ www.pangalink.net

// File encoding: UTF-8
// Check that your editor is set to use UTF-8 before using any non-ascii characters

// STEP 1. Setup private key
// =========================
session_start();

$total_price=$_SESSION['total_price'];

$private_key_swed = openssl_pkey_get_private(
"-----BEGIN RSA PRIVATE KEY-----
MIIEowIBAAKCAQEA5Jb/Rh56l4YTkiI49FU8RPlXhzrVt4nV3mc2NwohvPnm47MB
n/YKdaepR3UbgGhTGtEKrHLfp+B4F7IgO9wljIJT/dW4JBXmWdP2+KRMoLLieeSF
NsMu1XEgWI/JWXnswJFNymIODQ1Vyagtw95PVmzQsSLIAX8/RjLaWWsjdUPguNuq
9VlthN2zhf8T7VXNEgmBV2vixgZF+EeACe5FfHAr4Trd6zN1HYedQyGIs4evh9nc
gnKZbIzOmbO2HuvnKi2b4T3ALJJfoLlzTZ6Dp7Y5yXX1wAgn3E+WU2eG77Tzp9ER
7LlgQy3kj53KdDQ2+vY80LLDEMsadsYP+pfrOwIDAQABAoIBAAjzOI+ARgCEyWNh
X6WBaNiygpDS5udGyE7q7558ERIbHsUvjxK6SXKN2/zmQutmKkrUgHx8CvHBwjH7
UXPGjNnRiIRZx9nx2ZEO0Y6usClil6d6IRUh00WcJk4RYyrTsUdg6RDRggdUzFUW
9qPCooyZuhoVaItWdh3Dg/UYUs0WhlYBaqNuL7PjzANSxVYT/mcwwaosB2/ZvS2y
rquFRAUlPqX9EpDXXjwKBUlH5l7r0bNl/ATk9Bc+kb/etvytErnUGgIOkC94B/SU
iVcXwocSu4tkcU/tS065LZPezP/Tjz2mIWn3hFphQqJZ9ggSraAkHyeX4Euoecb4
W6Fzn1ECgYEA9VQL8BI26+V6X0lvjKCdd4hG2lyCLQ6duVt746iMOGx28r4n8+xk
Y7FQ3DQCDhBtpvxVN79dLFNkF5ZiP2G28JzRkkqBpMqTQPStm8ByeLDg6LB8c2KE
BZpTaItN+gOZ21FH4vlJO4gIWX341R0mmq5h7pKqaxHWuA3bokuYaSUCgYEA7oiN
a8m2Pyu1i8tY/Ymk7nYXKy1s13MND4/W8o7h/0DuqyV/AVlnNDNSW14E+dtZ0lmq
nOSCErC83kbp0i+IbWItkA7L2IlIZ9bliit9sH4wpBcuHZCJMtEza1UhpQDNK8WJ
4CA9bitSiU/WzaE1WPmZXTxVX9L7BnsPSDDExN8CgYEAq9etbQI1OlPJvgkge+7d
nib1CmuWO51rWbT9OOCNJ9DCGRKdxbymLTa9HyHG9rcHN9q0jpIa37uh9uu98guu
KyiNm91YpmfHcc5x9RF+nY+4WwWUhvZQ5+PL3QUHH8N5+CgdJJ3dcDe/MYCN1inP
KrZPnt9ZRBqAvvfmCu7M2YkCgYBxzizLFH4jPZNskyRuMtHCBA2hyBZ55KaCmjoP
mCQzSKOWfFlQJ3uZ6DKO7RiqrQD531YLbOqySCiUVHkSkyMgLQtYA/c15KnrARib
B4z8O/ixEW4rJN6QpEdIGmHm+67oB2N0z2z/tyO156Wwjg2J2exWE4cYJO0ndmcg
JkR7OQKBgFPSI11CIwSk9XWjxCBSSj1YCD6CF3LTaxWgdLycjyT4sMy/r0TB45DQ
hyywf4+e7VZ1SYSH57XAR7VBlGGB/pDdsOk+Fi49eMP98++g3Qngcg3EFokXtYYq
x84OA9oZoQl6e3fxJP2NOvrOIrL4hi3IA79cy8M5QnXAb5UCrsYk
-----END RSA PRIVATE KEY-----");
    
// STEP 2. Define payment information
// ==================================

$fields = array(
        "VK_SERVICE"     => "1011",
        "VK_VERSION"     => "008",
        "VK_SND_ID"      => "uid100023",
        "VK_STAMP"       => "12345",
        "VK_AMOUNT"      => number_format($total_price, 2),
        "VK_CURR"        => "EUR",
        "VK_ACC"         => "EE152200221234567897",
        "VK_NAME"        => "Toidupood",
        "VK_REF"         => "1234561",
        "VK_LANG"        => "EST",
        "VK_MSG"         => "Ostud Toidupoest",
        "VK_RETURN"      => "http://localhost:8081/success.php",
        "VK_CANCEL"      => "http://localhost:8081/cancel.php",
        "VK_DATETIME"    => date(DATE_ISO8601),   //"2020-05-12T19:15:39+0300",
        "VK_ENCODING"    => "utf-8",
);

// STEP 3. Generate data to be signed
// ==================================

// Data to be signed is in the form of XXXYYYYY where XXX is 3 char
// zero padded length of the value and YYY the value itself
// NB! Swedbank expects symbol count, not byte count with UTF-8,
// so use `mb_strlen` instead of `strlen` to detect the length of a string

$data = str_pad (mb_strlen($fields["VK_SERVICE"], "UTF-8"), 3, "0", STR_PAD_LEFT) . $fields["VK_SERVICE"] .    /* 1011 */
        str_pad (mb_strlen($fields["VK_VERSION"], "UTF-8"), 3, "0", STR_PAD_LEFT) . $fields["VK_VERSION"] .    /* 008 */
        str_pad (mb_strlen($fields["VK_SND_ID"], "UTF-8"),  3, "0", STR_PAD_LEFT) . $fields["VK_SND_ID"] .     /* uid100023 */
        str_pad (mb_strlen($fields["VK_STAMP"], "UTF-8"),   3, "0", STR_PAD_LEFT) . $fields["VK_STAMP"] .      /* 12345 */
        str_pad (mb_strlen($fields["VK_AMOUNT"], "UTF-8"),  3, "0", STR_PAD_LEFT) . $fields["VK_AMOUNT"] .     /* 150 */
        str_pad (mb_strlen($fields["VK_CURR"], "UTF-8"),    3, "0", STR_PAD_LEFT) . $fields["VK_CURR"] .       /* EUR */
        str_pad (mb_strlen($fields["VK_ACC"], "UTF-8"),     3, "0", STR_PAD_LEFT) . $fields["VK_ACC"] .        /* EE152200221234567897 */
        str_pad (mb_strlen($fields["VK_NAME"], "UTF-8"),    3, "0", STR_PAD_LEFT) . $fields["VK_NAME"] .       /* ÕIE MÄGER */
        str_pad (mb_strlen($fields["VK_REF"], "UTF-8"),     3, "0", STR_PAD_LEFT) . $fields["VK_REF"] .        /* 1234561 */
        str_pad (mb_strlen($fields["VK_MSG"], "UTF-8"),     3, "0", STR_PAD_LEFT) . $fields["VK_MSG"] .        /* Torso Tiger */
        str_pad (mb_strlen($fields["VK_RETURN"], "UTF-8"),  3, "0", STR_PAD_LEFT) . $fields["VK_RETURN"] .     /* http://localhost:8080/project/c5chykbg0T3Pq2CO?payment_action=success */
        str_pad (mb_strlen($fields["VK_CANCEL"], "UTF-8"),  3, "0", STR_PAD_LEFT) . $fields["VK_CANCEL"] .     /* http://localhost:8080/project/c5chykbg0T3Pq2CO?payment_action=cancel */
        str_pad (mb_strlen($fields["VK_DATETIME"], "UTF-8"), 3, "0", STR_PAD_LEFT) . $fields["VK_DATETIME"];    /* 2020-05-12T19:15:39+0300 */

/* $data = "0041011003008009uid10002300512345003150003EUR020EE152200221234567897009ÕIE MÄGER0071234561011Torso Tiger069http://localhost:8080/project/c5chykbg0T3Pq2CO?payment_action=success068http://localhost:8080/project/c5chykbg0T3Pq2CO?payment_action=cancel0242020-05-12T19:15:39+0300"; */

// STEP 4. Sign the data with RSA-SHA1 to generate MAC code
// ========================================================

$signed=openssl_sign ($data, $signature, $private_key_swed, OPENSSL_ALGO_SHA1);

/* CgAeXK2FxTbWkZMEzcTQQiaRYuhnWDNETYXcJ1pw30ezC4k28S/5OtabwJJcxV2UswQl1s8W2eb1O5+HLySsqiYOUUzT4Xihp3tUPIf+rd8nt9XiIsRbke5dSzElLYErR0rrbcIydjl9l0G1emxSX5NfXoYW29V4+CmSIA/35X0Btc9WQB/uBtzDrbtDt282uLFJk90WIKl4E1sNcKPvqenNv6Xz87Tzj/TeeJ8wRvJ6BT9MB/69Y5ieqe5Fu48lLdyicwweIOYCRy7HYHu7wYTZepav+/mI02hmxEp82u4hBGK35KXXlYcSS7Bz4eIb6s+C7wrJhoqzzlgNFwidHA== */
if(!$signed){
    print_r(sprintf('OpenSSL data signing failed with error: %s', openssl_error_string()));
    print_r($private_key);
}
$fields["VK_MAC"] = base64_encode($signature);

// STEP 5. Generate POST form with payment data that will be sent to the bank
// ==========================================================================
?>

        <h1><a href="http://localhost:8080/">Pangalink-net</a></h1>
        <p>Makse teostamise näidisrakendus <strong><?php echo $_POST['payment_method'];?></strong></p>

        <form method="post" action="http://localhost:8080/banklink/swedbank-common" >
            <!-- include all values as hidden form fields -->
<?php foreach($fields as $key => $val):?>
            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo htmlspecialchars($val); ?>" />
<?php endforeach; ?>

            <!-- draw table output for demo -->
            <table>
<?php foreach($fields as $key => $val):?>
                <tr>
                    <td><strong><code><?php echo $key; ?></code></strong></td>
                    <td><code><?php echo htmlspecialchars($val); ?></code></td>
                </tr>
<?php endforeach; ?>

                <!-- when the user clicks "Edasi panga lehele" form data is sent to the bank -->
                <tr><td colspan="2"><input type="submit" value="Edasi panga lehele" /></td></tr>
            </table>
        </form>

    </body>
</html>