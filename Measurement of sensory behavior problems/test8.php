<!DOCTYPE html>
<html>

<head>
    <title>Social Participation Test</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>

<body style="margin:20px;">
    <?php include 'nav.html'; ?>
    <p style="font-size:36px; color: purple; font-family: Century Gothic;">Planning and Ideas</p>
    <div class="">
        <p>Does not perform consistently in daily tasks;quality of work varies widely.</p>
        <select id="selectOption1" name="selectOption1">
            <option value="1">Never</option>
            <option value="2">Occassionally</option>
            <option value="3">Frequently</option>
            <option value="4">Always</option>
        </select>
        <p>Is unable to solve problems effectively.</p>
        <select id="selectOption2" name="selectOption2">
            <option value="1">Never</option>
            <option value="2">Occassionally</option>
            <option value="3">Frequently</option>
            <option value="4">Always</option>
        </select>
        <p>Boobles or drops items when attempting to carry multiple objects.</p>
        <select id="selectOption3" name="selectOption3">
            <option value="1">Never</option>
            <option value="2">Occassionally</option>
            <option value="3">Frequently</option>
            <option value="4">Always</option>
        </select>
        <p>Does not perform tasks in proper sequence.</p>
        <select id="selectOption4" name="selectOption4">
            <option value="1">Never</option>
            <option value="2">Occassionally</option>
            <option value="3">Frequently</option>
            <option value="4">Always</option>
        </select>
        <p>Fails to complete tasks with multiple steps.</p>
        <select id="selectOption5" name="selectOption5">
            <option value="1">Never</option>
            <option value="2">Occassionally</option>
            <option value="3">Frequently</option>
            <option value="4">Always</option>
        </select>
        <p>Has difficulty correctly imitating demonstrations.</p>
        <select id="selectOption6" name="selectOption6">
            <option value="1">Never</option>
            <option value="2">Occassionally</option>
            <option value="3">Frequently</option>
            <option value="4">Always</option>
        </select>
        <p>Has difficulty completing tasks from a presented model.</p>
        <select id="selectOption7" name="selectOption7">
            <option value="1">Never</option>
            <option value="2">Occassionally</option>
            <option value="3">Frequently</option>
            <option value="4">Always</option>
        </select>
        <p>Demonstrates limited imagination and creativity in play and free time.</p>
        <select id="selectOption8" name="selectOption8">
            <option value="1">Never</option>
            <option value="2">Occassionally</option>
            <option value="3">Frequently</option>
            <option value="4">Always</option>
        </select>
        <p>Plays repetitively during free time;does not expand or alter activity when given opportunity.</p>
        <select id="selectOption9" name="selectOption9">
            <option value="1">Never</option>
            <option value="2">Occassionally</option>
            <option value="3">Frequently</option>
            <option value="4">Always</option>
        </select>
        <p>Shows poor organization of materials in, on, or around desk area. </p>
        <select id="selectOption10" name="selectOption10">
            <option value="1">Never</option>
            <option value="2">Occassionally</option>
            <option value="3">Frequently</option>
            <option value="4">Always</option>
        </select>
        <br>
        <br>
        <button class="btn btn-primary btn-lg" onclick="sendTest8();">Next</button>
        <button class="btn btn-primary btn-lg" onclick="skipTest();">Skip</button>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<!-- <script src="scripts.js"></script> -->
<script>
    function sendTest8() {
        // var base = document.querySelector('input[name="pizza-option"]:checked').value;
        // console.log(base)
        // window.localStorage.setItem("base",base);
        // window.location.assign("./step2.html");
        var tscore = parseInt($("#selectOption1 option:selected").val()) +
            parseInt($("#selectOption2 option:selected").val()) +
            parseInt($("#selectOption3 option:selected").val()) +
            parseInt($("#selectOption4 option:selected").val()) +
            parseInt($("#selectOption5 option:selected").val()) +
            parseInt($("#selectOption6 option:selected").val()) +
            parseInt($("#selectOption7 option:selected").val()) +
            parseInt($("#selectOption8 option:selected").val()) +
            parseInt($("#selectOption9 option:selected").val()) ;
        console.log(parseInt($("#selectOption2 option:selected").val()));
        console.log("tscore : " + tscore);

        var form = document.createElement("form");
        form.setAttribute("method", "post");
        form.setAttribute("action", "./score.php");

        var ttypeField= document.createElement("input");
        ttypeField.setAttribute("type", "hidden");
        ttypeField.setAttribute("name", "ttype");
        ttypeField.setAttribute("value", "Planning and Ideas");

        form.appendChild(ttypeField);

        var tscoreField = document.createElement("input");
        tscoreField.setAttribute("type", "hidden");
        tscoreField.setAttribute("name", "tscore");
        tscoreField.setAttribute("value", tscore);

        form.appendChild(tscoreField);

        document.body.appendChild(form);
        form.submit();
        skipTest();
    }

    function skipTest() {
        window.location.assign("final.php");
    }
</script>

</html>
