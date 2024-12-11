<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "ApplicationDB");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL Query
    $sql = "INSERT INTO Applicants (first_name, middle_name, last_name, father_name, mobile_no, email_id, temporary_address, permanent_address, country, state, city, pincode, occupation, school_name, puc_college_name, degree_college_name, master_college_name, current_status, self_description) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param(
        "sssssssssssssssssss", 
        $_POST['first_name'], 
        $_POST['middle_name'], 
        $_POST['last_name'], 
        $_POST['father_name'], 
        $_POST['mobile_no'], 
        $_POST['email_id'], 
        $_POST['temporary_address'], 
        $_POST['permanent_address'], 
        $_POST['country'], 
        $_POST['state'], 
        $_POST['city'], 
        $_POST['pincode'], 
        $_POST['occupation'], 
        $_POST['school_name'], 
        $_POST['puc_college_name'], 
        $_POST['degree_college_name'], 
        $_POST['master_college_name'], 
        $_POST['current_status'], 
        $_POST['self_description']
    );

    if ($stmt->execute()) {
        // Success
        $file = fopen("applications.txt", "a");
        fwrite($file, json_encode($_POST) . PHP_EOL);
        fclose($file);
        echo "<script>alert('Application Submitted'); window.location.href='index.html';</script>";
        
    } else {
        // Error
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
