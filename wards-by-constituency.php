<?php
if(!isset($_SESSION))
{
    session_start();
}
require_once "db.php";
global $conn;
$ward = mysqli_real_escape_string($conn, $_SESSION['ward']);
$constituency_id = $_POST["constituency_id"];
$result = mysqli_query($conn,"SELECT * FROM wards where constituency_id = '$constituency_id'") or die(mysqli_error($conn));

?>
    <option value="">Select Ward</option>
<?php
while($row = mysqli_fetch_array($result)) {

    $constituency=$row['name'];
    echo $constituency;

    ?>
    <option value="<?php echo $row["id"];?>"><?php echo $row["name"];?></option>
    <?php
}
?>



