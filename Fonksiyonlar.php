<?php
 
function MesajOku($SmsApiKey, $ID){
    global $SmsApiKey;

    $Baglanti = 'http://sms-activate.ru/stubs/handler_api.php?api_key='.$SmsApiKey.'&action=getStatus&status=1&id='.$ID.'&forward=0';
    $Kaynak = file_get_contents($Baglanti);
    if(preg_match('@STATUS_OK@', $Kaynak)){

        $Sms = trim(str_replace('STATUS_OK:', '', $Kaynak));
        return array('Durum' => 1, 'Sms' => $Sms);

    }else{

        return array('Durum' => 0);
        
    }

}

function YeniNumaraVer(){
    global $SmsApiKey;

    $Servis = 'go';
    //$Servis = 'ot';
    $Baglanti = 'http://sms-activate.ru/stubs/handler_api.php?api_key='.$SmsApiKey.'&action=getNumber&service='.$Servis.'&forward=0&ref=sinankarayaman';
    $Kaynak = file_get_contents($Baglanti);
    if(preg_match('@ACCESS_NUMBER@', $Kaynak)){

        $NumaraBilgisi = explode(':', str_replace('ACCESS_NUMBER:', '', $Kaynak));

        $ID = $NumaraBilgisi[0];
        $Numara = $NumaraBilgisi[1];
        return array('Durum' => 1, 'ID' => $ID, 'Numara' => $Numara, 'Site' => 'SmsActivate');

    }else{

        return array('Durum' => 0);

    }

}
?>
