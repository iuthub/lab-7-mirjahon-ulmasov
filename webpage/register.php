<?php

$db=new PDO("mysql:host=localhost; dbname=blog","mirjahon-ulmasov", "QIvMiE6oBpLB008w");


if($_SERVER["REQUEST_METHOD"]=="POST"){
    $uname=$_POST["username"];
    $fullname=$_POST["fullname"];
    $email=$_POST["email"];
    $pass=$_POST["pwd"];
    $passc=$_POST["confirm_pwd"];
    $date = date('Y-m-d H:i:s');

    if(
        preg_match('/[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z]{1,3}/i',$email)&&
        $pass==$passc&&
        preg_match('/^.{8,}$/i',$pass)
    )
    {
        $stmt=$db->prepare("INSERT INTO users (username,email,password,fullname,dob) VALUES (?,?,?,?,?)");
        $stmt->bindParam(1,$uname);
        $stmt->bindParam(2,$email);
        $stmt->bindParam(3,$pass);
        $stmt->bindParam(4,$fullname);
        $stmt->bindParam(5,$date);
        $stmt->execute();
        header('Location: index.php');
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>My Blog - Registration Form</title>
		<link href="style.css" type="text/css" rel="stylesheet" />
	</head>
	
	<body>
		<?php include('header.php'); ?>

		<h2>User Details Form</h2>
		<h4>Please, fill below fields correctly</h4>
		<form action="register.php" method="post">
				<ul class="form">
					<li>
						<label for="username">Username</label>
						<input type="text" name="username" id="username" required/>
					</li>
					<li>
						<label for="fullname">Full Name</label>
						<input type="text" name="fullname" id="fullname" required/>
					</li>
					<li>
						<label for="email">Email</label>
						<input type="email" name="email" id="email" />
					</li>
					<li>
						<label for="pwd">Password</label>
						<input type="password" name="pwd" id="pwd" required/>
					</li>
					<li>
						<label for="confirm_pwd">Confirm Password</label>
						<input type="password" name="confirm_pwd" id="confirm_pwd" required />
					</li>
					<li>
                        <input type="submit" value="Submit" /> &nbsp; Already registered? <a href="index.php">Login</a>
					</li>
				</ul>
		</form>
	</body>
</html>