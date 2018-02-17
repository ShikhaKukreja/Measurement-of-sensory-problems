<html>
<head>
<style type="text/css">
#chart-container{
	width: 640px;
	height: auto;
}
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://code.highcharts.com/highcharts.src.js"></script>
</head>
<body>
<div id="chart-container">
<canvas id="mycanvas"></canvas>
</div>
<?php
// include('./php-wrapper/fusioncharts.php');


$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "ttherapy";
// Create connection
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $sql1 = "SELECT SUM(ts.scoreSum) AS TOTALSCORE, d.monthdate, st.studentfirstname, st.studentlastname FROM studentdw st,total_score ts, date d WHERE ts.studentkey = st.StudentKey AND d.dateKey = ts.datekey and st.studentkey = 15 GROUP BY d.monthdate";

 $drillResult = $conn->query($sql1);
 $rowDrill = $drillResult->fetchAll();
 $sqlQuarter = "SELECT SUM(ts.scoreSum) as TOTALSCORE, d.datequarter, st.studentfirstname, st.studentlastname FROM studentdw st, total_score ts, date d WHERE ts.studentkey = st.StudentKey AND d.dateKey = ts.datekey GROUP BY d.datequarter, st.studentfirstname";
 $drillQuarter = $conn->query($sqlQuarter);
 $resultDrill = $drillQuarter->fetchAll();
 $sqlDayofMonth = "SELECT SUM(ts.scoreSum) as TOTALSCORE, d.dayofmonth, st.studentfirstname, st.studentlastname FROM studentdw st, total_score ts, date d WHERE ts.studentkey = st.StudentKey AND d.dateKey = ts.datekey GROUP BY d.dayofmonth, st.studentfirstname";
 $drillDayOfMonth = $conn->query($sqlDayofMonth);
 $resultDayofMonth = $drillDayOfMonth->fetchAll();
 $sqlDayofWeek = "SELECT SUM(ts.scoreSum) as TOTALSCORE, d.dayofweek, st.studentfirstname, st.studentlastname FROM studentdw st, total_score ts, date d WHERE ts.studentkey = st.StudentKey AND d.dateKey = ts.datekey GROUP BY d.dayofweek, st.studentfirstname";
 $drillDayOfWeek = $conn->query($sqlDayofWeek);
 $resultDayofWeek = $drillDayOfWeek->fetchAll();
$sql = "SELECT SUM(ts.scoreSum) AS TOTALSCORE, d.monthdate, st.studentfirstname, st.studentlastname FROM studentdw st,total_score ts, date d WHERE ts.studentkey = st.StudentKey AND d.dateKey = ts.datekey GROUP BY d.monthdate,st.studentfirstname";
$result = $conn->query($sql);
$rowResult = $result->fetchAll();

echo '<pre>' . var_export($rowDrill, true) . '</pre>';
// If the query returns a valid response, prepare the JSON string
            // The `$arrData` array holds the chart attributes and data
            $arrData = array(
                "chart" => array(
                  "caption" => "Top 10 Most Populous Countries",
                  "showValues" => "0",
                  "theme" => "zune"
                  )
               );

            $arrData["data"] = array();
echo "Finding the total scores of students for every month ";
foreach ($rowDrill as $key=>$val) {
    array_push($arrData["data"], array(
                  "label" => $key,
                  "month" => $rowDrill[$key]['monthdate'],
                  "value" => $rowDrill[$key]['TOTALSCORE']
                  )
               );
}

/*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

            $jsonEncodedData = json_encode($arrData);
/*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/
?>
<div class="" id="container3">

</div>
<script type="text/javascript">
    var data = <?php echo $jsonEncodedData ?>.data;

    console.log(data);
    var temp = { "name" : "student score", data : [0,0,0,0,0,0,0,0,0,0,0,0]};
    for(var i =0; i<data.length; i++){
        temp.data[parseInt(data[i].month)-1] = parseInt(data[i].value);
    }
    console.log(temp);
    var dataset = [];
    dataset.push(temp);

    $(function () {
        Highcharts.chart('container3', {
            chart: {
                type: 'bar',
                marginLeft: i === 0 ? 100 : 10
            },
            title: {
                text: 'Score by month'
            },
            xAxis: {
                categories: ['1','2','3','4','5','6','7','8','9','10','11','12'],
                crosshair: true
            },
            yAxis: {
                min: 0,
                max: 200
            },
            series: [dataset]
        });
    });
</script>
<?php
echo"Finding the total score of students by year";
foreach ($rowDrill as $key=>$val) {
    ?>

<tr>
<td>
TotalScore:
</td>
<td>
<?php
echo $rowDrill[$key]['TOTALSCORE']; ?>
</td>
<td>
Year
</td>
<td>
<?php
echo $rowDrill[$key]['yeardate']; ?>
</td>
<td>
Student First name:
</td>
<td>
<?php
echo $rowDrill[$key]['studentfirstname']; ?>
</td>
<td>
Student Last name:
</td>
<td>
<?php
echo $rowDrill[$key]['studentlastname']; ?>
</td>
</tr>
<?php

}
echo "Finding total scores of all the students quarter";
foreach ($resultDrill as $key=>$val) {
    ?>
<tr>
<td>Total Score:</td>
<td>
<?php
echo $resultDrill[$key]['TOTALSCORE']; ?>
</td>
<td>Quarter:</td>
<td><?php
echo $resultDrill[$key]['datequarter']; ?></td>
<td>Firstname:</td>
<td><?php
echo $resultDrill[$key]['studentfirstname']; ?>
</td>
<td>Lastname:</td>
<td>
<?php
echo $resultDrill[$key]['studentlastname']; ?>
</td>
</tr>
<?php

}
echo "Finding total scores of all the students by day of month";
foreach ($resultDayofMonth as $key=>$val) {
    ?>
<tr>
<td>
TotalScore:
</td>
<td>
<?php
echo $resultDayofMonth[$key]['TOTALSCORE']; ?>
</td>
<td>
Day of month:
</td>
<td>
<?php
echo $resultDayofMonth[$key]['dayofmonth']; ?>
</td>
<td>Firstname:</td>
<td>
<?php
echo $resultDayofMonth[$key]['studentfirstname']; ?>
</td>
<td>Lastname:</td>
<td>
<?php
echo $resultDayofMonth[$key]['studentlastname']; ?>
</td>
</tr>
<?php

}
echo "Finding total scores for students by day of week";
foreach ($resultDayofWeek as $key=>$value) {
    ?>
	<tr>
	<td>Total Score:</td>
	<td>
	<?php
echo $resultDayofWeek[$key]['TOTALSCORE']; ?>
	</td>
	<td>
	Day of week:
	</td>
	<td>
	<?php
    echo $resultDayofWeek[$key]['dayofweek']; ?>
	</td>
	<td>
	Firstname:
	</td>
	<td>
	<?php
    echo $resultDayofWeek[$key]['studentfirstname']; ?>
	</td>
	<td>
	Lastname:
	</td>
	<td>
	<?php
echo $resultDayofWeek[$key]['studentlastname']; ?>
	</td>
	</tr>
<?php

}
?>
</table>
</body


</html>
