<?php
session_start(); 
include("dbconnection.php");
$dt = date("Y-m-d");
if (isset($_POST['submit']) and $_POST['teamname']!="")
	{$insres = mysqli_query($cnn, "INSERT INTO teams (teamname,createddate) values ('$_POST[teamname]','$dt')");
	$_POST['teamname']="";
	if(!$insres)
	{
		echo "string";
		exit(0);
		$qresult =   "Failed to insert record";
	}
	else
	{
		$qresult =  "Record inserted successfully..";
	}	}

$_SESSION["setvar"] = rand();
?>
<?php
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
<h2 style="color: orange">Team</h2>    
<form method="post" action="" enctype="multipart/form-data">
<input type="hidden" name="setvar" value="<?php echo $_SESSION[setvar]; ?>">
<table  height=100 style="color: white">
<tr>
	<th>TEAM NAME</th><th><input type=text name=teamname></th>
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
</div>
<?php
include("footer.php");
?>
<script language="javascript" type="application/javascript">
function validation()
{
	if(form1.teamname.value == "" )
	{
		alert("Team name should not be empty..");
		form1.teamname.focus();
		return false;
	}
	else if(form1.teamname.value.length < 3 )
	{
		alert("Minimum length should be more than 3 characters..");
		form1.teamname.focus();
		return false;
	}
	else if(isNaN(form1.teamname.value) != true)
	{
		alert("Please enter alphabets in Team name..");
		form1.teamname.focus();
		return false;
	}
	if ( ( form1.status[0].checked == false ) && ( form1.status[1].checked == false ) ) 
	{
		alert("Please slect status..");

		return false;
	}
	else
	{
		return true;
	}
}
</script>