<?php 
include 'inc/documentHead.php';
include 'inc/config.php';
?>

<title>Punk Points Dashboard</title>
</head>
<h1 id="top">Punk Points</h1>
<hr>

<?php

// get the records from the database
if ($result = $mysqli->query("SELECT * FROM points ORDER BY updateDate DESC"))
{
	// display records if there are records to display
	if ($result->num_rows > 0)
	{

		while ($row = $result->fetch_object())
		{

			// set up a row for each record
			// echo $row->id . "<br><br>";
			echo "<h2 class='noMarginDown'>" . $row->name . " / ";
			echo $row->currPoints . "</h2><p class='fade small noMargin'><span class='green'>+ ";
			echo $row->addPoints . "</span> / <span class='red'>- ";
			echo $row->remPoints . "</span></p><p class='fade noMargin'>";
			echo $row->reason . "</p><p class='fade small date'>";
			$newdate = date( 'F j, Y, g:i a', strtotime($row->updateDate));
			echo $newdate . "</p>";
			echo "<a class='editButton' href='update.php?id=" . $row->id . "'>Edit Punk Points</a><br><br>";
			echo "<hr>";

		}

		echo "<a href='newPunk.php'>Add New</a>";

	}

	else
	{
		echo "No results to display!";
	}
}
// show an error if there is an issue with the database query
else
{
	echo "Error: " . $mysqli->error;
}

// close database connection
$mysqli->close();


?>

<p style="color:#646464;font-size:14px;">Sponsored by <b>Buckfast</b>. Brewed by Monks, drunk by <b>Punks</b>!</p>
<img class="gg" src="img/gg.png">
</body>
</html>

<script type='text/javascript'>
	// window.onload = window.location.hash = 'top';
</script>"

