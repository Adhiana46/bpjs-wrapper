<?php

namespace Adhiana46\Bpjs\Vclaim;

use Adhiana46\Bpjs\BpjsService;

class RujukanV1 extends BpjsService
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

        self::$_instance = new RujukanV1($configuration);

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
        $response = $this->post('Rujukan/insert', $data);

        return $response;
    }

    public function updateRujukan($data = [])
    {
        $response = $this->put('Rujukan/update', $data);

        return $response;
    }

    public function deleteRujukan($data = [])
    {
        $response = $this->delete('Rujukan/delete', $data);

        return $response;
    }
}