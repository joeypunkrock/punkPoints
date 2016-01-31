<?php
/*
Allows the user to both create new records and edit existing records
*/

include 'inc/documentHead.php';
include 'inc/config.php';

// creates the new/edit record form
// since this form is used multiple times in this file, I have made it a function that is easily reusable
function renderForm($name = '', $error = '', $id = '')
{ ?>

<title>
<?php if ($id != '') { echo "Edit Punk"; } else { echo "New Punk"; } ?>
</title>

<a href="index.php">Go Back</a>

<h1><?php if ($id != '') { echo "Edit Punk"; } else { echo "New Punk"; } ?></h1>
<?php if ($error != '') {
echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error
. "</div>";
} ?>

<form name="insertForm" action="" method="post">
<?php if ($id != '') { ?>
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<p>ID: <?php echo $id; ?></p>
<?php } ?>
	<input type="text" name="name" placeholder="Name">
	<input type="submit" name="submit" value="Add">
</form>


</body>
</html>

<script>
$(function() {
    $('form[name="insertForm"]').submit(function(e) {
        var reason = $('form[name="insertForm"] input[name="name"]').val();
        if ( reason == '') {
            e.preventDefault();
            window.alert('G.G. Says: "Enter a name, fool!"')
        }
    });
});
</script>

<?php }

/*

NEW RECORD

*/
// if the form's submit button is clicked, we need to process the form
if (isset($_POST['submit']))
{
// get the form data
$name = htmlentities($_POST['name'], ENT_QUOTES);

// insert the new record into the database
if ($stmt = $mysqli->prepare("INSERT points (name) VALUES (?)"))
{
	$stmt->bind_param("s", $name);
	$stmt->execute();
	$stmt->close();
}
// show an error if the query has an error
else
{
	echo "ERROR: Could not prepare SQL statement.";
}

// redirec the user
header("Location: index.php");


}
// if the form hasn't been submitted yet, show the form
else
{
	renderForm();
}


// close the mysqli connection
$mysqli->close();
?>