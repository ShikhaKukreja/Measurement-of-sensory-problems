<?php

session_start();

if (isset($_POST['amount'])) {
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "ttherapy";

    $dbh = new mysqli($servername, $username, $password, $dbname);
    // echo "otid : ". $_SESSION['otid']." <br/>std_id:".$_SESSION['studentid'];

    $statement = $dbh->prepare("INSERT INTO billinginfo (studentid, otid, feespaid) VALUES (?,?,?)");
    print_r($dbh->error_list);

    // echo $_POST['amount'];

    if (!$statement) {
        echo "false";
    } else {
        $statement->bind_param("iii", $_SESSION['studentid'], $_SESSION['otid'], $_POST['amount']);
        if ($statement->execute()) {
            echo "New record created successfully";
            header("Location: final.php");
        } else {
            echo "Error: ".$statement->error ."<br>". $statement->errno;
        }
    }
} else {
    echo "Amount missing!!";
    echo "<br/>";
    echo "<br/>";
    echo "<a href='signin.php'>Back to Login page</a>";
}
