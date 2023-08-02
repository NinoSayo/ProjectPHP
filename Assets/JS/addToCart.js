$(document).ready(function () {
    
    $('.increment-btn').click(function (e) { 
        e.preventDefault();
        
        var qty = $(this).closest('.product_data').find('.input-qty').val();
        
        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if(value < 10)
        {
            value++;
            $(this).closest('.product_data').find('.input-qty').val(value);
        }
    });

    $('.decrement-btn').click(function (e) { 
        e.preventDefault();
        
        var qty = $(this).closest('.product_data').find('.input-qty').val();
        
        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if(value > 1)
        {
            value--;
            $(this).closest('.product_data').find('.input-qty').val(value);
        }
    });

    $('.addToCart-btn').click(function (e) { 
        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.input-qty').val();
        var prod_id = $(this).val();

        $.ajax({
            method: "POST",
            url: "Functions/handlecart.php",
            data: {
                "prod_id" : prod_id,
                "prod_qty": qty,
                "scope": "add",
            },
            success: function (response) {
                console.log(response);
                try {
                    var data = JSON.parse(response);
                    if (data.status === "existing") {
                        alertify.success(qty + ' item(s) added to cart. Total in cart: ' + data.qty_total);
                    } else if (data.status === "added") {
                        alertify.success(qty + ' item(s) added to cart');
                    } else if (data.status === "login") {
                        alertify.success("Login to continue");
                        setTimeout(function(){
                            window.location.href = 'login.php';
                        }, 800);
                    } else {
                        alertify.success("Something went wrong");
                    }
                } catch (error) {
                    alertify.success("Something went wrong");
                }
            }
        });
    });
});