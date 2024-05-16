<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <title>Room Scheduling System</title>
    <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: skyblue;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
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
font-size: 16px;    
    }

        .navbar a {
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
            padding: 10px 20px;
            display: inline-block;
            white-space: nowrap; 
            text-align: center;
           
        }

        .navbar a:hover {
            color: lightblue;
            text-decoration: none;
            background-color: rgba(255,255,255,0.1); 
            border-radius: 5px; 
        }


.container {
    text-align: center;
    margin-top: 20px;
}

footer {
    width: 97.30%;
    max-width: 100%;
    background-color: #34495e;
    color: white;
    padding: 20px;
    text-align: center;
    flex-shrink: 0;
    margin-top: 5px;
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

table {
    width: 100%;
    max-width: 100%;
    border-collapse: collapse;
    margin-top: 6px;
}

th,
td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

th {
    background-color: #007bff;
    color: white;
    cursor: pointer; 
    transition: background-color 0.3s ease; 
}

th:hover {
    background-color: #0056b3; 
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}
    </style>
</head>

<body>
<header>
    <img src="BUBT.png" alt="">
    <h1 style="margin: 0; font-size: 24px;">Bangladesh University Of Business & Technology</h1>
</header>

<div class="navbar-container">
    <nav class="navbar navbar-expand-lg navbar-light d-flex justify-content-center">
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="admin_dashboard.php">Home <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link active" href="room_find.php">Room Find <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link active" href="room_insert.php">Room Insert <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link active" href="update_delete_room_details.php">Update Room Details <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link active" href="sectionwise_routine.php">Student Routine <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link active" href="routine_with_teacher.php">Teacher Routine <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link active" href="index.php">Logout <span class="sr-only">(current)</span></a>
            </div>
        </div>
    </nav>
</div>

    <div class="container">
        <label for="building_filter">Filter by Building:</label>
        <select id="building_filter">
            <option value="">All</option>
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

        <label for="day_filter">Filter by Day:</label>
        <select id="day_filter">
            <option value="">All</option>
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
            <option value="Saturday">Saturday</option>
            <option value="Sunday">Sunday</option>
        </select>

        <label for="time_filter">Filter by Time:</label>
        <select id="time_filter">
            <option value="">All</option>
            <?php
            $times = ["08:00 AM - 09:15 AM", "09:15 AM - 10:30 AM", "10:30 AM - 11:45 AM", "11:45 AM - 01:00 PM", "01:30 PM - 02:45 PM", "02:45 PM - 04:00 PM", "04:00 PM - 05:15 PM", "05:15 PM - 06:30 PM"];
            foreach ($times as $time) {
                echo "<option value='$time'>$time</option>";
            }
            ?>
        </select>

        <label for="intake_filter">Filter by Intake:</label>
<select id="intake_filter">
    <option value="">All</option>
    <?php
    include 'conn.php';
    $sql = "SELECT DISTINCT intake FROM room_details WHERE intake IS NOT NULL AND intake <> '' ORDER BY intake ASC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['intake'] . "'>" . $row['intake'] . "</option>";
        }
    }
    $conn->close();
    ?>
</select>

<label for="sec_filter">Filter by Section:</label>
<select id="sec_filter">
    <option value="">All</option>
    <?php
    include 'conn.php';
    $sql = "SELECT DISTINCT sec FROM room_details WHERE sec IS NOT NULL AND sec <> '' ORDER BY sec ASC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['sec'] . "'>" . $row['sec'] . "</option>";
        }
    }
    $conn->close();
    ?>
</select>

<label for="department_filter">Filter by Department:</label>
<select id="department_filter">
    <option value="">All</option>
    <?php
    include 'conn.php';
    $sql = "SELECT DISTINCT department FROM room_details WHERE department IS NOT NULL AND department <> '' ORDER BY department ASC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['department'] . "'>" . $row['department'] . "</option>";
        }
    }
    $conn->close();
    ?>
</select>

<label for="teacher_filter">Filter by Course Teacher:</label>
<select id="teacher_filter">
    <option value="">All</option>
    <?php
    include 'conn.php';
    $sql = "SELECT DISTINCT course_teacher FROM room_details WHERE course_teacher IS NOT NULL AND course_teacher <> '' ORDER BY course_teacher ASC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['course_teacher'] . "'>" . $row['course_teacher'] . "</option>";
        }
    }
    $conn->close();
    ?>
</select>


 
    <br><br>
   <table>
    <thead>
        <tr>
            <th>Room No</th>
            <th>Building</th>
            <th>Intake</th>
            <th>Section</th>
            <th>Time</th>
            <th>Course Teacher</th>
            <th>Department</th>
            <th>Day</th>
        </tr>
    </thead>
    <tbody>
    <?php
include 'conn.php';
$sql = "SELECT * FROM room_details WHERE 
        (course_teacher IS NOT NULL AND course_teacher <> '') AND 
        (intake IS NOT NULL AND intake <> '') AND 
        (sec IS NOT NULL AND sec <> '') AND 
        (department IS NOT NULL AND department <> '') 
        ORDER BY room_no ASC, building ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . ($row['room_no'] ?? '') . "</td>";
        echo "<td>" . ($row['building'] ?? '') . "</td>";
        echo "<td>" . ($row['intake'] ?? '') . "</td>";
        echo "<td>" . ($row['sec'] ?? '') . "</td>";
        echo "<td>" . ($row['time'] ?? '') . "</td>";
        echo "<td>" . ($row['course_teacher'] ?? '') . "</td>";
        echo "<td>" . ($row['department'] ?? '') . "</td>";
        echo "<td>" . ($row['day'] ?? '') . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8'>No data found</td></tr>";
}
$conn->close();
?>

    </tbody>
</table>
</div>

<?php require 'footer.php'
   ?>

<script>
    document.getElementById("building_filter").addEventListener("change", filterTable);
    document.getElementById("day_filter").addEventListener("change", filterTable);
    document.getElementById("time_filter").addEventListener("change", filterTable);
    document.getElementById("intake_filter").addEventListener("change", filterTable);
    document.getElementById("sec_filter").addEventListener("change", filterTable);
    document.getElementById("department_filter").addEventListener("change", filterTable);
    document.getElementById("teacher_filter").addEventListener("change", filterTable);

    function filterTable() {
        var building = document.getElementById("building_filter").value;
        var day = document.getElementById("day_filter").value;
        var time = document.getElementById("time_filter").value;
        var intake = document.getElementById("intake_filter").value;
        var sec = document.getElementById("sec_filter").value;
        var department = document.getElementById("department_filter").value;
        var teacher = document.getElementById("teacher_filter").value;

        var rows = document.querySelectorAll("tbody tr");

        rows.forEach(function(row) {
            var rowBuilding = row.cells[1].textContent;
            var rowDay = row.cells[7].textContent; 
            var rowTime = row.cells[4].textContent; 
            var rowIntake = row.cells[2].textContent; 
            var rowSec = row.cells[3].textContent; 
            var rowDepartment = row.cells[6].textContent; 
            var rowTeacher = row.cells[5].textContent; 

            if ((building === "" || rowBuilding === building) &&
                (day === "" || rowDay === day) &&
                (time === "" || rowTime === time) &&
                (intake === "" || rowIntake === intake) &&
                (sec === "" || rowSec === sec) &&
                (department === "" || rowDepartment === department) &&
                (teacher === "" || rowTeacher === teacher)) {
                row.style.display = ""; 
            } else {
                row.style.display = "none";
            }
        });
    }
</script>
</body>

</html>
