   <!--
      Week 7 Assignment

      Author: Derrick Dryer
      Date:   2/27/2024

      Filename: view_products.php
   -->

   <?php

   ?>
   <!DOCTYPE html>
   <html>

   <head>
      <title>Week 7 Assignment</title>
      <link rel="stylesheet" href="main.css" />
      <h1>Week 7 Assignment</h1>
   </head>

   <body>
      <main>

         <!-- #1 Static display of ID and Name -->
         <h2>Display using echo statements:</h2>
         <?php foreach ($products as $product) : ?>
            <p><?php echo 'ID: ' . $product['productID'] . ', Name: ' . $product['productName']; ?></p>
         <?php endforeach; ?>

         <!-- #2 Static Display of Name and Code as List Items -->
         <h2>List Products</h2>
         <ul><?php foreach ($products as $product) :  ?>
               <li><?php echo 'Name: ' . $product['productName'] . ', Code: ' . $product['productCode']; ?></li>
            <?php endforeach; ?>
         </ul>

         <!-- #3 Populate a drop-down -->
         <h2>List products and make them selectable:</h2>
         <p><?php echo $msg2; ?>
         <form action="index.php" method="get">
            <label>Select Product:</label>
            <select name="product_list">
               <?php foreach ($products as $product) : ?>
                  <option value="<?php echo $product['productID']; ?>">
                     <?php echo $product['productName'] ?>
                  </option>
               <?php endforeach; ?>
            </select>

            <input type="submit" name="action" value="ListSelect"><br>

         </form>

         <!-- #4 display a product table -->
         <h2>Display product table:</h2>
         <p><?php echo $msg3; ?>
         <table>
            <tr>
               <th>Product Name</th>
               <th>List Price</th>
               <th></th>
               
            </tr>
            <?php foreach ($products as $product) : ?>
               <tr>
                  <td><?php echo $product['productName'] ?></td>
                  <td><?php echo $product['listPrice'] ?></td>
                  <td>
                     <form action='index.php' method='get'>
                        <input type='hidden' name='prodID' value='<?php echo $product['productID'] ?>'>
                        <input type='submit' name='action' value='TableSelect'>
                     </form>
                  </td>
               </tr>
            <?php endforeach; ?>
         </table>


      </main>
   </body>

   </html>
