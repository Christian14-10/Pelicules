<!DOCTYPE HTML>  
<html>
<head>
<style>
  form {
  width: 500px;
  margin: 50px auto;
  text-align: center;
  padding: 20px;
  background-color: lightgray;
  border-radius: 10px;
}

input[type="text"], input[type="email"], textarea {
  width: 100%;
  padding: 10px;
  margin-top: 10px;
  border-radius: 5px;
  border: none;
  font-size: 18px;
}

input[type="submit"] {
  width: 100%;
  padding: 10px;
  margin-top: 20px;
  background-color: blue;
  color: white;
  border-radius: 5px;
  border: none;
  font-size: 18px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: darkblue;
}
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
include "dades_connexio_BD.php";
include "classe_client.php";

// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
    
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "Email incorrecte";
      $emailErr = "Invalid email format";
    }
  }
    
  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) { 
      $websiteErr = "Invalid URL";
    }
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  }
  else
  {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } 
  else
  {
    $gender = test_input($_POST["gender"]);
  }

  if ($nameErr != "" or $emailErr !="" or $websiteErr!="" 
  or $genderErr != "") //Hi ha errors
  {
    $gender = test_input($_POST["gender"]);
    $comment = test_input($_POST["comment"]);
    $website = test_input($_POST["website"]);
    $email = test_input($_POST["email"]);
    $name = test_input($_POST["name"]);
  }
  else  //Les dades són correctes
  {
    $client = new Client();
    $client -> inserir($servername,$username,$password,$name,$email,$website,$comment,$gender);
    $name="";
    $email="";
    $website="";
    $comment="";
    $gender="";
  }


}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Website: <input type="text" name="website" value="<?php echo $website;?>">
  <span class="error"><?php echo $websiteErr;?></span>
  <br><br>
  Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
  <br><br>
  Gender:
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other  
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>


<?php
/*
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
*/
?>

</body>
</html>