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
    function array_not_unique($my_array) {
        $same = array();
        // Hàm natcasesort() trong php dùng để sắp xếp các phần tử trong mảng. Các phần tử sẽ được sắp xếp dựa theo giá trị của phần tử dựa vào trật tự alphabet và không phân biệt chữ hoa chữ thường.
        natcasesort($my_array);
        reset ($my_array);

        $old_key = NULL;
        $old_value = NULL;

        foreach ($my_array as $key => $value) {
            if ($value === NULL) { 
                continue; 
            }

            if ($old_value == $value) {
                $same[$old_key]    = $old_value;
                $same[$key]        = $value;
            }
            $old_value    = $value;
            $old_key    = $key;
        }
    return $same;
    }

    $test_array = array();
    $test_array[1]    = 'duynd.nde17023@vtc.edu.vn';
    $test_array[2]    = 'duylanh1818@gmail.com';
    $test_array[3]    = 'duynd.nde17023@vtc.edu.vn';
    $test_array[4]    = 'duy.elbi1818@gmail.com';
    $test_array[5]    = 'duy.elbi1818@gmail.com';

    echo "<pre>";
    print_r(array_not_unique($test_array));
    echo "<pre>";
?>
</body>
</html>