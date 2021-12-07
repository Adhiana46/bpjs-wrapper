<?php

namespace Adhiana46\Bpjs\Vclaim;

use Adhiana46\Bpjs\BpjsService;

class SepV1 extends BpjsService
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

        self::$_instance = new SepV1($configuration);

        return self::$_instance;
    }

    public function insertSep($data)
    {
        $response = $this->post('SEP/1.1/insert', $data);

        return $response;
    }

    public function updateSep($data)
    {
        $response = $this->put('SEP/1.1/Update', $data);

        return $response;
    }

    public function deleteSep($data)
    {
        $response = $this->delete('SEP/Delete', $data);

        return $response;
    }

    public function getSep($noSep)
    {
        $response = $this->get("SEP/$noSep");

        return $response;
    }
}