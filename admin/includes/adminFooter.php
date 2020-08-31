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
<script>
    function loadUsersOnline() {
        $.get("functions.php?onlineusers=result", function(data) {
            $(".usersonline").text(data);
        });

    }
    setInterval(function() {

        loadUsersOnline();
    }, 500);
</script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>