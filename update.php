<?php
/*
Allows the user to edit existing records
*/

include 'inc/documentHead.php';
include 'inc/config.php';

?>

<a href="index.php">Go Back</a>

<?php
// creates the form
function renderForm($name = '', $currPoints = '', $addPoints = '', $remPoints = '', $reason = '', $updateDate = '', $error = '', $id = '')
{ ?>

<title>
<?php if ($id != '') { echo "Edit Punk Points"; } else { echo "New Punk"; } ?>
</title>

<h2><?php if ($id != '') { echo "Edit Punk points"; } else { echo "New Punk"; } ?></h2>
<?php if ($error != '') {
echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error
. "</div>";
} ?>

<form name="pointsForm" action="" method="post">
<?php if ($id != '') { ?>
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<p>For <?php echo $name; ?> / <?php echo $currPoints; ?></p>
<?php } ?>
	<input type="number" name="addPoints" placeholder="Add Punk Points">
	<input type="number" name="remPoints" placeholder="Remove Punk Points">
	<input type="text" name="reason" placeholder="Reason">
	<input type="submit" name="submit" value="Update Punk Points">
</form>


</body>
</html>

<script>
$(function() {
    $('form[name="pointsForm"]').submit(function(e) {
        var reason = $('form[name="pointsForm"] input[name="reason"]').val();
        if ( reason == '') {
            e.preventDefault();
            window.alert("Enter a reason, fool!")
        }
    });
});
</script>


<?php
}

/*GET THE FORM*/

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

$stmt->bind_result($id, $name, $currPoints, $addPoints, $remPoints, $reason, $updateDate);
$stmt->fetch();

// show the form
renderForm($name, $currPoints, $addPoints, $remPoints, $reason, $updateDate, NULL, $id);


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


/*EDIT RECORD*/

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

date_default_timezone_set("Europe/London");

$script_tz = date_default_timezone_get();

// get variables from the URL/form
$id = $_POST['id'];
$addPoints = htmlentities($_POST['addPoints'], ENT_QUOTES);
$remPoints = htmlentities($_POST['remPoints'], ENT_QUOTES);
$reason = htmlentities($_POST['reason'], ENT_QUOTES);
$updateDate = date("Y-m-d H:i:s");

//Check what the current points are first
// make sure the 'id' value is valid also
if (is_numeric($_GET['id']) && $_GET['id'] > 0)
{
    // get 'id' from URL
    $id = $_GET['id'];

    // get the record from the database
    if($stmt = $mysqli->prepare("SELECT * FROM points WHERE id=?"))
    {
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $stmt->bind_result($id, $name, $currPoints, $addPoints, $remPoints, $reason, $updateDate);
        $stmt->fetch();

        // show the form
        renderForm($name, $currPoints, $addPoints, $remPoints, $reason, $updateDate, NULL, $id);

        $stmt->close();
    }
    else
        echo "<p class='error'>Error: could not prepare SQL statement</p>";
}

//Now update currPoints
$currPoints += $addPoints-$remPoints;


// if everything is fine, update the record in the database
if ($stmt = $mysqli->prepare("UPDATE points SET currPoints = ? , addPoints = ?, remPoints = ?, reason = ?, updateDate = ?
WHERE id=?"))
{
    $stmt->bind_param("iiisdi", $currPoints, $addPoints, $remPoints, $reason, $updateDate, $id);
    $stmt->execute();
    $stmt->close();
}
else
    echo "<p class='error'>ERROR: could not prepare SQL statement.</p>";

// redirect the user once the form is updated
header("Location: index.php");

}

?>

<?php include 'inc/footer.php'; ?>