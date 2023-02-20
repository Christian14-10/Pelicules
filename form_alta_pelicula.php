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
include "classe_pelicula.php";

// define variables and set to empty values
$titolErr = $data_estrenoErr = $duradaErr = "";
$titol = $data_estreno = $durada = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["titol"])) {
    $titolErr = "titol is required";
  } else {
    $titol = test_input($_POST["titol"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$titol)) {
      $titolErr = "Only letters and white space allowed";
    }
    
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["data_estreno"])) {
      $data_estrenoErr = "data estreno is required";
    } else {
      $data_estreno = test_input($_POST["data_estreno"]);
    }
}
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["durada"])) {
          $duradaErr = "durada is required";
        } else {
          $durada = test_input($_POST["durada"]);
        }
    }
  if ($titolErr != "" or $data_estrenoErr != "" or $duradaErr != "") //Hi ha errors
  {
    $titol = test_input($_POST["titol"]);
    $data_estreno = test_input($_POST["data_estreno"]);
    $durada = test_input($_POST["durada"]);

  }
  else  //Les dades són correctes
  {
    $pelicula = new pelicula();
    $pelicula -> inserir($servername,$username,$password,$titol,$data_estreno,$durada);
    $titol="";
    $data_estreno="";
    $durada="";
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
  data estreno: <input type="date" name="data_estreno" value="<?php echo $data_estreno;?>">
  <span class="error">* <?php echo $data_estrenoErr;?></span> 
  <br>  
  Durada: <input type="number" name="durada" value="<?php echo $durada;?>">
  <span class="error">* <?php echo $duradaErr;?></span>
  <br>
  Titulo: <input type="text" name="titol" value="<?php echo $titol;?>">
  <span class="error">* <?php echo $titolErr;?></span>
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