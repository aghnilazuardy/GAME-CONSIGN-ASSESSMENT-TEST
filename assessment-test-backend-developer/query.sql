--1. Query for products created in the last 6 months:
SELECT *
FROM products
WHERE created_at >= DATE_SUB(NOW(), INTERVAL 6 MONTH);

-- 2. Query for products with average review rating of 4 or higher:
SELECT 
    products.*,
    categories.name as category_name,
    AVG(reviews.rating) as avg_rating
FROM products
JOIN categories ON products.category_id = categories.id
JOIN reviews ON products.id = reviews.product_id
GROUP BY 
    products.id,
    products.name,
    products.price,
    products.category_id,
    products.store_id,
    products.created_at,
    products.updated_at,
    categories.name
HAVING AVG(reviews.rating) >= 4;

-- 3. Query for products in categories with more than 10 products:
SELECT *
FROM products
WHERE category_id IN (
    SELECT category_id
    FROM products
    GROUP BY category_id
    HAVING COUNT(*) > 10
);

-- 4. Query for products sorted by total quantity sold:
SELECT 
    products.id,
    products.name,
    products.price,
    SUM(orders.quantity) as order_quantity
FROM products
LEFT JOIN orders ON products.id = orders.product_id
GROUP BY 
    products.id,
    products.name,
    products.price
ORDER BY order_quantity DESC;