<?php

namespace Adhiana46\Bpjs\Vclaim;

use Adhiana46\Bpjs\BpjsService;

class RujukanV2 extends BpjsService
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

        self::$_instance = new RujukanV2($configuration);

        return self::$_instance;
    }

    /**
     * Pencarian data rujukan dari Pcare/Rumah Sakit berdasarkan nomor rujukan
     *
     * @param string $noRujukan
     * @param string $jenis ([pcare], rs)
     */
    public function getByNomorRujukan($noRujukan, $jenis = 'pcare')
    {
        $response = null;
        switch ($jenis) {
            case 'rs':
                $response = $this->get("Rujukan/RS/$noRujukan");
                break;
            default:
                $response = $this->get("Rujukan/$noRujukan");
        }

        return $response;
    }

    /**
     * Pencarian data rujukan dari PCare/Rumah Sakit berdasarkan nomor kartu
     *
     * @param string $noKartu
     * @param string $jenis ([pcare], rs)
     */
    public function getByNomorKartu($noKartu, $jenis = 'pcare')
    {
        $response = null;
        switch ($jenis) {
            case 'rs':
                $response = $this->get("Rujukan/RS/Peserta/$noKartu");
                break;
            default:
                $response = $this->get("Rujukan/Peserta/$noKartu");
        }

        return $response;
    }

    /**
     * Pencarian data rujukan dari PCare/Rumah Sakit berdasarkan nomor kartu (Multiple)
     *
     * @param string $noKartu
     * @param string $jenis ([pcare], rs)
     */
    public function getListByNomorKartu($noKartu, $jenis = 'pcare')
    {
        $response = null;
        switch ($jenis) {
            case 'rs':
                $response = $this->get("Rujukan/RS/List/Peserta/$noKartu");
                break;
            default:
                $response = $this->get("Rujukan/List/Peserta/$noKartu");
        }

        return $response;
    }

    public function insertRujukan($data = [])
    {
        $response = $this->post('Rujukan/2.0/insert', $data);

        return $response;
    }

    public function updateRujukan($data = [])
    {
        $response = $this->put('Rujukan/2.0/Update', $data);

        return $response;
    }

    public function deleteRujukan($data = [])
    {
        $response = $this->delete('Rujukan/delete', $data);

        return $response;
    }

    public function insertRujukanKhusus($data = [])
    {
        $response = $this->post('Rujukan/Khusus/insert', $data);

        return $response;
    }

    public function deleteRujukanKhusus($data = [])
    {
        $response = $this->post('Rujukan/Khusus/delete', $data);

        return $response;
    }

    /**
     * Get Data Rujukan Khusus
     *
     * @param string $bulan (1-12)
     * @param string $tahun
     */
    public function listRujukanKhusus($bulan, $tahun)
    {
        $response = $this->get("Rujukan/Khusus/List/Bulan/$bulan/Tahun/$tahun");

        return $response;
    }

    /**
     * Get Data Spesialistik
     *
     * @param string $kodePpk
     * @param string $tglRujukan (yyyy-mm-dd)
     */
    public function listSpesialistikRujukan($kodePpk, $tglRujukan)
    {
        $response = $this->get("Rujukan/ListSpesialistik/PPKRujukan/$kodePpk/TglRujukan/$tglRujukan");

        return $response;
    }

    /**
     * Get Data Saran
     *
     * @param string $kodePpk
     */
    public function listSarana($kodePpk)
    {
        $response = $this->get("Rujukan/ListSarana/PPKRujukan/$kodePpk");

        return $response;
    }
}