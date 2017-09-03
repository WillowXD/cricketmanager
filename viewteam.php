<?php
include("dbconnection.php");
if(isset($_GET["deleteid"]))
{
	$delres3 = mysqli_query($cnn, "DELETE FROM bowlingperformance where playerid like (select playerid from players where teamid=$_GET[deleteid])");
	$delres2 = mysqli_query($cnn, "DELETE FROM batperformance where playerid like (select playerid from players where teamid=$_GET[deleteid])");
	$delres1 = mysqli_query($cnn, "DELETE FROM players where teamid=$_GET[deleteid]");
	$delres = mysqli_query($cnn, "DELETE FROM teams where teamid=$_GET[deleteid]");
		if((!$delres) and (!$delres1) and (!$delres2) and (!$delres3))
			{
				$resdel = "<strong>Failed to delete record</strong>";
			}
			else
			{
				$resdel =  "<strong>Record deleted successfully..</strong>";
			}
}
else
{
	$resdel="";
}
?>
<?php
session_start(); 
if(!isset($_SESSION['userid']))
{
	header("Location: login.php");
}
include("header.php");

?>
<!-- content -->
<div class="wrapper row3" style="background-color: grey">
  <div id="container">
    <!-- ################################################################################################ -->
    <div id="sidebar_1" class="sidebar one_quarter first" style="background-color: grey">
		<?php
		include("adminmenu.php");
		?>
    </div>
    <!-- ################################################################################################ -->
    <div id="portfolio" class="three_quarter" style="background-color: white">
<?php
echo $resdel; 
?>
  <?php
    $qres = mysqli_query($cnn, "select * from teams");
	while($arrrec = mysqli_fetch_array($qres))
	{  
	echo "<table width='581' border='1'>";
	echo "<tr>";
    echo "<td>
	<strong>Team detail</strong><br>
	&nbsp;Team name: $arrrec[teamname] <br> ";
	echo "</td><td>
	Created Date: $arrrec[createddate] <br>
	&nbsp; <a href='teams.php?editid=$arrrec[teamid]'>Edit</a> | 
	<a href='viewteam.php?deleteid=$arrrec[teamid]'>Delete</a> </td>";
	echo "</tr>";
	echo "</table>";
	}
  ?>

 </div>
    <div class="clear"></div>
  </div>
</div>
<?php
include("footer.php");
?>