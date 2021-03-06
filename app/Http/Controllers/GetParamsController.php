<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetParamsController extends Controller
{
    /**
     * Get list of disticts given province.
     *
     * @param int $province_id
     * @return \Illuminate\Http\Response
     **/
    public function getDistricts($province_id)
    {
        $districts = DB::table("districts")->where("province_id", $province_id)->pluck('name', 'id')->all();

        return json_encode($districts);
    }

    /**
     * Get list of sectors given district.
     *
     * @param int $district_id
     * @return \Illuminate\Http\Response
     **/
    public function getSectors($district_id)
    {
        $sectors = DB::table("sectors")->where("district_id", $district_id)->pluck('name', 'id')->all();

        return json_encode($sectors);
    } 

    /**
     * Get list of cells given sector.
     *
     * @param int $sector_id
     * @return \Illuminate\Http\Response
     **/
    public function getCells($sector_id)
    {
        $cells = DB::table("cells")->where("sector_id", $sector_id)->pluck('name', 'id')->all();

        return json_encode($cells);
    }

    /**
     * Get list of villages given cell.
     *
     * @param int $cell_id
     * @return \Illuminate\Http\Response
     **/
    public function getVillages($cell_id)
    {
        $villages = DB::table("villages")->where("cell_id", $cell_id)->pluck('name', 'id')->all();

        return json_encode($villages);
    }

    /**
     * Get list of parishes given cell.
     *
     * @param int $diocese_id
     * @return \Illuminate\Http\Response
     **/
    public function getParishes($diocese_id)
    {
        $parishes = DB::table("parishes")->where("diocese_id", $diocese_id)->pluck('name', 'id')->all();

        return json_encode($parishes);
    }

    /**
     * Get list of chapelles given cell.
     *
     * @param int $parish_id
     * @return \Illuminate\Http\Response
     **/
    public function getChapelles($parish_id)
    {
        $chapelles = DB::table("chapelles")->where("parish_id", $parish_id)->pluck('name', 'id')->all();

        return json_encode($chapelles);
    }

    /**
     * Get list of zones given cell.
     *
     * @param int $chapelle_id
     * @return \Illuminate\Http\Response
     **/
    public function getZones($chapelle_id)
    {
        $zones = DB::table("zones")->where("chapelle_id", $chapelle_id)->pluck('name', 'id')->all();

        return json_encode($zones);
    }        
}
