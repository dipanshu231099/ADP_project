<?php
//enter your username passwd here in place of dipanshu, dipanshu23 respectively.
    $conn = mysqli_connect('localhost','root','','MINIPROJ');
    $from_date = $_POST['from_date'];
    $in_date = new DateTime($from_date . " 01:00:00");

    $to_date = $_POST['to_date'];
    $fin_date = new DateTime($to_date . " 23:00:01");

    $field = $_POST['field'];
    $query = "SELECT * FROM POLLUTION_DATA2";
    $result = $conn->query($query);
    $maximum = 0.00;
    $minimum = 10000.00;
    $avg = 0;
    $count=0;
    while($row = mysqli_fetch_array($result)){
        $date= explode(" ",$row['TIMESTAMP'])[0];
        $mm = (int)explode('/',$date)[0];
        $dd = (int)explode('/',$date)[1];
        $yy = (int)explode('/',$date)[2];
        $date = new DateTime(strval($yy) . "-" . strval($mm) . "-" . strval($dd) . " 12:00:00");
        if($date>$in_date && $date<$fin_date){
            $count++;
            $req_value = $row[$field];
            $avg += (float)$req_value;
            if($req_value > $maximum){
                $maximum = $req_value;
            }
            if($req_value < $minimum){
                $minimum = $req_value;
            }
        }
        
    }
    $avg/=$count;
    $hint = "";
    if($_POST['avg'])$hint.= "average value $avg <br>";
    if($_POST['max']){
        if($maximum != 0)$hint.= "maximum value: $maximum <br>";
        else $hint.= "no value to maximise <br>";
    }
    if($_POST['min']){
        if($minimum!=10000)    $hint.= "minimum value: $minimum <br>";
        else $hint.= "no value to minimise <br>";
    }

    echo $hint;

?>

<?php
$con=mysqli_connect("localhost","root","","MINIPROJ");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$from_date = $_POST['from_date'];
$in_date = new DateTime($from_date . " 01:00:00");


$to_date = $_POST['to_date'];
$fin_date = new DateTime($to_date . " 23:00:01");

$field = $_POST['field'];

$params = array("TIMESTAMP","CO","H","NO2","O3","P","PM_10","PM_1_0","PM_2_5","SO2","T","WS");


// print_r(explode("-",$from_date));

$A = array();

// $a = array_search($field, $params);

function Search($value, $array) 
{ 
    return(array_search($value, $array,false)); 
} 
// echo "***".$field."***";
// print_r(Search($field, $params));

$sql="SELECT * FROM POLLUTION_DATA2";

if ($result=mysqli_query($con,$sql))
  {
  // Fetch one and one row
  while ($row=mysqli_fetch_row($result))
    {
        $date= explode(" ",$row[0])[0];
        $mm = (int)explode('/',$date)[0];
        $dd = (int)explode('/',$date)[1];
        $yy = (int)explode('/',$date)[2];
        $date = new DateTime(strval($yy) . "-" . strval($mm) . "-" . strval($dd) . " 12:00:00");
        if($date>$in_date && $date<$fin_date)
        {
            $A[] = $row[array_search($field, $params)];
        }
    }
  // Free result set
  mysqli_free_result($result);
}

// print_r($A);

mysqli_close($con);

?> 

<!DOCTYPE HTML>
<html>
<head> 

<script>
    var ff= <?php echo json_encode($A);?>;
    var params= <?php echo json_encode($params);?>;
    var field = "<?php echo $field; ?>";
    var obj=[];
    ff.forEach(ll=>{
        obj.push({y:parseFloat(ll)});
    })
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Line Plot : " + field
	},
	axisY:{
		includeZero: false
	},
	data: [{        
		type: "line",       
		dataPoints: obj,
	}]
});
chart.render();

}

</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>
</html>
