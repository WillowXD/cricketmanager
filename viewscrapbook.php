<?php
include("dbconnection.php");
if(isset($_GET["deleteid"]))
{
	$delres = mysqli_query($cnn, "DELETE FROM scrapbook where sbid='$_GET[deleteid]'");
	if(!$delres)
			{				
				$resdel = "You cant delete this records..";
			}
			else
			{
				$resdel =  "Record deleted successfully..";
			}
}

session_start(); 
include("header.php");

?>
<?php if(isset($_GET["deleteid"]))
{
	$delres = mysqli_query($cnn, "DELETE FROM scrapbook where sbid='$_GET[deleteid]'");
	if(!$delres)
			{				
				$resdel = "You cant delete this records..";
			}
			else
			{
				$resdel =  "Record deleted successfully..";
			}
}?>
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
    <table width="441" border="1" style="background-color: white">
      	<tr style="background: white">
    	<th width="105" scope="col">Name</th>
    	<th width="105" scope="col">Message</th>
    	<th width="105" scope="col">Date</th>
      	<th width="87" scope="col">Action</th>
  		</tr>
  <?php
	$qres = mysqli_query($cnn, "SELECT * FROM  scrapbook ");
	
	while($arrrec = mysqli_fetch_array($qres))
	{
	echo "<tr>";
   	echo "<td>$arrrec[name]</td>"; 
	echo "<td>&nbsp;$arrrec[message]</td>";
	echo "<td>&nbsp;$arrrec[sdatetime]</td>";	
    echo "<td>&nbsp;<a href='viewscrapbook.php?deleteid=$arrrec[sbid]'>Delete</a> </td>";
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