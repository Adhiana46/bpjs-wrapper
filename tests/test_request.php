<?php

require_once __DIR__.'/../vendor/autoload.php';

use Adhiana46\Bpjs\BpjsService;
use Adhiana46\Bpjs\Vclaim\Peserta;

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

// Get Peserta
$response = Peserta::getInstance($config)->getByNoKartu('0000055335723', date('Y-m-d'));

echo "<pre>";
print_r($response);