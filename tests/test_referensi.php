<?php

require_once __DIR__.'/../vendor/autoload.php';

use Adhiana46\Bpjs\BpjsService;
use Adhiana46\Bpjs\Vclaim\Referensi;

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
    'cons_id' => $_ENV['CONSID'],
    'secret_key' => $_ENV['SECRETKEY'],
    'user_key' => $_ENV['USERKEY'],
    'base_url' => $_ENV['BASE_URL'],
    'service_name' => $_ENV['VCLAIM_SERVICE'],
    'kode_ppk' => $_ENV['KODE_PPK'],
    'nama_ppk' => $_ENV['NAMA_PPK'],
];

$referensi = Referensi::getInstance($config);

// $response = $referensi->diagnosa('A01.0');
// $response = $referensi->poli('Bedah Saraf');
// $response = $referensi->faskes('bandung', 2); // RS dengan nama mengandung kata "bandung"
// $response = $referensi->dokterPelayanan(1, date('Y-m-d'), 'MATA');
// $response = $referensi->propinsi();
// $response = $referensi->kabupaten('11'); // get kabupaten jawa barat
// $response = $referensi->kecamatan('0120'); // get kecamatan jawa barat - kab. bandung
// $response = $referensi->diagnosaprb();
// $response = $referensi->procedure('21.05');
// $response = $referensi->kelasrawat();
// $response = $referensi->dokter("Adhiana Mastur");
// $response = $referensi->spesialistik();
// $response = $referensi->ruangRawat();
// $response = $referensi->caraKeluar();
// $response = $referensi->pascaPulang();


echo "<pre>";
print_r($response);