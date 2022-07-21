<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;
use Location\Coordinate;
use Location\Distance\Vincenty;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $office_address=$request->get('address_of');
        $your_adress=$request->get('address');
        $token = "e0f394c2b1c7f7654e4b5186bda58513336373c9";
        $secret = "9a59c1ab7ce15689da4b8746df0d6ccced640fe7";
        $dadata = new \Dadata\DadataClient($token,  $secret);
        $res_of = $dadata->clean("address", $office_address);
        $res_your = $dadata->clean("address", $your_adress);

        foreach ($res_of as $elem) {

            $geo_lat_of=$res_of['geo_lat'];
            $geo_lon_of=$res_of['geo_lon'];
        }
        foreach ($res_your as $value) {
            $geo_lat_your=$res_your['geo_lat'];
            $geo_lon_your=$res_your['geo_lon'];
        }
        $coordinate1 = new Coordinate($geo_lat_of, $geo_lon_of);
        $coordinate2 = new Coordinate($geo_lat_your, $geo_lon_your);

        $calculator = new Vincenty();
        $distance =$calculator->getDistance($coordinate1, $coordinate2);
        //dd( $calculator->getDistance($coordinate1, $coordinate2));
        return redirect()->back()->with('message', $distance);



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        //
    }
}
