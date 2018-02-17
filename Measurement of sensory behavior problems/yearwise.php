<?php
include('fusioncharts.php');

// Create connection
if (
    isset($_POST['ystid'])
) {
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "ttherapy";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// $sql1 = "SELECT SUM(ts.scoreSum) as TOTALSCORE, d.yeardate, st.studentfirstname, st.studentlastname FROM studentdw st, total_score ts, date d WHERE ts.studentkey = st.StudentKey AND d.dateKey = ts.datekey GROUP BY d.yeardate, st.studentfirstname";
// $drillResult = $conn->query($sql1);
// $rowDrill = $drillResult->fetchAll();

    $studentid = $_POST['ystid'];

    $sql1 = "SELECT avg(ts.scoreSum) as AVGYEAR, d.yeardate as year FROM studentdw st, total_score ts, date d WHERE ts.studentkey = st.StudentKey AND d.dateKey = ts.datekey and st.studentkey = :stid AND d.yeardate >2009 AND d.yeardate<2018 GROUP BY d.yeardate";

    $sql12 = $conn->prepare($sql1);

    $sql12->bindParam(':stid', $studentid);

    $sql12->execute();

    $rowyearDrill = $sql12->fetchAll();


    $arrYear = array(
                    "chart" => array(
                      "caption" => "Average score of student by year",
                      "showValues" => "0",
                      "theme" => "zune",
                      "xAxisName"=> "Year",
                      "yAxisName"=> "Score"
                      )
                   );
    $arrYear["data"] = array();
//var_dump($arrDayOfMonth);
}
// echo '<pre>' . var_export($arrMonth, true) . '</pre>';

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
<div class="col-md-4">

</div>
<div >

    <div id="chart-1" >

    <!--<canvas id="mycanvas"></canvas>-->
    </div>
</div>
<?php


foreach ($rowyearDrill as $key=>$val) {
    array_push($arrYear["data"], array(
                "label" => $rowyearDrill[$key]['year'],
                "value" => $rowyearDrill[$key]['AVGYEAR']
            ));
}
/*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */
$jsonEncodedYear = json_encode($arrYear);

/*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/
$columnChartYear = new FusionCharts("column2D", "chart-year", 600, 300, "chart-1", "json", $jsonEncodedYear);



            // Render the chart
$columnChartYear->render();

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
