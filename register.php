    <?php
        
    $baglan=mysqli_connect("localhost","user_name","user_pass","datebase_name"); 
    mysqli_set_charset($baglan, "utf8");

    $name=$_POST["isim"];
    $Email=$_POST["mail"];
    $tel=$_POST["telefon"];
    $sqlekle="INSERT INTO kayit( isim, email, telefon) 
                VALUES ('$name','$Email','$tel')";
    
    ?>


<!DOCTYPE html>
<html>
<head>
	<title>Etkinlik Kayıt - İEEE Çanakkale Onsekiz Mart Üniversitesi Öğrenci Topluluğu</title>
    <style type="text/css">
        .anagovde{
                text-align: center;
                background: url('img/1920x1080/02.gif') fixed;
                background-color: #141415;
                background-position: center;
                background-repeat: no-repeat;
                margin-top: 200px;
        }
        .yazi{
            
            font: Verdane 25px Tahoma #666;
            border: solid 2px #fff;
            border-radius: 50px;
            background-color: #fff;
            padding: 50px;
            margin-right: 300px;
            margin-left: 300px;
        }
        .logo{
            height: %20;
            width: %20;
            text-align: center;
        }

    </style>
</head>
<body class="anagovde">
    <div class="logo">
        <img src="img/logo.png" alt="IEEE ÇOMÜ Logo">
    </div>
    <div class="yazi">
    <?php 
        if (!$name || !$Email || !$tel) {
            echo "Lütfen tüm alanları doldurunuz.";
        }
        else{
        	$sayi=0;
        	$sql = $baglan->query("SELECT * FROM kayit");
    	    if($sql==false) echo "hata:".$baglan->error;
			if($sql->num_rows>0){
				while($gelenVeri=$sql->fetch_assoc()){
					if($gelenVeri["email"]==$Email){
						$sayi=1;
					}
        		}
        	}
        	if($sayi==0){						
        		$sonuc=mysqli_query($baglan,$sqlekle);
           		if($sonuc){
       				echo $name;
           		   	echo "<br>Etkinliğimize kayıt olduğun için teşekkür ederiz.";
            		echo "<br>";
            	   	echo "Etkinlikte görüşmek dileğiyle.";
       			}
           		else{
            	   	echo "Bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz.";
           		}
        	}
        	else{
        		echo "Bu mail ile daha önce kayıt yapılmıştır.";
        	}
        }

    ?>
    </div>
</body>
</html>
