<?php

namespace Adhiana46\Bpjs\Vclaim;

use Adhiana46\Bpjs\BpjsService;

class Peserta extends BpjsService
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

        self::$_instance = new Peserta($configuration);

        return self::$_instance;
    }

    public function getByNoKartu($noKartu, $tglPelayananSep)
    {
        $response = $this->get("Peserta/nokartu/$noKartu/tglSEP/$tglPelayananSep");

        return $response;
    }

    public function getByNik($nik, $tglPelayananSep)
    {
        $response = $this->get("Peserta/nik/$nik/tglSEP/$tglPelayananSep");

        return $response;
    }
}