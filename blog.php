<?php
error_reporting(0);
session_start();
if($_SESSION['kullaniciAd']==""){
    header("Refresh: 0; url=login.php");exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WEBTEDERS</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href="dosyalar/css/bootstrap.css" rel="stylesheet">
    <link href="dosyalar/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="dosyalar/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="dosyalar/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="dosyalar/lineicons/style.css">
    <link href="dosyalar/css/style.css" rel="stylesheet">
    <link href="dosyalar/css/style-responsive.css" rel="stylesheet">
    <script src="dosyalar/js/chart-master/Chart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="menu.php" class="navbar-brand">WEBTEDERS</a>
        </div>

        <div>
            <ul class="nav navbar-nav">
            </ul>
            <form role="search" class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" placeholder="Ara..." class="form-control">
                </div>
                <button type="submit" class="btn btn-default">Ara</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li> <a data-toggle="modal" href="menu.php#myModal"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Not Al</a></li>
                <li><a data-toggle="modal" href="menu.php#myBilgi"><span class="glyphicon glyphicon-user"></span>&nbsp;Bilgilerim</a></li>
                <li><a href="cikis.php"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Çıkış Yap</a></li>
            </ul>
        </div>
    </div>
</nav>
<?php
include("ayarlar.php");
error_reporting(0);
if (isset($_POST['guncelle'])){
    session_start();
    ob_start();
    $kullaniciAd=$_POST["kullaniciAdi"];
    $sifre=$_POST["sifreniz"];
    $e_posta=$_POST["emailiniz"];
    $id=$_SESSION['kid'];
    $sorgu=mysql_query("update kullanicilar set kad='$kullaniciAd',ksifre='$sifre',kemail='$e_posta' where kid='$id' ");

}
?>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Not Defteri</h4>
            </div>
            <div class="modal-body">
                <form action="menu.php" method="post">
                    <?php
                    if(isset($_POST['submit'])){
                        session_start();
                        ob_start();
                        $baglanti = mysqli_connect('localhost','emir','1234','kayit');
                        $yaz=$_POST['yaz'];
                        $id=$_SESSION['kid'];
                        $zaman=date("d M Y H:i:s");
                        $sql ="insert into not_ekle (nyaz,ntarih,kid) values('$yaz','$zaman','$id')";
                        if($baglanti->query($sql) == TRUE){
                            echo "<script>alert('Notunuz Eklendi.Not Defterine Bakabilirsiniz.')</script>";
                        }
                        ob_end_flush();
                    }
                    ?>
                    <textarea style='width:570px;height:400px;background-color:#CDBF79;resize:none;' type="text" class="form-control" name="yaz"></textarea><br>
                    <button data-dismiss="modal" class="btn btn-default" type="button">İptal</button>
                    <button name="submit" class="btn btn-theme" type="submit">Kaydet</button>
                </form>
            </div>

        </div>
    </div>
</div>


<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myBilgi" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Kayıt Güncelle</h4>
            </div>
            <div class="modal-body">

                <form action="menu.php" method="post">
                    Kullanıcı Adı <input type="text" class="form-control" name="kullaniciAdi" autofocus>
                    <br>
                    Şifre <input type="password" class="form-control" name="sifreniz" >
                    <br>
                    E-Posta<input type="text" name="emailiniz" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
                    <br>
                    <button data-dismiss="modal" class="btn btn-default" type="button">İptal</button>
                    <button name="guncelle" class="btn btn-theme" type="submit">Güncelle</button>
                </form>
            </div>


        </div>
    </div>
</div>

<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
            <?php
            ob_start();
            error_reporting(0);
            session_start();
            echo "<h3 style='color: #ffffff;
	font-size: 16px;
	padding: 0 10px;
	line-height: 60px;
	height: 60px;
	margin: 0;
	background: #ABA8A8;
	text-align: center;'>Merhaba ".$_SESSION['kullaniciAd']."</h3>";
            ob_end_flush();
            ?>

            <li class="mt">
                <a class="active" href="menu.php">
                    <i class="fa fa-dashboard"></i>
                    <span>Anasayfa</span>
                </a>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fa fa-desktop"></i>
                    <span>Sınavlar</span>
                </a>
                <ul class="sub">
                    <li><a  href="ygs.php">YGS</a></li>
                    <li><a  href="lys.php">LYS</a></li>
                    <li><a  href="kpss.php">KPSS</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="blog.php" >
                    <i class="fa fa-cogs"></i>
                    <span>Blog Oluştur</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="soru_cevap.php" >
                    <i class="fa fa-book"></i>
                    <span>Soru-Cevap</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="not.php" >
                    <i class="fa fa-tasks"></i>
                    <span>Not Defterim</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fa fa-th"></i>
                    <span>Yayınlanan Bloklar</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="paylas.php" >
                    <i class=" fa fa-bar-chart-o"></i>
                    <span>Yorumlar</span>
                </a>

            </li>

        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<section id="main-content">
    <section class="wrapper">

        <div style="position:relative;float:left;width:70%;height:auto;">
            <form action="" method="post">
                <h4 class="form-baslik">Eğitimle İlgili Fikirlerinizi,Deneyimlerinizi ve Çalışmalarınızı Kendi Bloğunuzda Paylaşın</h4>
                <?php

                if(isset($_POST['yeni_blok'])){
                    session_start();
                    ob_start();
                    error_reporting(0);
                    $baglanti = mysqli_connect('localhost','emir','1234','kayit');
                    $baslik=$_POST['baslik'];
                    $meslek=$_POST['meslek'];
                    $hakkimda=$_POST['hakkimda'];
                    $blokkonu=$_POST['blokkonu'];
                    $fikir=$_POST['fikir'];
                    $id=$_SESSION['kid'];
                    $zaman=date("d M Y H:i:s");
                    $sql ="INSERT INTO blok (blok_baslik,blok_meslek,blok_hakkimda,blok_konu,blok_fikir,tarih,kid) VALUES('$baslik','$meslek','$hakkimda','$blokkonu','$fikir','$zaman','$id')";
                    if($baslik=="" || $meslek=="" || $hakkimda=="" || $blokkonu=="" || $fikir=="") {
                        echo "<div style='background-color:#E71212;width:auto;height:auto;'>
				<p style='text-align:center;font-size:13pt'>Lütfen tüm bilgileri doldurunuz.<img style='width:30px;height:30px' src='hata.png'/></div>";
                    }
                    else if($baglanti->query($sql) == TRUE){
                        echo "<div style='background-color:#79C53A;width:auto;height:auto;'>
				<p style='text-align:center;font-size:13pt'>Bloğunuz Oluşturuldu.<img style='width:30px;height:30px' src='onay.png'/></div>";

                    }
                    ob_end_flush();
                }
                ?>

                <div class="login-wrap">
                    <h3>Bloğa Yazılacak Bilgileri Doldurunuz</h3>
                    Blog Başlığı: <input style='padding:20px' type="text" class="form-control" placeholder="Başlık Yazınız" name="baslik" autofocus><br>
                    Mesleğiniz: <input style='padding:20px' type="text" class="form-control" placeholder="Mesleğinizi Yazınız" name="meslek" autofocus><br>
                    Hakkımda: <textarea style='height:200px;padding-left:10px;resize:none;' type="text" class="form-control" placeholder="Bloğunuzda Kendinizi Tanıtabilirsiniz..." name="hakkimda"></textarea><br>
                    Blog Konusu: <input style='padding:20px' type="text" class="form-control" placeholder="Blok Konusunu Yazınız" name="blokkonu" autofocus><br>
                    Bloğa Ekle: <textarea style='height:200px;padding-left:10px;resize:none;' type="text" class="form-control" placeholder="Bloğunuza Düşüncelerinizi Yazabilirsiniz..." name="fikir"></textarea><br>
                    <button style='width:150px;background-color:#44CC3F' class="btn btn-theme btn-block" type="submit" name="yeni_blok"><i class="fa fa-lock">&nbsp;</i>Yeni Blog Oluştur</button>
                </div>
            </form>
            <br>

            <?php
            ob_start();
            error_reporting(0);
            $id=$_SESSION['kid'];
            $baglanti = mysqli_connect('localhost','emir','1234','kayit');
            $sorgu = "SELECT DISTINCT b.blok_baslik, b.blok_meslek,b.blok_hakkimda,b.blok_konu,b.blok_fikir,b.tarih FROM blok as b where '$id'=b.kid ";
            $sorguSonucu = mysqli_query($baglanti, $sorgu) or trigger_error("Hata: ". mysqli_error($mysqli), E_USER_ERROR);
            if($sorguSonucu) {
                echo "<table border='1px' >";
                while($kayit = mysqli_fetch_assoc($sorguSonucu)){
                    echo '<div style="border:1px solid black;display:block"><div style="padding:30px;color:#4865A2;font-size:15pt;background-color:#DCD6D6">'
                        .$kayit['blok_baslik'].'</div><div style="padding:15px 30px;color:#4865A2;font-size:15pt;">'
                        .$kayit['blok_meslek'].'</div><div style="position:relative;float:left;width:60%;height:500px;border:1px solid black;padding:10px"><div>Yüklenme:'
                        .$kayit['tarih'].'</div><div style="font-weight:bold;font-size:14pt">- '
                        .$kayit['blok_konu'].'</div><div>'
                        .$kayit['blok_fikir'].'</div></div><div style="width:40%;height:500px;float:right;padding:15px 30px;color:#4865A2;font-size:15pt;border:1px solid black"><h4 style="text-align:center;text-decoration:underline">Hakkımda</h4>'
                        .$kayit['blok_hakkimda'].'</div></div>';


                }
            }
            echo "</table>";
            ob_end_flush();
            ?>
        </div>
        <div style="position:absolute;width:21%;"
        <div class="col-lg-3 ds">
            <h3>Haberler</h3>

            <!-- First Action -->
            <div class="desc">

                <div class="details">
                    <p>Haberler Burada Olacak</p>
                </div>
            </div>
            <!-- Second Action -->
            <div class="desc">
                <div class="details">
                    <p>Haberler Burada Olacak</p>
                </div>
            </div>
            <!-- Third Action -->
            <div class="desc">
                <div class="details">
                    <p>Haberler Burada Olacak</p>
                </div>
            </div>
            <!-- Fourth Action -->
            <div class="desc">
                <div class="details">
                    <p>Haberler Burada Olacak</p>
                </div>
            </div>
            <!-- Fifth Action -->
            <div class="desc">
                <div class="details">
                    <p>Haberler Burada Olacak</p>
                </div>
            </div>
            <!-- USERS ONLINE SECTION -->
            <h3>Duyurular</h3>
            <!-- First Member -->
            <div class="desc">
                <div class="details">
                    <p>Burada Duyurular Olacak</p>
                </div>
            </div>
            <!-- Second Member -->
            <div class="desc">

                <div class="details">
                    <p>Burada Duyurular Olacak</p>
                </div>
            </div>
            <!-- Third Member -->
            <div class="desc">
                <div class="details">
                    <p>Burada Duyurular Olacak</p>
                </div>
            </div>
            <!-- Fourth Member -->
            <div class="desc">
                <div class="details">
                    <p>Burada Duyurular Olacak</p>
                </div>
            </div>
            <!-- Fifth Member -->
            <div class="desc">
                <div class="details">
                    <p>Burada Duyurular Olacak</p>
                </div>
            </div>
        </div>
    </section>
</section>
<footer class="site-footer">
    <div class="text-center">
        2016 - WebteDers
        <a href="paylas.php" class="go-top">
            <i class="fa fa-angle-up"></i>
        </a>
    </div>
</footer>
<script src="dosyalar/js/jquery.js"></script>
<script src="dosyalar/js/jquery-1.8.3.min.js"></script>
<script src="dosyalar/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="dosyalar/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="dosyalar/js/jquery.scrollTo.min.js"></script>
<script src="dosyalar/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="dosyalar/js/jquery.sparkline.js"></script>
<script src="dosyalar/js/common-scripts.js"></script>
<script type="text/javascript" src="dosyalar/js/gritter/js/jquery.gritter.js"></script>
<script type="text/javascript" src="dosyalar/js/gritter-conf.js"></script>
<script src="dosyalar/js/sparkline-chart.js"></script>
<script src="dosyalar/js/zabuto_calendar.js"></script>
</body>
</html>