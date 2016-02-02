<!-- todo - (Fix page refresh notification) -->

<?php 
include 'inc/documentHead.php';
include 'inc/config.php';
?>

<script>
$( document ).ready(function() {
  $('#spinnerHolder').show().delay( 500 ).fadeOut( 200 );
  $('#contentHolder').hide().delay( 650 ).fadeIn( 500 );
	setTimeout(
  		function() 
  		{
    		$("#sticker").sticky({topSpacing:-10});
     	}, 1260);
});
</script>

<title>Punk List</title>
</head>

<div id='spinnerHolder'>
    <div class='spinner'>
      <div class='double-bounce1'></div>
      <div class='double-bounce2'></div>
    </div>
</div>

<div id="contentHolder" style="display:none;">

<h1 id="top">Punk Ranks</h1>

<div id="sticker">
	<hr>
	<a class="aInput" href="index.php">Back To List View</a>
	<hr style="margin-bottom:0;">
</div>

<?php

$result = $mysqli->query("SELECT * FROM points ORDER BY currPoints DESC");

	// display records if there are records to display
	if ($result->num_rows > 0)
	{

		while ($row = $result->fetch_object())
		{
			// set up a row for each record

			$currPoints = $row->currPoints;

			echo "<table><tr><td>";
			echo "<h2>";

			echo $row->name . " ";

			if ($currPoints > 0) {
				echo "<span class='green'>";
			}else if ($currPoints < 0) {
				echo "<span class='red'>";
			}

			echo $currPoints;
			echo "</span></h2>";
			echo "</td></tr></table>";

		}

		echo "<a href='newPunk.php'>Add New</a>";

	}

	else
	{
		echo "<p>No results to display!</p>";
	}

// close database connection
$mysqli->close();

?>

<p style="color:#646464;font-size:14px;">Sponsored by <b>Buckfast</b>. Brewed by Monks, drunk by <b>Punks</b>!</p>
<img class="gg" src="img/gg.png">

</div> <!--/contentHolder-->

</body>
</html>

