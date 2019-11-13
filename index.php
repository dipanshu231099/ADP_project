<html>

    <head>
        <title>Mini project</title>
        <link rel="stylesheet" href="main.css">

        <script>
        function ajax(){
                var max = document.getElementById("max").checked;
                var min = document.getElementById("min").checked;
                var avg = document.getElementById("avg").checked;
                var str="";
                if(max){str+="max"};
                if(min){str+="min"};
                if(avg){str+="avg"};

                var from_date = document.getElementById("from_date").value;
                var to_date = document.getElementById("to_date").value;
                var field = document.getElementById("field").value;
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "gethint.php?from_date=" + from_date + "&to_date="+to_date+"&field="+field+"&q="+str, true);
                xmlhttp.send();
            }
        </script>
    </head>

<body>
    <h1>Using php</h1>
<method1>
    <form action="result.php" method="POST">
        <label for="from_date">From: </label>
        <input type="date" name="from_date">

        <label for="to_date">To: </label>
        <input type="date" name="to_date"><br><br>

        <div class="dropdown">
            <select name="field" style="color: white'; background-color:black;">

                <?php 
                    $conn = mysqli_connect('localhost','dipanshu','dipanshu23','project');
                    $result = $conn -> query("DESC pollution_data");
                    while($row = mysqli_fetch_array($result)) {
                        echo "<option value='".$row['Field']."'>".$row['Field']."</option>";
                    }
                    
                ?>
            </select>
        </div>
        <br>
        <button type="submit">Submit Query</button>
        <br><br>
        <label for="max">Maximum: </label> <input type="checkbox" name="max">
        <label for="min">Minimum: </label> <input type="checkbox" name="min" id="">
        <label for="avg">Average: </label> <input type="checkbox" name="avg">
    </form>
</method1>

    <h1>Using Ajax</h1>
<method2>
<form>
        <label for="from_date">From: </label>
        <input type="date" name="from_date" id="from_date">

        <label for="to_date">To: </label>
        <input type="date" name="to_date" id="to_date"><br><br>

        <div class="dropdown">
            <select name="field" style="color: white'; background-color:black;" id="field">

                <?php 
                    $conn = mysqli_connect('localhost','dipanshu','dipanshu23','project');
                    $result = $conn -> query("DESC pollution_data");
                    while($row = mysqli_fetch_array($result)) {
                        echo "<option value='".$row['Field']."'>".$row['Field']."</option>";
                    }
                    
                ?>
            </select>
        </div>
        <br>
        
        <label for="max">Maximum: </label> <input type="checkbox" name="max" id="max" value="dipanshu">
        <label for="min">Minimum: </label> <input type="checkbox" name="min" id="min" value="dipanshu">
        <label for="avg">Average: </label> <input type="checkbox" name="avg" id="avg" value="dipanshu">
        <br><br>
        <input type="button" value="Submit Query Ajax" onclick="ajax()">
        <br><br>
        <p id="txtHint"></p>
    </form>

    
</method2>
</body>


</html>