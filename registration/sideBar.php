<?php 
if(!isset($_SESSION['ID']) || !isset($_SESSION['NAME'])){
	exit();
} ?>

<div id = "SideBar">
<div class="well anwid"><?php echo $_SESSION['NAME'].' (ANW'. $_SESSION['ID'].')'; ?></div>
	<ul class="nav nav-pills links">
		<li><a href="ViewEvents.php">My Events</a></li>
		<!--<span>Payment Status</span>
		<span>Personal Details</span>-->
		<li><a href="Logout.php">Logout</a></li>
	</ul>
</div>
