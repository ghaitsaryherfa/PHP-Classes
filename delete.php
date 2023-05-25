<?php 
    include 'Expense.php';

    $id = $_POST['id'];

    $deleteSQL = new Expense();
    $deleteSQL->deleteShopping('shopping',"shopping_code=$id");
    $deleteSQL->deleteItems('items',"shopping_code=$id");
?>