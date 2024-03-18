USE my_guitar_shop2;

SELECT categoryName, categoryID FROM categories
WHERE categoryID <= 2;

SELECT productName, listPrice
FROM products
INNER JOIN orderItems
ON products.productID = orderItems.productID
WHERE listPrice > 300.00;

UPDATE orderItems
SET quantity = 3
WHERE orderID = 3;
