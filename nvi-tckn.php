<?php
    if ($_POST['tckn'] == NULL) {
        echo 'TC Kimlik Numarası Boş.';
    } elseif ($_POST['name'] == NULL) {
        echo 'İsim Kısmı Boş';
    } elseif ($_POST['surname'] == NULL) {
        echo 'Soyad Kısmı Boş';
    } elseif ($_POST['birthy'] == NULL) {
        echo 'Doğum Yılı Boş';
    } else {
        $url = 'https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL';
        $client = new SoapClient($url);
        $result = $client->TCKimlikNoDogrula([
            'TCKimlikNo' => $_POST['tckn'],
            'Ad' => mb_strtoupper($_POST['name'], "UTF-8"),
            'Soyad' => mb_strtoupper($_POST['surname'], "UTF-8"),
            'DogumYili' => $_POST['birthy']
        ]);
        if ($result->TCKimlikNoDogrulaResult) {
            echo 'T.C. Kimlik Numarası Başarıyla Doğrulandı_true';
        } else {
            echo 'TC Kimlik Numarası Geçersiz Doğrulanmadı_false';
        }
    }
?>