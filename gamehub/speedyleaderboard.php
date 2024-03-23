<!DOCTYPE html>
<html>
<head>
    <title>Leaderboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

<style>
    .pagination {
        display: flex;
        justify-content: center;
    }
    .pagination button {
        margin: 0 5px;
        padding: 5px 10px;
        cursor: pointer;
        padding: 1em;
        background: #25252b;
        border: none;
        color: gray;
    }
</style>

</head>
<body>


      <div class="content" style="background-color:#070d14;">
        <div class="container">
          <div class="table-responsive custom-table-responsive">
            <table class="table custom-table">
              <thead>
                        <tr>

                          <th scope="col">

                          </th>


                          <th scope="col">Username</th>
                          <th scope="col">Track Time</th>
                          <th scope="col">Date</th>
                        </tr>
            </thead>

        <tbody>
            <?php
            // Read leaderboard data from the TXT file
            $leaderboard_data = file('leaderboard.txt');

            // Pagination
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $perPage = 10;
            $totalEntries = count($leaderboard_data);
            $totalPages = ceil($totalEntries / $perPage);
            $start = ($page - 1) * $perPage;
            $end = $start + $perPage;
            $leaderboard_data = array_slice($leaderboard_data, $start, $perPage);

            // Process the data
            $count = 0;
            foreach ($leaderboard_data as $line) {
                $fields = explode(',', $line);
                $rank = $fields[0];
                $username = $fields[1];
                $score = $fields[2] / 1000; // Convert milliseconds to seconds
                if ($score >= 60) {
                    $minutes = floor($score / 60);
                    $seconds = $score % 60;
                    $milliseconds = round(($score - $minutes * 60 - $seconds) * 1000);
                    $score = sprintf("%02d:%02d.%03d", $minutes, $seconds, $milliseconds); // Format minutes, seconds, and milliseconds
                } else {
                    $score = sprintf("%06.3f", $score); // Format seconds with milliseconds
                }
                $extra = $fields[3];
                $date = $fields[4];

                // Convert date to relative time
                $date_formatted = date_format_relative($date);

                // CSS class for first, second, and third places
                $row_class = '';
                if ($count == 0 && $page == 1) {
                    $row_class = 'first-place';
                } elseif ($count == 1 && $page == 1) {
                    $row_class = 'second-place';
                } elseif ($count == 2 && $page == 1) {
                    $row_class = 'third-place';
                }

                // Display data
                echo "<tr class='$row_class'>";
                echo "<td>$rank</td>";
                echo "<td>$username</td>";
                echo "<td>$score</td>";
                echo "<td>$date_formatted</td>";
                echo "</tr>";

                $count++;
            }

            // Function to convert date to relative time
            function date_format_relative($date) {
                $timestamp = strtotime($date);
                $diff = time() - $timestamp;

                if ($diff < 60) {
                    return 'just now';
                } elseif ($diff < 3600) {
                    $minutes = floor($diff / 60);
                    return $minutes == 1 ? '1 minute ago' : "$minutes minutes ago";
                } elseif ($diff < 86400) {
                    $hours = floor($diff / 3600);
                    return $hours == 1 ? '1 hour ago' : "$hours hours ago";
                } elseif ($diff < 172800) {
                    return 'yesterday';
                } else {
                    $days = floor($diff / 86400);
                    return "$days days ago";
                }
            }
            ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination">
        <?php
        // Generate pagination buttons
        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<a href='?page=$i'><button class='button-page'>$i</button></a>";
        }
        ?>
    </div>
</div>
        </div>


</body>
</html>
