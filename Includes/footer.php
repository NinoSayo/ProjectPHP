<script src="Assets/JS/jquery-3.7.min.js"></script>
<script src="Assets/JS/bootstrap.bundle.min.js"></script>
<script src="Assets/JS/addToCart.js"></script>
<script src="Assets/JS/cancelOrder.js"></script>
<script src="Assets/JS/alertify.min.js"></script>


<script>
    alertify.set('notifier', 'position', 'top-center');
    <?php
    if (isset($_SESSION['message'])) { ?>
 
        alertify.success('<?= $_SESSION['message']; ?>');
    <?php
        unset($_SESSION['message']);
    } ?>
</script>
</body>
</html>