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
			echo $newdate . "</p><br>";
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
</body>
</html>

<script type='text/javascript'>
  // Let's check if the browser supports notifications
  if (!("Notification" in window)) {
    alert("This browser does not support desktop notification");
  }

  // Let's check whether notification permissions have already been granted
  else if (Notification.permission === "granted") {
    // If it's okay let's create a notification
    var notification = new Notification("Points updated since last check");
  }

  // Otherwise, we need to ask the user for permission
  else if (Notification.permission !== 'denied') {
    Notification.requestPermission(function (permission) {
      // If the user accepts, let's create a notification
      if (permission === "granted") {
        var notification = new Notification("Points updated since last check");
      }
    });
  }
</script>"


<?php include 'inc/js.php';?>

