<?php
// Include database connection parameters
include 'db_config.php';

// Get the selected game ID from the query parameters
$gameId = isset($_GET['gameId']) ? intval($_GET['gameId']) : null;

// Get the selected event type from the query parameters
$eventType = isset($_GET['eventType']) ? $_GET['eventType'] : null;

// Prepare SQL statement
$sql = "SELECT id, gameId, player_name, score, ip_address, event_type, event_time FROM scores WHERE 1";

// If a specific game ID is selected, add a WHERE clause to filter by game ID
if ($gameId !== null) {
    $sql .= " AND gameId = $gameId";
}

// If a specific event type is selected, add a WHERE clause to filter by event type
if ($eventType !== null) {
    $sql .= " AND event_type = '$eventType'";
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
