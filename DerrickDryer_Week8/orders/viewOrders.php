<!DOCTYPE html>
<!-- Head Section -->
<html>
    <title>Admin - Orders</title>
    <link rel="stylesheet" type="text/css" href="../main.css" />
</html>

<!-- Body Section -->
<body>
    <h1>Orders Page</h1>
    <main>
        <!-- Display a list of categories -->
        <aside>
            <h2>Categories</h2>
            <nav>
                <ul>
                    <?php foreach ($categories as $category) : ?>
                        <li>
                            <a href="?category_id=<?php echo $category['categoryID']; ?>">
                                <?php echo $category['categoryName']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
            <button onclick="document.location='../index.php'">Back</button>
        </aside>

        <section>
            <!-- Display a table of products only if category is selected -->
            <?php if ($category_id != NULL) { ?>
                <h2><?php echo $category_name; ?></h2>
                <table>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th class="right">Price</th>
                    </tr>
                    <?php foreach ($products as $product) : ?>
                        <tr>
                            <td><?php echo $product['productCode']; ?></td>
                            <td><?php echo $product['productName']; ?></td>
                            <td class="right">
                                <?php
                                    $price = $product['listPrice'];
                                    $formattedPrice = number_format($price, 2);
                                    echo '$'.$formattedPrice;
                                ?>
                            </td>
                            <td>
                                <form>
                                    <input type="submit" name="action" value="View Orders">
                                    <input type="hidden" name="prodID" value="<?php echo $product['productID']; ?>">
                                    <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php } ?>
        
        <!-- Display order details for specific product -->
        <?php if ($action == "View Orders") { ?>
            <br>
            <br>
            <?php if(empty($orders)) {
                echo "<h3>There are no orders for this product.</h3>";
            } else { ?>
            <table>
                <?php foreach ($products as $product) : ?>
                    <?php if($product['productID'] == $product_id) { ?>
                        <h3><?php echo $product['productName'] . ' Orders'; ?></h3>
                    <?php } endforeach; ?>
                <tr>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
                <?php foreach($orders as $order) : ?>
                    <?php if($order['productID'] == $product_id) { ?>
                        <tr>
                            <td><?php echo $order['orderID']; ?></td>
                            <td><?php echo $order['orderDate']; ?></td>
                            <td><?php echo $order['quantity']; ?></td>
                            <?php
                                $price = $order['quantity'] * $order['itemPrice'] - $order['discountAmount'];
                                $formattedPrice = number_format($price, 2);
                            ?>
                            <td><?php echo '$'.$formattedPrice ?></td>
                        </tr>
                <?php } endforeach; } } ?>
            </table>
        </section>
    </main>
    <footer></footer>
</body>