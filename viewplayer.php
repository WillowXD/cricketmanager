<?php
session_start(); 
include("dbconnection.php");
if(isset($_GET["deleteid"]))
{
	$delres = mysqli_query($cnn, "DELETE FROM players where playerid='$_GET[deleteid]'");
	if(!$delres)
			{				
				$resdel = "You cant delete this records..";
			}
			else
			{
				$resdel =  "Record deleted successfully..";
			}
}
else
{
	$resdel="";
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
    <p>
      <?php
	echo $resdel;
	?>
    </p>
    <form id="form1" name="form1" method="post" action="">
    Select Team : <select name="teamid">
    <option value="">Select</option>
	<?php
	$qres = mysqli_query($cnn, "select * from teams");
	while($arrrec = mysqli_fetch_array($qres))
	{
		echo "<option value='$arrrec[teamid]'>$arrrec[teamname]</option>"; 
	}
    ?>
    </select>
    <input name="selectteam" type="submit" value="Submit" />
    </form><br />
    <table width="441" border="1" style="background-color: white">
      <tr>
    <th width="105" scope="col">Name</th>
    <th width="105" scope="col">Team name</th>
    <th width="105" scope="col">Createddate</th>  
    
      <th width="87" scope="col">Action</th>
  </tr>
  <?php
		if(isset($_POST['selectteam']))
		{
		$qres = mysqli_query($cnn, "select players.*,teams.* from players INNER JOIN teams ON teams.teamid=players.teamid where teams.teamid='$_POST[teamid]' and players.teamid!='0' ");
		}
		else
		{
		$qres = mysqli_query($cnn, "select players.*,teams.* from players INNER JOIN teams ON teams.teamid=players.teamid  and players.teamid!='0' ");
		}
	
	while($arrrec = mysqli_fetch_array($qres))
	{
	echo "<td>&nbsp;";
	echo "<tr>";
	echo "</td>";
	echo "<td>&nbsp;$arrrec[name]</td>";
   	echo "<td>$arrrec[teamname]</td>"; 
	echo "<td>&nbsp;$arrrec[createddate]</td>";
	echo "<td>&nbsp; <a href='players.php?editid=$arrrec[playerid]'>Edit</a> | 
	<a href='viewplayer.php?deleteid=$arrrec[playerid]'>Delete</a> </td>";
	echo "</tr>";
	}
  ?>
</table>
</div>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<?php
include("footer.php");
?>