<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <title>Kayıt Ol</title>
    <link href="dosyalar/css/bootstrap.css" rel="stylesheet">
    <link href="dosyalar/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="dosyalar/css/style.css" rel="stylesheet">
    <link href="dosyalar/css/style-responsive.css" rel="stylesheet">
    <header>
    </header>
</head>

<body id="login">
<div id="login-page">
    <div class="container">
        <form class="form-login" action="" method="post">

            <h2 class="form-login-heading">ŞİMDİ KAYDOL</h2>
            <?php
            if(isset($_POST['submit'])){
                ob_start();
                error_reporting(0);
                $baglanti = mysqli_connect('localhost','emir','1234','kayit');
                $kullaniciAd=$_POST['kullaniciAd'];
                $sifre=$_POST['sifre'];
                $email=$_POST['email'];
                $sql ="INSERT INTO kullanicilar (kad,ksifre,kemail) VALUES('$kullaniciAd','$sifre','$email')";
                if($kullaniciAd=='' || $sifre=='' || $email=='') {
                    echo "<div style='background-color:#E71212;width:auto;height:auto;'>
				<p style='text-align:center;font-size:13pt'>Lütfen tüm bilgileri doldurunuz.<img style='width:30px;height:30px' src='hata.png'/></div>";

                }
                else if($baglanti->query($sql) == TRUE){
                    echo "<div style='background-color:#79C53A;width:auto;height:auto;'>
				<p style='text-align:center;font-size:13pt'>Kayıt eklendi.<img style='width:30px;height:30px' src='onay.png'/></div>";

                }
                ob_end_flush();
            }
            ?>
            <div class="login-wrap">
                Kullanıcı Adı <input type="text" class="form-control" name="kullaniciAd" autofocus>
                <br>
                Şifre <input type="password" class="form-control" name="sifre" >
                <br>
                E-Posta<input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
                <br>
                <a href='login.php' data-dismiss="modal" class="btn btn-default" type="button">Çıkış</a>
                <button class="btn btn-theme" type="submit" name="submit">Kaydol</button>
                <hr>
            </div>

        </form>
    </div>
</div>
<script src="dosyalar/js/jquery.js"></script>
<script src="dosyalar/js/bootstrap.min.js"></script>
<script type="text/javascript" src="dosyalar/js/jquery.backstretch.min.js"></script>
</body>
</html>