<!DOCTYPE html>
<!-- Head Section -->
<html>
    <title>Admin - Products</title>
    <link rel="stylesheet" type="text/css" href="../main.css" />
</html>

<!-- Body Section -->
<body>
    <h1>Products Page</h1>
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
                                    <input type="submit" name="action" value="View Details">
                                    <input type="hidden" name="prodID" value="<?php echo $product['productID']; ?>">
                                    <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php } ?>
        
        <!-- Display product details after view details is clicked -->
        <?php if ($action == "View Details") { ?>
            <?php foreach ($products as $product) : ?>
                <?php if($product['productID'] == $product_id) { ?>
                    <h3><?php echo $product['productName']; ?></h3>
                    <p><?php echo $product['description']; ?></p>
            <?php } endforeach; } ?>
        </section>
    </main>
    <footer></footer>
</body>