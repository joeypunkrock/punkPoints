<!-- todo - (Fix page refresh notification) -->

<?php 
include 'inc/documentHead.php';
include 'inc/config.php';
include 'inc/functions.php';
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

<title>Punk Points Dashboard</title>
</head>

<?php tyrone(); ?>

<div id='spinnerHolder'>
    <div class='spinner'>
      <div class='double-bounce1'></div>
      <div class='double-bounce2'></div>
    </div>
</div>

<div id="contentHolder" style="display:none;">

<h1 class="noMargin">Punk Points</h1>

<?php
if (isset($_POST['sortDate']))
{
  $result = $mysqli->query("SELECT * FROM points ORDER BY updateDate DESC");
  $currentSort = "Sorted by latest update";
} 
else if (isset($_POST['sortPoints']))
{
  $result = $mysqli->query("SELECT * FROM points ORDER BY currPoints DESC");
  $currentSort = "Sorted by most Punk Points";
}else
{
  $result = $mysqli->query("SELECT * FROM points ORDER BY updateDate DESC");
  $currentSort = "Sorted by latest update";
}

?><p class="fade tiny noMargin"><?php echo $currentSort; ?></p><?php
?>

<div id="sticker">
  <hr>

  <form class="sortSelector" name="sortSelector" action="" method="post">
    <input type="submit" name="sortDate" value="Sort by latest">
    <input type="submit" name="sortPoints" value="Sort by points">
    <a class="aInput" href="ranks.php">Ranks</a>
  </form>

  <hr style="margin-bottom:0;">

</div>

<?php

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
      // if ($row->nickname!=''){
      //   echo "<p class='nickname'>( " . $row->nickname . " )</p><hr class='small-hr'><p class='fade small noMargin'><span class='green'>+ ";
      // }else {
        echo "<p class='fade small noMargin'><span class='green'>+ ";
      // }
      echo $row->addPoints . "</span> / <span class='red'>- ";
      echo $row->remPoints . "</span></p><p class='fade noMargin'>";
      echo $row->reason . "</p><p class='fade small date'>";
      $newdate = date( 'F j, Y, g:i a', strtotime($row->updateDate));
      echo $newdate . "</p>";
      echo "<a class='editButton' href='addPoints.php?id=" . $row->id . "'><b>Add</b> Punk Points</a>";
      echo "<a class='editButton' href='remPoints.php?id=" . $row->id . "'><b>Remove</b> Punk Points</a><br><br>";
      // echo "<a class='editButton' href='updateNick.php?id=" . $row->id . "'>Edit Nickname</a><br><br>";
      echo "<hr class='row'>";

      echo "</td></tr></table>";

    }

    echo "<br><a href='newPunk.php' class='editButton'>Add New Punk</a>";

  }

  else
  {
    echo "No results to display!";
  }


// close database connection
$mysqli->close();


?>

<?php include 'inc/footer.php'; ?>

<style>
  table:nth-child(odd) {
    background-color: #090909!important;
  }
  table:nth-child(even) {
      background-color: #000!important;
  }
</style>


