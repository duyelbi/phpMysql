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
    // số nguyên tố Palindrome hay số xuôi ngược nguyên tố là số nguyên tố viết xuôi hay viết ngược vẫn chỉ cho ra một số
    function check_palindrome($string) {
        if ($string == strrev($string))
            return 1;
        else
	        return 0;
    }

    echo check_palindrome('xxx') . "<br>";
    echo check_palindrome('duy') . "<br>";
    echo check_palindrome('1221') . "<br>";
    echo check_palindrome('abccba') . "<br>";
    echo check_palindrome('elbi') . "<br>";
?>
</body>
</html>