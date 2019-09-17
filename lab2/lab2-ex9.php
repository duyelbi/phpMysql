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
    function is_str_lowercase($str1)
    {
        for ($sc = 0; $sc < strlen($str1); $sc++) 
        {
            if (ord($str1[$sc]) >= ord('A') &&ord($str1[$sc]) <= ord('Z')) 
            {
                return false;
            }
        }

        return true;
    }

    // Hàm var_dump() sẽ in ra thông tin của biến gồm kiểu dữ liệu của biến và giá trị.
    var_dump(is_str_lowercase('nguyen duc duy'));
    echo "<br>";
    var_dump(is_str_lowercase('nguyễn đức duy'));
    echo "<br>";
    var_dump(is_str_lowercase('Nguyễn Đức Duy'));
?>
</body>
</html>