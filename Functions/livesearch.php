<?php
require_once("../Functions/dbhelper.php");
require_once("../Functions/myFunction.php");

$input = $_POST['input'];
$result = execute("SELECT *
                  FROM product
                  INNER JOIN product_image ON product.product_id = product_image.product_id 
                  WHERE product.product_name LIKE '%{$input}%'");

// Initialize the output
$output = '';

if (mysqli_num_rows($result) > 0) {
    while ($items = mysqli_fetch_assoc($result)) {
        $output = '

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Slug</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Description</th>
            <th>Category</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>';
        $output .= '
        <tr>
            <td>' . $items['product_id'] . '</td>
            <td><img src="../Assets/' . $items['image_source'] . '" width="50px" height="50px" alt=""></td>
            <td>' . $items['product_name'] . '</td>
            <td>' . $items['product_slug'] . '</td>
            <td>' . $items['product_quantity'] . '</td>
            <td>' . $items['product_price'] . '</td>
            <td>' . $items['product_descriptions'] . '</td>
            <td>' . getCategoryName($items['category_id']) . '</td>
            <td>' . ($items['product_status'] == '1' ? 'Visible' : 'Hidden') . '</td>
            <td><a href="editProduct.php?id=' . $items['product_id'] . '" class="btn btn-sm btn-primary">Edit</a></td>
            <td>
                <form action="code.php" method="POST">
                    <input type="hidden" name="product_id" value="' . $items['product_id'] . '">
                    <button type="submit" class="btn btn-sm btn-danger" name="delete_product">Delete</button>
                </form>
            </td>
        </tr>';
    }
} else {
    $output .= '<tr><td colspan="11">No record found</td></tr>';
}

echo $output;
