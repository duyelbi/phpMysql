<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php

    $x = 5;
    $y = 6;
    $z = 7;
    function sumAndAverage() {
        $GLOBALS['sum'] = $GLOBALS['x'] + $GLOBALS['y'] + $GLOBALS['z'];

        $GLOBALS['Average'] = $GLOBALS['sum'] / 3;
    }

    echo "5 + 6 + 7 = " . sumAndAverage() . "$sum" . "<br>";
    echo "(5 + 6 + 7)/3 = " . sumAndAverage() . "$Average" . "<br>";
    // echo $tong;
?>
</body>
</html>