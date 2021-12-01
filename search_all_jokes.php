<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#accordion" ).accordion({ collapsible: true, active: false });
  } );
  </script>
<style>
* {
  font-family: Arial, Helvetica, sans-serif;

}
</style>



<?php

if ($mysqli -> connect_errno)
{
	echo "Failed to connect to MySQL:  (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;

}
echo $mysqli->host_info . "\n";

$sql = "SELECT JokeID, Joke_question, Joke_answer, users_id FROM Jokes_table";
$result = $mysqli->query($sql);



if ($result->num_rows > 0) {
  // output data of each row
  
  while($row = $result->fetch_assoc()) {
    ?><div class="accordion">
    <?php
    echo"<h3>" . $row['Joke_question'] . "</h3?>";
    echo "<div><p> " . $row["Joke_answer"]. "-- Submitted by user #" . $row["users_id"].  "</p></div>";
    ?></div>
    <?php
    
  }
} else {
  	echo "0 results";
}



?>
<a href= "index.php"> Return to main page </a>