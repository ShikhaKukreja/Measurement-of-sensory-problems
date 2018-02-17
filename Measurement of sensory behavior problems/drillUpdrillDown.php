<?php
// include('fusioncharts.php');
// $servername = "localhost";
// $username = "root";
// $password = "root";
// $dbname = "ttherapy";
// // Create connection
// $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// // $sql1 = "SELECT SUM(ts.scoreSum) as TOTALSCORE, d.yeardate, st.studentfirstname, st.studentlastname FROM studentdw st, total_score ts, date d WHERE ts.studentkey = st.StudentKey AND d.dateKey = ts.datekey GROUP BY d.yeardate, st.studentfirstname";
// // $drillResult = $conn->query($sql1);
// // $rowDrill = $drillResult->fetchAll();
//
// $sql1 = "SELECT ts.scoreSum as TOTALSCORE, d.fulldate, day(d.fulldate) as day FROM studentdw st, total_score ts, date d WHERE ts.studentkey = st.StudentKey AND d.dateKey = ts.datekey AND d.monthdate = 11 and d.yeardate = 2016 and st.studentkey = 16";
// $drillResult = $conn->query($sql1);
// $rowDrill = $drillResult->fetchAll();
//
// $sql2 = "SELECT avg(ts.scoreSum) as AVGMONTH, d.monthdate as month FROM studentdw st, total_score ts, date d WHERE ts.studentkey = st.StudentKey AND d.dateKey = ts.datekey and st.studentkey = 16 AND d.yeardate = 2016 GROUP BY d.monthdate";
//
//
// $monthdrillResult = $conn->query($sql2);
// $rowmonthDrill = $monthdrillResult->fetchAll();
//
//
// $sql3 = "SELECT avg(ts.scoreSum) as AVGYEAR, d.yeardate as year FROM studentdw st, total_score ts, date d WHERE ts.studentkey = st.StudentKey AND d.dateKey = ts.datekey and st.studentkey = 16 AND d.yeardate >2009 AND d.yeardate<2018 GROUP BY d.yeardate";
//
//
// $yeardrillResult = $conn->query($sql3);
// $rowyearDrill = $yeardrillResult->fetchAll();
//
// $arrDayOfMonth = array(
//                 "chart" => array(
//                   "caption" => "Score of student by day",
//                   "showValues" => "0",
//                   "theme" => "zune"
//                   )
//                );
// $arrDayOfMonth["data"] = array_fill(0, 30, 0);
// //var_dump($arrDayOfMonth);
//
//
// $arrMonth = array(
//                 "chart" => array(
//                   "caption" => "Average score of student by month",
//                   "showValues" => "0",
//                   "theme" => "zune"
//                   )
//                );
// $arrMonth["data"] = array_fill(0, 12, 0);
// $arrMonth["data"] = array();
// // echo '<pre>' . var_export($arrMonth, true) . '</pre>';
//
//
// $arrYear = array(
//                 "chart" => array(
//                   "caption" => "Average score of student by year",
//                   "showValues" => "0",
//                   "theme" => "zune"
//                   )
//                );
// $arrYear["data"] = array();
// // echo '<pre>' . var_export($arrMonth, true) . '</pre>';

?>

<html>
<head>
<style type="text/css">
#chart-container{
	width: 640px;
	height: auto;
}
</style>
<!--<script src="/Occupational_therapy/view/jquery-fusioncharts"></script>-->
<script type="text/javascript" src="fusioncharts/js/fusioncharts.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script type="text/javascript" src="fusioncharts/plugin/package/fusioncharts-jquery-plugin.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!--[if lt IE 9]>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
<![endif]-->
</head>
<body>
<?php include 'nav.html'; ?>
<!--
<select id="selectOption1">
    <option value="1">Day wise</option>
    <option value="2">Month Wise</option>
    <option value="3">Year Wise</option>
</select> -->
<!--
<button type="button" onclick=DayWise() name="button">Day Wise</button>
<button type="button" onclick=MonthWise() name="button">Month Wise</button>
<button type="button" onclick=YearWise() name="button">Year Wise</button> -->

<div id='daywise'>

    <div class="col-md-3">
        <form name="daywiseForm" action="daywise.php" method="POST">
            <h2>Day Wise Analysis</h2>
            <div class='form-row'>
                <label for='dstid'>Student ID</label>
                <input id='dstid' name='dstid' type='text' />
            </div>
            <div class='form-row'>
                <label for='cmonth'>Month</label>
                <input id='cmonth' name='cmonth' type='text' />
            </div>
            <div class='form-row'>
                <label for='cyear'>Year</label>
                <input id='cyear' name='cyear' type='text' />
            </div>

            <input class="btn btn-primary btn-md" type="submit" value="Submit" />
        </form>
    </div>
    <div class="col-md-3">
        <h2>Month Wise Analysis</h2>
        <form name="monthwiseForm" action="monthwise.php" method="POST">
            <div class='form-row'>
                <label for='mstid'>Student ID</label>
                <input id='mstid' name='mstid' type='text' />
            </div>
            <div class='form-row'>
                <label for='myear'>Year</label>
                <input id='myear' name='myear' type='text' />
            </div>

            <input class="btn btn-primary btn-md" type="submit" value="Submit" />
        </form>
    </div>
    <div class="col-md-3">
        <form name="yearwise" action="yearwise.php" method="POST">
            <h2>Year Wise Analysis</h2>
            <div class='form-row'>
                <label for='ystid'>Student ID</label>
                <input id='ystid' name='ystid' type='text' />
            </div>
            <input class="btn btn-primary btn-md" type="submit" value="Year Wise Graph" />
        </form>
    </div>
    <div class="col-md-3">
        <h2>Therapist Earnings Analysis</h2>
        <input class="btn btn-primary btn-md" type="submit" value="Therapist Earnings" />
    </div>
</div>


<div id="chart-1" >

<!--<canvas id="mycanvas"></canvas>-->
</div>
<div id="chart-2" >
<!--<canvas id="mycanvas"></canvas>-->
</div>
<div id="chart-3" >
<!--<canvas id="mycanvas"></canvas>-->
</div>
<div id="chart-4">
<!--<canvas id="mycanvas"></canvas>-->
</div>
<div id="chart-5">
<!--<canvas id="mycanvas"></canvas>-->
</div>
<?php
//
// foreach ($rowDrill as $key=>$val) {
//     $arrDayOfMonth["data"][$rowDrill[$key]['day']] =  array(
//                 "label" => $rowDrill[$key]['fulldate'],
//                 "value" => $rowDrill[$key]['TOTALSCORE']
//                );
// }
//
// foreach ($rowmonthDrill as $key=>$val) {
//     array_push($arrMonth["data"], array(
//                 "label" => $rowmonthDrill[$key]['month'],
//                 "value" => $rowmonthDrill[$key]['AVGMONTH']
//                ));
//     // $arrMonth["data"][$rowmonthDrill[$key]['month']] =  array(
//     //             "label" => $rowmonthDrill[$key]['month'],
//     //             "value" => $rowmonthDrill[$key]['AVGMONTH']
//     //            );
// }
//
// foreach ($rowyearDrill as $key=>$val) {
//     array_push($arrYear["data"], array(
//                 "label" => $rowyearDrill[$key]['year'],
//                 "value" => $rowyearDrill[$key]['AVGYEAR']
//             ));
//     // $arrYear["data"][$rowyearDrill[$key]['year']] =  array(
//     //             "label" => $rowyearDrill[$key]['year'],
//     //             "value" => $rowyearDrill[$key]['AVGYEAR']
//     //            );
// }
//
// // echo '<pre>' . var_export($arrYear, true) . '</pre>';
//
// /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */
// $jsonEncodedDayofMonth = json_encode($arrDayOfMonth);
//
// $jsonEncodedMonth = json_encode($arrMonth);
//
// $jsonEncodedYear = json_encode($arrYear);
// /*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/
//
//              $columnChartDayofMonth = new FusionCharts("column2D", "chart-dayofmonth", 600, 300, "chart-1", "json", $jsonEncodedDayofMonth);
//
//              $columnChartMonth = new FusionCharts("column2D", "chart-month", 600, 300, "chart-2", "json", $jsonEncodedMonth);
//
//              $columnChartYear = new FusionCharts("column2D", "chart-year", 600, 300, "chart-3", "json", $jsonEncodedYear);
//
//             // Render the chart
//             $columnChartDayofMonth->render();
//             $columnChartMonth->render();
//             $columnChartYear->render();

?>
</table>
</body>
<script type="text/javascript">
$(document).ready(function(){

    $('#selectOption1').on('change', function() {

      if ( this.value == '1')
      {
          console.log("daywise");

          $("#DayWise").show();

        // $("#chart1").show();
        // $("#chart2").hide();
        // $("#chart3").hide();
      }
      else if( this.value == '2')
      {
          console.log("monthwise");
          $("#MonthWise").show();

        //   $("#chart1").hide();
        //   $("#chart2").show();
        //   $("#chart3").hide();
      }
      else if( this.value == '3')
      {
          console.log("yearwise");

          $("#YearWise").show();
        //   $("#chart1").hide();
        //   $("#chart2").hide();
        //   $("#chart3").show();
      }
    });
});
</script>
</html>
