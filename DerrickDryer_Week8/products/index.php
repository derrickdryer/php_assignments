<?php
    require_once('../inc/db_connect.php');

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $action = filter_input(INPUT_GET, 'action');

    if($action == NULL) 
    {
        $action = "";
    }

    // Get the hidden field
    $product_id = filter_input(INPUT_GET, 'prodID');

    // Get category id
    $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);

    // Get name for selected category
    if ($category_id != NULL) {
        $queryCategory = 'SELECT * FROM categories
                            WHERE categoryID = :category_id';
        $statement1 = $db->prepare($queryCategory);
        $statement1->bindValue(':category_id', $category_id);
        $statement1->execute();
        $category = $statement1->fetch();
        $category_name = $category['categoryName'];
        $statement1->closeCursor();
    }
    #var_dump($category);

    // Get all categories
    $queryAllCategories = 'SELECT * FROM categories
                            ORDER BY categoryID';
    $statement2 = $db->prepare($queryAllCategories);
    $statement2->execute();
    $categories = $statement2->fetchAll();
    $statement2->closeCursor();
    #var_dump($categories)

    // Get products for selected category
    $queryProducts = 'SELECT * FROM products
                    WHERE categoryID = :category_id
                    ORDER BY productID';
    $statement3 = $db->prepare($queryProducts);
    $statement3->bindValue(':category_id', $category_id);
    $statement3->execute();
    $products = $statement3->fetchAll();
    $statement3->closeCursor();
    #var_dump($products);

    include("./viewProducts.php");
?>