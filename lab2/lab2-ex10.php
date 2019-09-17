<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EX10 Loop</title>
    <style>
        .logo{
            height: 121px;
        }
        .card{
            text-align: center;
            width:300px;
            height:400px;
            margin-left: 100px;
            margin-right: 100px;
            float:left;
            
            
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
            <img src="img-lab2/logo-vtca-xanh-duong-png.png" alt="" style="float: left;">
            <h3 style="float: right;">
            Buiding Web Apps with PHP and MySQL
            </h3>
        </div>
    <?php
        // $h3="Buiding Web Apps with PHP and MySQL";
        // echo "<div class=logo>";
        //     echo "<img src=imgLap2/logo-vtca-xanh-duong-png.png alt= >";
        //     echo "h3" . $h3 . "</h3>"
        // echo "</div>";
        function infomation()
        {
            $title="Máy ảnh Sony RX100 IV(Chính Hãng)";
            $new_price ="19.090.000";
            $old_price ="22.990.000";
            $dv="đ";
            $km="-17%";

            echo "<div class=card>";
                echo "<img src=img-lab2/sony_dsc_rx100_mark_4_digital_1436371587000_1159879.jpg alt=img width=300px heigth=300px >";

                echo "<div class=title>". 
                    "<p>" . $title . "</p>" .
                "</div>";

                echo "<div class=price>".
                    "<div class=newprice>". 
                        "<h2>" . $new_price ."<span>".$dv."</span>". "</h2>".
                    "</div>".

                    "<div class=oldprice>".
                        "<p>" . $old_price ."<span>".$dv."</span>". "</p>".
                    "</div>"  .

                    "<div class=km>".
                        "<p>" . $km . "</p>".
                    "</div>"  .
                "</div>";
            echo  "</div>";
        }
        for ($i=0; $i < 9; $i++) { 
            # code...
            infomation();
        }
        ?>
    
</body>
</html>