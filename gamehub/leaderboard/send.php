<?php
// Database connection parameters
$servername = "localhost";
$username = "strayScorer";
$password = "B4htHTrKANGBvnssHQ8nA";
$database = "scoredb";

// Read the raw POST data
$postData = file_get_contents("php://input");

// Decode JSON data
$data = json_decode($postData, true);

// Check if JSON data was successfully decoded
if ($data === null) {
    // JSON decoding failed
    http_response_code(400);
    echo json_encode(array("error" => "Invalid JSON data"));
    exit;
}

// Extract player_name, score, ip_address, event_type, and gameID from JSON data
$playerName = isset($data['player_name']) ? $data['player_name'] : '';
$score = isset($data['score']) ? intval($data['score']) : 0;
$ipAddress = $_SERVER['REMOTE_ADDR'];
$eventType = isset($data['event_type']) ? $data['event_type'] : '';
$gameID = isset($data['gameID']) ? intval($data['gameID']) : 0;

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement
$sql = "INSERT INTO scores (player_name, score, ip_address, event_type, gameID) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sissi", $playerName, $score, $ipAddress, $eventType, $gameID);

// Execute SQL statement
$response = array();
if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['error'] = "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$stmt->close();
$conn->close();

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
