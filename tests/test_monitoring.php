<?php

require_once __DIR__.'/../vendor/autoload.php';

use Adhiana46\Bpjs\BpjsService;
use Adhiana46\Bpjs\Vclaim\Monitoring;
use Adhiana46\Bpjs\Vclaim\RujukanV2;

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

$monitoring = Monitoring::getInstance($config);

// $response = $monitoring->dataKunjungan('2021-08-02', 1);
// $response = $monitoring->dataKlaim('2021-12-01', 1, 3);
// $response = $monitoring->dataHistoryPelayananPeserta('0000055335723', '2019-01-01', date('Y-m-d'));
// $response = $monitoring->dataKlaimJasaRaharja('2019-01-01', date('Y-m-d'));

$response = RujukanV2::getInstance($config)->listSarana($_ENV['KODE_PPK']);

echo "<pre>";
print_r($response);