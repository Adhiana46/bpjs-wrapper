<?php

namespace Adhiana46\Bpjs\Vclaim;

use Adhiana46\Bpjs\BpjsService;

class Referensi extends BpjsService
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

        self::$_instance = new Referensi($configuration);

        return self::$_instance;
    }

    /**
     * Get Diagnosa by kode atau nama
     *
     * @param string $param
     */
    public function diagnosa($param)
    {
        $response = $this->get("referensi/diagnosa/$param");

        return $response;
    }

    /**
     * Get Poli by kode atau nama
     *
     * @param string $param
     */
    public function poli($param)
    {
        $response = $this->get("referensi/poli/$param");

        return $response;
    }

    /**
     * Get Fasilitas Kesehatan (Faskes) berdasarkan nama/kode, dan jenis faskes
     *
     * @param string $namaKode
     * @param string $jenis  (1. Faskes 1, 2. Faskes 2/RS)
     */
    public function faskes($namaKode, $jenis)
    {
        $response = $this->get("referensi/faskes/$namaKode/$jenis");

        return $response;
    }

    /**
     * Get Dokter DPJP berdasarkan jenis pelayanan, tgl pelayanan/sep, kode spesialis/subspesialis
     *
     * @param string $jenis_pelayanan (1. Rawat Inap, 2. Rawat Jalan)
     * @param string $tgl (format: yyyy-mm-dd)
     * @param string $kode
     */
    public function dokterPelayanan($jenis_pelayanan, $tgl, $kode)
    {
        $response = $this->get("referensi/dokter/pelayanan/$jenis_pelayanan/tglPelayanan/$tgl/Spesialis/$kode");

        return $response;
    }

    /**
     * Get Propinsi
     *
     */
    public function propinsi()
    {
        $response = $this->get("referensi/propinsi");

        return $response;
    }

    /**
     * Get Kabupaten By Propinsi
     *
     * @param string $kodeProv (kode provinsi)
     */
    public function kabupaten($kodeProv)
    {
        $response = $this->get("referensi/kabupaten/propinsi/$kodeProv");

        return $response;
    }

    /**
     * Get kecamatan By Kabupaten
     *
     * @param string $kodeKabupaten (Kode Kabupaten)
     */
    public function kecamatan($kodeKabupaten)
    {
        $response = $this->get("referensi/kecamatan/kabupaten/$kodeKabupaten");

        return $response;
    }

    /**
     * Get Diagnosa PRB
     *
     */
    public function diagnosaprb()
    {
        $response = $this->get("referensi/diagnosaprb");

        return $response;
    }

    /**
     * Get Obat Generik PRB
     *
     * @param string $nama
     */
    public function obatprb($nama)
    {
        $response = $this->get("referensi/obatprb/$nama");

        return $response;
    }

    /**
     * Get Data Procedure/Tindakan (Hanya untuk Lembar Pengajuan Klaim)
     *
     * @param string $q (kode / nama)
     */
    public function procedure($q)
    {
        $response = $this->get("referensi/procedure/$q");

        return $response;
    }

    /**
     * Get Data Kelas Rawat (Hanya untuk Lembar Pengajuan Klaim)
     */
    public function kelasrawat()
    {
        $response = $this->get("referensi/kelasrawat");

        return $response;
    }

    /**
     * Get Data Dokter DPJP (Hanya untuk Lembar Pengajuan Klaim)
     *
     * @param string $nama  (nama dokter)
     */
    public function dokter($nama)
    {
        $response = $this->get("referensi/dokter/$nama");

        return $response;
    }

    /**
     * Get Data Spesialistik (Hanya untuk Lembar Pengajuan Klaim)
     *
     */
    public function spesialistik()
    {
        $response = $this->get("referensi/spesialistik");

        return $response;
    }

    /**
     * Get Data Ruang Rawat (Hanya untuk Lembar Pengajuan Klaim)
     *
     */
    public function ruangRawat()
    {
        $response = $this->get("referensi/ruangrawat");

        return $response;
    }

    /**
     * Get Data Cara Keluar (Hanya untuk Lembar Pengajuan Klaim)
     *
     */
    public function caraKeluar()
    {
        $response = $this->get("referensi/carakeluar");

        return $response;
    }

    /**
     * Get Data Pasca Pulang (Hanya untuk Lembar Pengajuan Klaim)
     *
     */
    public function pascaPulang()
    {
        $response = $this->get("referensi/pascapulang");

        return $response;
    }
}