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
                "scope": "add"
            },
            success: function (response) {
                if(response ==  200){
                    alertify.success('Product added to cart');
                }else if(response == "existing"){
                    alertify.success(qty + "item(s) added to cart. Total item: " + response.qty_total);
                }else if(response == 401){
                    alertify.success("Login to continue");
                    window.location.href = "login.php";
                }else if(response == 500){
                    alertify.success("Something went wrong");
                }
            }
        });
    });

});