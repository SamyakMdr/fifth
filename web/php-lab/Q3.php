<!DOCTYPE html>
<html>
<head>
    <title>Number Checker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            line-height: 1.6;
        }
        .result {
            font-weight: bold;
            margin-top: 15px;
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h2>Number Checker</h2>
    
    <form method="post">
        Enter a number: <input type="number" name="number" step="any" required>
        <input type="submit" value="Check">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $number = $_POST["number"];
        echo "<div class='result'>";
        if ($number == 0) {
            echo "The number is zero.";
        } 
        elseif ($number > 0) {
            echo "The number is positive.";
        } 
        elseif ($number < 0) {
            echo "The number is negative.";
        }
        else {
            echo "This is not a valid number.";
        }
        echo "</div>";
        echo "<h3>Additional Checks:</h3>";
        echo "<ul>";
        if ($number === 0) {
            echo "<li>The number is exactly zero (including type check)</li>";
        }
        if ($number != 0) {
            echo "<li>The number is not zero</li>";
        }
        $comparison = $number <=> 0;
        if ($comparison === 1) {
            echo "<li>Spaceship operator: Number is greater than zero</li>";
        } elseif ($comparison === -1) {
            echo "<li>Spaceship operator: Number is less than zero</li>";
        } else {
            echo "<li>Spaceship operator: Number is equal to zero</li>";
        }
        echo "</ul>";
    }
    ?>
    <pre>
        Name: Samyak Manandhar
        Symbol: 79010513
        Registration Number: 5-2-410-62-2022
        BSc.CSIT 5th Semester
    </pre>
</body>
</html>