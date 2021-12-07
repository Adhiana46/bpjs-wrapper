<?php

namespace Adhiana46\Bpjs\Vclaim;

use Adhiana46\Bpjs\BpjsService;

class LPK extends BpjsService
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

        self::$_instance = new LPK($configuration);

        return self::$_instance;
    }

    public function insertLPK($data = [])
    {
        $response = $this->post('LPK/insert', $data);

        return $response;
    }

    public function updateLPK($data = [])
    {
        $response = $this->put('LPK/update', $data);

        return $response;
    }

    public function deleteLPK($data = [])
    {
        $response = $this->delete('LPK/delete', $data);

        return $response;
    }

    /**
     * Get Data LPK (Lembar Pengajuan Klaim)
     *
     * @param string $tglMasuk (yyyy-mm-dd)
     * @param string $jenisPelayanan (1. Inap 2.Jalan)
     */
    public function dataLPK($tglMasuk, $jenisPelayanan)
    {
        $response = $this->get("LPK/TglMasuk/$tglMasuk/JnsPelayanan/$jenisPelayanan");

        return $response;
    }
}