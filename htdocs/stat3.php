<!DOCTYPE html>
<html >
<body >
<?php 

require_once 'src/Database.php';
$database = new Database();
$result = $database->avgGameByUser();
echo "$result";
?>
</body >
</html >
