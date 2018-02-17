<?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "ttherapy";

    $dbh = new mysqli($servername, $username, $password, $dbname);
    //echo "otid : ". $_SESSION['otid']." <br/>rpt_id:".$_SESSION['reportid']."<br/> studentid:".$_SESSION['studentid'];

    $statement = $dbh->prepare("SELECT repscore.reportid, repscore.Totalscore, repscore.TestsTaken, repscore.TestsName, COALESCE(GROUP_CONCAT(treatment.description SEPARATOR ', '), 'None suggested') as TreatmentSuggestion FROM (select R.reportid, SUM(T.score) as TotalScore, COUNT(*) as TestsTaken, GROUP_CONCAT(T.testType SEPARATOR ', ') as TestsName from testreport as T right join (Select * from report where studentid = ?) as R  on T.reportid = R.reportId GROUP BY R.reportid) as repscore LEFT JOIN therapysuggestion on repscore.reportid=therapysuggestion.reportid left JOIN treatment on treatment.id = therapysuggestion.treatmentid GROUP By repscore.reportid DESC");
    //echo "<br/>";
    //SELECT reportId, SUM(score), COUNT(*) FROM tests where testId IN (SELECT testid FROM tests GROUP BY reportId, testType) AND reportid IN (SELECT reportid FROM report WHERE studentid = 11 ) GROUP BY reportId
    //print_r($dbh->error_list);
    if (!$statement) {
        echo "false";
    } else {
        $statement->bind_param("i", $_SESSION['studentid']);
        //echo "here true";
        $statement->execute();
        $statement->bind_result($rid, $TotalScore, $TestsTaken, $TestsName, $TreatmentSuggestion);
    }

    $dbh1 = new mysqli($servername, $username, $password, $dbname);
    $statement1 = $dbh1->prepare("SELECT st.studentId, st.firstName, st.lastName, st.dob, st.address, sc.name as schoolname, sc.address as schooladress from student as st LEFT JOIN school as sc on st.schoolId = sc.id WHERE st.studentId = ? LIMIT 1");
    //echo "<br/>";
    //SELECT reportId, SUM(score), COUNT(*) FROM tests where testId IN (SELECT testid FROM tests GROUP BY reportId, testType) AND reportid IN (SELECT reportid FROM report WHERE studentid = 11 ) GROUP BY reportId
    //print_r($dbh->error_list);
    if (!$statement1) {
        echo "false";
    } else {
        $statement1->bind_param("i", $_SESSION['studentid']);
        //echo "here true";
        $statement1->execute();
        $statement1->bind_result($stid, $stfname, $stlname, $dob, $stadress, $scname, $scaddress);
    }

    // $statement = $dbh->prepare();
    // echo "<br/>";
    // //SELECT reportId, SUM(score), COUNT(*) FROM tests where testId IN (SELECT testid FROM tests GROUP BY reportId, testType) AND reportid IN (SELECT reportid FROM report WHERE studentid = 11 ) GROUP BY reportId
    // //print_r($dbh->error_list);
    // if (!$statement) {
    //     echo "false2";
    // } else {
    //     $statement->bind_param("i", $_SESSION['studentid']);
    //     echo "here true2";
    //     $statement->execute();
    //     $statement->bind_result($rid, $TotalScore, $TestsTaken);
    // }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body style="padding: 10px;">

        <?php include 'nav.html'; ?>

        <div class="row">
            <div class="col-md-8">
                <h1 style="text-align:center;">Student Info</h1>

                <div class="col-md-8">
                    <?php
                        while ($statement1->fetch()) {
                            echo "<h1> <b>Name :</b> $stfname $stlname</h1>";
                            echo "<p> <b>Student ID :</b> $stid</p>";
                            echo "<p> <b>DoB :</b> $dob</p> ";
                            echo "<p> <b>Address :</b> $stadress</p>";
                            echo "<p> <b>School Name :</b> $scname</p>";
                            echo "<p> <b>School Adress :</b> $scaddress</p>";
                            echo "<br ><br>";
                        }
                        $statement1->close();
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <table class="table">
                    <thead>
                        <tr>
                          <th>Report Id</th>
                          <th>Score / Total Score</th>
                          <th>Tests Taken</th>
                          <th>Treatment Suggestions</th>
                          <!-- <th>Date</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while ($statement->fetch()) {
                                echo "<tr>";
                                echo "<td>$rid</td>";
                                echo "<td>".$TotalScore."/".($TestsTaken*40)."</td>";
                                echo "<td>$TestsName</td>";
                                echo "<td>$TreatmentSuggestion</td>";
                                echo "</tr>";
                            }
                            $statement->close();
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-4">
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#therapyModal">
                  Suggest Therapy
                </button>
                <div class="modal fade" id="therapyModal" tabindex="-1" role="dialog" aria-labelledby="therapyModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="therapyModalLabel">Suggest Therapy</h4>
                      </div>
                      <div class="modal-body">
                          <ul>
                              <li>
                                  <label class='checkbox-label ' for='suggestion'>
                                      <input name='suggestion' type='checkbox' value='1'/>
                                      <span>Chewable pencil tops</span>
                                  </label>
                              </li>
                              <li>
                                  <label class='checkbox-label' for='suggestion'>
                                      <input name='suggestion' type='checkbox' value='2'/>
                                      <span>Squishy Bangels</span>
                                  </label>
                              </li>
                              <li>
                                  <label class='checkbox-label' for='topping'>
                                      <input name='suggestion' type='checkbox' value='3'/>
                                      <span>Jumping on trampoline</span>
                                  </label>
                              </li>
                              <li>
                                  <label class='checkbox-label' for='topping'>
                                      <input name='suggestion' type='checkbox' value='4'/>
                                      <span>Practice how to catch a ball</span>
                                  </label>
                              </li>
                              <li>
                                  <label class='checkbox-label' for='topping'>
                                      <input name='suggestion' type='checkbox' value='5'/>
                                      <span>Paper rolls building</span>
                                  </label>
                              </li>
                              <li>
                                  <label class='checkbox-label' for='topping'>
                                      <input name='suggestion' type='checkbox' value='6'/>
                                      <span>Airplane catch</span>
                                  </label>
                              </li>
                              <li>
                                  <label class='checkbox-label' for='topping'>
                                      <input name='suggestion' type='checkbox' value='7'/>
                                      <span>Squeeze the puffy paint</span>
                                  </label>
                              </li>

                          </ul>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="suggestTherapy();">Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>
                <br>
                <br>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#feesModal">
                  Pay Fees
                </button>

                <!-- Modal -->
                <div class="modal fade" id="feesModal" tabindex="-1" role="dialog" aria-labelledby="feesModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="feesModalLabel">Pay Here</h4>
                      </div>
                      <div class="modal-body">
                        <p>Amount Due: $100</p>
                        Amount : <input type="text" name="amount" id="feeamount">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="payFees();">Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>

        </div>
    </body>
    <script type="text/javascript">
        function suggestTherapy() {
            var suggestions = [];
            $("input:checkbox[name=suggestion]:checked").each(function(){
                suggestions.push($(this).val());
            });

            var form = document.createElement("form");
            form.setAttribute("method", "post");
            form.setAttribute("action", "./therapy_suggestion.php");

            for (var i = 0, len = suggestions.length; i < len; i++) {
                var temp= document.createElement("input");
                temp.setAttribute("type", "hidden");
                temp.setAttribute("name", "suggestions[]");
                temp.setAttribute("value", suggestions[i]);
                form.appendChild(temp);
            }

            document.body.appendChild(form);
            form.submit();
        }

        function payFees() {

            var form = document.createElement("form");
            form.setAttribute("method", "post");
            form.setAttribute("action", "./payfees.php");

            var temp= document.createElement("input");
            temp.setAttribute("type", "hidden");
            temp.setAttribute("name", "amount");
            temp.setAttribute("value", document.getElementById('feeamount').value);
            form.appendChild(temp);

            document.body.appendChild(form);
            form.submit();
        }
    </script>
</html>
