<html>

    <head>
        <title>Mini project</title>
        <link rel="stylesheet" href="main.css">
    </head>

<body>
    <h1>Using php</h1>
<method1>
    <form action="<!-- to be set -->">
        <label for="from_date">From: </label>
        <input type="date" name="from_date">

        <label for="to_date">To: </label>
        <input type="date" name="to_date"><br><br>

        <div class="dropdown">
            <select style="color: white'; background-color:black;">
                <option value="temperature" selected disabled hidden>temperature</option>
                <?php 
                    $conn = mysqli_connect('localhost','dipanshu','dipanshu23','project');
                    $result = $conn -> query("SELECT distinct(T) FROM pollution_data");
                    while($row = mysqli_fetch_array($result)) {
                        echo "<option value='".$row['T']."'>".$row['T']."</option>";
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
</method2>
</body>
</html>