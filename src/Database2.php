<?php
/**
 * Created by PhpStorm.
 * User: Cihan
 * Date: 12/29/2016
 * Time: 13:33
 */
class Database2
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

    // NOT OWNED CAN BE TRUE FALSE
    function search($keyword, $userID) {
    	/*$sql = "WITH Belonging (idGame, gameName, genre, STATUS) as (SELECT idGame, Game.name AS gameName, genre, 'Owned' as STATUS
 				FROM Game INNER JOIN Owns INNER JOIN User
 				WHERE Game.idGame = Owns.OwnedGame and Owns.Owner = User.IDUser and '$userID' = User.IDUser) 
 				Select * from Belonging
 				UNION all
 				Select idGame, name AS gameName, genre, 'Not Owned' as STATUS FROM Game WHERE idGame not in (Select idGame from Belonging)";*/

 		$sql = "Select idGame, name AS gameName, genre, 'Not Owned' as STATUS FROM Game";

 		/*$sql =  "WITH Belonging (idGame, gameName, genre, STATUS) as (SELECT idGame, Game.name AS gameName, genre, 'Owned' as STATUS
 				FROM Game INNER JOIN Owns INNER JOIN User
 				WHERE Game.idGame = Owns.OwnedGame and Owns.Owner = User.IDUser and '$userID' = User.IDUser)";*/
				//WHERE userID = @userID AND @displayOwned = true";

        
        $result = $this->conn->query($sql);
        echo "result: " . $result->num_rows;

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
        		echo "\nid: " . $row["idGame"]. " - Name: " . $row["gameName"]. " " . $row["STATUS"]. "<br>";
    		}
            return 1;
        } else {
            echo "No user";
            return -1;
        }
    }

}
?>