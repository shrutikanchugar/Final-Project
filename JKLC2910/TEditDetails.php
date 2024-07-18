<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            background-color: #fff;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        canvas {
            margin-top: 20px;
        }

        a {
            text-decoration: none;
            color: #2196F3;
        }

        .home {
            float: right;
            background-color: #4CAF50;
            padding: 10px 15px;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .home:hover {
            background-color: #45a049;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .header {
            background-color: #333;
            padding: 20px;
            color: white;
            text-align: center;
        }

        .section {
            background-color: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .chart-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2 style="color:white">STUDENT PROFILE</h2>
        <button class="home"><a href="TMainScreen.html" style="text-decoration:none; color:white; font-weight:bold;">Home</a></button>
    </div>
    <br>
    <div class="section">
        <?php
        $servername = "localhost";  // Change to your database server
        $username = "root";     // Change to your database username
        $password = "";     // Change to your database password
        $database = "jklc"; // Change to your database name

        // Create a database connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_GET['student'])) {
            $studentID = $_GET['student'];

            // Handle form submission for updating student details
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $studentName = $_POST['student_name'];
                $pcontact = $_POST['pcontact'];
                $altcontact = $_POST['altcontact'];
                $gender = $_POST['gender'];
                $saddress = $_POST['saddress'];
                $class = $_POST['class'];
                $sbranch = $_POST['sbranch'];
                $semail = $_POST['semail'];
                $spassword = $_POST['spassword'];

                $updateQuery = "UPDATE sregister SET 
                    student_name = '$studentName', 
                    pcontact = '$pcontact', 
                    altcontact = '$altcontact', 
                    gender = '$gender', 
                    saddress = '$saddress', 
                    class = '$class', 
                    sbranch = '$sbranch', 
                    semail = '$semail',
                    spassword = '$spassword'
                    WHERE id = '$studentID'";

                if ($conn->query($updateQuery) === TRUE) {
                    echo "Record updated successfully !!!";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }

            // Fetch student details from sregister table
            $studentDetailsQuery = "SELECT * FROM sregister WHERE id = '$studentID'";
            $studentDetailsResult = $conn->query($studentDetailsQuery);

            if ($studentDetailsResult->num_rows > 0) {
                $studentDetails = $studentDetailsResult->fetch_assoc();
                ?>
                <!-- Display student details in a form -->
                <hr>
                <center><h3>Edit Student Details</h3></center>
                <hr>
                <br>
                <form method="POST">
                    <table>
                        <tr>
                            <th>Student ID</th>
                            <td><?php echo $studentDetails['id']; ?></td>
                        </tr>
                        <tr>
                            <th>Student Name</th>
                            <td><input type="text" name="student_name" value="<?php echo $studentDetails['student_name']; ?>"></td>
                        </tr>
                        <tr>
                            <th>Primary Contact</th>
                            <td><input type="text" name="pcontact" value="<?php echo $studentDetails['pcontact']; ?>"></td>
                        </tr>
                        <tr>
                            <th>Alternate Contact</th>
                            <td><input type="text" name="altcontact" value="<?php echo $studentDetails['altcontact']; ?>"></td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td><input type="text" name="gender" value="<?php echo $studentDetails['gender']; ?>"></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td><input type="text" name="saddress" value="<?php echo $studentDetails['saddress']; ?>"></td>
                        </tr>
                        <tr>
                            <th>Class</th>
                            <td><input type="text" name="class" value="<?php echo $studentDetails['class']; ?>"></td>
                        </tr>
                        <tr>
                            <th>Branch</th>
                            <td><input type="text" name="sbranch" value="<?php echo $studentDetails['sbranch']; ?>"></td>
                        </tr>
                        <tr>
                            <th>Email Address</th>
                            <td><input type="email" name="semail" value="<?php echo $studentDetails['semail']; ?>"></td>
                        </tr>

                        <tr>
                            <th>Password</th>
                            <td><input type="password" name="spassword" value="<?php echo $studentDetails['spassword']; ?>"></td>
                        </tr>
                    </table>
                    <br>
                    <center><input type="submit" value="Save Changes"></center>
                </form>
                <br><br><hr>
                <?php
            } else {
                echo '<p>No student details found.</p>';
            }
        } else {
            echo '<p>No student selected.</p>';
        }

        $conn->close();
        ?>
    </div>
</div>
</body>
</html>
