<?php
    $conn = mysqli_connect('localhost','dipanshu','dipanshu23','project');
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $field = $_POST['field'];
    $query = "SELECT * FROM pollution_data";
    $result = $conn->query($query);
    $maximum = 0;
    while($row = mysqli_fetch_array($result)){
        $date= explode(" ",$row['TIMESTAMP'])[0];
        $mm = explode('/',$date)[0];
        $dd = explode('/',$date)[1];
        $yy = explode('/',$date)[2];
        
    }
?>