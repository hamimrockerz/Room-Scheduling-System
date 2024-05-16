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
margin-left: 180px;        }

        .navbar a {
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
            padding: 10px 20px;
            display: inline-block;
            white-space: nowrap;
        }

        .navbar a:hover {
            color: lightblue;
            text-decoration: none;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
        }

        .container {
            text-align: center;
            padding: 20px;
            margin: auto;
            margin-top: 5px;
        }

        .card-body .input-group {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .card-body .input-group label {
            margin: 0 10px;
        }
        .submit-button,
.print-button {
    margin-top: 15px;
}

.text-center {
    text-align: center;
}

.print-button {
    margin-left: 10px;
}



        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 140%;
            max-width: 100%;
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
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        footer {
            width: 100%;
            max-width: 100%;
            background-color: #34495e;
            color: white;
            padding: 20px;
            text-align: center;
            flex-shrink: 0;
            margin-top: auto;
            box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.1);
        }

        .footer-link-1,
        .footer-link-2,
        .footer-link-3,
        .footer-link-4 {
            color: #ecf0f1;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-link-1:hover,
        .footer-link-2:hover,
        .footer-link-3:hover,
        .footer-link-4:hover {
            color: lightblue;
            text-decoration: none;
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
                    <a class="nav-item nav-link active" href="room_find.php">Room Insert <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link active" href="update_delete_room_details.php">Update Room Details <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link active" href="room_details_showlist.php">Room Details Showlist <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link active" href="routine_with_teacher.php">Teacher Routine <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link active" href="index.php">Logout <span class="sr-only">(current)</span></a>
                </div>
            </div>
        </nav>
    </div>

    <div class="container">
    <div class="card">
        <div class="card-header">
            <h2 class="text-center">Student Routine</h2>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="intake">Intake:</label>
                        <input type="text" class="form-control" id="intake" name="intake" list="intakeSuggestions" required>
                        <datalist id="intakeSuggestions">
                            <?php
                            include 'conn.php';
    
                            $sql = "SELECT DISTINCT intake FROM room_details ORDER BY intake ASC";
                            $result = $conn->query($sql);
    
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['intake'] . "'>" . $row['intake'] . "</option>";
                                }
                            }
                            ?>                          </datalist>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="section">Section:</label>
                        <input type="text" class="form-control" id="section" name="section" list="sectionSuggestions" required>
                        <datalist id="sectionSuggestions">
                        <?php
                        $sql = "SELECT DISTINCT sec FROM room_details ORDER BY sec ASC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['sec'] . "'>" . $row['sec'] . "</option>";
                            }
                        }
                        ?>                         </datalist>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="filterDay">Filter by Day:</label>
                        <select id="filterDay" name="filterDay" class="form-control">
                        <option value="">All</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>                         </select>
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-6 text-center">
                        <button type="submit" class="btn btn-primary submit-button">Submit</button>
                        <button type="button" class="btn btn-primary print-button" onclick="printTable()">Download Routine</button>
                    </div>
            </form>
        </div>
    </div>
</div>



    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'conn.php';

        $intake = $_POST['intake'];
        $section = $_POST['section'];
        $filterDay = $_POST['filterDay'];
        $sql = "SELECT * FROM room_details WHERE intake = '$intake'";
        if (!empty($section)) {
            $sql .= " AND sec = '$section'";
        }
        if (!empty($filterDay)) {
            $sql .= " AND day = '$filterDay'";
        }
        $sql .= " ORDER BY day ASC, time ASC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<div class='card'>";
            echo "<div class='card-body'>";
            echo "<div class='table-responsive'>";
            echo "<table class='table'>";
            echo "<thead><tr><th>Intake</th><th>Section</th><th>Room No</th><th>Building</th><th>Time</th><th>Day</th><th>Course Teacher</th><th>Department</th></tr></thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['intake'] . "</td>";
                echo "<td>" . $row['sec'] . "</td>";
                echo "<td>" . $row['room_no'] . "</td>";
                echo "<td>" . $row['building'] . "</td>";
                echo "<td>" . $row['time'] . "</td>";
                echo "<td>" . $row['day'] . "</td>";
                echo "<td>" . $row['course_teacher'] . "</td>";
                echo "<td>" . $row['department'] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        } else {
            echo "<p class='text-center'>No data found.</p>";
        }

        $conn->close();
    }
    ?></div>


    
    <?php require 'footer.php'
   ?>

    <script>
    function printTable() {
        var intake = document.getElementById("intake").value;
        var section = document.getElementById("section").value;
        var selectedDay = document.getElementById("filterDay").value;

        var output = "<div style='margin: 0 auto; max-width: 800px;'>";
        output += "<h2 style='text-align: center;'>Sectionwise Routine</h2>";
        output += "<table style='width: 100%; border-collapse: collapse; border: 2px solid #007bff; text-align: center;'>";
        output += "<thead style='background-color: #007bff; color: white;'>";

        output += "<tr>";
        output += "<th style='border: 1px solid #ddf; padding: 8px; background-color: #007bff; color: white;'>Intake</th>";
        output += "<th style='border: 1px solid #ddf; padding: 8px; background-color: #007bff; color: white;'>Section</th>";
        output += "<th style='border: 1px solid #ddf; padding: 8px; background-color: #007bff; color: white;'>Room No</th>";
        output += "<th style='border: 1px solid #ddf; padding: 8px; background-color: #007bff; color: white;'>Building</th>";
        output += "<th style='border: 1px solid #ddf; padding: 8px; background-color: #007bff; color: white;'>Time</th>";
        output += "<th style='border: 1px solid #ddf; padding: 8px; background-color: #007bff; color: white;'>Day</th>";
        output += "<th style='border: 1px solid #ddf; padding: 8px; background-color: #007bff; color: white;'>Course Teacher</th>";
        output += "<th style='border: 1px solid #ddf; padding: 8px; background-color: #007bff; color: white;'>Department</th>";
        output += "</tr>";

        output += "</thead>";
        output += "<tbody>";

        var rows = document.querySelectorAll("tbody tr");
        rows.forEach(function(row) {
            var rowDay = row.cells[5].textContent.trim(); 
            if (selectedDay === "" || rowDay === selectedDay) {
                output += "<tr>";
                for (var i = 0; i < row.cells.length; i++) {
                    if (i === 4) {
                        var time = row.cells[i].textContent;
                        output += "<td style='border: 1px solid #007bff; padding: 8px;'>" + time + "</td>";
                    } else {
                        output += "<td style='border: 1px solid #007bff; padding: 8px;'>" + row.cells[i].textContent + "</td>";
                    }
                }
                output += "</tr>";
            }
        });

        output += "</tbody></table></div>";

        var newWin = window.open("");
        newWin.document.write(output);
        newWin.print();
        newWin.close();
    }

    document.getElementById("filterDay").addEventListener("change", filterTable);

    function filterTable() {
        var selectedDay = document.getElementById("filterDay").value;

        var rows = document.querySelectorAll("tbody tr");

        rows.forEach(function(row) {
            var rowDay = row.cells[5].textContent.trim(); 

            if (selectedDay === "" || rowDay === selectedDay) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }
</script>


</body>

</html>