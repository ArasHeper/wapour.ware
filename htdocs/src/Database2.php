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
        //$servername = "139.179.206.167:3306";//this is for my machine we can change it?
        $servername = "172.20.10.3:3306";
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



    // NOT OWNED CAN BE TRUE FALSE
    function show($userID, $showOwned) {
    	/*$sql = "WITH Belonging (idGame, gameName, genre, STATUS) as (SELECT idGame, Game.name AS gameName, genre, 'Owned' as STATUS
 				FROM Game INNER JOIN Owns INNER JOIN User
 				WHERE Game.idGame = Owns.OwnedGame and Owns.Owner = User.IDUser and '$userID' = User.IDUser) 
 				Select * from Belonging
 				UNION all
 				Select idGame, name AS gameName, genre, 'Not Owned' as STATUS FROM Game WHERE idGame not in (Select idGame from Belonging)";*/

 		//$sql = "Select idGame, name AS gameName, genre, 'Not Owned' as STATUS FROM Game";

 		// Check if show including owned
 		if ($showOwned === TRUE) {
 			$sql = "SELECT * from Game";
 		} 
 		else {
 			$sql = "SELECT * from Game where not exists (SELECT idGame, Game.name AS gameName, genre, 'Owned' as STATUS
 				FROM Game INNER JOIN Owns INNER JOIN User
 				WHERE Game.idGame = Owns.OwnedGame and Owns.Owner = User.IDUser and '$userID' = User.IDUser)";
 		}

	    /*$sql = "SELECT idGame, Game.name AS gameName, genre, 'Owned' as STATUS
		FROM (Game INNER JOIN Owns INNER JOIN User
		WHERE Game.idGame = Owns.OwnedGame and Owns.Owner = User.IDUser and '$userID' = User.IDUser) as Belonging
		Select * from Belonging
		UNION all
		Select idGame, name AS gameName, genre, 'Not Owned' as STATUS FROM Game WHERE idGame not in (Select idGame from Belonging)";*/


 		/*$sql =  "WITH Belonging (idGame, gameName, genre, STATUS) as (SELECT idGame, Game.name AS gameName, genre, 'Owned' as STATUS
 				FROM Game INNER JOIN Owns INNER JOIN User
 				WHERE Game.idGame = Owns.OwnedGame and Owns.Owner = User.IDUser and '$userID' = User.IDUser)";*/
				//WHERE userID = @userID AND @displayOwned = true";

        
        $result = $this->conn->query($sql);
        echo "result: " . $result->num_rows;

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
        		echo "\nid: " . $row["idGame"]. " - Name: " . $row["name"]. " " . $row["genre"]. "<br>";
    		}
            return 1;
        } else {
            echo "No user";
            return -1;
        }
    }

    function showUserGames($userID) {
 		// Check if show including owned
 		$sql = "SELECT *
 				FROM Game INNER JOIN Owns INNER JOIN User
 				WHERE Game.idGame = Owns.OwnedGame and Owns.Owner = User.IDUser and '$userID' = User.IDUser
 				ORDER BY Game.name ASC";
 		


        
        $result = $this->conn->query($sql);
        echo "result: " . $result->num_rows;

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
        		echo "\nid: " . $row["idGame"]. " - Name: " . $row["name"]. " " . $row["genre"]. "<br>";
    		}
            return 1;
        } else {
            echo "No user";
            return -1;
        }
    }

    function search($keyword, $userID, $showOwned) {
    	/*$sql = "WITH Belonging (idGame, gameName, genre, STATUS) as (SELECT idGame, Game.name AS gameName, genre, 'Owned' as STATUS
 				FROM Game INNER JOIN Owns INNER JOIN User
 				WHERE Game.idGame = Owns.OwnedGame and Owns.Owner = User.IDUser and '$userID' = User.IDUser) 
 				Select * from Belonging
 				UNION all
 				Select idGame, name AS gameName, genre, 'Not Owned' as STATUS FROM Game WHERE idGame not in (Select idGame from Belonging)";*/

 		//$sql = "Select idGame, name AS gameName, genre, 'Not Owned' as STATUS FROM Game";

 		// Check if show including owned
 		if ($showOwned === TRUE) {
 			$sql = "SELECT * from Game where Game.name LIKE '%$keyword%";
 		} 
 		else {
 			$sql = "SELECT * from Game where Game.name LIKE '%$keyword%' and not exists (SELECT idGame, Game.name AS gameName, genre, 'Owned' as STATUS
 				FROM Game INNER JOIN Owns INNER JOIN User
 				WHERE Game.idGame = Owns.OwnedGame and Owns.Owner = User.IDUser and '$userID' = User.IDUser)";
 		}

	    /*$sql = "SELECT idGame, Game.name AS gameName, genre, 'Owned' as STATUS
		FROM (Game INNER JOIN Owns INNER JOIN User
		WHERE Game.idGame = Owns.OwnedGame and Owns.Owner = User.IDUser and '$userID' = User.IDUser) as Belonging
		Select * from Belonging
		UNION all
		Select idGame, name AS gameName, genre, 'Not Owned' as STATUS FROM Game WHERE idGame not in (Select idGame from Belonging)";*/


 		/*$sql =  "WITH Belonging (idGame, gameName, genre, STATUS) as (SELECT idGame, Game.name AS gameName, genre, 'Owned' as STATUS
 				FROM Game INNER JOIN Owns INNER JOIN User
 				WHERE Game.idGame = Owns.OwnedGame and Owns.Owner = User.IDUser and '$userID' = User.IDUser)";*/
				//WHERE userID = @userID AND @displayOwned = true";

        
        $result = $this->conn->query($sql);
        echo "result: " . $result->num_rows;

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
        		echo "\nid: " . $row["idGame"]. " - Name: " . $row["name"]. " " . $row["genre"]. "<br>";
    		}
            return 1;
        } else {
            echo "No user";
            return -1;
        }
    }

    function doesOwn($gameID, $userID) {
    	/*$sql = "WITH Belonging (idGame, gameName, genre, STATUS) as (SELECT idGame, Game.name AS gameName, genre, 'Owned' as STATUS
 				FROM Game INNER JOIN Owns INNER JOIN User
 				WHERE Game.idGame = Owns.OwnedGame and Owns.Owner = User.IDUser and '$userID' = User.IDUser) 
 				Select * from Belonging
 				UNION all
 				Select idGame, name AS gameName, genre, 'Not Owned' as STATUS FROM Game WHERE idGame not in (Select idGame from Belonging)";*/

 		//$sql = "Select idGame, name AS gameName, genre, 'Not Owned' as STATUS FROM Game";

 		// Check if show including owned
 			$sql = "SELECT idGame
 				FROM Game INNER JOIN Owns INNER JOIN User
 				WHERE Game.idGame = Owns.OwnedGame and Owns.Owner = User.IDUser and '$userID' = User.IDUser and '$gameID' = Game.idGame)";
 		

	    /*$sql = "SELECT idGame, Game.name AS gameName, genre, 'Owned' as STATUS
		FROM (Game INNER JOIN Owns INNER JOIN User
		WHERE Game.idGame = Owns.OwnedGame and Owns.Owner = User.IDUser and '$userID' = User.IDUser) as Belonging
		Select * from Belonging
		UNION all
		Select idGame, name AS gameName, genre, 'Not Owned' as STATUS FROM Game WHERE idGame not in (Select idGame from Belonging)";*/


 		/*$sql =  "WITH Belonging (idGame, gameName, genre, STATUS) as (SELECT idGame, Game.name AS gameName, genre, 'Owned' as STATUS
 				FROM Game INNER JOIN Owns INNER JOIN User
 				WHERE Game.idGame = Owns.OwnedGame and Owns.Owner = User.IDUser and '$userID' = User.IDUser)";*/
				//WHERE userID = @userID AND @displayOwned = true";

        


        $result = $this->conn->query($sql);
        echo "result: " . $result->num_rows;

        if ($result->num_rows > 0) {
        	echo "User owns the game";
            return 1;
        } else {
            echo "The user does not own the game";
            return -1;
        }
    }

    // give keyword blank to fetch all
    function showUserFriends($userID, $keyword) {
    	/*if ($keyword === '') {
    		$sql = "SELECT t2.IDUser, t2.name
					FROM (Friends INNER JOIN User ON Friends.Friend2 = User.IDUser) AS t2 
					WHERE Friends.Friend1 = '$userID'
					ORDER BY t2.name ASC";
    	}
    	else {
    		$sql = "SELECT t2.IDUser, t2.name
					FROM (Friends INNER JOIN JOIN User ON Friends.Friend2 = User.IDuser) AS t2 
					WHERE Friends.Friend1 = '$userID' and t2.name LIKE ‘%keyword%’
					ORDER BY t2.name ASC";
    	}*/

    	if ($keyword === '') {
    		$sql = "SELECT Friends.Friend2 as ide, User.name as name
					FROM Friends, User
					WHERE Friends.Friend1 = '$userID' and Friends.Friend2 = User.idUser
					ORDER BY User.name ASC";
    	}
    	else {
    		$sql = "SELECT Friends.Friend2 as ide, User.name as name
					FROM Friends, User
					WHERE Friends.Friend1 = '$userID' and Friends.Friend2 = User.IDUser and User.name LIKE '%$keyword%'
					ORDER BY User.name ASC";
    	}

    	$result = $this->conn->query($sql);
        echo "result: " . $result->num_rows;

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
        		echo "\nid: " . $row["ide"]. " - Name: " . $row["name"] . "<br>\n";
    		}
            return 1;
        } else {
            echo "No friends";
            return -1;
        }

    }



    function getUser($username)
    {
        $sql = "SELECT *
                FROM USER
                WHERE User.name = '$username' ";

        $result = $this->conn->query($sql);
        echo "result: " . $result->num_rows;

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc())
            {
                $idUser = $row["idUser"];
                $name = $row["name"];
                $birth_date = $row["birth_date"];
                $description = $row["description"];
                $email = $row["email"];
                $nickname = $row["nickname"];
                $country = $row["country"];
            }
            $arr = array($idUser,$name,$birth_date,$description,$email,$nickname,$country);
            echo "User Retrieved\n";
            return $arr;
        } else {
            echo "No such game";
            return -1;

        }
    }

    function userSearch($keyword) {
    	/*$sql = "SELECT t2.name as name, t2.groupID as groupide, (t2.IDUser IS NOT NULL) AS AlreadyIn 
				FROM (User LEFT JOIN ( SELECT * FROM Friends WHERE Friends.Friend2 = IDUser ) AS t1
				ON t1.IDUser = IDUser) AS t2
				ORDER BY t2.name ASC
				WHERE t2.name LIKE ‘%@keyword%’";*/

		$sql = "SELECT IDUser, name FROM User WHERE User.Name LIKE '%$keyword%'";


		$result = $this->conn->query($sql);
        echo "result: " . $result->num_rows;

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
        		echo "\nid: " . $row["IDUser"]. " - Name: " . $row["name"] . "<br>\n";
    		}
            return 1;
        } else {
            echo "No people";
            return -1;
        }

    }



}
?>