<?php
session_start(); 
include("dbconnection.php");
include("header.php");

if(!isset($rsarray))
{
	$rsarray['name']="";

}?>
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
<form method="post" action="" enctype="multipart/form-data">
<input type="hidden" name="setvar" value="<?php echo $_SESSION[setvar]; ?>">
<input type="hidden" name="cupid" value="<?php echo $rsarray[cupid]; ?>">
<table style="border-color: orange">
<?php
$sql=mysqli_fetch_assoc(mysqli_query($cnn,"SELECT teamname from teams where teamid=$_GET[tournamentid]"));
$qresult="Add Team";
$qresulti=1;?>
<tr>
	  <th height="32" style="background-color: grey" colspan="2">&nbsp;<h6>&nbsp;<?php echo "<font color='orange'>Add Team</font>"; ?><br><?php echo $sql['tournamentid']?>

    </tr>
<tr>
	<th height="32" style="background-color: grey">&nbsp;&nbsp;<?php echo "<font color='white'>Team</font>"; ?></th>
    
	<th>

		<select name=type style="background-color: orange;color: white"
			 <?php
			 	$arradtype = array("Select","League","Knock out");
			foreach($arradtype as $value)
			{
				if($value == $rsarray[type])
				{
				echo "<option value='$value' selected>$value</option>";
				}
				else
				{
				echo "<option value='$value'>$value</option>";
				}
			}
			?>
			>
		</select>

</th>
</tr>
</table>
</form>
  </div>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
  <br>
</div>
<div style="background-color: grey;color: orange"><b>________________________________________________________________________________________________________________________________________________________________________________________________<br>________________________________________________________________________________________________________________________________________________________________________________________________<br>________________________________________________________________________________________________________________________________________________________________________________________________</b><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></div>
    <!-- ################################################################################################ -->
  
 <?php
 if (!isset($rsarray))
 {
 	$rsarray['name']="";
 	$rsarray['noofteams']="";
 	$rsarray['startdate']="";
 	$rsarray['enddate']="";
 	$rsarray['overs']="";
 	$rsarray['status']="";
 }
 ?>
 
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<?php
if($_SESSION['setvar'] != $_POST['setvar'])
{
	if(isset($_POST['submit']))
	{
		
		if(isset($_GET['editid']))
		{

			
			$insres = mysqli_query($cnn,"UPDATE tournaments SET type='$_POST[type]',name='$_POST[name]',noofteams='$_POST[noofteams]',year='$_POST[year]',startdate='$_POST[startdate]',enddate='$_POST[enddate]',overs='$_POST[overs]',status='$_POST[status]' where tournamentid='$_GET[editid]'");
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
		
		$insres = mysqli_query($cnn, "INSERT INTO tournaments (type,name,noofteams,startdate,enddate,overs,status) values ('$_POST[type]','$_POST[name]','$_POST[noofteams]','$_POST[startdate]','$_POST[enddate]','$_POST[overs]','$_POST[status]')");
		
			if(!$insres)
			{
			$qresulti =  1;
			$qresult =   "Failed to insert record". mysqli_error($cnn);
			}
			else
			{
			$qresulti =  1;
			$qresult =  "Record inserted successfully..";
			}
	}
}
}

$selectquery = mysqli_query($cnn, "SELECT * FROM tournaments where tournamentid='$_GET[editid]'");
$rsarray = mysqli_fetch_array($selectquery);


if(!isset($_SESSION['userid']))
{
	header("Location: login.php");
}

include("footer.php");
?>