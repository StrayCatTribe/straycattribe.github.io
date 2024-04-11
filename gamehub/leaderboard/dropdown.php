<?php
// Include database connection parameters
include 'db_config.php';

// Fetch distinct game IDs from the database
$sqlGameIds = "SELECT DISTINCT gameId FROM scores";
$resultGameIds = $conn->query($sqlGameIds);

// Array to store game IDs
$gameIds = [];

if ($resultGameIds->num_rows > 0) {
    // Populate the array with distinct game IDs
    while ($row = $resultGameIds->fetch_assoc()) {
        $gameIds[] = $row["gameId"];
    }
}

// Fetch distinct event types from the database
$sqlEventTypes = "SELECT DISTINCT event_type FROM scores";
$resultEventTypes = $conn->query($sqlEventTypes);

// Array to store event types
$eventTypes = [];

if ($resultEventTypes->num_rows > 0) {
    // Populate the array with distinct event types
    while ($row = $resultEventTypes->fetch_assoc()) {
        $eventTypes[] = $row["event_type"];
    }
}

// Close the previous result sets
$resultGameIds->close();
$resultEventTypes->close();

// Close the connection
$conn->close();
?>

<!-- Dropdown to choose game ID -->
<label for="gameId" class="form-label">Choose Game:</label>
<select class="form-select" id="gameId" onchange="updateTable(this.value)">
    <?php foreach ($gameIds as $id): ?>
        <?php
        // Check if the game ID has a corresponding game name
        $gameName = ""; // Initialize with an empty string
        switch ($id) {
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
        ?>
        <option value="<?php echo $id; ?>"><?php echo ($gameName != "Unknown") ? $gameName : "Game " . $id; ?></option>
    <?php endforeach; ?>
</select>


<!-- Dropdown to choose event type -->
<label for="eventType" class="form-label">Choose Event Type:</label>
<select class="form-select" id="eventType" onchange="updateTableByEventType(this.value)">
    <?php foreach ($eventTypes as $eventType): ?>
        <option value="<?php echo $eventType; ?>"><?php echo $eventType; ?></option>
    <?php endforeach; ?>
</select>
