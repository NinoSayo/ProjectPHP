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
                            updateCategoryIDs(categoryID);
                            location.reload(); // Reload the page after successful deletion
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

function updateCategoryIDs(deleteCategoryID) {
    var rows = $('table tr');
    for (var i = 1; i < rows.length; i++) {
        var categoryIdCell = $(rows[i]).find('td:first-child');
        var categoryID = categoryIdCell.text().trim();
        if (categoryID !== '') {
            var categoryNumber = parseInt(categoryID.slice(1));
            if (categoryNumber > deleteCategoryID) {
                categoryIdCell.text('C' + (categoryNumber - 1));
                $(rows[i]).attr('id', 'row-C' + (categoryNumber - 1));
                $(rows[i]).find('.edit-link').data('id', 'C' + (categoryNumber - 1));
                $(rows[i]).find('.delete-link').data('id', 'C' + (categoryNumber - 1));
            }
        }
    }
}
