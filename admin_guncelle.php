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
                <a class="active" href="admin.php">
                    <i class="fa fa-dashboard"></i>
                    <span>Anasayfa</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="admin_ekle.php" >
                    <i class=" fa fa-bar-chart-o"></i>
                    <span>Ekleme İşlemleri</span>
                </a>

            </li>
            <li class="sub-menu">
                <a href="admin_guncelle.php" >
                    <i class="fa fa-desktop"></i>
                    <span>Güncelleme İşlemleri</span>
                </a>

            </li>

            <li class="sub-menu">
                <a href="#" >
                    <i class="fa fa-cogs"></i>
                    <span>Silme İşlemleri</span>
                </a>

            </li>

        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<section id="main-content">
    <section class="wrapper">
        <div style="position:absolute;float:left;width:60%;height:auto;">
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
            <h3>Admin Kayıt Güncelle</h3>
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
        <div style="position:relative;margin-left:0%;width:100%;">
            <div class="col-lg-3 ds">

                <h3>Duyurular</h3>
                <!-- First Member -->

                <?php
                ob_start();
                error_reporting(0);
                $baglanti = mysqli_connect('localhost','emir','1234','kayit');
                $sorgu = "SELECT * FROM duyuru_ekle";
                $sorguSonucu = mysqli_query($baglanti, $sorgu) or trigger_error("Hata: ". mysqli_error($mysqli), E_USER_ERROR);
                if($sorguSonucu) {
                    echo "<table border='1px' >";
                    while($kayit = mysqli_fetch_assoc($sorguSonucu)) {

                        echo "<div style='background-color:#E8E5E5'><div style='font-size:13pt;font-weight:bold;'>&nbsp;"
                            .$kayit['dbaslik']."</div><div>".$kayit['tarih'].
                            "</div><div>".$kayit['dmesaj']."</div></div><hr>";

                    }
                }
                echo "</table>";
                ob_end_flush();
                ?>



            </div><!-- /col-lg-3 -->
        </div>
    </section>
</section>

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