<!DOCTYPE html>

<html>

    <head>
<!--        <link href="styles.css" rel="stylesheet" type="text/css">-->
        <title>CSCI3369 Prisoner's Dilemma Assignment Simulation</title>
    </head>

    <body>
<?php
$method = $_SERVER['REQUEST_METHOD'];
if($method == "POST") {
  $agent1 = $_POST["a1"];
  $agent2 = $_POST["a2"];
} else {
  $agent1 = '0: 0.5 0 0 0 0';
  $agent2 = '0: 0.5 0 0 0 0';
}
?>


<center>
<h2>CSCI3369 Prisoner's Dilemma Assignment Simulation</h2>
<p>
To go back to the assignment description click <a href = "https://docs.google.com/document/d/1ALPaQJNPDAwkR0mkObVLiuRfQVa5sX_nmYPqz9AYWQA/edit?usp=sharing">here</a>.
</p>
<div>
     <br>
     <form action="index.php" method="post">
     <p><h3>Agent 1</h3></p>
     <p><textarea rows="6" cols="30" name="a1"><?php echo $agent1 ?></textarea></p>
     <p><h3>Agent 2</h3></p>
     <p><textarea rows="6" cols="30" name="a2"><?php echo $agent2 ?></textarea></p>
     <p><h3>Number of rounds: </h3> </p>
     <p><input type="text" name="numrounds" value="20"/></p>
     <input type="submit" value="Play!">
     </form>
     </div>
     <p>
     <?php
switch ($method) {
case 'POST':
#    echo "POSTed...<br>";
#    system("echo $PATH");
    echo "<br>";
# Save input to file
    $tmpfname = tempnam("/var/tmp", "cs186-pd-");

    $handle = fopen($tmpfname, "w");
    fwrite($handle, $agent1);
    fwrite($handle, "\n\n");
    fwrite($handle, $agent2);
    fwrite($handle, "\n");
    fclose($handle);
    # Convert to an int to prevent any shenanigans
    $numrounds = intval($_POST["numrounds"]);

#    echo "tmpfname = ", $tmpfname;
   // echo "<br><br>Results: <br>";
    $out = shell_exec("/usr/bin/python3 ./pd.py " . $numrounds . " html < " . $tmpfname);
    // echo $tmpfname;
    echo $out;
   // echo "<br>---<br>End of results";
    unlink($tmpfname);

#    system("/usr/bin/python /nfs/home/groups/mather/web/vs/pd.py");

    break;
case 'GET':
#    echo "GETed...";
    break;
case 'DEFAULT':
  echo "Weird request method: ", $method;
}
     ?>
</p>
</center>
     </body>

</html>