<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShippingController extends Controller
{
    // Koordinat Setiabudi, Jakarta Selatan (titik asal toko)
    private const ORIGIN_LAT = -6.2088;
    private const ORIGIN_LNG = 106.8226;

    private function getLocations(): array
    {
        $path = storage_path('app/indonesian_locations.json');
        if (!file_exists($path)) return [];
        return json_decode(file_get_contents($path), true) ?? [];
    }

    private function haversine(float $lat1, float $lng1, float $lat2, float $lng2): float
    {
        $R = 6371;
        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);
        $a = sin($dLat/2)**2 + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLng/2)**2;
        return $R * 2 * atan2(sqrt($a), sqrt(1 - $a));
    }

    private function getShippingTier(float $km): array
    {
        if ($km <= 15)   return ['zone'=>'Dalam Kota','reguler'=>9000,'express'=>15000,'ekonomi'=>7000,'sameday'=>20000,'etd_reg'=>'1-2 hari','etd_exp'=>'Hari ini - 1 hari','etd_eko'=>'2-3 hari','etd_sd'=>'Hari ini'];
        if ($km <= 50)   return ['zone'=>'Jabodetabek','reguler'=>12000,'express'=>20000,'ekonomi'=>9000,'sameday'=>null,'etd_reg'=>'1-2 hari','etd_exp'=>'1 hari','etd_eko'=>'2-4 hari','etd_sd'=>null];
        if ($km <= 200)  return ['zone'=>'Jawa Barat','reguler'=>15000,'express'=>25000,'ekonomi'=>11000,'sameday'=>null,'etd_reg'=>'2-3 hari','etd_exp'=>'1-2 hari','etd_eko'=>'3-5 hari','etd_sd'=>null];
        if ($km <= 600)  return ['zone'=>'Jawa','reguler'=>20000,'express'=>32000,'ekonomi'=>15000,'sameday'=>null,'etd_reg'=>'2-4 hari','etd_exp'=>'1-2 hari','etd_eko'=>'4-6 hari','etd_sd'=>null];
        if ($km <= 1200) return ['zone'=>'Jawa Timur/Bali','reguler'=>25000,'express'=>40000,'ekonomi'=>18000,'sameday'=>null,'etd_reg'=>'3-5 hari','etd_exp'=>'1-3 hari','etd_eko'=>'5-7 hari','etd_sd'=>null];
        if ($km <= 2500) return ['zone'=>'Luar Jawa','reguler'=>35000,'express'=>55000,'ekonomi'=>25000,'sameday'=>null,'etd_reg'=>'4-7 hari','etd_exp'=>'2-4 hari','etd_eko'=>'6-10 hari','etd_sd'=>null];
        return ['zone'=>'Indonesia Timur','reguler'=>50000,'express'=>80000,'ekonomi'=>35000,'sameday'=>null,'etd_reg'=>'5-10 hari','etd_exp'=>'3-5 hari','etd_eko'=>'8-14 hari','etd_sd'=>null];
    }

    public function searchDestination(Request $request)
    {
        $request->validate(['search' => 'required|string|min:2']);
        $q = strtolower($request->search);
        $locations = $this->getLocations();

        $results = collect($locations)->filter(function ($loc) use ($q) {
            $haystack = strtolower(($loc['subdistrict_name']??'').' '.($loc['district_name']??'').' '.($loc['city_name']??'').' '.($loc['province_name']??''));
            return str_contains($haystack, $q);
        })->take(10)->map(function ($loc) {
            $km = $this->haversine(self::ORIGIN_LAT, self::ORIGIN_LNG, $loc['latitude'], $loc['longitude']);
            $loc['distance_km'] = round($km, 1);
            $loc['label'] = ($loc['subdistrict_name']??'-').', '.($loc['district_name']??'').', '.($loc['city_name']??'').' - '.($loc['province_name']??'');
            return $loc;
        })->values()->toArray();

        return response()->json(['status' => 'success', 'data' => $results]);
    }

    public function getRates(Request $request)
    {
        $request->validate([
            'destination_subdistrict_id' => 'required|integer',
            'weight' => 'required|integer|min:1',
        ]);

        $locations = $this->getLocations();
        $dest = collect($locations)->firstWhere('id', $request->destination_subdistrict_id);

        if (!$dest) {
            return response()->json(['status'=>'error','message'=>'Lokasi tidak ditemukan.','data'=>[]], 404);
        }

        $km = $this->haversine(self::ORIGIN_LAT, self::ORIGIN_LNG, $dest['latitude'], $dest['longitude']);
        $tier = $this->getShippingTier($km);
        $weightMultiplier = max(1, $request->weight / 1000);

        $rates = [];
        $rates[] = ['code'=>'jne-reg','name'=>'JNE Reguler','desc'=>$tier['zone'].' (~'.round($km).' km)','etd'=>$tier['etd_reg'],'price'=>(int)round($tier['reguler']*$weightMultiplier)];
        $rates[] = ['code'=>'sicepat-best','name'=>'SiCepat BEST','desc'=>'Express - '.$tier['zone'],'etd'=>$tier['etd_exp'],'price'=>(int)round($tier['express']*$weightMultiplier)];
        $rates[] = ['code'=>'jnt-eco','name'=>'J&T Ekonomi','desc'=>'Hemat - '.$tier['zone'],'etd'=>$tier['etd_eko'],'price'=>(int)round($tier['ekonomi']*$weightMultiplier)];

        if ($tier['sameday']) {
            $rates[] = ['code'=>'grab-sd','name'=>'Grab Same Day','desc'=>'Pengiriman hari ini','etd'=>$tier['etd_sd'],'price'=>(int)round($tier['sameday']*$weightMultiplier)];
        }

        return response()->json(['status'=>'success','message'=>'OK','data'=>$rates]);
    }
}