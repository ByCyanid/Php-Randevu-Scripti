<?php ob_start(); ?>
<?php
if(basename($_SERVER['PHP_SELF'])==basename(__FILE__)){
  header("Location: ../index.php");
  exit();
}

?>
<?php include 'baglantilar/database.php'; ?>
<?php
$sayilar[]="";
$i=0;
$kac_sayi_uretilecek=1;
while($i<$kac_sayi_uretilecek)
{
  $rastgele=rand(1,900); 
  if (in_array($rastgele,$sayilar)) 
    {continue;} 
  else 
    {$sayilar[]=$rastgele; 
      $i++;
    }
  }
  foreach ($sayilar as $sayilar_ekrana);

  if (isset($_POST["Gonder"])) {  
    $gonderenid = $sayilar_ekrana;
    $isim = $_POST['isim'];
    $baslik = $_POST['baslik'];
    $eposta = $_POST['eposta'];
    $kullanicicevap = $_POST['kullanicicevap'];
    $yoneticicevap = 'Yonetici Mesaji Bekleniyor !';
    $durum = '1';
    $sql = "INSERT INTO destektalepleri (alanid, isim, baslik, eposta, kullanicicevap, yoneticicevap, durum) VALUES (:alanid, :isim, :baslik, :eposta, :kullanicicevap, :yoneticicevap, :durum)";
    $gonder = $conn->prepare($sql);
    $gonder->bindParam(':isim', $isim);
    $gonder->bindParam(':alanid', $gonderenid);
    $gonder->bindParam(':baslik', $baslik);
    $gonder->bindParam(':eposta', $eposta);
    $gonder->bindParam(':kullanicicevap', $kullanicicevap);
    $gonder->bindParam(':yoneticicevap', $yoneticicevap);
    $gonder->bindParam(':durum', $durum);
    $gonder->execute();
    if($gonder){
      $mesaj = '<div class="alert alert-dismissible alert-success">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>Destek talebi başarı ile oluşturuldu.</strong>
      </div>';
    }else{
      $mesaj = '<div class="alert alert-dismissible alert-danger">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>Talep başarısız !</strong>
      </div>';
    }
  }
  ?>
  <?php 
  $vericek = $conn -> prepare("SELECT * FROM ayarlar where id = 1");
  $vericek->bindParam(1, $_GET['id']);
  $vericek-> execute();
  $veriyigoster = $vericek -> fetch(PDO::FETCH_ASSOC);
  ?>


  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <form action="" method="post">
          <div class="message"></div>
          <?php if(!empty($mesaj)): ?>
            <p><?= $mesaj ?></p>
          <?php endif; ?>
          <div class="row">
            <div class="col-md-6 mx-auto">
              <div class="form-group">
                <label class="font-weight-bold">Adınız ve Soyadınız</label>
                <input type="text" name="isim" id="isim" class="form-control" placeholder="Ad Soyad:" autocapitalize="off">
              </div>
              <div class="form-group">
                <label class="font-weight-bold">Eposta Adresiniz</label>
                <input type="text" name="eposta" id="eposta" class="form-control" placeholder="E-Mail:" autocapitalize="off">
              </div>
              <div class="form-group">
                <label class="font-weight-bold">Başlığınız</label>
                <input type="text" name="baslik" id="baslik" class="form-control" placeholder="Örn:Siparişim Hakkında" autocapitalize="off">
              </div>
              <div class="form-group">
                <label class="font-weight-bold">Sorunuz</label>
                <input type="text" name="kullanicicevap" id="kullanicicevap" class="form-control" placeholder="Örn:Siparişimin Alındığını Nasıl Anlarım?" autocapitalize="off">
              </div>
              <div class="form-group">
                <button type="submit" name="Gonder" class="btn btn-primary btn-round">
                  Hemen Destek Talebi Oluştur !
                </button>
              </div>
              <div class="col-md-6">
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
