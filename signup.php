<?php
include 'conn.php';

$uname = $pass = $confirm_pass = "";
$uname_err = $pass_err = $confirm_pass_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["uname"]))) {
        $uname_err = "Please enter a username.";
    } else {
        $sql = "SELECT id FROM users WHERE uname = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $param_uname);
            $param_uname = trim($_POST["uname"]);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows == 1) {
                    $uname_err = "This username is already taken.";
                } else {
                    $uname = trim($_POST["uname"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }

 
    if (empty(trim($_POST["pass"]))) {
        $pass_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["pass"])) < 6) {
        $pass_err = "Password must have at least 6 characters.";
    } else {
        $pass = trim($_POST["pass"]);
    }


    if (empty(trim($_POST["confirm_pass"]))) {
        $confirm_pass_err = "Please confirm password.";
    } else {
        $confirm_pass = trim($_POST["confirm_pass"]);
        if (empty($pass_err) && ($pass != $confirm_pass)) {
            $confirm_pass_err = "Password did not match.";
        }
    }

    $profile_pic_path = "";
    if (isset($_FILES["profile_pic"]) && $_FILES["profile_pic"]["error"] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
                $profile_pic_path = $target_file;
            } else {
                echo "Error uploading profile picture.";
            }
        } else {
            echo "Uploaded file is not an image.";
        }
    }

    if (empty($uname_err) && empty($pass_err) && empty($confirm_pass_err)) {
        $sql = "INSERT INTO users (uname, pass, profile_pic) VALUES (?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sss", $param_uname, $param_pass, $param_profile_pic);
            $param_uname = $uname;
            $param_pass = password_hash($pass, PASSWORD_DEFAULT);
            $param_profile_pic = $profile_pic_path;
            if ($stmt->execute()) {
                header("Location: index.php");
                exit;
            } else {
                echo "Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Room Scheduling System</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding-bottom: 70px;
            transition: background-color 0.5s ease;
            height: 100vh;
        }

        body:hover {
            background-color: #e0e0e0;
        }

        .header img {
            width: 80px;
            height: auto;
            border-radius: 50%;
            margin-bottom: 5px;
        }

        .header h1 {
            font-style: italic;
            font-size: 1.5rem;
            margin-top: 0;
            color: #007bff;
        }

        .container {
            width: 90%;
            margin: 35px auto;
        }

        .card {
            width: 100%;
            border: none;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
        }

        label {
            font-size: 1.2rem;
            color: #007bff;
            font-weight: bold;
        }

        .text-center {
            margin-top: 15px;
        }

        .text-center:hover {
            margin-top: 15px;
            color: skygreen;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>

    <script>
        function showPopupAndRedirect(message) {
            alert(message);
            window.location.href = "login.php";
        }
    </script>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <img src="BUBT.png" alt="" class="img-fluid rounded-circle mb-3" style="max-width: 80px;">
                        <h1 class="mb-0">BUBT</h1>
                        <h2 class="mb-3">BANGLADESH UNIVERSITY OF BUSINESS AND TECHNOLOGY</h2>
                        <h3 class="mb-0">Commitment to Academic Excellence</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="uname">Username:</label>
                                <input type="text" id="uname" name="uname" class="form-control" placeholder="Enter your username" required autocomplete="off">
                                <span class="text-danger"><?php echo $uname_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="pass">Password:</label>
                                <input type="password" id="pass" name="pass" class="form-control" placeholder="Enter your password" required autocomplete="new-password">
                                <span class="text-danger"><?php echo $pass_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="confirm_pass">Confirm Password:</label>
                                <input type="password" id="confirm_pass" name="confirm_pass" class="form-control" placeholder="Confirm your password" required autocomplete="new-password">
                                <span class="text-danger"><?php echo $confirm_pass_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="profile_pic">Profile Picture:</label>
                                <input type="file" id="profile_pic" name="profile_pic" class="form-control-file">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        <p class="text-center">Already have an account? <a href="index.php">Login here</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
