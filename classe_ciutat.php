<html>
<?php
class ciutat {

  public function connectar_bd ($servername,$username,$password)
  { 
    try {
      $conn = new PDO("mysql:host=$servername;dbname=cinesa", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected successfully";
    } catch(PDOException $e) {
      echo "Connection failed2: " . $e->getMessage();
    }
    return $conn;
}
public function inserir ($servername,$username,$password,$nom)
{
    $conn = $this->connectar_bd($servername,$username,$password);
      try
      {
        $sql = "INSERT INTO ciutat (nom) VALUES ('$nom')";
        // use exec() because no results are returned
        $conn->exec($sql);
        $last_id = $conn->lastInsertId();
} catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
  }
  $conn = null;
}


public function consultaTots ($servername, $username,$password)
{
    $conn = $this->connectar_bd($servername,$username,$password);
    
    try {
       $stmt = $conn->prepare("SELECT * FROM ciutat");
       $result = $stmt->execute();
       $conn=null;
       return($stmt); 
    }

    catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    }
}

function modificar ($servername, $username, $password,$id,$nom, $email, $website, $comments, $gender)
{
  $conn = $this->connectar_bd($servername,$username,$password);
  try {
  
    $sql = "UPDATE ciutat SET nom='$nom' 
    WHERE id='$id'";

  // Prepare statement
  $stmt = $conn->prepare($sql);

  // execute the query
  $stmt->execute();
  $conn=null;
  // echo a message to say the UPDATE succeeded
  return $stmt->rowCount();
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;

}

function eliminar ($servername,$username,$password, $id)
{
  $conn = $this->connectar_bd($servername,$username,$password);
try {
  
  // sql to delete a record
  $sql = "DELETE FROM ciutat WHERE id='$id'";

  // use exec() because no results are returned
  $conn->exec($sql);
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
}
}

/*Provam els m??todes si funcionen */
/* Eliminar aquest tros quan ho volguem emprar des de formularis */
/* Recorrem l'array associativa per mostrar els resultats DINS
UNA TAULA*/
// $ciutat1=new ciutat();
// // $ciutat1->connectar_bd("localhost","root","iesmanacor");
// $resultat =$ciutat1->consultaTots("localhost","root","iesmanacor");
// echo "hola";
// $arrayValues = $resultat->fetchAll(PDO::FETCH_ASSOC); 
// echo "<table wdith=\"100%\">\n";
// echo "<tr>\n";
// // add the table headers
// foreach ($arrayValues[0] as $key => $useless){
//     echo "<th>$key</th>";
// }
// echo "</tr>";
// // display data
// foreach ($arrayValues as $row){
//     echo "<tr>";
//     foreach ($row as $key => $val){
//         echo "<td>$val</td>";
//     }
//     echo "</tr>\n";
// }
// // close the table
// echo "</table>\n";


 /* El seg??ent tros de codi mostra un exemple de com 
 treure els valors a una llista desplegable */

// echo "Llista desplegable";
// echo "<select>";
// $ciutat2 = new ciutat();
// $resultat =$ciutat2->consultaTots("cinesa","root","iesmanacor");
// $arrayValues = $resultat->fetchAll(PDO::FETCH_ASSOC); 
// foreach ($arrayValues as $row)
// {
//       echo "<option value='". $row['id']. "'>" .  $row['nom'] . "</option>";
// }
// echo "</select>";

// /* Provam m??tode modificar */
// $ciutat1->modificar("cinesa","root","iesmanacor","3","Y","X","X","X","x");
// /*Provam m??tode eliminar */
// $ciutat1->eliminar("cinesa","root","iesmanacor","4");
?>