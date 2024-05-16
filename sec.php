<div class="container">
        <h2>Sectionwise Routine</h2>
        <form action="" method="post">
            <div class="input-group">
                <label for="intake">Intake:</label>
                <input type="text" id="intake" name="intake" list="intakeSuggestions" required>
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
                    ?>
                </datalist>
           
                <label for="section">Section:</label>
                <input type="text" id="section" name="section" list="sectionSuggestions" required>
                <datalist id="sectionSuggestions">
                    <?php
                    $sql = "SELECT DISTINCT sec FROM room_details ORDER BY sec ASC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['sec'] . "'>" . $row['sec'] . "</option>";
                        }
                    }
                    ?>
                </datalist>
            
                <label for="filterDay">Filter by Day:</label>
                <select id="filterDay" name="filterDay"> 
                    <option value="">All</option>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                </select>
            </div>
            <input type="submit" value="Submit" class="submit-button">
            <button type="button" class="print-button" onclick="printTable()">Download Routine</button>
        </form>

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
                echo "<table id='output-table'>";
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
            } else {
                echo "No data found.";
            }

            $conn->close();
        }
        ?>
    </div>