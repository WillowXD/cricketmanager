<?php
session_start(); 
include("dbconnection.php");
include("header.php");

if(!isset($rsarray))
{
	$rsarray['name']="";
	$rsarray['type']="";
	$rsarray['cupid']="";
	$rsarray['noofteams']="";
	$rsarray['startdate']="";
	$rsarray['enddate']="";
	$rsarray['overs']="";
	$rsarray['status']="";
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

<table style="border-color: orange;" height=550 width=550>
<?php
$qresult="Create Tournament";
$qresulti=1;?>
<tr>
	  <th height="32" style="background-color: grey" colspan="2">&nbsp;<h6>&nbsp;<?php echo "<font color='orange'> Create Tournament</font>"; ?><br><?php echo "<font color='orange'>___________________________________________________________________</font>"; ?></h6></th>
    </tr>
?>
<tr>
	<th height="32" style="background-color: grey">&nbsp;&nbsp;<?php echo "<font color='white'>Tournament Type</font>"; ?></th>
    
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
<tr>

	<th height="32" style="background-color: grey"><br>&nbsp;&nbsp;<?php echo "<font color='white'>Tournament Name</font>"; ?></th>
	<th>
		<br><input style="background-color: orange;color: white"	 type=text name=name value="<?php echo $rsarray['name']; ?>">
	</th>
</tr>
<br>
<tr>
	<th height="32" style="background-color: grey"><br>&nbsp;&nbsp;<?php echo "<font color='white'>Maximum Number of Teams</font>"; ?></th>
	<th>
		<br><input style="background-color: orange;color: white" type=text name=noofteams value="<?php echo $rsarray['noofteams']; ?>">
	</th>
</tr>

<tr>
	<th height="32" style="background-color: grey"><br>&nbsp;&nbsp;<?php echo "<font color='white'>Tournament Start Date</font>"; ?></th>
	<th>
		<br><input style="background-color: orange;color: white" type="date" name="startdate" value="<?php echo $rsarray['startdate']; ?>">
		
	</th>
</tr>
<tr>
	<th height="32" style="background-color: grey"><br>&nbsp;&nbsp;<?php echo "<font color='white'>Tournament End Date</font>"; ?></th>
	<th>
		<br><input style="background-color: orange;color: white" type="date" name="enddate" value="<?php echo $rsarray['enddate']; ?>">
		
	</th>
</tr>
<tr>
	<th height="32" style="background-color: grey"><br>&nbsp;&nbsp;<?php echo "<font color='white'>Overs</font>"; ?></th>
	<th>
		<br><input style="background-color: orange;color: white" type=text name=overs value="<?php echo $rsarray['overs']; ?>">
		
	</th>
</tr>
<tr>
	<th height="32" style="background-color: grey"><br>&nbsp;&nbsp;<?php echo "<font color='white'>Status</font>"; ?></th>
	<th>
		<p align="center" style="color: white"><b>Active 
        <input style="background-color: orange;color: white" type=radio name=status value=Active
        <?php
        		if($rsarray['status']== "Active")
				{
				echo "checked";
				}
		?>
        >
		Inactive</b></p>
        <input type=radio name=status value=Inactive
        <?php
        		if($rsarray['status']== "Inactive")
				{
				echo "checked";
				}
		?>
        >
		
	</th>
</tr>
<tr>
	<th>
		<input type=submit name="submit" value=SUBMIT>
	</th>
	<th>
		<input type=RESET>
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