<?php
include 'Expense.php';

if (isset($_POST['shoppingTitle'])) {
    //insert shopping data
    $shoppingTitle = $_POST['shoppingTitle'];
    $shoppingDescription = $_POST['shoppingDescription'];
    $shoppingCategory = $_POST['shoppingCategory'];
    $shoppingDate = $_POST['shoppingDate'];

    //insert items data
    $itemName = $_POST['itemName'];
    $itemCategory = $_POST['itemCategory'];
    $itemDescription = $_POST['itemDescription'];
    $itemQuantity = $_POST['itemQuantity'];
    $itemPrice = $_POST['itemPrice'];
    $totalItemPrice = $_POST['totalItemPrice'];

    $insertSQL = new Expense();
    $shoppingCode = $insertSQL->insertShopping('shopping', ['shopping_title' => $shoppingTitle, 'shopping_description' => $shoppingDescription, 'shopping_category' => $shoppingCategory, 'shopping_date' => $shoppingDate, 'total_shopping'=>$totalItemPrice]);
    
    $insertSQL->insertItems('items', ['item_name' => $itemName, 'item_category' => $itemCategory, 'item_description' => $itemDescription, 'item_qty' => $itemQuantity, 'price' => $itemPrice, 'total_price' => $totalItemPrice, 'shopping_code'=>$shoppingCode]);
    // if ($insertSQL == true) {
    //     header('location:ExpenseInput.html');
    // }
}
