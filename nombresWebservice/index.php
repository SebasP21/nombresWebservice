
<?php
if(isset($_POST["btnEjecutar"])) {
  $names_url = 'https://api.genderize.io/?name=' . urlencode($_POST['location']);


  $names_json = file_get_contents($names_url);

  $names_array = json_decode($names_json, true);
  //$names_info = $names_array['name']['gender'];
  $name = $names_array["name"];
  $gender = $names_array["gender"];

  echo "<h2>Nombre y Genero: </h2>";
  echo "El nombre es: " . $names_array["name"] . "<br>";
  echo "El genero definido para el nombre es: " . $names_array["gender"] . "<br>";


  $search_name_url = 'http://api.wordnik.com/v4/word.json/' . $name . '/definitions?limit=200&includeRelated=true&sourceDictionaries=ahd&api_key=a2a73e7b926c924fad7001ca3111acd55af2ffabf50eb4ae5';
  $search_name_json = file_get_contents($search_name_url);
  $search_name_array = json_decode($search_name_json, true);

  $search_name2_url = 'http://api.wordnik.com/v4/word.json/' . $name . '/definitions?limit=200&includeRelated=true&sourceDictionaries=wiktionary&api_key=a2a73e7b926c924fad7001ca3111acd55af2ffabf50eb4ae5';
  $search_name2_json = file_get_contents($search_name2_url);
  $search_name2_array = json_decode($search_name2_json, true);

  $search_related_url = 'http://api.wordnik.com/v4/word.json/' . $name . '/relatedWords?useCanonical=false&relationshipTypes=etymologically-related-term&limitPerRelationshipType=10&api_key=a2a73e7b926c924fad7001ca3111acd55af2ffabf50eb4ae5';
  $search_related_json = file_get_contents($search_related_url);
  $search_related_array = json_decode($search_related_json, true);

//PRIMERA DEFINICION
$con = 0;
echo "<h2>Definiciones fuente Ahd: </h2>";
foreach ($search_name_array as $val) {
$con ++;
  echo "<h3>Significado " . $con . " es: </h3>";
  echo $val["text"]."<br>";

}

//SEGUNDA DEFINICION
$con2 = 0;
echo "<h2>Definiciones fuente Wiktionary: </h2>";
foreach ($search_name2_array as $val2) {
$con2 ++;
  echo "<h3>Significado " . $con2 . " es: </h3>";
  echo $val2["text"]."<br>";

}
//RELACIONADAS
$conn = 0;
echo "<h2>Palabras relacionadas: </h2>";

foreach ($search_related_array as $val) {
$conn ++;
  echo "<h3>Lista " . $conn . " palabras: </h3>";
  foreach ($val["words"] as $vall) {
  echo $vall ."<br>";

    }
  }



  //BUSQUEDA PALABRAS RELACIONADAS
  $connn = 0;
  $connn1 = 0;
  echo "<h2>Definiciones de las 3 primeras palabras: </h2>";

  foreach ($search_related_array as $val) {


    $connn ++;
    foreach ($val["words"] as $vall) {
      echo "<br>";
      if($connn1 <= 7){
//  echo $vall ."<br>";

        if($connn1 == 0){
          $v1 = $vall;

//json
$search_name2_url = 'http://api.wordnik.com/v4/word.json/' . $v1 . '/definitions?limit=200&includeRelated=true&sourceDictionaries=wiktionary&api_key=a2a73e7b926c924fad7001ca3111acd55af2ffabf50eb4ae5';
$search_name2_json = file_get_contents($search_name2_url);
$search_name2_array = json_decode($search_name2_json, true);

          echo "<h3>Palabra : </h3>" . $v1;
          $conp1 = 0;

          foreach ($search_name2_array as $valp1) {
          $conp1 ++;
            echo "<h3>Significado " . $conp1 . " es: </h3>";
            echo $valp1["text"]."<br>";
        }
      }
        if ($connn1 == 1) {
          $v2 = $vall;

          //json
          $search_name2_url = 'http://api.wordnik.com/v4/word.json/' . $v2 . '/definitions?limit=200&includeRelated=true&sourceDictionaries=wiktionary&api_key=a2a73e7b926c924fad7001ca3111acd55af2ffabf50eb4ae5';
          $search_name2_json = file_get_contents($search_name2_url);
          $search_name2_array = json_decode($search_name2_json, true);
          echo "<h3>Palabra : </h3>" . $v2 ."<br>";
          $conp2 = 0;

          foreach ($search_name2_array as $valp2) {
          $conp2 ++;
            echo "<h3>Significado " . $conp2 . " es: </h3>";
            echo $valp2["text"]."<br>";
        }
        }
        if ($connn1 == 2) {
          $v3 = $vall;

          //json
          $search_name2_url = 'http://api.wordnik.com/v4/word.json/' . $v3 . '/definitions?limit=200&includeRelated=true&sourceDictionaries=wiktionary&api_key=a2a73e7b926c924fad7001ca3111acd55af2ffabf50eb4ae5';
          $search_name2_json = file_get_contents($search_name2_url);
          $search_name2_array = json_decode($search_name2_json, true);
          echo "<h3>Palabra : </h3>" . $v3 ."<br>";
          $conp3 = 0;

          foreach ($search_name2_array as $valp3) {
          $conp3 ++;
            echo "<h3>Significado " . $conp3 . " es: </h3>";
            echo $valp3["text"]."<br>";
        }
        }
        $connn1 ++;
      }


}
}
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>INTEGRACION APIS NOMBRES</title>
    	<link rel="stylesheet" href="css/style.css">
      <Link rel="stylesheet" type="text/css" href="css/style.css"  />
      <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
      <script src="js/jquery.js"></script>
  </head>
  <body>
<form action="" method="post">
  <input type="text" name="location">
  <button type="submit" name="btnEjecutar" id="btnEjecutar">Ingresar</button>
</br>
</form>
  </body>
</html>
