<?php 
/*include "config.php";

function update($db, $obj) {

}

function insert($db, $obj) {
    $sku = $obj['sku'];
    $db->query("INSERT INTO `products`(`sku`) VALUES ('$sku')");
}


function isUnique($db, $sku){
    $sql = $db->query("SELECT `SKU` FROM `products` WHERE `SKU` = '$sku'");
    if(mysqli_num_rows($sql) != 0){
        return false;
    }
    return true;
}*/

$requestPayload = file_get_contents("php://input");

$object = json_decode($requestPayload);
//echo json_last_error_msg();
foreach($object as $holder) {
    echo $holder;
}
print_r($object);

?>