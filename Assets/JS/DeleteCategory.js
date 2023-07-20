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
                        } else {
                            alert('An error occurred while deleting the category.');
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