<?php
var_dump($_POST);
?>
<form action="fork.php" method="post">
    <input type="checkbox" name="vehicle" value="Bike" <?php echo isset($_POST['vehicle']) ? ($_POST['vehicle']== "Bike" ? 'checked="checked"' : '') : ''?>> I have a bike<br>
    <input type="checkbox" name="vehicle" value="Car" <?php echo isset($_POST['vehicle']) ? ($_POST['vehicle']== "Car" ? 'checked="checked"' : '') : ''?>> I have a car<br>
    <input type="submit" value="Submit">
</form>