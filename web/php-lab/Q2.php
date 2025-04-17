<!DOCTYPE html>
<html>
<head>
    <title>PHP Variables and Constants Demo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
    </style>
</head>
<body>
    <h2>PHP Variables and Constants Demo</h2>
    <?php
    $intVar = 42;
    echo "<p>Integer Variable: $intVar</p>";
    $floatVar = 3.14;
    echo "<p>Float Variable: $floatVar</p>";
    $stringVar = "Hello, World!";
    echo "<p>String Variable: $stringVar</p>";
    define("PI", 3.14159);
    define("GREETING", "Welcome to PHP!");
    echo "<p>PI Constant: " . PI . "</p>";
    echo "<p>Greeting Constant: " . GREETING . "</p>";
    ?>
    <pre>
        Name: Samyak Manandhar
        Symbol: 79010513
        Registration Number: 5-2-410-62-2022
        BSc.CSIT 5th Semester
    </pre>
</body>
</html>