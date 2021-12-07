<?php

require_once __DIR__.'/../vendor/autoload.php';

use Adhiana46\Bpjs\BpjsService;
use Adhiana46\Bpjs\Vclaim\SepV1;

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

$sepService = SepV1::getInstance($config);

$dataSep = [
    'request' => array(
        't_sep' => array(
            'noKartu' => '0000055335723',
            'tglSep' => date('Y-m-d H:i:s'),
            // 'ppkPelayanan' => $this->input->post('ppk_pelayanan'),
            'ppkPelayanan' => $config['kode_ppk'],
            'jnsPelayanan' => 2, // rawat jalan
            'klsRawat' => 3,
            'noMR' => '000006',
            'rujukan' => '#',
            'catatan' => 'ini catatan',
            'diagAwal' => 'A01.0',
            'poli' => array(
                'tujuan' => 'BSY',
                'eksekutif' => '0',
            ),
            'cob' => array(
                'cob' => '0',
            ),
            'katarak' => array(
                'katarak' => '0',
            ),
            'jaminan' => array(
                'lakaLantas' => '0',
                'penjamin' => array(
                    'penjamin' => '',
                    'tglKejadian' => '',
                    'keterangan' => '',
                    'suplesi' => array(
                        'suplesi' => '0',
                        'noSepSuplesi' => $this->input->post('no_sep_suplesi'),
                        'lokasiLaka' => array(
                            'kdPropinsi' => $this->input->post('laka_kode_propinsi'),
                            'kdKabupaten' => $this->input->post('laka_kode_kabupaten'),
                            'kdKecamatan' => $this->input->post('laka_kode_kecamatan'),
                        ),
                    ),
                ),
            ),
            'skdp' => array(
                'noSurat' => $this->input->post('skdp_no_surat'),
                'kodeDPJP' => $this->input->post('skdp_kode_dpjp'),
            ),
            'noTelp' => $this->input->post('no_telp') ? : "-",
            'user' => $user,
        ),
    ),
];
$response = $sepService->insertSep($dataSep);

echo "<pre>";
print_r($response);