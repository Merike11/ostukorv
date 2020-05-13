<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Example payment usage - SEB - Pangalink-net</title>
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

$private_key = openssl_pkey_get_private(
"-----BEGIN RSA PRIVATE KEY-----
MIIEowIBAAKCAQEAzQCZ5YwF11DLw5KaW3XNwEddOflss1TQG4yBmlkAcxAZAPfP
w+a0rOTmnoaT9Yx0FtzeUEukNme69e1210fLcoU1y5rJ0qNhwcws/q+DHE1FCpdf
lZ27hq3up+aATelfAsXg1bLUeqlORN6nB567rhx6Ck16DGQcjbYO3BNyXXC9oZYQ
uHodOdafyckbbo2bxfEHRgv0dvz33cyALPQTneVQh09h05P3ygYEXKTyKZqfWMzY
D71/R4qdWlC85dPcNjD3FWJWfiqNDuoMiW5LcqcJDUcToaofhrIuGUyr2ISWKoMY
RjyG5zuFiMTuwU6wyN7jJN5/W5ol95KIAjPnPQIDAQABAoIBAG6+wGStPAqRb0J7
1D9MaJZS9x32jK5kRvha8zi6k++U5q0LMoYV/8zW628ALLYd5ijjsIWYF2H8r5dj
bSvncRSwudsAB79u28Sh1DzR+/YyF/YcyFo/F6suExtI/k8Yn2cUFt3a+cY56Dp0
Pa90JNduMs+WAzTmcDZt/6EMMGAhK7EWuwpGi7/O2shRb/s1GogX3T2T0lb46fmo
BULPwPETdNZYxSCZXUBm2RyHKqFaUyBy4x2/+pLAw8QUfj+o0nQ20tJOZPwSTadu
hOkWc/To8YAEW3JOxBRoGhCnXL9nDOQYYOx7SEPCP/0V0yd0Sxn02XCm4h5o3zEq
kToFcYECgYEA8bdUVyFkPlPS4OS/0GoNreRxlHxJHfih319l0xPP6JqTOy0syixg
dHlq1Dz6jKxA3W83ez2CCGi4KzKo8UAzDvjD4jNuV2mVGI2K7uHhZZwQogSf4vzI
fpTXVkSODujRGhianXX31G18Ifk/5vrk84BV0hnSKOGz7ZplgC4oevUCgYEA2R3e
BoTSyG/fg9bcv79OsHBrXbFQL8JyV9iZLx3oAmYP1dLSBBOd2bmRbg2OwHqCXL9m
E37/Y2oI3H/tbQmuNPOL+oZ9J9+SlEeNejY7yhOUiLGNOIVWx5ec5oTC6ZeLXa2B
l51rcvAkMDoCYdU5y4a4iLeD8cjszZfoB/9hnikCgYEA4qkmJnpCdQvHkGoQ0I/S
egDg3Pta2QcAS+U6J5/Jc3YXoAMxn/fTDwWYPqNb0zPns32KCj/YQqhoIuHjeC7a
ciymCuRtkPyJ+jcoU+9unAintDYf9AtUuxY5g0TP7X02L4Fo40Tu+70bDQScfq1A
qnHqiBT8dKeJQMJqcbNW9E0CgYBtYojLi/uOFB7uE0AgMsf4SIsvJvgZN8PX0j5K
6KxNGRJ9TbuVZjSuzrkgUyBKhO5Mv/kzdVZBxdg1DxaVSr1D3Df3ve4sOo1kuy/i
FJTG2FqLC7j0cuknoZDg6p4whbMnPRT/R8YsoCP7UB6HH6AAlB1AdAS7udjkM9Yo
wVdzEQKBgDtlPz2XMTjD/Bchcpw2Mr+y/w+xgUGblRIQ+crNFNeyaZBt4a4+HIrA
AVTnFcJ5czz2V2iNiMZn8dt7Z88QmZ/5VltenS503vmoa89j31JFgQcyBOD95Oqv
d3PcH2xC+uKIuYSD0wWYKy9p5B47iju15GEbhIuyrgLnxXPFIFYx
-----END RSA PRIVATE KEY-----");

// STEP 2. Define payment information
// ==================================

$fields = array(
        "VK_SERVICE"     => "1011",
        "VK_VERSION"     => "008",
        "VK_SND_ID"      => "uid100010",
        "VK_STAMP"       => "12345",
        "VK_AMOUNT"      => number_format($total_price, 2),
        "VK_CURR"        => "EUR",
        "VK_ACC"         => "EE171010123456789017",
        "VK_NAME"        => "Toidupood",
        "VK_REF"         => "1234561",
        "VK_LANG"        => "EST",
        "VK_MSG"         => "Ostud Toidupoest",
        "VK_RETURN"      => "http://localhost:8081/success.php",
        "VK_CANCEL"      => "http://localhost:8081/cancel.php",
        "VK_DATETIME"    => date(DATE_ISO8601),   //"2020-05-09T20:48:57+0300"
        "VK_ENCODING"    => "utf-8",
);

// STEP 3. Generate data to be signed
// ==================================

// Data to be signed is in the form of XXXYYYYY where XXX is 3 char
// zero padded length of the value and YYY the value itself
// NB! SEB expects symbol count, not byte count with UTF-8,
// so use `mb_strlen` instead of `strlen` to detect the length of a string

$data = str_pad (mb_strlen($fields["VK_SERVICE"], "UTF-8"), 3, "0", STR_PAD_LEFT) . $fields["VK_SERVICE"] .    /* 1011 */
        str_pad (mb_strlen($fields["VK_VERSION"], "UTF-8"), 3, "0", STR_PAD_LEFT) . $fields["VK_VERSION"] .    /* 008 */
        str_pad (mb_strlen($fields["VK_SND_ID"], "UTF-8"),  3, "0", STR_PAD_LEFT) . $fields["VK_SND_ID"] .     /* uid100010 */
        str_pad (mb_strlen($fields["VK_STAMP"], "UTF-8"),   3, "0", STR_PAD_LEFT) . $fields["VK_STAMP"] .      /* 12345 */
        str_pad (mb_strlen($fields["VK_AMOUNT"], "UTF-8"),  3, "0", STR_PAD_LEFT) . $fields["VK_AMOUNT"] .     /* 150 */
        str_pad (mb_strlen($fields["VK_CURR"], "UTF-8"),    3, "0", STR_PAD_LEFT) . $fields["VK_CURR"] .       /* EUR */
        str_pad (mb_strlen($fields["VK_ACC"], "UTF-8"),     3, "0", STR_PAD_LEFT) . $fields["VK_ACC"] .        /* EE171010123456789017 */
        str_pad (mb_strlen($fields["VK_NAME"], "UTF-8"),    3, "0", STR_PAD_LEFT) . $fields["VK_NAME"] .       /* ÕIE MÄGER */
        str_pad (mb_strlen($fields["VK_REF"], "UTF-8"),     3, "0", STR_PAD_LEFT) . $fields["VK_REF"] .        /* 1234561 */
        str_pad (mb_strlen($fields["VK_MSG"], "UTF-8"),     3, "0", STR_PAD_LEFT) . $fields["VK_MSG"] .        /* Torso Tiger */
        str_pad (mb_strlen($fields["VK_RETURN"], "UTF-8"),  3, "0", STR_PAD_LEFT) . $fields["VK_RETURN"] .     /* http://localhost:8080/project/DQnxvHFxeQR8m5cC?payment_action=success */
        str_pad (mb_strlen($fields["VK_CANCEL"], "UTF-8"),  3, "0", STR_PAD_LEFT) . $fields["VK_CANCEL"] .     /* http://localhost:8080/project/DQnxvHFxeQR8m5cC?payment_action=cancel */
        str_pad (mb_strlen($fields["VK_DATETIME"], "UTF-8"), 3, "0", STR_PAD_LEFT) . $fields["VK_DATETIME"];    /* 2020-05-09T20:48:57+0300 */

/* $data = "0041011003008009uid10001000512345003150003EUR020EE171010123456789017009ÕIE MÄGER0071234561011Torso Tiger069http://localhost:8080/project/DQnxvHFxeQR8m5cC?payment_action=success068http://localhost:8080/project/DQnxvHFxeQR8m5cC?payment_action=cancel0242020-05-09T20:48:57+0300"; */

// STEP 4. Sign the data with RSA-SHA1 to generate MAC code
// ========================================================

openssl_sign ($data, $signature, $private_key, OPENSSL_ALGO_SHA1);

/* q6xNYQsnCVxI4w7pc0DCCzQCBXFtYt55jYSpye1ziySnya9dubZtvpuprz67Zl/CpPhPWiVHfDVjGFByIcGczlD2QOnhcveUtVqEeEVBaWpRmUYQ7n0P/tsnNZ7UJoH0wzAVfZ6gxsWc8+DvQURei1B1wosJji4OkgCblOQ+09ei3ROoodB1PZ0iKbJEHNGdWOYKx8yDQXyIPYPQQ4cZuZrnNMFMuVt1lTbxQ5FPBlUS4mlpAoqgjR84rrgm9ffh9qxB/JiEAiNKQ9/lgjRDHTgiwmVmOez67n3HnlPkpP6TMX912lOGE0ro3qJN615A0c4vCnG8+PSsx6Wi0Q4cjQ== */
$fields["VK_MAC"] = base64_encode($signature);

// STEP 5. Generate POST form with payment data that will be sent to the bank
// ==========================================================================
?>

        <h1><a href="http://localhost:8080/">Pangalink-net</a></h1>
        <p>Makse teostamise näidisrakendus <strong>"SEB Pank"</strong></p>

        <form method="post" action="http://localhost:8080/banklink/seb-common">
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