<?php
if(!isset($_SESSION))
{
    session_start();
}
require_once "db.php";
global $conn;
$county_id = $_POST["county_id"];
$result = mysqli_query($conn,"SELECT * FROM constituencies where county_id ='$county_id'") or die(mysqli_error($conn));

?>
    <option value="">Select Constituency</option>
<?php
while($row = mysqli_fetch_array($result)) {
    ?>
    <option value="<?php echo $row["id"];?>"><?php echo $row["name"];?></option>
    <?php
}
?>

