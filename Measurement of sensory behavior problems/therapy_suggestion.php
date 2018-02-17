<?php

session_start();

if (isset($_POST['suggestions'])) {
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "ttherapy";

    $dbh = new mysqli($servername, $username, $password, $dbname);
    echo "otid : ". $_SESSION['otid']." <br/>rpt_id:".$_SESSION['reportid'];

    $statement = $dbh->prepare("INSERT INTO therapysuggestion (reportId, treatmentid) VALUES (?,?)");
    print_r($dbh->error_list);

    foreach ($_POST['suggestions'] as $checkbox) {
        if (!$statement) {
            echo "false";
        } else {
            $statement->bind_param("ii", $_SESSION['reportid'], $checkbox);

            if ($statement->execute()) {
                echo "New record created successfully";
            } else {
                echo "Error: ".$statement->error ."<br>". $statement->errno;
            }
        }
    }
    header("Location: final.php");
} else {
    echo "tscore or ttype is missing!!";
    echo "<br/>";
    echo "<br/>";
    echo "<a href='signin.php'>Back to Login page</a>";
}
