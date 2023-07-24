$(document).ready(function () {
    $('.delete-product').click(function (e) {
        e.preventDefault();
        var productID = $(this).data('id');
        if (confirm("Are you sure you want to delete this product?")) {
            $.ajax({
                url: 'DeleteProduct.php',
                type: 'GET',
                data: {
                    id: productID
                },
                success: function (response) {
                    try {
                        var jsonData = JSON.parse(response);
                        if (jsonData.status === 'success') {
                            // Product deleted successfully
                            alert('Product deleted successfully.');
                            $('#row-' + productID).remove();
                            // Optionally, you can reload the page after deletion
                            location.reload();
                        }else{
                            alert('An error occured while deleting product');
                        }
                    }catch (error){
                        alert('An error occured while parsing the response');
                    }
                  
                },
                error: function () {
                    alert('An error occurred while deleting the product.');
                }
            });
        }
    });
});
