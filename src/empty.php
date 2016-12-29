<?php include("Database2.php"); ?>
<?php
    $d =  new Database2();
    $name = "Bekir Bozdağ";
    $birth_date = "19540606";
    $desc = "Very tal guy.";
    $email = "gökçek@gmail.com";
    $nickname = "recep123";
    $country = "TR";
    $username = "denemelan";
    $password = "123";
    //$d->register($name, $birth_date, $desc, $email, $nickname, $country,$username,$password);
    //$d->search("1", False);
    $d->showUserFriends(1, 'tugrul');

/*$sql = "INSERT INTO Group(name,admin_id) VALUES ('RTS Lovers',1)";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully\n";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$sql = "INSERT INTO Group(name,admin_id) VALUES ('Cool Bois',2)";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully\n";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$sql = "INSERT INTO Review(score,comment,likes,dislikes)
VALUES (5,'Good',5,3)";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully\n";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();*/
?>