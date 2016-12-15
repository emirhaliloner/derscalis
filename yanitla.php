<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <script>
        $(document).ready(function(){
            $(".vazgec").click(function(){
                $("#acilis").hide();
            });
            $(".ac").click(function(){
                $("#acilis").show();
            });

        });
    </script>
</head>
<body>
<?php
error_reporting(0);
$form= <<<HTML
<div style="display:none" id="acilis">
<form action="" method="post">
<textarea style='width:1000px;height:100px;resize:none;' 
type="text" class="form-control" name="yanit" placeholder="Yanıtla"></textarea>
<button name="gonder" class="btn btn-theme" type="submit">Kaydet</button>
</form>
</div>
HTML;
$baglanti = mysqli_connect('localhost','emir','1234','kayit');
$sorgu = "SELECT k.kad,s.soru,s.tarih,c.cyanit,c.ctarih FROM kullanicilar as k,soru_ekle as s,cevap_ekle as c where k.kid=s.kid and s.sid=c.sid";
$sorguSonucu = mysqli_query($baglanti, $sorgu) or trigger_error("Hata: ". mysqli_error($mysqli), E_USER_ERROR);
if($sorguSonucu) {
    echo "<table border='1px' >";
    while($kayit = mysqli_fetch_assoc($sorguSonucu)) {
        echo "<div style='background-color:#E8E5E5'><div style='font-size:13pt;font-weight:bold;'><img style='float:left;width:25px;height:25px;' src='icon.png'/>&nbsp;"
            .$kayit['kad']."</div><br><div style='padding:5px;border:0px;border-radius:5px;'>Soru:"
            . $kayit['soru'] . "</div>Tarih:".$kayit['tarih']."<br><hr>Cevap:".$kayit['cyanit']."<br>Tarih: ".$kayit['ctarih']."<button class='ac'>Yanıtla</button><button class='vazgec'>Vazgeç</button><hr></div>";

        echo $form;
    }

}
echo "</table>";


if(isset($_POST['gonder'])){
    session_start();
    $yaz=$_POST['yanit'];
    $id=$_SESSION['kid'];
    $sid=$_SESSION['soru_id'];
    $zaman=date("d M Y H:i:s");
    $sql ="insert into cevap_ekle (cyanit,ctarih,kid,sid) values('$yaz','$zaman','$id','$sid')";
    if($baglanti->query($sql) == TRUE){
        echo "<script>alert('Yanit Eklendi.')</script>";
    }
}

?>
</body>
</html>