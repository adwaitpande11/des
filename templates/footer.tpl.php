<?php
if(!isset($_SESSION['name_of_user']))
	$_SESSION['name_of_user'] = getOne($con, "SELECT name FROM adw_user WHERE user_id = ".$user_id);
?>
<div style="width:100%; text-align:right;">
	<span style="float:left; font-style:italic; font-size:3vw;"><strong style=" font-size:3vw;">Logged in as: </strong><?php echo $_SESSION['name_of_user'] ?></span>
	<span id="server_time" style="padding-right:10px; font-size:3vw;"><?php echo date('d M Y h:i:s A') ?></span>
    <a href="logout.php" onClick="javascript:return confirm('Log out?')"><img src="images/logout.png" style="width:3vw;height:3vw" /></a>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript">
setTimeout(function(){document.location = 'logout.php'}, 900000);	// Automatic logout after 15 min
$(document).ready(function(e) {
	$('.content_holder').fadeIn(500);
	$('#page_loading').css('display', 'none');
	
	setTimeout(function(){$(".success").slideUp(1000)}, 20000);
});
</script>
</div> <!--  End of class 'content_holder' -->
</div> <!--  End of class 'container' -->
</body>
</html>

<?php
mysqli_close($con);
?>