<?php
// Hash'J Programming - hashJProgramming (Joshua Ambalong)

require_once '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['status'])) {
        $status = 'Pending';   
    } else {
        $status = $_POST['status'];
    }
    // Get the form data
    $course_id = $_POST['course'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $suffix = $_POST['suffix'];
    $birthdate = $_POST['birthdate'];
    $region = $_POST['region'];
    $province = $_POST['province'];
    $municipality = $_POST['municipality'];
    $barangay = $_POST['barangay'];
    $sex = $_POST['sex'];
    $new_student = $_POST['new_student'];
    $school_year = $_POST['school_year'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $elementary_name = $_POST['elementary_name'];
    $elementary_graduated = $_POST['elementary_graduated'];
    $elementary_address = $_POST['elementary_address'];
    $secondary_name = $_POST['secondary_name'];
    $secondary_graduated = $_POST['secondary_graduated'];
    $secondary_address = $_POST['secondary_address'];
    $last_school_name = $_POST['last_school_name'];
    $last_school_graduated = $_POST['last_school_graduated'];
    $last_school_address = $_POST['last_school_address'];
    $guardian_name = $_POST['guardian_name'];
    $guardian_phone = $_POST['guardian_phone'];
    $guardian_occupation = $_POST['guardian_occupation'];
    $guardian_relationship = $_POST['guardian_relationship'];
    $guardian_address = $_POST['guardian_address'];

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql_check = "SELECT * FROM `users` WHERE username = :username";
    $stmt_check = $db->prepare($sql_check);
    $stmt_check->bindParam(':username', $username);
    $stmt_check->execute();

    if ($stmt_check->rowCount() > 0) {
        $response = array('status' => 'error', 'message' => 'Username already exists!');
        echo json_encode($response);
        exit();
    }

    $sql = "INSERT INTO `users` (`name`, `username`, `password`, `role`) VALUES (:name ,:username, :password, 'student')";
    $password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':name', $firstname . ' '. $middlename . ' '. $lastname . ' '. $suffix);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    $user_id = $db->lastInsertId();


    // Assuming $db is your database connection
    $sql = 'SELECT * FROM students WHERE firstname = :firstname AND middlename = :middlename AND lastname = :lastname AND suffix = :suffix';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':middlename', $middlename);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':suffix', $suffix);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $response = array('status' => 'error', 'message' => 'Student already exists!');
        echo json_encode($response);
        exit();
    }

    $sql = "INSERT INTO students (user_id, course_id, firstname, middlename, lastname, suffix, birthdate, region, province, municipality, barangay, 
            sex, new_student, school_year, address, phone, elementary, elementary_year_graduated, elementary_address, 
            secondary, secondary_year_graduated, secondary_address, school_last_attended, school_last_attended_year_graduated, 
            school_last_attended_address, guardian, guardian_phone, guardian_occupation, guardian_relationship, guardian_address, status) 
            VALUES (:user_id, :course_id, :firstname, :middlename, :lastname, :suffix, :birthdate, :region, :province, :municipality, :barangay, 
            :sex, :new_student, :school_year, :address, :phone, :elementary, :elementary_graduated, :elementary_address, 
            :secondary, :secondary_graduated, :secondary_address, :last_school_name, :last_school_graduated, 
            :last_school_address, :guardian_name, :guardian_phone, :guardian_occupation, :guardian_relationship, :guardian_address, :status)";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':course_id', $course_id);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':middlename', $middlename);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':suffix', $suffix);
    $stmt->bindParam(':birthdate', $birthdate);
    $stmt->bindParam(':region', $region);
    $stmt->bindParam(':province', $province);
    $stmt->bindParam(':municipality', $municipality);
    $stmt->bindParam(':barangay', $barangay);
    $stmt->bindParam(':sex', $sex);
    $stmt->bindParam(':new_student', $new_student);
    $stmt->bindParam(':school_year', $school_year);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':elementary', $elementary_name);
    $stmt->bindParam(':elementary_graduated', $elementary_graduated);
    $stmt->bindParam(':elementary_address', $elementary_address);
    $stmt->bindParam(':secondary', $secondary_name);
    $stmt->bindParam(':secondary_graduated', $secondary_graduated);
    $stmt->bindParam(':secondary_address', $secondary_address);
    $stmt->bindParam(':last_school_name', $last_school_name);
    $stmt->bindParam(':last_school_graduated', $last_school_graduated);
    $stmt->bindParam(':last_school_address', $last_school_address);
    $stmt->bindParam(':guardian_name', $guardian_name);
    $stmt->bindParam(':guardian_phone', $guardian_phone);
    $stmt->bindParam(':guardian_occupation', $guardian_occupation);
    $stmt->bindParam(':guardian_relationship', $guardian_relationship);
    $stmt->bindParam(':guardian_address', $guardian_address);
    $stmt->bindParam(':status', $status);

    if ($stmt->execute()) {
        $response = array('status' => 'success', 'message' => 'Student added successfully!');
    } else {
        $response = array('status' => 'error', 'message' => 'Failed to add student!');
    }

    echo json_encode($response);
} else {
    $response = array('status' => 'error', 'message' => 'Invalid request method!');
    echo json_encode($response);
}
