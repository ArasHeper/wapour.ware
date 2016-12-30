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
        $servername = "localhost";//this is for my machine we can change it?
        $username = "root";
        $password = "123123";
        $dbname = "CS353";

        // Create connection
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        else
            echo "Connected to database\n";
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

    function login($username,$password)
    {

        $sql = "SELECT idofuser
                FROM login_system
                WHERE (username = '$username') AND (password = $password) ";

        $result = $this->conn->query($sql);
        //echo "result: " . $result->num_rows;
        $id=-1;
        if ($result->num_rows > 0) {
            echo "Logged in successfully\n";
            while($row = $result->fetch_assoc())
            {
               // echo  "q";
                $id =  $row["idofuser"];

            }

            return $id;
        } else {
            echo "No user";
            return -1;
        }
    }

    //returns array. 0 has genre, 1 has age, 2 has unit_sold, 3 has description, 4 has price, 5 has is mult
    function getGame($gamename)
    {
        $sql = "SELECT *
                FROM game
                WHERE name = '$gamename' ";

        $result = $this->conn->query($sql);
        //echo "result: " . $result->num_rows;

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc())
            {
                $genre = $row["genre"];
                $age = $row["age"];
                $unit_sold = $row["unit_sold"];
                $description = $row["description"];
                $price = $row["price"];
                $isMult = $row["ismultiplayer"];
            }
            $arr = array($genre,$age,$unit_sold,$description,$price,$isMult);
            echo "Game retrieved\n";
            return $arr;
        } else {
            echo "No such game";
            return -1;
        }
    }

    //username is owner of the credit card
    function createCreditCard($id,$number,$cvc,$expDate)
    {
        /*$sql = "SELECT *
                FROM user
                WHERE email = '$email' ";

        $result = $this->conn->query($sql);
        //echo "result: " . $result->num_rows;
        $id=-1;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc())
                $id = $row["idUser"];
            echo "id is: " . $id . "\n";
        }
        else
        {
            echo "User retrieval error";
            return false;
        }*/




        $sql = "INSERT INTO Credit_Card(number, cvc, exp) 
                VALUES ($number, $cvc, '$expDate');";

        if ($this->conn->query($sql) === TRUE) {
            echo "New Credit Card created successfully\n";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
            return false;
        }

        $sql = "INSERT INTO has(holder,card) 
                VALUES ($id, $number);";

        if ($this->conn->query($sql) === TRUE) {
            echo "Has relation created successfully\n";
            return true;
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
            return false;
        }

    }

}

?>