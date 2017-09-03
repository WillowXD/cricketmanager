<?php
include("dbconnection.php"); 
include("header.php");
?>
<div class="wrapper row3" style="background-color: grey">  
    <div id="container" style="background-color: grey">

        <h1 style="color: orange">Give Suggestions here ...</h1>
<?php


	if(isset($_POST['submit']))
	{
		$insscrapbook = "INSERT INTO scrapbook (name ,posttype ,message ,status ,sdatetime)VALUES ('$_POST[author]',  '$pagename',  '$_POST[message]',  'Enabled',  '$dttim')";
		if(!mysqli_query($cnn,$insscrapbook))
		{
			echo mysqli_error($cnn);
		?>
		<script type="application/javascript" language="javascript">
		alert("Problem in connection...");
		</script>
		<?php
		}
		else
		{
		?>
		<script type="application/javascript" language="javascript">
		alert("Comment published successfully...");
		</script>
		<?php
		}
	}

$_SESSION['setcmtid'] = rand();
?>
        <form class="rnd5" action="" method="post" style="background-color: grey;color : orange">
        <input type="hidden" name="setcmtid" value="<?php echo $_SESSION[setcmtid]; ?>" />
          <div class="form-input clear">
            <label class="one_third first" for="author"><h2>Name</h2>
              <input type="text" name="author" id="author" value="" size="22">
            </label>
          </div>
          <br><br>
          <div class="form-message">
            <label class="one_third first" for="author"><h2>Suggestions</h2>

            <textarea name="message" id="message" cols="25" rows="3"></textarea>
            </label>
          </div>
          <div>
            <input type="submit" value="Submit" name="submit">
            &nbsp;
            <input type="reset" value="Reset">
          </div>
        </form>
      </div>
      <br><br><br><br><br><br><br>
<!-- Scrap book post form ends here -->   
   
<!--Scrap book View code starts here  -->   
<?php
$selectquery = mysqli_query($cnn, "SELECT * FROM  scrapbook ORDER BY sbid DESC ");
while($rsarray = mysqli_fetch_array($selectquery))
{
?>
      <div class="alert-msg info" style="background-color: white">
      <a href='#' ><?php echo $rsarray['name']; ?></a> <a href='#' style='float: right;vertical-align:top' >Published date: <?php echo $rsarray['sdatetime']; ?> </a>
	  <hr>
      <?php echo $rsarray['message']; ?>
      </div>
	  
<?php	  
}
?>	  
</div>
<?php
include("footer.php")
?>