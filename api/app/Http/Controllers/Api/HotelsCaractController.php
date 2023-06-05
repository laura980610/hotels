<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HotelCaract;
use App\Models\Hotel;
class HotelsCaractController extends Controller
{
    public function store(Request $request, $id)
    {
        $hotelCaract = new HotelCaract();
        $hotel = Hotel::find($id);
        $name = $hotel->name;
        $quantitytot = $hotel->room_num;
        $quanticaract = HotelCaract::where('hotel_name',$name)->get();
        $quanticaract = $quanticaract->sum('quantity');
        $quantifin = $quanticaract+$request->quantity;
        $hotelCaract->hotel_name = $name;
        $hotelCaract->quantity = $request->quantity;
        $hotelCaract->type = $request->type;
        $hotelCaract->accommodation = $request->accommodation;
        $validacion = HotelCaract::where('hotel_name',$name)->where('type',$request->type)->where('accommodation',$request->accommodation)->exists();
        if(!$validacion && $quantifin <= $quantitytot)
        {   
            switch ($request->type) {
                case 'Estándar':
                    $response = ($request->accommodation == 'Sencilla' || $request->accommodation == 'Doble') ? 1 : 'Las habitaciones de tipo Estándar solo pueden tener acomodación Sencilla o Doble';
                break;
                case 'Junior':
                    $response = ($request->accommodation == 'Triple' || $request->accommodation == 'Cuadruple') ? 1 :'Las habitaciones de tipo Junior solo pueden tener acomodación Triple o Cuadruple';
                break;
                case 'Suite':
                    $response = ($request->accommodation == 'Sencilla' || $request->accommodation == 'Doble' || $request->accommodation == 'Triple') ? 1 :'Las habitaciones de tipo Suite solo pueden tener acomodación Sencilla, Doble o Triple';
                break;
            }
            if($response == 1)
            {
                $hotelCaract->save(); 
            }
        }
        else
        {
            $response = ($validacion) ? 'Ya existen una asignación igual para esta acomodación' : 'No cuenta con suficientes habitaciones' ;
        }
        return $response;
    }

    public function destroy($id)
    {
        $hotel = HotelCaract::destroy($id);
        return $hotel;
    }
}
