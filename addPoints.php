<?php
/*
Allows the user to edit existing records
*/

include 'inc/documentHead.php';
include 'inc/config.php';

?>

<?php
// creates the form
function renderForm($name = '', $nickname = '', $currPoints = '', $addPoints = '', $remPoints = '', $reason = '', $updateDate = '', $error = '', $id = '')
{ ?>

<title>
<?php if ($id != '') { echo "Add Punk Points"; } ?>
</title>

<div id="formHolder">

<h2><?php if ($id != '') { echo "Add Punk points"; } ?></h2>
<?php if ($error != '') {
echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error
. "</div>";
} ?>

<p class="marginUp">For <?php echo $name; ?>  <?php echo $currPoints; ?></p><br>
<form class="updateForm" id="form" name="pointsForm" action="" method="post">
    <?php if ($id != '') { ?>
    <input type="hidden" name="id" value="<?php echo $id; ?>" />

    <?php } ?>
	<input type="number" name="addPoints" placeholder="Amount">
	<input type="text" name="reason" placeholder="Reason">
	<input type="submit" name="submit" value="Add Punk Points">
</form>
</div>

<a id="backBut" class="editButton" href="index.php">Go Back</a>

<script>
$(function() {
    $('form[name="pointsForm"]').submit(function(e) {
        var reason = $('form[name="pointsForm"] input[name="reason"]').val();
        if ( reason == '') {
            e.preventDefault();
            window.alert('G.G. Says: "Enter a reason, fool!"')
        }
    });
});
</script>

<?php
}

/* GET THE FORM */

// make sure the 'id' value is valid
if (is_numeric($_GET['id']) && $_GET['id'] > 0)
{
    // get 'id' from URL
    $id = $_GET['id'];

    // get the record from the database
    if($stmt = $mysqli->prepare("SELECT * FROM points WHERE id=?"))
    {
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $stmt->bind_result($id, $name, $nickname, $currPoints, $addPoints, $remPoints, $reason, $updateDate);
    $stmt->fetch();

    // show the form
    renderForm($name, $nickname, $currPoints, $addPoints, $remPoints, $reason, $updateDate, NULL, $id);

    }
    // show an error if the query has an error
    else
    {
        echo "<p class='error'>Error: could not prepare SQL statement</p>";
    }
}
// if the 'id' value is not valid, redirect the user back to the view.php page
else
{
    echo "<p class='error'>Error: id value not valid</p>";
    // header("Location: index.php");
}


/* EDIT RECORD */

if (!isset($_GET['id']) || !isset($_POST['submit']))
{
 	// echo "<p class='error'>No Data!</p>";
    return;
}

if (!is_numeric($_POST['id']))
{
	header("Location: index.php");
    return;
}

if (isset($_POST['submit']))
{

// get variables from the URL/form
$id = $_POST['id'];
$addPoints = htmlentities($_POST['addPoints'], ENT_QUOTES);

// if addPoints or remPoints is larger than 5000 or -5000 then set to 5000 or -5000
if ($addPoints>1000) {
    $addPoints=1000;
}

$reason = htmlentities($_POST['reason'], ENT_QUOTES);
$updateDate = date("Y-m-d H:i:s");

//Check what the current points are first
// make sure the 'id' value is valid also
if (is_numeric($_GET['id']) && $_GET['id'] > 0)
{
    // get 'id' from URL
    $id = $_GET['id'];

    // get the record from the database
    if($stmt = $mysqli->prepare("SELECT currPoints FROM points WHERE id=?"))
    {
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $stmt->bind_result($id, $currPoints);
        $stmt->fetch();

        $stmt->close();
    }
}
else {
    echo "<p class='error'>Error: could not prepare SQL statement for currPoints</p>";
}

//Now update currPoints
 $currPoints += $addPoints;
 $remPoints = 0;

// if everything is fine, update the record in the database
if ($stmt = $mysqli->prepare("UPDATE points SET currPoints = ? , addPoints = ?, remPoints = ?, reason = ?, updateDate = ?
WHERE id=?"))
{
    $stmt->bind_param("iiissi", $currPoints, $addPoints, $remPoints, $reason, $updateDate, $id);
    $stmt->execute();
    $stmt->close();
}
else {
    echo "<p class='error'>ERROR: could not prepare SQL statement.</p>";
}

// commence loading animation and redirect to index
header('Refresh: 3;URL=index.php');
echo "

<div id='spinnerHolder' style='display:none'>
    <p class='small'>Adding Punk Points for ";echo $name; echo"...</b></p>
    <div class='spinner'>
      <div class='double-bounce1'></div>
      <div class='double-bounce2'></div>
    </div>
</div>

<script type='text/javascript'>
    $('#formHolder').show().fadeOut( 500 );
    $('#backBut').show().fadeOut( 500 );
    $('#spinnerHolder').hide().fadeIn( 1000 );
</script>"
;

die();
}

?>

</body>
</html>