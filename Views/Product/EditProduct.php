<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add and Edit</title>
</head>
<body>
    <form action="" method = "POST" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name = "name" value="<?=$name?>">
        <br>
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" value="<?=$quantity?>">
        <br>
        <label for="price">Price:</label>
        <input type="number" name="price" value="<?=$price?>">
        <label for="description">Desecription:</label>
        <textarea name="description" id="" cols="30" rows="10"><?=$description?></textarea>
        <br>
        Category: <select name="category_id" id="">
            <?php 
            foreach($categories as $category){
                if($category['category_id'] == $category_id){
                    echo '<option selected value ="'.$category['category_id'].'">'.$category['category_name'].'</option>';
                }else{
                    echo '<option value="'.$category['category_id'].'">'.$category['category_name'].'</option>';
                }
            }
          ?>
        </select>
        <br>
        <input type="submit" value="submit">
    </form>
</body>
</html>