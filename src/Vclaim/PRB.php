<?php

namespace Adhiana46\Bpjs\Vclaim;

use Adhiana46\Bpjs\BpjsService;

class PRB extends BpjsService
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

        self::$_instance = new PRB($configuration);

        return self::$_instance;
    }

    public function insertPRB($data = [])
    {
        $response = $this->post('PRB/insert', $data);

        return $response;
    }

    public function updatePRB($data = [])
    {
        $response = $this->put('PRB/Update', $data);

        return $response;
    }

    public function deletePRB($data = [])
    {
        $response = $this->delete('PRB/Delete', $data);

        return $response;
    }

    public function getByNomor($noSRB, $noSEP)
    {
        $response = $this->get("prb/$noSRB/nosep/$noSEP");

        return $response;
    }

    public function getByTanggal($tanggalMulai, $tanggalAkhir)
    {
        $response = $this->get("prb/tglMulai/$tanggalMulai/tglAkhir/$tanggalAkhir");

        return $response;
    }
}