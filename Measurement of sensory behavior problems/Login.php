<?php
session_start();
if ((
    isset($_POST['username']) &&
    isset($_POST['password'])
  ) || (isset($_SESSION['otid']))) {
    $otusername= $_POST['username'];
    $otpassword = $_POST['password'];

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "ttherapy";

    $dbh = new mysqli($servername, $username, $password, $dbname);

    print_r($otusername);
    $statement = $dbh->prepare("SELECT otid,username,password FROM occupationaltherapist WHERE username = ? LIMIT 1");
    print_r($dbh->error_list);
    if (!$statement) {
        echo "false";
    } else {
        $statement->bind_param("s", $otusername);
        $statement->execute();
        $rows = $statement->get_result()->fetch_all();
        print_r($rows);
        $passwordHash = $rows[0][2];
        if ($otpassword === $passwordHash) {
            $_SESSION['otid']=$rows[0][0];
            header("Location: home.php");
        } else {
            echo "Invalid credentials. Please try again!!";
            echo "<br/>";
            echo "<br/>";
            echo "<a href='signin.php'>Back to Login page</a>";
        }
    }
} else {
    echo "User ID or/and Password are empty!!";
    echo "<br/>";
    echo "<br/>";
    echo "<a href='signin.php'>Back to Login page</a>";
}
