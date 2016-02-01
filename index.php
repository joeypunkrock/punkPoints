<!-- todo - (Fix page refresh notification) -->

<?php 
include 'inc/documentHead.php';
include 'inc/config.php';
?>

<script>
$( document ).ready(function() {
	$('#spinnerHolder').show().delay( 1000 ).fadeOut( 300 );
	$('#contentHolder').hide().delay( 1250 ).fadeIn( 700 );
	setTimeout(
  		function() 
  		{
    		$("#sticker").sticky({topSpacing:-10});
     	}, 1260);
});
</script>

<title>Punk Points Dashboard</title>
</head>

<div id='spinnerHolder'>
    <p class='small'>Loading Punks...</b></p>
    <div class='spinner'>
      <div class='double-bounce1'></div>
      <div class='double-bounce2'></div>
    </div>
</div>

<div id="contentHolder" style="display:none;">

<h1 id="top">Punk Points</h1>

<div id="sticker">
<hr>

<form class="sortSelector" name="sortSelector" action="" method="post">
	<input type="submit" name="sortDate" value="Sort by latest">
	<input type="submit" name="sortPoints" value="Sort by points">
</form>



<?php

$result = $mysqli->query("SELECT * FROM points ORDER BY updateDate DESC");
$currentSort = "Sorted by latest update";

if (isset($_POST['sortDate']))
{
	$result = $mysqli->query("SELECT * FROM points ORDER BY updateDate DESC");
	$currentSort = "Sorted by latest update";
} 
else if (isset($_POST['sortPoints']))
{
	$result = $mysqli->query("SELECT * FROM points ORDER BY currPoints DESC");
	$currentSort = "Sorted by most Punk Points";
}

?><p class="fade tiny noMargin" style="margin-top:10px;"><?php echo $currentSort; ?></p><hr style="margin-bottom:0;"></div><?php

	// display records if there are records to display
	if ($result->num_rows > 0)
	{

		while ($row = $result->fetch_object())
		{
			echo "<table><tr><td>";
			// set up a row for each record
			// echo $row->id . "<br><br>";
			echo "<h2 class='marginDown'>" . $row->name . "  ";
			echo $row->currPoints . "</h2>";
			if ($row->nickname!=''){
				echo "<p class='nickname'>( " . $row->nickname . " )</p><hr class='small-hr'><p class='fade small noMargin'><span class='green'>+ ";
			}else {
				echo "<p class='fade small noMargin'><span class='green'>+ ";
			}
			echo $row->addPoints . "</span> / <span class='red'>- ";
			echo $row->remPoints . "</span></p><p class='fade noMargin'>";
			echo $row->reason . "</p><p class='fade small date'>";
			$newdate = date( 'F j, Y, g:i a', strtotime($row->updateDate));
			echo $newdate . "</p>";
			echo "<a class='editButton' href='update.php?id=" . $row->id . "'>Edit Punk Points</a>";
			echo "<a class='editButton' href='updateNick.php?id=" . $row->id . "'>Edit Nickname</a><br><br>";
			echo "<hr class='row'>";

			echo "</td></tr></table>";

		}

		echo "<a href='newPunk.php'>Add New</a>";

	}

	else
	{
		echo "No results to display!";
	}


// close database connection
$mysqli->close();


?>

<p style="color:#646464;font-size:14px;">Sponsored by <b>Buckfast</b>. Brewed by Monks, drunk by <b>Punks</b>!</p>
<img class="gg" src="img/gg.png">

</div> <!--/contentHolder-->

</body>
</html>

<script type='text/javascript'>
	// window.onload = window.location.hash = 'top';
</script>"

