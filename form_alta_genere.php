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
include "classe_genere.php";

// define variables and set to empty values
$nameErr = "";
$name = ""; 

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
  if ($nameErr != "") //Hi ha errors
  {
    $name = test_input($_POST["name"]);
  }
  else  //Les dades són correctes
  {
    $genere = new genere();
    $genere -> inserir($servername,$username,$password,$name);
    $name="";
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
  Genero: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
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