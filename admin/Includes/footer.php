<!-- jQuery -->
<script src="../Assets/JS/jquery-3.7.min.js"></script>

<!-- Bootstrap JS and Popper JS -->
<script src="../Assets/JS/popper.min.js.map"></script>
<script src="../Assets/JS/popper.min.js"></script>
<script src="../Assets/JS/bootstrap.bundle.min.js"></script>

<!-- Rest of the scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../Assets/JS/adminChart.js"></script>
<script src="../Assets/JS/custom.js"></script>
<script src="../Assets/JS/adminOrder.js"></script>

<script>
    <?php
    if (isset($_SESSION['message'])) { ?>
        alertify.set('notifier', 'position', 'top-center');
        alertify.success('<?= $_SESSION['message']; ?>');
    <?php
        unset($_SESSION['message']);
    } ?>
</script>
</body>

</html>