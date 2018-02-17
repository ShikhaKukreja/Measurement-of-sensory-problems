<?php
session_start();
if (
    isset($_POST['studentid'])
  ) {
    $studentid= $_POST['studentid'];


    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "ttherapy";

    $dbh = new mysqli($servername, $username, $password, $dbname);
    echo "otid". $_SESSION['otid']." stid:".$studentid;

    $statement = $dbh->prepare("INSERT INTO REPORT (studentid, otid, date) VALUES (?,?,NOW())");
    print_r($dbh->error_list);
    if (!$statement) {
        echo "false";
    } else {
        $statement->bind_param("ii", $studentid, $_SESSION["otid"]);

        if ($statement->execute()) {
            $_SESSION['reportid'] = $statement->insert_id;
            $_SESSION['studentid'] = $_POST['studentid'];
            echo "New record created successfully";
            header("Location: test1.php");
        } else {
            echo "Error: ".$statement->error ."<br>". $statement->errno;
        }

        // $passwordHash = $rows[0][2];
        // if ($otpassword === $passwordHash) {
        //     $_SESSION['otid']=$rows[0][0];
        //     header("Location: Index.html");
        // } else {
        //     echo "Invalid credentials. Please try again!!";
        //     echo "<br/>";
        //     echo "<br/>";
        //     echo "<a href='Login.html'>Back to Login page</a>";
        // }
    }
} else {
    echo "Student ID is empty!!";
    echo "<br/>";
    echo "<br/>";
    echo "<a href='signin.php'>Back to Login page</a>";
}
