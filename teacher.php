<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Teacher Routine</h2>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="input-group">
                    <label for="day">Day :</label>
                    <input type="text" id="day" name="day" list="daySuggestions" required>
                    <datalist id="daySuggestions">
                        <option value="All">All</option>
                        <option value="Monday"></option>
                        <option value="Tuesday"></option>
                        <option value="Wednesday"></option>
                        <option value="Thursday"></option>
                        <option value="Friday"></option>
                        <option value="Saturday"></option>
                        <option value="Sunday"></option>
                    </datalist>

                    <label for="course_teacher">Teacher Name :</label>
                    <input type="text" id="course_teacher" name="course_teacher" list="teacherSuggestions">
                    <datalist id="teacherSuggestions">
                        <?php
                        include 'conn.php';

                        $sql = "SELECT DISTINCT course_teacher FROM room_details ORDER BY course_teacher ASC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['course_teacher'] . "'>" . $row['course_teacher'] . "</option>";
                            }
                        }
                        ?>
                    </datalist>

                    <label for="filterBuilding">Filter by Building :</label>
                    <select id="filterBuilding" name="filterBuilding">
                        <option value="">All</option>
                        <?php
                        $sql = "SELECT DISTINCT building FROM room_details ORDER BY building ASC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['building'] . "'>" . $row['building'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="input-group">
                    <input type="submit" value="Submit" class="submit-button">
                    <button type="button" class="print-button" onclick="printTable()">Download</button>
                </div>
            </form>
        </div>
  

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conn.php';

  
    $day = $_POST['day'];
    $teacher = $_POST['course_teacher'];
    $filterBuilding = isset($_POST['filterBuilding']) ? $_POST['filterBuilding'] : "";
    $intake = isset($_POST['intake']) ? $_POST['intake'] : ""; 
    $section = isset($_POST['section']) ? $_POST['section'] : ""; 

    
    if (empty($day) || empty($teacher)) {
        echo "Please select both a day and a teacher.";
        exit;
    }

    
    if ($day === "All") {
       
        $sql = "SELECT * FROM room_details WHERE course_teacher = '$teacher'";
        
        if (!empty($filterBuilding)) {
            $sql .= " AND building = '$filterBuilding'";
        }
        if (!empty($intake)) {
            $sql .= " AND intake = '$intake'";
        }
        if (!empty($section)) {
            $sql .= " AND sec = '$section'";
        }
        
        
        $sql .= " ORDER BY FIELD(day, 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'), time ASC";
    } else {
        
        $sql = "SELECT * FROM room_details WHERE day = '$day' AND course_teacher = '$teacher'";

        if (!empty($filterBuilding)) {
            $sql .= " AND building = '$filterBuilding'";
        }
        if (!empty($intake)) {
            $sql .= " AND intake = '$intake'";
        }
        if (!empty($section)) {
            $sql .= " AND sec = '$section'";
        }
        
        
        $sql .= " ORDER BY time ASC";
    }

  
    $result = $conn->query($sql);

   
    if ($result->num_rows > 0) {
        
        echo "<table>";
        echo "<thead><tr><th>Room No</th><th>Building</th><th>Time</th><th>Day</th><th>Course Teacher</th><th>Department</th><th>Intake</th><th>Section</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['room_no'] . "</td>";
            echo "<td>" . $row['building'] . "</td>";
            echo "<td>" . $row['time'] . "</td>";
            echo "<td>" . $row['day'] . "</td>";
            echo "<td>" . $row['course_teacher'] . "</td>";
            echo "<td>" . $row['department'] . "</td>";
            echo "<td>" . $row['intake'] . "</td>";
            echo "<td>" . $row['sec'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "No data found.";
    }

  
    $conn->close();
}
?>


</div>


</div>