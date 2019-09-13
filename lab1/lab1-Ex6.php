<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .card{
            width:300px;
            height:400px;
            
            margin:100px auto 100px auto;
            
            
        }
        .card:hover{
            box-shadow: 2px 2px 2px 2px #c8d6e5;
        }
        .title {
            padding-left:10px;
            font-size:20px;
            font-weight :100;
        }
         p{
            margin:0;
        }
        .price{
            display:flex;
            margin-top:10px;
            margin-left :10px;
            
        }
        .newprice{
            font-size:15px;
           
        }
        h2{
            margin:0;
        }
        .newprice span{
            text-decoration: underline;
        }
        .oldprice{
            font-size:18px;
            font-weight :100;
            text-decoration:  line-through;
            color: #576574;
            margin-left:2px;
            padding:3px;
        }
        .km{
            color:red;
            font-weight:bold;
            padding:5px;
        }
    </style>
</head>
<body>
<div class="logo">
    <img src="imgLap1/logo-vtca-xanh-duong-png.png" alt="">
    <h3>Buiding Web Apps with PHP and MySQL</h3>
</div>
    <img src="imgLap1/sony_dsc_rx100_mark_4_digital_1436371587000_1159879.jpg" width="300px" height="300px;" alt="">
<?php
    $title="Máy ảnh Sony RX100 IV(Chính Hãng)";
    $new_price ="19.090.000";
    $old_price ="22.990.000";
    $dv="đ";
    $km="-17%";
    echo "<div class=". "title>" . "<p>" . $title . "</p>" ."</div>";
    echo "<div class=". "price>" .
        "<div class=". "newprice>" . 
    "<h2>" . $new_price ."<span>".$dv."</span>". "</h2>".
    "</div>".
    "<div class=". "oldprice>".
    "<p>" . $old_price ."<span>".$dv."</span>". "</p>".
    "</div>"  .
    "<div class=". "km>".
    "<p>" . $km ."<span>". "</p>".
    "</div>"  .
    "</div>";
       
?>
</body>
</html>