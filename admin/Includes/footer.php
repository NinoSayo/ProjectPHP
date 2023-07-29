<!-- jQuery -->
<script src="../Assets/JS/jquery-3.7.min.js"></script>

<!-- Bootstrap JS and Popper JS -->
<script src="../Assets/JS/popper.min.js"></script>
<script src="../Assets/JS/bootstrap.bundle.min.js"></script>

<!-- Rest of the scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../Assets/JS/chart.js"></script>
<script src="../Assets/JS/custom.js"></script>

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