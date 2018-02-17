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
    <p style="font-size:36px; color: purple; font-family: Century Gothic;">Balance </p>
    <div class="">
        <p> Runs hand along wall when walking.</p>
        <select id="selectOption1" name="selectOption1">
            <option value="1">Never</option>
            <option value="2">Occassionally</option>
            <option value="3">Frequently</option>
            <option value="4">Always</option>
        </select>
        <p>Wraps legs around chair legs.</p>
        <select id="selectOption2" name="selectOption2">
            <option value="1">Never</option>
            <option value="2">Occassionally</option>
            <option value="3">Frequently</option>
            <option value="4">Always</option>
        </select>
        <p>Rocks in chair while seated at desk or table.</p>
        <select id="selectOption3" name="selectOption3">
            <option value="1">Never</option>
            <option value="2">Occassionally</option>
            <option value="3">Frequently</option>
            <option value="4">Always</option>
        </select>
        <p>Fidgets when seated at desk or table.</p>
        <select id="selectOption4" name="selectOption4">
            <option value="1">Never</option>
            <option value="2">Occassionally</option>
            <option value="3">Frequently</option>
            <option value="4">Always</option>
        </select>
        <p>Falls out of chair when seated at desk or table.</p>
        <select id="selectOption5" name="selectOption5">
            <option value="1">Never</option>
            <option value="2">Occassionally</option>
            <option value="3">Frequently</option>
            <option value="4">Always</option>
        </select>
        <p> Leans on walls, furniture, or other epople for support when standing.</p>
        <select id="selectOption6" name="selectOption6">
            <option value="1">Never</option>
            <option value="2">Occassionally</option>
            <option value="3">Frequently</option>
            <option value="4">Always</option>
        </select>
        <p>When seated on floor, cannot sit up without support.</p>
        <select id="selectOption7" name="selectOption7">
            <option value="1">Never</option>
            <option value="2">Occassionally</option>
            <option value="3">Frequently</option>
            <option value="4">Always</option>
        </select>
        <p>Slumps,leans on desk, or holds haed up in hands while seated at desk.</p>
        <select id="selectOption8" name="selectOption8">
            <option value="1">Never</option>
            <option value="2">Occassionally</option>
            <option value="3">Frequently</option>
            <option value="4">Always</option>
        </select>
        <p>Has poor coordination, appears clumsy.</p>
        <select id="selectOption9" name="selectOption9">
            <option value="1">Never</option>
            <option value="2">Occassionally</option>
            <option value="3">Frequently</option>
            <option value="4">Always</option>
        </select>
        <br>
        <br>
        <button class="btn btn-primary btn-lg" onclick="sendTest7();">Next</button>
        <button class="btn btn-primary btn-lg" onclick="skipTest();">Skip</button>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<!-- <script src="scripts.js"></script> -->
<script>
    function sendTest7() {
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
        ttypeField.setAttribute("value", "Balance");

        form.appendChild(ttypeField);

        var tscoreField = document.createElement("input");
        tscoreField.setAttribute("type", "hidden");
        tscoreField.setAttribute("name", "tscore");
        tscoreField.setAttribute("value", tscore);

        form.appendChild(tscoreField);

        document.body.appendChild(form);
        form.submit();
        // skipTest();
    }

    function skipTest() {
        window.location.assign("test8.php");
    }
</script>

</html>
