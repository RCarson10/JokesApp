<head>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
  <script>
  $( function() {
    $( ".accordion" ).accordion({ collapsible: true, active: false });
  } );
  </script>
<style>
* {
  font-family: Arial, Helvetica, sans-serif;

}

</style>


</head>


<?php

include "db_connect.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

$keywordfromform = $_GET["keyword"];
echo $keywordfromform;

$keywordfromform = "%" . $keywordfromform . "%";


echo "<h2> Showing all jokes with the word " . $keywordfromform . "</h2>";

$stmt = $mysqli->prepare("SELECT JokeID, Joke_question, Joke_answer, users_id,username FROM Jokes_table JOIN users ON users.id = jokes_table.users_id WHERE Joke_question LIKE ?");

$stmt->bind_param("s",$keywordfromform);

$stmt->execute();
$stmt->store_result();

$stmt->bind_result($JokeID, $Joke_question, $Joke_answer, $userid,$username);

//$sql = "SELECT JokeID, Joke_question, Joke_answer, users_id, FROM Jokes_table JOIN users ON users.id = jokes_table.users_id WHERE Joke_question LIKE '%$keywordfromform%'";

//echo "Select returned $result->num_rows rows of data<br>"

?>



<?php
  while($stmt->fetch()) {
    ?><div class="accordion">
      <?php
      $safe_joke_question = htmlspecialchars($Joke_question);
      $safe_joke_answer = htmlspecialchars($Joke_answer);
    echo"<h3>" . $safe_joke_question . "</h3>";
    
    echo "<div><p> " . $safe_joke_answer. " -- Submitted by user #" . $username.  "</p></div>";
    ?></div>
    <?php
  }
?>
<a href= "index.php"> Return to main page </a>