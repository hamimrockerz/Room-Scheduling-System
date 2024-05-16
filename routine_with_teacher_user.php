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
            font-size: 18px;
margin-left: 540px;    
    }

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
    margin-right: 10px;
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
                <a class="nav-item nav-link active" href="welcome.php">Home <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link active" href="room_find_user.php">Room Find <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link active" href="sectionwise_routine_user.php">Student Routine <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link active" href="index.php">Logout <span class="sr-only">(current)</span></a>
            </div>
        </div>
    </nav>
</div>
 
<?php require 'teacher.php'
   ?>
<?php require 'footer.php'
   ?>
    <script>
   
    document.getElementById("filterBuilding").addEventListener("change", filterTable);

    function filterTable() {
        var selectedBuilding = document.getElementById("filterBuilding").value;

        var rows = document.querySelectorAll("tbody tr");

        rows.forEach(function(row) {
            var rowBuilding = row.cells[1].textContent;

            if (selectedBuilding === "" || rowBuilding === selectedBuilding) {
                row.style.display = ""; 
            } else {
                row.style.display = "none";
            }
        });
    }

    function printTable() {
            var output = "<div style='margin: 0 auto; max-width: 800px;'>";
            output += "<h2 style='text-align: center;'>Teacher Routine</h2>";
            output += "<table style='width: 100%; border-collapse: collapse; border: 2px solid #007bff; text-align: center;'>";
            output += "<thead style='background-color: #007bff; color: white;'>";
            output += "<tr><th style='border: 1px solid #007bff; padding: 8px;'>Room No</th>";
            output += "<th style='border: 1px solid #007bff; padding: 8px;'>Building</th>";
            output += "<th style='border: 1px solid #007bff; padding: 8px;'>Time</th>";
            output += "<th style='border: 1px solid #007bff; padding: 8px;'>Day</th>";
            output += "<th style='border: 1px solid #007bff; padding: 8px;'>Course Teacher</th>";
            output += "<th style='border: 1px solid #007bff; padding: 8px;'>Department</th>";
            output += "<th style='border: 1px solid #007bff; padding: 8px;'>Intake</th>";
            output += "<th style='border: 1px solid #007bff; padding: 8px;'>Section</th></tr>";
            output += "</thead>";
            output += "<tbody>";

            var rows = document.querySelectorAll("tbody tr");
            rows.forEach(function(row) {
                output += "<tr>";
                for (var i = 0; i < row.cells.length; i++) {
                
                    if (i === 2) {
                        var time = row.cells[i].textContent;
                        output += "<td style='border: 1px solid #007bff; padding: 8px;'>" + time + "</td>";
                    } else {
                        output += "<td style='border: 1px solid #007bff; padding: 8px;'>" + row.cells[i].textContent + "</td>";
                    }
                }
                output += "</tr>";
            });

            output += "</tbody></table></div>";

            var newWin = window.open("");
            newWin.document.write(output);
            newWin.print();
            newWin.close();
        }
</script>
</body>

</html>