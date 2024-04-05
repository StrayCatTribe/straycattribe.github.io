<?php
// Database connection parameters
$servername = "localhost";
$username = "strayScorer";
$password = "B4htHTrKANGBvnssHQ8nA";
$database = "scoredb";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the selected game ID from the query parameters
$gameId = isset($_GET['gameId']) ? intval($_GET['gameId']) : null;

// Prepare SQL statement
$sql = "SELECT id, gameId, player_name, score, ip_address, event_type, event_time FROM scores";

// If a specific game ID is selected, add a WHERE clause to filter by game ID
if ($gameId !== null) {
    $sql .= " WHERE gameId = $gameId";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    echo "<table class='table custom-table'><tr><th>Game ID</th><th>ID</th><th>Player Name</th><th>Score</th><th>IP Address</th><th>Event Type</th><th>Event Time</th></tr>";
    while ($row = $result->fetch_assoc()) {
        // Get the custom name for the game ID if it exists, otherwise use the raw ID
        $gameId = $row["gameId"];
        $gameName = "";
        switch ($gameId) {
            case 1:
                $gameName = "Speedy Paws";
                break;
            case 2:
                $gameName = "Kitty Kaboom";
                break;
            case 3:
                $gameName = "Fly Kitty";
                break;
            case 4:
                $gameName = "Pawsome Tank";
                break;
            case 5:
                $gameName = "Cubic Tangle";
                break;
            default:
                $gameName = "Unknown";
        }
        echo "<tr><td>" . $gameName . "</td><td>" . $row["id"] . "</td><td>" . $row["player_name"] . "</td><td>" . $row["score"] . "</td><td>" . $row["ip_address"] . "</td><td>" . $row["event_type"] . "</td><td>" . $row["event_time"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
