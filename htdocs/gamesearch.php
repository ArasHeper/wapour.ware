<!DOCTYPE html>
<html >
<head>
  <style>
		table.top
		{
			font-family:Arial,Helvetica,sans-serif;
		}
		
		a.top:link {text-decoration:none; color:#FFFFFF;}
		a.top:visited {text-decoration:none; color:#FFFFFF;}
		a.top:hover {text-decoration:none; color:#FFFFFF;}
		a.top:active {text-decoration:none; color:#FFFFFF;}
		html, body {
		  border: 0;
		  padding: 0;
		  margin: 0;
		  height: 100%;
		}

		body {
		  background: #920c11;
		  display: flex;
		  justify-content: center;
		  align-items: center;
		  font-size: 16px;
		}

		form {
		  background: white;
		  width: 100%;
		  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.7);
		  font-family: lato;
		  position: relative;
		  color: #333;
		  border-radius: 10px;
		}
		form header {
		  background: #FF3838;
		  padding: 30px 20px;
		  color: white;
		  font-size: 1.2em;
		  font-weight: 600;
		  border-radius: 10px 10px 0 0;
		}
		form label {
		  margin-left: 20px;
		  display: inline-block;
		  margin-top: 30px;
		  margin-bottom: 5px;
		  position: relative;
		}
		form label span {
		  color: #FF3838;
		  font-size: 2em;
		  position: absolute;
		  left: 2.3em;
		  top: -10px;
		}
		form input {
		  display: block;
		  width: 78%;
		  margin-left: 20px;
		  padding: 5px 20px;
		  font-size: 1em;
		  border-radius: 3px;
		  outline: none;
		  border: 1px solid #ccc;
		}
		form .help {
		  margin-left: 20px;
		  font-size: 0.8em;
		  color: #777;
		}
		form button {
		  position: relative;
		  margin-top: 30px;
		  margin-bottom: 30px;
		  left: 50%;
		  transform: translate(-50%, 0);
		  font-family: inherit;
		  color: white;
		  background: #FF3838;
		  outline: none;
		  border: none;
		  padding: 5px 15px;
		  font-size: 1.3em;
		  font-weight: 400;
		  border-radius: 3px;
		  box-shadow: 0px 0px 10px rgba(51, 51, 51, 0.4);
		  cursor: pointer;
		  transition: all 0.15s ease-in-out;
		}
		form button:hover {
		  background: #ff5252;
		}

	</style>
  <meta charset="UTF-8">
  <title>Wapour...Ware</title>
  
</head>

<body>
<table width="1024" align="right" >
<tr >
<td>
<form action="search.php" method="post">
  <header>Game Search</header>
  <label>Search game </label>
  <input type='text' id='gamename' name='gamename' /><br/>
  <button type="submit" name="search" value = "post"> Submit </button>
</form>
</td></tr>
<tr><td>


</td></tr>
</table>

<?php
require_once 'C:/xampp/htdocs/databaseservice/Database.php';

if(isset($_POST['search'])){
		$var = $database = new Database();
	
		$games = $_POST['gamename'];
		
		// $val = $_SESSION["userid"];
		$answer = $database->search($gamename, 1, TRUE);
		if($answer = -1){
			echo("FAILURE");
		}
		else{
			foreach ($game as $games ) {
				//echo "<br>'".$game['IDGame']."'<br>";
				echo "Oldu!";
			}
		}
}



	

?>
</body>
</html>