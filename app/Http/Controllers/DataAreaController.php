<?php

namespace App\Http\Controllers;

use App\Models\DataArea;
use Illuminate\Http\Request;

class DataAreaController extends Controller
{
    public function index()
    {
        $provinces = DataArea::select('province_code','province_name')->distinct()->get();
        dd($provinces);
        return view('companies.index', compact('provinces '));
    }

    public function getCities($province_id)
    {
        $cities = DataArea::select('city_code','city_name')
        ->where('province_code', $province_id)
        ->orderBy('city_code', 'asc')
        ->distinct()
        ->get();
        return response()->json($cities);
    }

    public function getDistrict($city_id)
    {
        $district = DataArea::select('district_code','district_name')
        ->where('city_code', $city_id)
        ->orderBy('district_code', 'asc')
        ->distinct()
        ->get();
        return response()->json($district);
    }

    public function getSubdistrict($district_id)
    {
        $subdistrict = DataArea::select('subdistrict_code','subdistrict_name')
        ->where('district_code', $district_id)
        ->orderBy('subdistrict_code', 'asc')
        ->distinct()
        ->get();
        return response()->json($subdistrict);
    }
}
