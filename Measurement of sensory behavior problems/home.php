<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">

    <title>Home</title>
    <meta name="description" content="HTML exercise">
    <link rel='stylesheet' href='style.css' />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<body>
    <?php include 'nav.html'; ?>
    <header class='home-header'>
        <h1 style="text-align:center;">Occupational Therapy</h1>
        <p style="text-align:center;"><em>Welcome to student assessment.</em></p>
        <br>
        <br>
        <div class="col-md-3">

        </div>

        <div class="col-md-4" style="margin-left:175px">
            <button class="btn btn-primary btn-lg" onclick="takeatest()">Take a test</button>
            <button class="btn btn-primary btn-lg" onclick="liststudents()">List of Students</button>
            <button class="btn btn-primary btn-lg" onclick="dashboard()">Dashboard</button>
        </div>
    </header>


    <script type="text/javascript">
        function takeatest() {
            window.location.assign("newassess.php");
        }
        function liststudents() {
            window.location.assign("students.php");
        }
        function dashboard() {
            window.location.assign("drillupdrilldown.php");
        }
    </script>
</body>

</html>
