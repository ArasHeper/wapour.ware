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
		//$servername = "172.20.10.3:3306";//this is for my machine we can change it?
		$username = "Tcan";
        //$servername = "localhost";//this is for my machine we can change it?
        //$username = "root";
        $password = "123123";
        $dbname = "CS353";

        // Create connection
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($this->conn->connect_error) {
			echo "0";
            die("Connection failed: " . $this->conn->connect_error);
			echo "0";
        }
        else
            echo "1";
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
    //returns the id of the user
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

    //Buys the game with specified game and user id
    function buyGame($gameID,$userID)
    {

        $sql = "INSERT INTO OWNS 
                VALUES ($gameID, $userID);";

        if ($this->conn->query($sql) === TRUE) {
            echo "Game bought successfully\n";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
            return false;
        }

    }

    function getUser($userid)
    {
        $sql = "SELECT *
                FROM USER
                WHERE User.userid = '$userid' ";

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

    //Updated profile name
    function editProfileName($userid, $name)
    {


        $sql = "UPDATE User SET name = '$name' WHERE iduser = '$userid'";

        if ($this->conn->query($sql) === TRUE) {
            echo "Profile Updated successfully\n";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
            return false;
        }

    }
    //Updated profile birthdate
    function editProfileBirthdate($userid, $birtdate)
    {
        $sql = "UPDATE User SET birth_date = '$birtdate' WHERE iduser = '$userid'";

        if ($this->conn->query($sql) === TRUE) {
            echo "Profile Updated successfully\n";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
            return false;
        }
    }
    //Updated profile description
    function editProfileDesc($userid, $desc)
    {
        $sql = "UPDATE User SET description = '$desc' WHERE iduser = '$userid'";

        if ($this->conn->query($sql) === TRUE) {
            echo "Profile Updated successfully\n";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
            return false;
        }

    }
    //Updated profile name
    function editProfileEmail($userid, $email)
    {


        $sql = "UPDATE User SET email = '$email' WHERE iduser = '$userid'";

        if ($this->conn->query($sql) === TRUE) {
            echo "Profile Updated successfully\n";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
            return false;
        }

    }
    //Updated profile name
    function editProfileNickname($userid, $nickname)
    {


        $sql = "UPDATE User SET nickname = '$nickname' WHERE iduser = '$userid'";

        if ($this->conn->query($sql) === TRUE) {
            echo "Profile Updated successfully\n";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
            return false;
        }

    }
    //Updated profile name
    function editProfileCountry($userid,$country)
    {


        $sql = "UPDATE User SET country = '$country' WHERE iduser = '$userid'";

        if ($this->conn->query($sql) === TRUE) {
            echo "Profile Updated successfully\n";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
            return false;
        }

    }
    //changes the password
    function changePassword($userid,$newpassword)
    {
        $sql = "UPDATE login_System SET password = '$newpassword' WHERE idofuser = '$userid'";

        if ($this->conn->query($sql) === TRUE) {
            echo "Password changed successfully\n";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
            return false;
        }

    }

    //Sends gift. Gift message is message with a gift. Sender and reciever id is self explanatory. Game id is id of the sended game
    function sendGift($giftMsg, $senderid, $recieverid, $gameid)
    {
        $sql = "INSERT INTO Gift(message) 
                VALUES ('$giftMsg');";

        if ($this->conn->query($sql) === TRUE) {
            echo "Gift created successfully\n";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }



        $sql = "SELECT count(idgift) as count FROM Gift GROUP BY idgift";
        $result = $this->conn->query($sql);

        $giftID = $result->num_rows;
        $sql = "INSERT INTO Contains 
                VALUES ($giftID, $gameid)";

        if ($this->conn->query($sql) === TRUE) {
            echo "Contain created successfully\n";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }

        $sql = "INSERT INTO Gift_sends
                VALUES ($giftID,$senderid,$recieverid);";

        if ($this->conn->query($sql) === TRUE) {
            echo "Transaction created successfully\n";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
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

        $users = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($users, $row);
                echo "\nid: " . $row["IDUser"]. " - Name: " . $row["name"] . "<br>\n";
            }
            return $users;
        } else {
            echo "No people";
            return -1;
        }

    }


    // NOT OWNED CAN BE TRUE FALSE
    // Show all games, if showowned true, show all including user own
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

        $games = array()
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "\nid: " . $row["idGame"]. " - Name: " . $row["name"]. " " . $row["genre"]. "<br>";
                array_push($games, $row);
            }
            return $games;
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

        $games = array()
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "\nid: " . $row["idGame"]. " - Name: " . $row["name"]. " " . $row["genre"]. "<br>";
                $games = array_push($games, $row);
            }
            return 1;
        } else {
            echo "No user";
            return -1;
        }
    }

    // Search for games
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

        $games = array();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($games, $row);
                echo "\nid: " . $row["idGame"]. " - Name: " . $row["name"]. " " . $row["genre"]. "<br>";
            }

            return $games;
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

        $friends = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "\nid: " . $row["ide"]. " - Name: " . $row["name"] . "<br>\n";
                array_push($friends, $row);
            }
            return $friends;
        } else {
            echo "No friends";
            return -1;
        }

    }


}

?>