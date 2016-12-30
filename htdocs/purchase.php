<?php
session_start();
?>
<!DOCTYPE html>


<html>
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
  <title>Wapour....Ware</title>
</head>

<body>
<table>
<tr><td>
<table class="top" width ="1024">
<tr>
<td>
 <a class="top" href="store.php">Store</a>
</td>
<td>
 <a class="top" href="profileinfo.php">Profile</a>
</td>
<td>
 <a class="top" href="friends.php">Social</a>
</td>
<td>
 <a class="top" href="mygames.php">Library</a>
</td>
<td>
 <a class="top" href="gifts.php">Gifts</a>
</td>
</tr>
</td>
</tr>
</table>
</tr>
<tr>
<td>
<form action="signup.php" method="post">
<?php
  echo '<header>$_SESSION["viewed_game"]</header>'; 
 ?>
  <label> Is Gift <input type='checkbox' id='gift' name='gift' value = 'on' /><br/>
<?php
	require_once 'src/Database.php';
	$game = $_SESSION["viewed_game"];
	$price = ($database -> getGame("$game"));
	$price = $price['price'];
	echo '<label>$price</label>'; 
  
 ?>
  <label> Receiver </label>
  <input type='text' id='receiver' name='reciever' /><br/>

  <label>Card no</label>
  <input type='text' id='cardNo' name='cardNo' /><br/>

  <label>Expiration date </label>
  <input type='text' id='expDate' name='expDate' /><br/>
  
  <label> CVC </label>
  <input type='text' id='cvc' name='cvc' /><br/>

  <label>Msg:</label>
  <input type='text' id='msg' name='msg' /><br/>
  
  <button type="submit" name="buy" value = "post">  Continue</button>

	<button type="submit" name="Save Card" value = "post">  Save Vard</button>
<a />
</form>

</td></tr>
<tr><td>
<form action="login.php" >

  <button > Return to Login Page </button>
</form>

</td></tr>

<tr><td>

</td></tr>

</table>
<?php
	if(session_status() == PHP_SESSION_ACTIVE){
		if($_POST['gift'] == 'on'){
			
		}
		else{
			$name = $_POST['name'];
			$username = $_POST['username'];
			$nickname = $_POST['nickname'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$birtdate = $_POST['birtdate'];
			$country = $_POST['country'];
		}
		require_once 'src/Database.php';
		//pull the data from sql database
		$array;
		//echo a form for each of them, like this;
		$count = count($array);
		for( $i; $i < $count; $i++){
			$game = $array[$i];
			$id = "toGamePage:" + $i;
			echo '
			<form action="store.php" method="post">
				<input type="hidden" id=$id name="hiddenVar" value=$game />
				<button type="submit" name="toGamePage" value = "post"> $game </button>
			</form>';
		}
	}
	else {
		header("Location: login.php");
		exit;	
	}
	?>
<?php
require_once 'src/Database.php';

if(isset($_POST['abc'])){
	$var;
	$var = 2;//gggg.func(sadasd);
	$var = $database = new Database();
    //$var = $database->function __construct();
	if($var == 1){
		
		//header("Location: login.php");
		echo("SUCCCESSS");
		$password = $_POST['password'];
		$password2 = $_POST['password2'];
		if( $password == $password2){
			$name = $_POST['name'];
			$username = $_POST['username'];
			$nickname = $_POST['nickname'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$birtdate = $_POST['birtdate'];
			$country = $_POST['country'];
			$desc = '';
			$answer = $database->register($name, $birtdate, $desc, $email, $nickname, $country,$username,$password);
			header("Location: login.php");
			exit;
		}else{
			echo'Wrong input.';
		}
	}
	else{
		//header("Location: login.php");
		echo("FAILURE");
		//exit;
	}
	
}
?>
</body>
</html>