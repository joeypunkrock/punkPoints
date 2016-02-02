<?php

include 'config.php';

function listBlocks()
{

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
			echo "<h2 class='marginDown'>" . $row->name . "  ";
			echo $row->currPoints . "</h2>";
			if ($row->nickname!=''){
				echo "<p class='nickname'>( " . $row->nickname . " )</p><hr class='small-hr'>";
			}
			echo "<p class='fade small noMargin'><span class='green'>+ " . $row->addPoints . "</span> / ";
			echo "<span class='red'>- " . $row->remPoints . "</span></p>";
			echo "<p class='fade noMargin'>" . $row->reason . "</p>";
			$newdate = date( 'F j, Y, g:i a', strtotime($row->updateDate));
			echo "<p class='fade small date'>" .  $newdate . "</p>";
			echo "<a class='editButton' href='update.php?id=" . $row->id . "'>Edit Punk Points</a>";
			echo "<a class='editButton' href='updateNick.php?id=" . $row->id . "'>Edit Nickname</a>";
			echo "<br><br><hr class='row'>";
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

}
?>