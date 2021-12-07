<?php

namespace Adhiana46\Bpjs\Vclaim;

use Adhiana46\Bpjs\BpjsService;

class Monitoring extends BpjsService
{
    private static $_instance;

    public function __construct($configuration)
    {
        parent::__construct($configuration);
    }

    public static function getInstance($configuration)
    {
        if (isset(self::$_instance))
            return self::$_instance;

        self::$_instance = new Monitoring($configuration);

        return self::$_instance;
    }

    /**
     * Get Data Kunjungan
     *
     * @param string $tglSep (yyyy-mm-dd)
     * @param string $jenisPelayanan (1. Rawat Inap 2. Rawat Jalan)
     */
    public function dataKunjungan($tglSep, $jenisPelayanan)
    {
        $response = $this->get("Monitoring/Kunjungan/Tanggal/$tglSep/JnsPelayanan/$jenisPelayanan");

        return $response;
    }

    /**
     * Get Data Klaim
     *
     * @param string $tglPulang (yyyy-mm-dd)
     * @param string $jenisPelayanan (1. Rawat Inap 2. Rawat Jalan)
     * @param string $statusKlaim (1. Proses Verifikasi 2. Pending Verifikasi 3. Klaim)
     */
    public function dataKlaim($tglPulang, $jenisPelayanan, $statusKlaim)
    {
        $response = $this->get("Monitoring/Klaim/Tanggal/$tglPulang/JnsPelayanan/$jenisPelayanan/Status/$statusKlaim");

        return $response;
    }

    /**
     * Get Histori Pelayanan Per Peserta
     *
     * @param string $noKartu (nomor kartu peserta)
     * @param string $tglMulai (yyyy-mm-dd, tanggal mulai pencarian)
     * @param string $tglAkhir (yyyy-mm-dd, tanggal akhir pencarian)
     */
    public function dataHistoryPelayananPeserta($noKartu, $tglMulai, $tglAkhir)
    {
        $response = $this->get("monitoring/HistoriPelayanan/NoKartu/$noKartu/tglMulai/$tglMulai/tglAkhir/$tglAkhir");

        return $response;
    }

    /**
     * Get Monitoring Klaim Jasa Raharja
     *
     * @param string $tglMulai (yyyy-mm-dd, tanggal mulai pencarian)
     * @param string $tglAkhir (yyyy-mm-dd, tanggal akhir pencarian)
     */
    public function dataKlaimJasaRaharja($tglMulai, $tglAkhir)
    {
        $response = $this->get("monitoring/JasaRaharja/tglMulai/$tglMulai/tglAkhir/$tglAkhir");

        return $response;
    }
}