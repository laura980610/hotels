<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\HotelCaract;

class HotelsController extends Controller
{
    public function index()
    {
        $hotel = Hotel::all();
        return $hotel;
    }

    public function store(Request $request)
    {
        $hotel = new Hotel();
        $validacion = Hotel::where('name',$request->name)->exists();
        if(!$validacion && $request->room_num > 0)
        {
            $hotel->name = $request->name;
            $hotel->address = $request->address;
            $hotel->city = $request->city;
            $hotel->nit = $request->nit;
            $hotel->room_num = $request->room_num;
            $hotel->save(); 
            $response = 1;
            return $response;
        }
        else
        {
            $response = ($validacion ) ?  'El nombre del hotel ya existe' : 'Ingrese una cantidad valida';
            return $response;
        }
    }

    public function show($id)
    {
        $array = collect();
        $cont = 0;
        $hotel = Hotel::find($id);
        $name = $hotel->name;
        $hotels = HotelCaract::where('hotel_name',$hotel->name)->get();
        return $hotels;
    }

    public function update(Request $request, $id)
    {
        $hotel = Hotel::findOrFail($request->id);
        $validacion = Hotel::where('name',$request->name)->where('id','<>',$request->id)->exists();
        if(!$validacion && $request->room_num > 0)
        {
            $hotel->name = $request->name;
            $hotel->address = $request->address;
            $hotel->city = $request->city;
            $hotel->nit = $request->nit;
            $hotel->room_num = $request->room_num;
            $hotel->save(); 
            $response = 1;
        }
        else
        {
            $response = ($validacion ) ?  'El nombre del hotel ya existe' : 'Ingrese una cantidad valida';
        }
        return $response;
    }


    public function destroy($id)
    {
        $name = Hotel::find($id);
        $name = $name->name;
        $hotelCaract = HotelCaract::where('hotel_name', $name)->delete();
        $hotel = Hotel::destroy($id);
        return $hotel;
    }
}
