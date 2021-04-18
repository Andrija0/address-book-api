<?php

namespace App\Http\Controllers;

use App\Agency;
use App\Http\Requests\AgencyRequest;
use App\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('s');
        $agencies = new Agency();
        if ($search) {
            $agencies = $agencies->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhereHas('phoneNumbers', function($q) use($search) {
                    $q->where('phone_number', 'LIKE', '%' . $search . '%');
                });
        }

        $agencies = $agencies->get();

        return response($agencies, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgencyRequest $request)
    {
        $agency = Agency::create($request->only(['name', 'address', 'city_id', 'email', 'web']));
        $phones = $request->input('phone_numbers');
        foreach ($phones as $phoneNumber) {
            $phone = PhoneNumber::make(['phone_number' => $phoneNumber]);
            $agency->phoneNumbers()->save($phone);
        }

        return response($agency, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function show(Agency $agency)
    {
        return response($agency, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function update(AgencyRequest $request, Agency $agency)
    {
        $agency->update($request->only(['name', 'address', 'city_id', 'web']));
        $agency->phoneNumbers()->delete();

        $phones = $request->input('phone_numbers');
        foreach ($phones as $phoneNumber) {
            $phone = PhoneNumber::make(['phone_number' => $phoneNumber]);
            $agency->phoneNumbers()->save($phone);
        }

        return response($agency, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Agency $agency
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Agency $agency)
    {
        $agency->delete();

        return response([], Response::HTTP_OK);
    }
}
