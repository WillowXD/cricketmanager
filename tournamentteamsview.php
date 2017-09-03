<?php
session_start(); 
include("dbconnection.php");
if(isset($_GET["deleteid"]))
{
	$delres = mysqli_query($cnn, "DELETE FROM tournaments where tournamentid='$_GET[deleteid]'");
		if(!$delres)
			{
				$resdel = "Failed to delete record";
			}
			
}

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
    <div id="sidebar_1" class="sidebar one_quarter first">
		<?php
		include("adminmenu.php");
		?>
    </div>
    <!-- ################################################################################################ -->
    <div id="portfolio" class="three_quarter">


<a href="tournamentteamsadd.php?tournamentid=<?php echo $_GET['tournamentteams'] ?>"><h2>Add tournament teams</h2></a>
    
<table width="581" border="1" style="background-color: white">
  <tr>
    	<th width="177" scope="col">Teams</th>
        <th width="201" scope="col">description</th>
   		<th width="91" scope="col">status</th>      
    	<th width="84" scope="col">Action</th>
  </tr>
  <?php
  /*
    $qres = mysqli_query($cnn, "select tournaments.*,tournamentteams.*,teams.*  from tournaments INNER JOIN tournamentteams INNER JOIN teams ON tournaments.tournamentid=tournamentteams.tournamentid AND tournamentteams.teamid= teams.teamid where tournamentteams.tournamentid='$_GET[tournamentteams]' ");*/
$qresteams = mysqli_query($cnn, "SELECT DISTINCT teamid FROM tournamentteams WHERE tournamentid =  '$_GET[tournamentteams]'");
	while($arrrecteams = mysqli_fetch_array($qresteams))
	{

$qres = mysqli_query($cnn, "select tournaments.*,tournamentteams.*,teams.* from tournaments INNER JOIN tournamentteams INNER JOIN teams ON tournaments.tournamentid=tournamentteams.tournamentid AND tournamentteams.teamid= teams.teamid where tournamentteams.teamid='$arrrecteams[teamid]' ");
$arrrec = mysqli_fetch_array($qres);

		echo "<tr>";
    	echo "<td>&nbsp;<strong>Team name: </strong>$arrrec[teamname] <br>";
			
		echo "</td>";
	 	echo "<td>&nbsp;$arrrec[description]</td>";
    	echo "<td>&nbsp;$arrrec[status]</td>";
	 
	  	echo "<td>&nbsp;<a href='tournamentteamsview.php?deleteid=$arrrec[tournamentid]'>Delete</a> </td>";
		echo "</tr>";
	}
  ?>
</table>
</div>
<div class="Add teams to Tournaments">

</div>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<?php
include("footer.php");
?>