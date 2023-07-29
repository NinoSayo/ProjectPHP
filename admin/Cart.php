<?php
session_start();
include("../Functions/myFunction.php");
include("../Middleware/admin.php");
include("Includes/header.php");
?>
<main class="mt-5 pt-5 ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Order list</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Customer Name</th>
                                    <th>Product ID</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Product Quantity</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $cart = getCart("carts","product","product_id","product_id");
                                if (!empty($cart)) {
                                    foreach ($cart as $items) {
                                        $user_id = $items['user_id'];
                                        $user_data = getSingleData("users","id",$user_id);
                                        $username = $user_data['username'];
                                ?>
                                        <tr>
                                            <td><?= $user_id; ?></td>
                                            <td><?=$username;?></td>
                                            <td><?= $items['product_id']; ?></td>
                                            <td><img src="../Assets/<?= $product_image['image_source']; ?>" width="50px" height="50px" alt=""></td>
                                            <td><?= $items['product_name']; ?></td>
                                            <td><?=$items['product_qty']?></td>
                                            <td><?=$items['cart_status'] == '1' ? 'Responded' : 'Pending' ?></td>
                                            <td></td>
                                            <td>
                                                <a href="editCategory.php?id=<?= $items['category_id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                            </td>
                                            <td>
                                            <form action="code.php" method="POST">
                                                    <input type="hidden" name="category_id" value="<?= $items['category_id']; ?>">
                                                    <button type="submit" class="btn btn-sm btn-danger" name="delete_category">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "No record found";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
<?php
include("Includes/footer.php");
?>