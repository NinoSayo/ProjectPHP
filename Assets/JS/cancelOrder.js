$(document).ready(function() {
    $('.cancel-link').click(function(event) {
    event.preventDefault();
    
    var orderID = $(this).data('order-id');
    
    $.ajax({
        url: 'Functions/cancelOrder.php', // Change this to the actual URL that handles the cancellation
        method: 'POST',
        data: { orderID: orderID },
        success: function(response) {
            console.log(response)
            if (response === 'success') {
                // Update the status on the page
                $(event.target).closest('td').prev().html('<span class="status-dot" style="background-color: red;"></span>Canceled');
                // Show success notification
                alertify.success('Order canceled successfully.');
                location.reload();
            } else {
                // Show error notification
                alertify.error('Failed to cancel order.');
            }
        },
        error: function() {
            // Show error notification
            alertify.error('An error occurred while canceling the order.');
        }
    });
});
});