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
                <li> <a data-toggle="modal" href="menu.php#myModal"> <span class="glyphicon glyphicon-pencil"></span>&nbsp;Not Al</a></li>
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
                            echo "<script>alert('Not Eklendi.Not Defterine Bakabilirsiniz.')</script>";
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
                <a href="javascript:;" >
                    <i class="fa fa-cogs"></i>
                    <span>Blog</span>
                </a>
                <ul class="sub">
                    <li><a  href="#">Haberler</a></li>
                    <li><a  href="#">Güncel</a></li>
                    <li><a  href="#">Bilgiler</a></li>
                </ul>
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
                    <span>Testler</span>
                </a>
                <ul class="sub">
                    <li><a  href="#">Derslere Yönelik Testler</a></li>
                    <li><a  href="#">Psikolojik Testler</a></li>
                    <li><a  href="#">IQ Testleri</a></li>
                </ul>
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
        <div style="position:relative;float:left;width:50%;height:auto;">
            <?php
            $baglanti = mysqli_connect('localhost','emir','1234','kayit');
            $sorgu=mysql_query("select DISTINCT ders_adi from ders where sinav_turu='kpss'");
            echo '<form action="" method="post">';
            echo '<fieldset><legend>Çalışmak İstediğiniz Dersi Seçin</legend><select 
style="width:240px;height:34px;overflow:hidden;background: url(acilir.jpg) no-repeat right #ddd;
border: 1px solid #ccc;padding-left:10px;-webkit-appearance: none;
        -moz-appearance: none;" name="ders_sec" >';
            echo '<option value="" >Ders Seç</option>';
            while ($kayit=mysql_fetch_array($sorgu)){
                echo '<option>'.$kayit["ders_adi"].'</option>';

            }
            echo '</select></fieldset></br>';
            echo '<button style=" background-color: #4CAF50;border: none;color: white;padding: 10px 20px;text-decoration: none;margin: 4px 2px;cursor: pointer;" id="tikla" type="submit" name="git">Konu Seç</button></form>';
            ?>

        </div>
        <div id="acilis" style="position:relative;float:left;width:50%;height:auto;">
            <div id="konular">
                <?php
                $baglanti = mysqli_connect('localhost','emir','1234','kayit');
                $secilenders=$_POST['ders_sec'];
                $sorgu=mysql_query("select DISTINCT ders_konu from ders where ders_adi='$secilenders' and sinav_turu='kpss'");
                echo '<form action="" method="post">';
                echo '<fieldset><legend>Çalışmak İstediğiniz Konuyu Seçin</legend><select style="width:240px;height:34px;overflow:hidden;background: url(acilir.jpg) no-repeat right #ddd;
border: 1px solid #ccc;padding-left:10px;-webkit-appearance: none;
        -moz-appearance: none;" id="konu" name="ders_konu_sec">';
                echo '<option value="" >Konu Seç</option>';
                while ($kayit=mysql_fetch_array($sorgu)){
                    echo '<option>'.$kayit["ders_konu"].'</option>';

                }
                echo '</select></fieldset></br>';
                echo '<button style="background-color: #4CAF50;border: none;color: white;padding: 10px 20px;text-decoration: none;margin: 4px 2px;cursor: pointer;"" id="dersi_ac" type="submit" name="derse_git">İçeriği Aç</button></form>';
                ?>
            </div>
        </div>
        <div style="position:relative;float:left;width:100%;height:600px;"><hr>
            <?php
            $baglanti = mysqli_connect('localhost','emir','1234','kayit');
            $secilenkonu=$_POST['ders_konu_sec'];
            $sorgu=mysql_query("select DISTINCT ders_konu,ders_icerik from ders where ders_konu='$secilenkonu' and sinav_turu='kpss'");
            while ($kayit=mysql_fetch_array($sorgu)){
                echo '<h2>'.$kayit["ders_konu"].'<h2><br><p>'.$kayit['ders_icerik'].'</p>';

            }
            ?>
        </div>
    </section>
</section>
<footer class="site-footer">
    <div class="text-center">
        2016 - WebteDers
        <a href="ygs.php" class="go-top">
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