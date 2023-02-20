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
include "classe_cine.php";
include "classe_ciutat.php";

// define variables and set to empty values
$nameErr =$id_ciutatErr ="";
$name = $id_ciutat = ""; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id_ciutat = test_input($_POST["id_ciutat"]);
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
    $cine = new cine();
    $cine -> inserir($servername,$username,$password,$name,$id_ciutat);
    $name="";
    $id_ciutat="";
  }

 }
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
<p><span class="error">* required field</span></p>
  cine: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
   <?php $ciutat1=new ciutat();?> 
 Ciutat: <select name="id_ciutat" id="ciutat">
<?php
$resultat =$ciutat1->consultaTots("localhost","root","iesmanacor");
$res = $resultat->fetchAll(PDO::FETCH_ASSOC);
foreach ($res as $fila){
    echo "<option value=" .$fila["id"]. ">".$fila["nom"]. "</option>";
    }
?>
  <span class="error">* <?php echo $ciutatErr;?></span>
</select>
  <input type="submit" name="submit" value="Submit"> 
  </input>
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