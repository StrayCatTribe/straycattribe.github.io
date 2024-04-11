<!DOCTYPE html>
<html>
<head>
    <title>Scores</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="content">
    <div class="container">
        <!-- Content will be loaded here from scores.php -->
        <div class="mb-3" id="dropdownContainer"></div>
        <div class="table-responsive custom-table-responsive" id="scoreTable"></div>
    </div>
</div>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

<!-- JavaScript to load dropdown and table dynamically -->
<script>
    function loadDropdownAndTable() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("dropdownContainer").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "dropdown.php", true);
        xhttp.send();
    }

    function updateTable(gameId) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("scoreTable").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "scores.php?gameId=" + gameId, true);
        xhttp.send();
    }

    // Load dropdown and table on page load
    window.onload = loadDropdownAndTable;
</script>

</body>
</html>
