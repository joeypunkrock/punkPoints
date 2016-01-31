<?php 
include 'inc/documentHead.php';
include 'inc/config.php';
?>

<title>Punk Points Dashboard</title>
</head>
<img class="gg" src="img/gg.png">
<hr style="margin-top:-10px;">
<h1>Punk Points</h1>
<hr>

<?php

// get the records from the database
if ($result = $mysqli->query("SELECT * FROM points ORDER BY currPoints DESC"))
{
	// display records if there are records to display
	if ($result->num_rows > 0)
	{

		while ($row = $result->fetch_object())
		{
			// set up a row for each record
			// echo $row->id . "<br><br>";
			echo "<h2 class='noMarginDown'>" . $row->name . " / ";
			echo $row->currPoints . "</h2><p class='fade small noMargin'>+ ";
			echo $row->addPoints . " / - ";
			echo $row->remPoints . "</p><p class='fade noMargin'>";
			echo $row->reason . "</p><p class='fade small'>";
			echo /*$row->updateDate .*/ "</p><br>";
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

<?php include 'inc/footer.php';?>

