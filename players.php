<?php
session_start(); 
include("dbconnection.php");
?>

<?php
if(!isset($_SESSION['userid']))
{
	header("Location: login.php");
}

$dt = date("Y-m-d");
if(isset($_POST['submit']))
{

	if(isset($_GET['editid']))
		{

$insres = mysqli_query($cnn,"UPDATE players SET teamid='$_POST[teamid]',name='$_POST[name]',playingrole='$_POST[playingrole]',battingstyle='$_POST[battingstyle]',bowlingstyle='$_POST[bowlingstyle]' where playerid='$_GET[editid]'");
			if(mysqli_affected_rows($cnn) == 1)
			{
				$qresulti =  1;
				$qresult =  "Record updated successfully..";
			}
			else
			{
				$qresulti =  1;
				$qresult =  "No records found to update";	
			}
		}
		else
		{
	$insres = mysqli_query($cnn, "INSERT INTO players (teamid,name,playingrole,battingstyle,bowlingstyle,createddate) values
 ('$_POST[teamid]','$_POST[name]','$_POST[playingrole]', '$_POST[battingstyle]','$_POST[bowlingstyle]','$dt')");
	
			if(!$insres)
		{
			$qresulti =  1;
			$qresult =   "Failed to insert record";
		}
		else
		{
			$qresulti =  1;
			$qresult =  "Record inserted successfully..";
		}
	
	}
	}

else
{
	$qresult="ADD PLAYERS";
}
$_SESSION["setvar"] = rand();

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
    <div id="portfolio" class="three_quarter" style="background-color: grey;color: white">
<form name="form1" method="post" action="" enctype="multipart/form-data">
<input type="hidden" name="setvar" value="<?php echo $_SESSION[setvar]; ?>">
<table border=9 height=550 width=550>
<font style="color: grey">
<?php

$selectquery = mysqli_query($cnn, "SELECT * FROM players where playerid='$_GET[editid]'");
$rsplarray = mysqli_fetch_array($selectquery);
?>
</font>
<?php
$qresulti=1;
if($qresulti == 1 )
{
	echo "<tr><td colspan='2'>$qresult</td></tr>";
}
?>
<tr>
	<th>
		TEAM NAME
	</th>
	<th>
<select name="teamid">
<option value="">Select</option>
<?php
$sqlteams = "SELECT * FROM teams";
$sqlquery  = mysqli_query($cnn,$sqlteams);
while($rsres = mysqli_fetch_array($sqlquery))
{
	if($rsres[teamid]== $rsplarray["teamid"])
	{
	echo "<option value='$rsres[teamid]' selected>$rsres[teamname]</option>";
	}
	else
	{
	echo "<option value='$rsres[teamid]'>$rsres[teamname]</option>";
	}
}
?>
</select>
	</th>
</tr>
<tr>
	<th>
		Player Name
	</th>
	<th>
		<input type=text name=name value="<?php echo $rsplarray['name']; ?>">
	</th>
</tr>
<tr>
	<th>
		Playing Role
	</th>
	<th>
    <?php
	$arr = array("Batsman","Bowler","Wicket Keeper Batsman","Allrounder");
	foreach($arr as $value)
	{
		if($value == $rsplarray['playingrole'])
		{
		echo "$value <input type=radio name='playingrole' value='$value' checked><hr>";
		}
		else
		{
		echo "$value <input type=radio name='playingrole' value='$value'><hr>";
		}
	}
	?>
	</th>
</tr>
<tr>
	<th>
		BATTING STYLE
	</th>
	<th>
    <select name="battingstyle">
            	<option value=""></option>

	<?php
	$arr = array("Right-hand bat","Left-hand bat");
	foreach($arr as $value)
	{
		if($value == $rsplarray['battingstyle'])
		{
		echo "<option value='$value' selected>$value</option>";
		}
		else
		{
		echo "<option value='$value'>$value</option>";
		}
	}
	?>
</select>	
	</th>
</tr>
<tr>
	<th>
		BOWLING&nbsp;STYLE
	</th>
	<th>
			<select name=bowlingstyle>
			<option value=""></option>

   <?php
	$arr = array("RIGHT-Arm Fast","LEFT-Arm Fast","RIGHT-Arm MEDIUM Fast","LEFT-Arm MEDIUM Fast","RIGHT-Arm OFF Spin","LEFT-Arm OFF Spin","RIGHT-Arm LEG break","LEFT-Arm LEG break");
	foreach($arr as $value)
	{
		if($value == $rsplarray['bowlingstyle'])
		{
		echo "<option value='$value' selected>$value</option>";
		}
		else
		{
		echo "<option value='$value'>$value</option>";
		}
	}
	?>
			</select>
		
	</th>
</tr>

<tr>
	<th>
		<input style="background-color: grey;color: white" type=submit name="submit" value=SUBMIT>
		<input style="background-color: grey;color: white" type="reset" name="reset">
	</th>
</tr>
</table>
</form>
  </div>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<?php
include("footer.php");
?>