<?php

namespace Adhiana46\Bpjs\Vclaim;

use Adhiana46\Bpjs\BpjsService;

class RencanaKontrol extends BpjsService
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

        self::$_instance = new RencanaKontrol($configuration);

        return self::$_instance;
    }

    public function insertRencanaKontrol($data = [])
    {
        $response = $this->post('RencanaKontrol/insert', $data);

        return $response;
    }

    public function updateRencanaKontrol($data = [])
    {
        $response = $this->put('RencanaKontrol/Update', $data);

        return $response;
    }

    public function hapusRencanaKontrol($data = [])
    {
        $response = $this->delete('RencanaKontrol/Delete', $data);

        return $response;
    }

    public function insertSPRI($data = [])
    {
        $response = $this->post('RencanaKontrol/InsertSPRI', $data);

        return $response;
    }

    public function updateSPRI($data = [])
    {
        $response = $this->put('RencanaKontrol/UpdateSPRI', $data);

        return $response;
    }

    public function cariSep($noSep)
    {
        $response = $this->get("RencanaKontrol/nosep/$noSep");

        return $response;
    }

    public function cariSuratKontrol($noSuratKontrol)
    {
        $response = $this->get("RencanaKontrol/noSuratKontrol/$noSuratKontrol");

        return $response;
    }

    /**
     * Get Data Rencana Kontrol
     *
     * @param string $tglAwal (yyyy-mm-dd)
     * @param string $tglAkhir (yyyy-mm-dd)
     * @param string $filter (1: tanggal entri, 2: tanggal rencana kontrol)
     */
    public function dataSuratKontrol($tglAwal, $tglAkhir, $filter)
    {
        $response = $this->get("RencanaKontrol/ListRencanaKontrol/tglAwal/$tglAwal/tglAkhir/$tglAkhir/filter/$filter");

        return $response;
    }

    /**
     * Get Data Poli/Spesialistik
     *
     * @param string $jenisKontrol (1: SPRI, 2: Rencana Kontrol)
     * @param string $nomor (jika jenis kontrol = 1, maka diisi nomor kartu; jika jenis kontrol = 2, maka diisi nomor SEP)
     * @param string $tglRencanaKontrol (yyyy-MM-dd)
     */
    public function dataPoliSpesialistik($jenisKontrol, $nomor, $tglRencanaKontrol)
    {
        $response = $this->get("RencanaKontrol/ListSpesialistik/JnsKontrol/$jenisKontrol/nomor/$nomor/TglRencanaKontrol/$tglRencanaKontrol");

        return $response;
    }

    /**
     * Get Data Dokter
     *
     * @param string $jenisKontrol (1: SPRI, 2: Rencana Kontrol)
     * @param string $kodePoli
     * @param string $tglRencanaKontrol (yyyy-MM-dd)
     */
    public function dataDokter($jenisKontrol, $kodePoli, $tglRencanaKontrol)
    {
        $response = $this->get("RencanaKontrol/JadwalPraktekDokter/JnsKontrol/$jenisKontrol/KdPoli/$kodePoli/TglRencanaKontrol/$tglRencanaKontrol");

        return $response;
    }
}