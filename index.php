<?php

error_reporting(0);
$SmsApiKey = 'REPLACE-API-KEY';

include('Fonksiyonlar.php');
 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Numara</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>


	<div id="Genel">
		
		<center><a href="index.php?Neresi=NumaraVer" class="numaraVer">Numara Ver</a></center>

	<?php

		if(isset($_GET['Neresi']) && $_GET['Neresi']=='YeniMesaj'){

		    $TelefonNumaraID = $_GET['NumaraID'];
		    $Baglanti = 'http://sms-activate.ru/stubs/handler_api.php?api_key='.$SmsApiKey.'&action=setStatus&status=3&id='.$TelefonNumaraID.'&forward=0'; // Tekrar Başka Sms Kontrolü
		    $Kaynak = file_get_contents($Baglanti);

		    if(preg_match('@ACCESS_RETRY_GET@', $Kaynak)){

		?>

			<div class="numaralar" style="margin-top: 25px;">Numara Yenilendi</div>

		<?php

		    }else{

		?>

			<div class="numaralar" style="margin-top: 25px;">Numara YENİLENEMEDİ</div>

		<?php
		    }

		}

		if(isset($_GET['Neresi']) && $_GET['Neresi']=='MesajOku'){

		    $TelefonNumaraID = $_GET['NumaraID'];
		    $MesajOku = MesajOku($SmsApiKey, $TelefonNumaraID);
		    if($MesajOku['Durum']){

		        $Sms = $MesajOku['Sms'];
		        $Kod = preg_match('@([0-9]+)@', $Sms, $Kod)?end($Kod):false;
		        if($Kod){

		?>

			<div class="numaralar" style="margin-top: 25px;">Mesaj: <?=$Kod?></div>

		<?php

		        }else{

		?>

			<div class="numaralar" style="margin-top: 25px;">Mesaj Bulunamadı</div>

		<?php

		        }

		    }else{

		?>

			<div class="numaralar" style="margin-top: 25px;">Mesaj Bulunamadı</div>

		<?php

		    }

		}

		if(isset($_GET['Neresi']) && $_GET['Neresi']=='NumaraVer'){

		    $YeniNumaraVer = YeniNumaraVer($SmsApiKey);
		    $TelefonNumarasi = $YeniNumaraVer['Numara'];
		    $TelefonNumaraID = $YeniNumaraVer['ID'];
	?>

			<div class="numaralar" style="margin-top: 25px;">Telefon Numarası: <span><?=$TelefonNumarasi?></span></div>
			<div class="numaralar" style="margin-bottom: 25px;">Telefon Numarası ID: <span><?=$TelefonNumaraID?></span></div>

		    <center><a href="index.php?Neresi=YeniMesaj&NumaraID=<?=$TelefonNumaraID?>" target="_blank" class="numaraVer">Numarayı Yenile</a></center>

		    <center><a href="index.php?Neresi=MesajOku&NumaraID=<?=$TelefonNumaraID?>" target="_blank" class="numaraVer">Mesaj Kontrol</a></center>

	<?php

		}

	?>
	</div>

</body>
</html>
