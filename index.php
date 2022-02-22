<style>
    .products {
        display: inline-block;
        border: 2px solid #333;
    }
    table {
        border-collapse: collapse;
    }
    td, th {
        border: 1px solid #4f4949;
    }
</style>
<?php

//$db = mysqli_connect('localhost', 'root', '');
//$shop = mysqli_select_db($db, 'shop');
//
//$products = mysqli_query($db, 'SELECT * FROM product;', MYSQLI_USE_RESULT);

$shop = new mysqli('localhost', 'root', '', 'shop');
$products = $shop->query('SELECT * FROM product;');

$productsWithCategories = $shop->query("SELECT `product`.`Name`,
       `product`.`Price`,
       `category`.`Name` AS `Category_Name`
    FROM `product`
JOIN `category`
    ON `category`.`id` = `product`.`id_category`;");

$productsJava = $shop->query("SELECT `product`.`Name`,
       `product`.`Price`,
       `category`.`Name` AS `Category_Name`
    FROM `product`
JOIN `category`
    ON `category`.`id` = `product`.`id_category`
WHERE `category`.`Name` = 'Java';");

$productsWithoutCategories = $shop->query("SELECT `product`.`Name`,
       `product`.`Price`,
       `category`.`Name` AS `Category_Name`
    FROM `product`
LEFT JOIN `category`
    ON `category`.`id` = `product`.`id_category`
WHERE `product`.`id_category` IS NULL;");

if (is_object($products)) {
?>
    <div class="products">
        <h2>Вывод названий всех продуктов</h2>
        <table>
            <tbody>
                <tr>
                    <th>Продукт</th>
                </tr>
                    <?php
                    foreach ($products as $product) {
                        echo '<tr>';
                        echo '<td>';
                        echo $product['Name'];
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
            </tbody>
        </table>
    </div>
<?php
}
?>
<div class="products">
    <h2>Вывод продуктов с категорями</h2>
    <table>
        <tbody>
            <tr>
                <th>Продукт</th>
                <th>Цена</th>
                <th>Категория</th>
            </tr>
            <?php
            foreach ($productsWithCategories as $products) {
                echo '<tr>';
                foreach ($products as $product) {
                    echo '<td>' . $product . '</td>';
                }
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<div class="products">
    <h2>Вывод продуктов с категорией JAVA</h2>
    <table>
        <tbody>
            <tr>
                <th>Продукт</th>
                <th>Цена</th>
                <th>Категория</th>
            </tr>
            <?php
            foreach ($productsJava as $products) {
                echo '<tr>';
                foreach ($products as $product) {
                    echo '<td>' . $product . '</td>';
                }
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>
<div class="products">
    <h2>Вывод продуктов без категории</h2>
    <table>
        <tbody>
            <tr>
                <th>Продукт</th>
                <th>Цена</th>
                <th>Категория</th>
            </tr>
            <?php
            foreach ($productsWithoutCategories as $products) {
                echo '<tr>';
                foreach ($products as $product) {
                    echo '<td>' . $product . '</td>';
                }
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>