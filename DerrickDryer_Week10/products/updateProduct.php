<?php

//fetch inputs
$prodId = filter_input(INPUT_POST, 'prodId', FILTER_VALIDATE_INT);
$prodCat = filter_input(INPUT_POST, 'prodCat', FILTER_VALIDATE_INT);
$prodCode = filter_input(INPUT_POST, 'prodCode');
$prodName = filter_input(INPUT_POST, 'prodName');
$prodPrice = filter_input(INPUT_POST, 'prodPrice', FILTER_VALIDATE_FLOAT);
$prodDiscount = filter_input(INPUT_POST, 'prodDiscount', FILTER_VALIDATE_FLOAT);

//validate inputs
if ($prodId === null || $prodId === false || 
        $prodCat === null || $prodCat === false || (($prodCat >= 3)&&($prodCat <=1))||
        $prodCode === null || $prodName === null || $prodPrice === null || $prodPrice === false || $prodDiscount === null || 
		$prodDiscount === false) {
    $error = "Invalid product data. Check all fields and try again.";
    echo $error;
}

else {
    require_once('../inc/db_connect.php');

	 $query = 'UPDATE products
                 SET categoryID = :prodCat, productCode = :prodCode, 
				 productName =:prodName, listPrice =:prodPrice, discountPercent =:prodDiscount
				 WHERE productID =:prodId';
				 
    $statement = $db->prepare($query);
	 $statement->bindValue(':prodId', $prodId);
    $statement->bindValue(':prodCat', $prodCat);
    $statement->bindValue(':prodCode', $prodCode);
    $statement->bindValue(':prodName', $prodName);
    $statement->bindValue(':prodPrice', $prodPrice);
	$statement->bindValue(':prodDiscount', $prodDiscount);
	
    $statement->execute();
    $statement->closeCursor();
     
	 $category_id = $prodCat;
    // Display the Product List page
	echo "Update successful!";
    include('index.php');
}	


 
 
?>