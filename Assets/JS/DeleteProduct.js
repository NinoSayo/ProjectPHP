$(document).ready(function () {
    $('.delete-link').click(function (e) {
        e.preventDefault();
        var productID = $(this).data('id');
        if (confirm("Are you sure you want to delete this product?")) {
            $.ajax({
                url: 'DeleteProduct.php',
                type: 'POST',
                data: {
                    id: productID
                },
                success: function (response) {
                    try {
                        var jsonData = JSON.parse(response);
                        if (jsonData.status === 'success') {
                            alert('Product deleted successfully.');
                            $('#row-' + productID).remove();
                            location.reload();
                        } else {
                            alert('An error occurred while deleting the product.');
                        }
                    } catch (error) {
                        alert('An error occurred while parsing the response.');
                    }
                },
                error: function () {
                    alert('An error occurred while deleting the product.');
                }
            });
        }
    });
});
