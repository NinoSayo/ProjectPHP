$(document).ready(function () {
    $('.delete_product').click(function (e) {
        e.preventDefault();
        var id = $(this).val();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "POST",
                    url: "code.php",
                    data: {
                        'product_id': id,
                        'delete_product': true
                    },
                    success: function (response) {
                        if (response === "success") {
                            Swal.fire(
                                'Deleted!',
                                'Product has been deleted.',
                                'success'
                            );
                            $("#products_table").load(location.href + " #products_table");
                        } else {
                            Swal.fire(
                                'Failed!',
                                'Delete failed.',
                                'error'
                            );
                        }
                    }
                });
            }
        });
    });
});
