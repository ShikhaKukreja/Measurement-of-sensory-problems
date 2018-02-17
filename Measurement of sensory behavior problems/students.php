<?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "ttherapy";

    $dbh = new mysqli($servername, $username, $password, $dbname);
    $statement = $dbh->prepare("SELECT id, name FROM school");

    if (!$statement) {
        echo "false";
    } else {
        // echo "here true";
        $statement->execute();
        $statement->bind_result($scid, $scname);
    }

    $dbh1 = new mysqli($servername, $username, $password, $dbname);
    $statement1 = $dbh1->prepare("SELECT st.studentId, st.firstName, st.lastName, st.dob, st.address, sc.name as schoolname, sc.address as schooladress from student as st LEFT JOIN school as sc on st.schoolId = sc.id");

    if (!$statement1) {
        echo "false";
    } else {
        // echo "here true";
        $statement1->execute();
        $statement1->bind_result($stid, $stfname, $stlname, $dob, $stadress, $scname, $scaddress);
    }

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

        <div class="page-header">
          <h1>Students <small>All students info</small></h1>
        </div>
        <div class="col-md-7">
            <table class="table">
                <thead>
                    <tr>
                      <th>Student ID</th>
                      <th>Name</th>
                      <th>DoB</th>
                      <th>Address</th>
                      <th>School Name</th>
                      <!-- <th>School Address</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($statement1->fetch()) {
                            echo "<tr>";
                            echo "<td>$stid</td>";
                            echo "<td>$stfname $stlname</td>";
                            echo "<td>$dob</td> ";
                            echo "<td>$stadress</td>";
                            echo "<td>$scname</td>";
                            // echo "<td>$scaddress</td>";
                            echo "</tr>";
                        }
                        $statement1->close();
                    ?>
                </tbody>
            </table>

        </div>
        <div class="col-md-4">
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#studentModal">
              Add a Student
            </button>
            <div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="studentModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="studentModalLabel">Add Student Info</h4>
                  </div>
                  <form class="" action="addstudent.php" method="post">
                      <div class="modal-body">

                          <div class="form-group">
                            <label for="fname">First Name</label>
                            <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name">
                          </div>
                          <div class="form-group">
                            <label for="lname">Last Name</label>
                            <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name">
                          </div>
                          <div class="form-group">
                            <label for="dob">Birth Date</label>
                            <input type="date" class="form-control" id="dob" name="dob">
                          </div>
                          <div class="form-group">
                            <label for="adress">Address</label>
                            <input type="text" class="form-control" id="adress" name="address" placeholder="Student Adress">
                          </div>
                          <div class="form-group">
                              <label for="school">School Name</label>
                              <select class="form-control" id="school" name="school">
                                  <?php
                                      while ($statement->fetch()) {
                                          echo "<option value='$scid'>$scname</option>";
                                      }
                                   ?>
                                  <!-- <option value="1">SJSU</option>
                                  <option value="2">Stanford</option>
                                  <option value="3">Berkley</option>
                                  <option value="4">CSU</option>
                                  <option value="5">De Anza</option> -->
                              </select>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                      </div>
                   </form>
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

    </script>
</html>
