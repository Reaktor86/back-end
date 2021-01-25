<?php
require ('vendor/autoload.php');

$obj = new \Eshop\Product();

$allProducts = $obj->getProducts();
//echo "<pre>";
//print_r($allProducts);
//echo "</pre>";
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Price</th>
                <th>Active</th>
                <th>Description</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
        <?php
           foreach ($allProducts as $key => $val):?>
        <tr>
                <td><?=$val["id"]?></td>
                <td><?=$val["name"]?></td>
                <td><?=$val["price"]?></td>
                <td><?=$val["active"]?></td>
                <td><?=$val["description"]?></td>
                <td><button class="delete" data-id="<?=$val["id"]?>">x</button></td>
                <td><button class="update" data-id="<?=$val["id"]?>">!</button></td>
        </tr>
        <?php
            endforeach;?>
        </tbody>
    </table>
</body>


<div class="popup">
    <div class="error"></div>
    <form class="popup__form">
        <input type="hidden" name="id">
        <input type="text" name="Name">
        <input type="text" name="Price">
        <input type="text" name="Active">
        <input type="text" name="Description">
        <br>
        <input type="submit" name="submit">
    </form>
</div>
<style>
    .error {
        color: #f00;
    }
.popup {
    width: 300px;
    /*height: 300px;*/
    flex-direction: column;
    justify-content: space-between;
    align-content: center;
    padding: 30px;
    display: none;

}
input {
    margin-bottom: 15px;
}
</style>
<script src="scripts.js"></script>
</html>
