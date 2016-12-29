<?php
/**
 * Created by PhpStorm.
 * User: Cihan
 * Date: 12/29/2016
 * Time: 13:33
 */
class Database
{
    var $conn;
    function __construct()
    {
        $servername = "139.179.206.167:3306";//this is for my machine we can change it?
        $username = "Tcan";
        $password = "123123";
        $dbname = "CS353";
        // Create connection
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        else
            echo "Connected to database";
    }
    //Name,birthdate,desc,email,country,username our all strings, password is int.
    //Also do we need an username? It can be just email too. todo
    function register($name, $birtdate, $desc, $email, $nickname, $country,$username,$password)
    {
        $sql = "INSERT INTO USER(name, birth_date, description, email, nickname,country) 
                VALUES ('$name', '$birtdate', '$desc', '$email', '$nickname', '$country');";
        if ($this->conn->query($sql) === TRUE) {
            echo "New record created successfully\n";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
        $sql = "SELECT count(iduser) as count FROM USER GROUP BY iduser";
        $result = $this->conn->query($sql);
        $row = $result->num_rows;
        $sql = "INSERT INTO Login_system(username, password, idofUser) 
                VALUES ('$username', $password, $row )";
        if ($this->conn->query($sql) === TRUE) {
            echo "New record created successfully\n";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }
    function login($name, $birtdate, $desc, $email, $nickname, $country,$username,$password)
    {
        $sql = "INSERT INTO USER(name, birth_date, description, email, nickname,country) 
                VALUES ($name, $birtdate,$desc, $email, $nickname,$country)";
        if ($this->conn->query($sql) === TRUE) {
            echo "New record created successfully\n";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }
}
?>