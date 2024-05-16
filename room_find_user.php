<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


    <title>Room Scheduling System</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
    background-color: #343a40;
    color: white;
    padding: 10px 20px; 
    text-align: center;
    margin: 0;
}

header img {
    width: 80px; 
    height: auto;
    margin-right: 10px; 
    vertical-align: middle;
}

header h1 {
    margin: 0;
    font-size: 20px; 
    display: inline-block;
    vertical-align: middle;
}


        .navbar-container {
            display: flex;
            justify-content: center;
            background-color: darkcyan; 
        }

        .navbar {
            width: 100%;
            max-width: 1000px; 
            margin-right: -500px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
            padding: 10px 20px;
            display: inline-block;
            white-space: nowrap; 
            font-size: 20px;
        }

        .navbar a:hover {
            color: lightblue;
            text-decoration: none;
            background-color: rgba(255,255,255,0.1); 
            border-radius: 5px; 
        }


        .container {
            width: 90%;
            max-width: 800px;
            background-color: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
        }

        table {
            width: 90%;
            margin-bottom: 20px;
            
        }

        table th,
        table td {
            text-align: center;
            padding: 15px;
            text-align: center;
        }

        input[type="text"],
        input[type="submit"] {
            width: calc(100% - 30px);
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border-radius: 8px;
            border: 1px solid #ced4da;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

      
        footer {
            width: 100%;
            background-color: #34495e;
            color: white;
            padding: 20px;
            text-align: center;
            flex-shrink: 0;
            margin-top: auto;
            box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.1);
        }

        .footer-link-1 {
            color: #ecf0f1;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-link-1:hover {
            color: lightblue;
            text-decoration: none;
        }

        .footer-link-2 {
            color: #ecf0f1;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-link-2:hover {
            color: #c0392b;
            text-decoration: none;
        }

        .footer-link-3 {
            color: #ecf0f1;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-link-3:hover {
            color: #2ecc71;
            text-decoration: none;
        }

        .footer-link-4 {
            color: #ecf0f1;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-link-4:hover {
            color: #d35400;
            text-decoration: none;
        }

        .filter-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .filter-item {
            flex: 0 0 48%;
            margin-bottom: -10px;

        }
    </style>
</head>

<body>
    <header>
        <img src="BUBT.png" alt="">
        <h1 style="margin: 0; font-size: 24px;">Bangladesh University Of Business & Technology</h1>
    </header>
  
    <div class="navbar-container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="welcome.php">Home <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link active" href="sectionwise_routine_user.php">Student Routine <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link active" href="routine_with_teacher_user.php">Teacher Routine <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link active" href="index.php">Logout <span class="sr-only">(current)</span></a>
                </div>
            </div>
        </nav>
    </div>
   

    <div class="container">
    <h2 class="text-center mb-4">Enter Day</h2>
    <form id="searchForm" class="mb-4" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="row">
            <div class="col-md-6">
                <label for="day"></label>
                <input type="text" name="day" id="day" required list="days" class="form-control">
                <datalist id="days">
                    <option value="Monday">
                    <option value="Tuesday">
                    <option value="Wednesday">
                    <option value="Thursday">
                    <option value="Friday">
                    <option value="Saturday">
                    <option value="Sunday">
                </datalist>
            </div>
            <div class="col-md-3">
                <label for="buildingFilter">Filter by Building:</label>
                <select id="buildingFilter" class="form-select">
                    <option value="">All Buildings</option>
                    <?php
                    include 'conn.php';

                    $sql = "SELECT DISTINCT building FROM room_details ORDER BY building ASC";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['building'] . "'>" . $row['building'] . "</option>";
                        }
                    }
                    $conn->close();
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="timeFilter">Filter by Time:</label>
                <select id="timeFilter" class="form-select">
                    <option value="">All Times</option>
                    <option value="08:00 AM - 09:15 AM">08:00 AM - 09:15 AM</option>
                    <option value="09:15 AM - 10:30 AM">09:15 AM - 10:30 AM</option>
                    <option value="10:30 AM - 11:45 AM">10:30 AM - 11:45 AM</option>
                    <option value="11:45 AM - 01:00 PM">11:45 AM - 01:00 PM</option>
                    <option value="01:30 PM - 02:45 PM">01:30 PM - 02:45 PM</option>
                    <option value="02:45 PM - 04:00 PM">02:45 PM - 04:00 PM</option>
                    <option value="04:00 PM - 05:15 PM">04:00 PM - 05:15 PM</option>
                    <option value="05:15 PM - 06:30 PM">05:15 PM - 06:30 PM</option>
                </select>
            </div>
        </div>
        <input type="submit" name="submit" value="Find Rooms" class="btn btn-primary mt-3">
    </form>

    <div id="roomTable">
        <?php
        include 'conn.php';

        if (isset($_POST['submit'])) {
            $day = $_POST['day'];

            $sql = "SELECT room_no, building, time FROM room_details WHERE day = '$day' AND course_teacher IS NULL AND intake IS NULL AND sec IS NULL AND department IS NULL";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<h2 class='text-center mb-3'>Available Rooms for $day</h2>";
                echo "<div class='table-responsive'>";
                echo "<table class='table table-striped'>";
                echo "<thead><tr><th class='text-center'>Day</th><th class='text-center'>Time</th><th class='text-center'>Room No</th><th class='text-center'>Building</th></tr></thead>";
                echo "<tbody>";
                while ($row = $result->fetch_assoc()) {
                    $time = $row["time"];
                    echo "<tr class='roomRow' data-time='$time' data-building='" . $row["building"] . "'><td class='text-center'>$day</td><td class='text-center'>$time</td><td class='text-center'>" . $row["room_no"] . "</td><td class='text-center'>" . $row["building"] . "</td></tr>";
                }
                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            } else {
                echo "<h2 class='text-center'>No Available Rooms for $day</h2>";
            }
        }
        $conn->close();
        ?>
    </div>
</div>


<script>
    document.getElementById("timeFilter").addEventListener("change", filterRooms);
    document.getElementById("buildingFilter").addEventListener("change", filterRooms);
    document.getElementById("day").addEventListener("input", filterRooms);

    function filterRooms() {
        var selectedTime = document.getElementById("timeFilter").value;
        var selectedBuilding = document.getElementById("buildingFilter").value;
        var selectedDay = document.getElementById("day").value.toLowerCase(); 
        var roomRows = document.getElementsByClassName("roomRow");
        for (var i = 0; i < roomRows.length; i++) {
            var rowTime = roomRows[i].getAttribute("data-time");
            var rowBuilding = roomRows[i].getAttribute("data-building");
            var rowDay = roomRows[i].getElementsByTagName("td")[0].innerText.toLowerCase(); 

            var showTime = selectedTime === "" || rowTime.includes(selectedTime); 
            var showBuilding = selectedBuilding === "" || selectedBuilding === rowBuilding;
            var showDay = selectedDay === "" || selectedDay === rowDay;

            if (showTime && showBuilding && showDay) {
                roomRows[i].style.display = "table-row";
            } else {
                roomRows[i].style.display = "none";
            }
        }
    }
</script>

<?php require 'footer.php'
   ?>
</body>

</html>