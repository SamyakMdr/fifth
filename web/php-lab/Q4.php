<!DOCTYPE html>
<html>
<head>
    <title>Array Average Calculator</title>
</head>
<body>
    <h2>Array Average Calculator</h2>    
    <?php
    function calculateAverage($array) {
        if (empty($array)) {
            return 0;
        }
        $sum = array_sum($array);
        $count = count($array);
        return $sum / $count;
    }
    $array1 = [1, 2, 3, 4, 5];
    $array2 = [10, 20, 30, 40];
    $array3 = [7, 14, 21, 28, 35];
    echo "<div class='result'>Average of array [" . implode(', ', $array1) . "]: " . calculateAverage($array1) . "</div>";
    echo "<div class='result'>Average of array [" . implode(', ', $array2) . "]: " . calculateAverage($array2) . "</div>";
    echo "<div class='result'>Average of array [" . implode(', ', $array3) . "]: " . calculateAverage($array3) . "</div>";
    $emptyArray = [];
    $singleElementArray = [42];
    $negativeNumbers = [-5, -10, -15];
    ?>
    <pre>
        Name: Samyak Manandhar
        Symbol: 79010513
        Registration Number: 5-2-410-62-2022
        BSc.CSIT 5th Semester
    </pre>
</body>
</html>