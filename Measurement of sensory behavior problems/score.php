<?php
session_start();

if (
    isset($_POST['tscore']) &&
    isset($_POST['ttype'])
  ) {
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "ttherapy";

    $dbh = new mysqli($servername, $username, $password, $dbname);
    echo "otid : ". $_SESSION['otid']." <br/>rpt_id:".$_SESSION['reportid'];

    $statement = $dbh->prepare("INSERT INTO testreport (reportId, score, testType) VALUES (?,?,?)");
    echo "<br/>";
    print_r($dbh->error_list);
    if (!$statement) {
        echo "false";
    } else {
        $statement->bind_param("iis", $_SESSION['reportid'], $_POST['tscore'], $_POST['ttype']);

        if ($statement->execute()) {
            echo "<br/>";
            echo "New record created successfully";
            echo "<br/>";
            echo "report ".$_SESSION['reportid']."<br/> total score ".$_POST['tscore'];
            echo "<br/>studentid : ".$_SESSION['studentid'];
            switch ($_POST['ttype']) {
                case "Social Participation":
                    header("Location: test2.php");
                    break;
                case "Vision":
                    header("Location: test3.php");
                    break;
                case "Hearing":
                    header("Location: test4.php");
                    break;
                case "Touch":
                    header("Location: test5.php");
                    break;
                case "Taste and Smell":
                    header("Location: test6.php");
                    break;
                case "Body Awareness":
                    header("Location: test7.php");
                    break;
                case "Balance":
                    header("Location: test8.php");
                    break;
                case "Planning and Ideas":
                    header("Location: final.php");
                    break;
                default:
                    header("Location: newassess.php");
                    break;
            }
            // header("Location: final.php");
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
        // $data = json_decode(file_get_contents('php://input'), true);
        // print_r($data);
        // echo $data["tscore"];
        // echo $data["ttype"];
    }
} else {
    echo "tscore or ttype is missing!!";
    echo "<br/>";
    echo "<br/>";
    echo "<a href='signin.php'>Back to Login page</a>";
}
