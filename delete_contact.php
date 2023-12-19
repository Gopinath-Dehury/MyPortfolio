<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "porfolio";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request is a DELETE request
if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    // Get the contact id from the request parameters
    $contactId = $_GET['id'];

    // SQL query to delete the contact with the specified id
    $sql = "DELETE FROM contact WHERE id = $contactId";

    $response = array(); // Initialize an array to store the response message

    if ($conn->query($sql) === TRUE) {
        $response['status'] = 'success';
        $response['message'] = 'Contact deleted successfully';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error deleting contact: ' . $conn->error;
    }

    // Return the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Close connection
$conn->close();
?>
