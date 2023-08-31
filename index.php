<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Product List</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        button 
        {
            font-size: 15px;
            padding: 10px;
            margin: 10px;
            margin-bottom: 20px;
            background-color: white;
            box-shadow: rgba(0, 0, 0, 1) 5px 5px;
            cursor: pointer;
        }
        h1 {
            color: #000000;
            font-weight: normal;
        }
        hr {
            border-top: 2px solid grey;
        }
        .head {
            display: flex;
            justify-content: space-between;
            margin-left: 40px;
            margin-right: 40px;
        }
        #btn-container
        {
            text-align: right;
            display: flex;
            justify-content: space-between;
        }
        #features .fea-box{
            background-color: #FFFFFF;
            margin-bottom: 20px;
            text-align: start;
            border-color: #000000;
        }
        #footer {
            padding: 5vw 8vw 0 8vw;
            text-align: center;
        }
        #features {
            padding: 1.5vw 3vw 0 3vw;
            text-align: center;

        }

        #features .fea-base {
            display: grid;
            grid-template-columns: repeat(auto-fit,minmax(320px, 1fr));
            grid-gap: 1rem;
            position: relative;
            margin-top: 0;

        }

        #features .fea-box{
            background-color: #FFFFFF;
            margin-bottom: 0px;
            text-align: start;
            border-style: solid;
            border-color: #000000;
        }

        #features .fea-box p {
            font-size: 0.8rem;
            color: #000000;
            font-weight: 600;
            padding: 10px 0 15px 0;
            margin-left: 0;
            margin-right: 0;
            margin-bottom: 50px;
            margin-top: 20px;
            /*text-align: center;*/
        }

        #features .fea-box .delete-checkbox {
            margin: 10px;
        }
        #foot {
            margin-top: 40px;
        }

        #foot h4{
            margin-top: 20px;
            font-weight: normal;
            display: flex;
            justify-content: center;        
        }
    </style>
</head>
<body>
    <div class="head">
        <h1>Product List</h1>
        <div id="btn-container">
            <a href="add-product.php"><button id="add">ADD</button></a>
            <form method="POST">
                <button type="submit" name="delete" id="delete" class="#delete-product-btn">MASS DELETE</button>
        </div>
    </div>
    <hr>
    <?php 
    include "config.php"; //Connects to database
    class Product {
        public $sku;
        private $name;
        private $price;
        private $attributes;
        public function __construct($sku, $name, $price, $attributes){
            $this->sku = $sku;
            $this->name = $name;
            $this->price = $price;
            $this->attributes = $attributes;
        }
        public function getInfo(){ //gets the data that will be shown in the list for each product object
            $str =  $this->sku ."<br>". $this->name ."<br>" . $this->price . " $<br>" . $this->attributes;
            return $str;
        }
    }
    $array = getArrayOfProducts($db);
    $length = count($array);
    for($i = 0; $i < $length; $i++){
        $sku = $array[$i];
        $name = getName($db, $array[$i]);
        $price = getPrice($db, $array[$i]);
        $att = getAtt($db, $array[$i]);
        $array[$i] = new Product($sku, $name, $price, $att);
    }
    ?>
    <section id="features"><div class="fea-base">
    <?php
    if(isset($_POST['delete']) && isset($_POST['id'])){
        $selected = $_POST['id'];
        $count = count($selected);
        for($k = 0; $k <$count; $k++){
            $sql = $db->query("DELETE FROM `products` WHERE `SKU` = '$selected[$k]'");
        }
        header("Refresh:1");
    }
    for($j = 0; $j < $length; $j++){
        ?>
        <div class="fea-box">
            <input type="checkbox" class="delete-checkbox" name="id[]" value="<?= $array[$j]->sku; ?>">
            <p>
            <?php
            echo ($array[$j]->getInfo());
            ?>
            </p></div>
        <?php
    }
    ?>
    </div>
    </form>
    </section>
    <section id="foot">
        <hr><h4>Scandiweb Test assignment</h4>
    </section>
    <?php
    
    function getArrayOfProducts($db){
        $array = array();
        $sql = $db->query("SELECT `SKU` FROM `products` ORDER BY `SKU` ");
        while($row = $sql->fetch_assoc()){
            $identifier = $row['SKU'];
            array_push($array, $identifier);
        }
        return $array;
    }

    function getName($db, $sku){
        $sql = $db->query("SELECT `Name` FROM `products` WHERE `SKU` = '$sku'");
        while($row = $sql->fetch_assoc()){
            return $row['Name'];
        }
    }

    function getPrice($db, $sku){
        $sql = $db->query("SELECT `Price in $` FROM `products` WHERE `SKU` = '$sku'");
        while($row = $sql->fetch_assoc()){
            return $row['Price in $'];
        }
    }

    function getAtt($db, $sku){
        $sql = $db->query("SELECT `Attributes` FROM `products` WHERE `SKU` = '$sku'");
        while($row = $sql->fetch_assoc()){
            return $row['Attributes'];
        }
    }
    ?>
    
</body>
</html>
<!-- INSERT INTO `scandiweb`.`products` (`SKU`, `Name`, `Price in $`, `Attributes`) VALUES ('GGWP0007', 'War and Peace', 20.00, 'Weight: 2KG'); -->