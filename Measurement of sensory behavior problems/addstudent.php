<?php

session_start();

if (
    isset($_POST['fname']) &&
    isset($_POST['lname']) &&
    isset($_POST['dob']) &&
    isset($_POST['address']) &&
    isset($_POST['school'])
) {
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "ttherapy";

    $dbh = new mysqli($servername, $username, $password, $dbname);
    // echo "otid : ". $_SESSION['otid']." <br/>std_id:".$_SESSION['studentid'];

    $statement = $dbh->prepare("INSERT INTO student (firstName, lastName, dob, address, schoolId) VALUES (?,?,?,?,?)");
    print_r($dbh->error_list);

    // echo $_POST['amount'];

    if (!$statement) {
        echo "false";
    } else {
        $statement->bind_param("ssssi", $_POST['fname'], $_POST['lname'], $_POST['dob'], $_POST['address'], $_POST['school']);
        if ($statement->execute()) {
            echo "New record created successfully";
            header("Location: students.php");
        } else {
            echo "Error: ".$statement->error ."<br>". $statement->errno;
        }
    }
} else {
    echo "Student Info missing!!";
    echo "<br/>";
    echo "<br/>";
    echo "<a href='students.php'>Back to Students page</a>";
}
