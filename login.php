<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <title>Login</title>
    <link href="dosyalar/css/bootstrap.css" rel="stylesheet">
    <link href="dosyalar/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="dosyalar/css/style.css" rel="stylesheet">
    <link href="dosyalar/css/style-responsive.css" rel="stylesheet">
    <header>
        <?php include("ayarlar.php"); ?>
    </header>
</head>
<body id="login">
<div id="login-page">
    <div class="container">
        <form class="form-login" action="" method="post">

            <h2 class="form-login-heading">ŞİMDİ GİRİŞ YAP</h2>

            <div class="login-wrap">
                <input type="text" class="form-control" placeholder="Kullanıcı Ad" name="kullaniciAd" autofocus>
                <br>
                <input type="password" class="form-control" placeholder="Password" name="sifre">
                <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="login.php#myModal"> Parolanızı mı Unuttunuz?</a>

		                </span>
                </label>
                <button id="btngiris" class="btn btn-theme btn-block" type="submit" name="submit"><i class="fa fa-lock">&nbsp;</i> GİRİŞ</button>
                <hr>
                <div class="registration">
                    Henüz Bir Hesabınız Yok mu?<br/>
                    <a class="" href="hesap.php">
                        Yeni Bir Hesap Oluştur
                    </a>
                </div>
            </div>
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Parolanızı mı Unuttunuz?</h4>
                        </div>
                        <div class="modal-body">
                            <p>Şifrenizi sıfırlamak için aşağıya e-posta adresinizi girin.</p>
                            <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                            <button class="btn btn-theme" type="button">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if(isset($_POST['submit'])){
                ob_start();
                error_reporting(0);
                session_start();
                $kullaniciAd = $_POST['kullaniciAd'];
                $sifre = $_POST['sifre'];
                $_SESSION['kullaniciAd']=$kullaniciAd;
                if($kullaniciAd=='' && $sifre==''){
                    echo "<div style='background-color:#E71212;width:auto;height:auto;'>
<p style='text-align:center;font-size:13pt'>Kullanıcı adı veya şifre girilmedi.<img style='width:30px;height:30px' src='hata.png'/></div>";
                }
                $sor=mysql_fetch_array(mysql_query("select kid,kad,ksifre,rol from kullanicilar where kad='$kullaniciAd' and ksifre='$sifre' "))  or die(mysql_error());;
                $rol=$sor["rol"];
                $kuid=$sor["kid"];
                if($rol=="1"){
                    $_SESSION['kid']=$kuid;

                    echo "<div style='text-align:center;'><img src='3.gif'/></div>";
                    header("Refresh: 1; url=menu.php");exit;
                }
                if($rol=="0"){
                    echo "<div style='text-align:center;'><img src='3.gif'/></div>";
                    header("Refresh: 1; url=index.php"); exit;
                }
                ob_end_flush();
            }
            ?>
        </form>
    </div>

</div>
<script src="dosyalar/js/jquery.js"></script>
<script src="dosyalar/js/bootstrap.min.js"></script>
<script type="text/javascript" src="dosyalar/js/jquery.backstretch.min.js"></script>
</body>
</html>
