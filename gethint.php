<?php
    $conn = mysqli_connect('localhost','dipanshu','dipanshu23','project');
    $from_date = $_REQUEST['from_date'];
    $in_date = new DateTime($from_date . " 01:00:00");

    $to_date = $_REQUEST['to_date'];
    $fin_date = new DateTime($to_date . " 23:00:01");

    $field = $_REQUEST['field'];
    $query = "SELECT * FROM pollution_data";
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
    $q = $_REQUEST["q"];
    $hint = "";
    if(strpos($q,"avg")!==false)$hint.= "average value $avg <br>";
    if(strpos($q,"max")!==false){
        if($maximum != 0)$hint.= "maximum value: $maximum <br>";
        else $hint.= "no value to maximise <br>";
    }
    if(strpos($q, "min")){
        if($minimum!=10000)$hint.= "minimum value: $minimum <br>";
        else $hint.= "no value to minimise <br>";
    }
    echo $hint;
?>