</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="js/jquery.js"></script>
<script src="js/scripts.js"></script>
<script>
    var divBox = "<div id='load-screen'><div id='loading'></div></div>";
    $("body").prepend(divBox);
    $('#load-screen').delay(700).fadeOut(600, function() {
        $(this).remove();
    });
</script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>