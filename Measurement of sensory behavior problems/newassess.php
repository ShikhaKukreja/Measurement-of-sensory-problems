<html>

<head>
    <title> Form for Occupational Therapist</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>

<body>
    <?php include 'nav.html'; ?>
    <h1><center>Analysis of student's behavior</center></h1>
    <h4><center>Form to be filled by Occupational Therapist</center></h4>
    <br>
    <div class="col-md-4">

    </div>
    <div class="col-md-6">
        <form name="testForm" action="start.php" method="POST" style="margin-left:30px;">
            <h2>
                <b>Student ID: </b>
                <input type="text" id="stid" name="studentid">
            </h2>

            <input class="btn btn-primary btn-lg" type="submit" value="Start" />
        </form>

    </div>
</body>

</html>
