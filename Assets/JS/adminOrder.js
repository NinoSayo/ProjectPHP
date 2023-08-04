$(document).ready(function() {
    $(".check-link").on("click", function(e) {
        e.preventDefault();
        
        var orderID = $(this).data("order-id");
        
        // Set the selected order ID in the modal
        $("#statusModal").data("order-id", orderID);
        
        // Show the modal when the "check" link is clicked
        $('#statusModal').modal('show');
    });
    
    // Handle confirm button click inside the modal
    $("#confirmStatus").on("click", function() {
        var orderID = $("#statusModal").data("order-id");
        var newStatus = $("#newStatus").val();
        
        // Send AJAX request to update order status
        $.ajax({
            url: "../Functions/orderStatus.php", // Replace with the actual path to your PHP script
            type: "POST",
            data: { order_id: orderID, new_status: newStatus },
            success: function(response) {
                if (response === "success") {
                    // Close the modal and refresh the page or update the table to reflect the changes
                    $('#statusModal').modal('hide');
                    location.reload();
                } else {
                    alert("Failed to update order status.");
                }
            },
            error: function() {
                alert("An error occurred while updating order status.");
            }
        });
    });
});

$(document).ready(function() {
    $(".delete-link").on("click", function(e) {
        e.preventDefault();
        
        var orderID = $(this).data("order-id");
        
        // Send AJAX request to delete order and order items
        $.ajax({
            url: "../Functions/deleteOrder.php", // Replace with the actual PHP file to process the deletion
            type: "POST",
            data: { order_id: orderID },
            success: function(response) {
                if (response === "success") {
                    // Refresh the page or update the table to reflect the changes
                    location.reload();
                } else {
                    alert("Failed to delete order.");
                }
            },
            error: function() {
                alert("An error occurred while deleting order.");
            }
        });
    });
});
