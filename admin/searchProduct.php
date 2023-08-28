<?php
include("Database/Connect.php");

if (isset($_POST["query"])) {
    $searchText = $_POST["query"];

    $products = searchProducts($con, $searchText);

    if (count($products) > 0) {
        foreach ($products as $item) {
            echo "<p>{$item['product_name']}</p>";
        }
    } else {
        echo "No matching products found.";
    }
}

mysqli_close($con);

function searchProducts($con, $searchText) {
    $searchText = mysqli_real_escape_string($con, $searchText);

    $query = "SELECT * FROM product WHERE product_name LIKE '%$searchText%'";
    $result = mysqli_query($con, $query);

    $products = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }

    return $products;
}
?>
