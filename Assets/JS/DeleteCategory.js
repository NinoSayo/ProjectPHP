$(document).ready(function () {
    $('.delete-link').click(function (e) {
        e.preventDefault();
        var categoryID = $(this).data('id');
        if (confirm("Are you sure you want to delete this category?")) {
            $.ajax({
                url: 'DeleteCategory.php',
                type: 'POST',
                data: {
                    id: categoryID
                },
                success: function (response) {
                    try {
                        var jsonData = JSON.parse(response);
                       
                        if (jsonData.status === 'success') {
                            alert('Category deleted successfully.');
                            $('#row-' + categoryID).remove();
                            location.reload();
                        } else if (jsonData.status === "error_product") {
                            alert('Cannot delete category. It is associated with one or more products.');
                        } else {
                            alert("123");
                        }
                    } catch (error) {
                        alert('An error occurred while parsing the response.');
                    }
                },
                error: function () {
                    alert('An error occurred while executing the function.');
                }
            });
        }
    });
});