<?php

if(!isset($prod_id)){
$prod_id = filter_input(INPUT_POST, 'product_id');

if($prod_id == null){
$error = "Error";
echo $error;
}

else {
require('../inc/db_connect.php');

$queryProducts = 'SELECT * FROM products
                  WHERE productID = :prod_id';
                   
$statement1 = $db->prepare($queryProducts);
$statement1->bindValue(':prod_id', $prod_id);
$statement1->execute();
$product = $statement1->fetch();
$statement1->closeCursor();
var_dump($product);
}
}

if(!isset($category_id)){
$category_id = filter_input(INPUT_POST, 'category_id');
}

?>


<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<!-- the body section -->
<body>
    <header><h1>Product Manager</h1></header>

    <main>
     
          <form action="updateProduct.php" method="post"
              id="update_product_form">

            <label>Category ID:</label>
             <input type="text" name="prodCat" value="<?php echo $product["categoryID"];?>" ><br>


            <label>Product Code:</label>
            <input type="text" name="prodCode" value="<?php echo $product["productCode"];?>" ><br>

            <label>Product Name:</label>
            <input type="text" name="prodName" value="<?php echo $product["productName"];?>"><br>

            <label>List Price:</label>
            <input type="text" name="prodPrice" value="<?php echo $product["listPrice"];?>"><br>

			<label>Discount Percent:</label>
            <input type="text" name="prodDiscount" value="<?php echo $product["discountPercent"];?>"><br>
			
			<input type="hidden" name="prodId" value="<?php echo $product["productID"];?>" ><br>
			
			

			
            <label>&nbsp;</label>
            <input type="submit" value="Update Product"><br>
           </form>
		   
           <p><a href="index.php?category_id=<?php echo $product['categoryID']; ?>">View Product List</a></p>
	 
	</main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
    </footer>
</body>
</html>	