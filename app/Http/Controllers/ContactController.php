<?php

namespace App\Http\Controllers;

use App\Agency;
use App\Contact;
use App\Http\Requests\ContactRequest;
use App\PhoneNumber;
use App\Profession;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', new Contact());

        $search = $request->input('s');
        $contacts = new Contact();
        if ($search) {
            $contacts = $contacts->where('first_name', 'LIKE', '%' . $search . '%')
                ->orWhere('last_name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhereHas('phoneNumbers', function($q) use($search) {
                        $q->where('phone_number', 'LIKE', '%' . $search . '%');
                    }
                );
        }

        $contacts = $contacts->get();

        return response($contacts, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(ContactRequest $request)
    {
        $this->authorize('create', new Contact());

        $contact = Contact::create($request->only(['first_name', 'last_name', 'agency_id', 'email', 'web', 'photo_id']));

        $phones = $request->input('phone_numbers');
        foreach ($phones as $phoneNumber) {
            $phone = PhoneNumber::make(['phone_number' => $phoneNumber]);
            $contact->phoneNumbers()->save($phone);
        }

        $professions = $request->input('professions');
        foreach ($professions as $professionData) {
            $profession = Profession::make(['profession' => $professionData]);
            $contact->professions()->save($profession);
        }

        return response($contact, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Contact $contact
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Contact $contact)
    {
        $this->authorize('view', $contact);

        return response($contact, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Contact $contact
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(ContactRequest $request, Contact $contact)
    {
        $this->authorize('update', $contact);

        $contact->update($request->only(['first_name', 'last_name', 'agency_id', 'email', 'web', 'photo_id']));

        return response($contact, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Contact $contact
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Contact $contact)
    {
        $this->authorize('delete', $contact);

        $contact->delete();

        return response([], Response::HTTP_OK);
    }

    public function contactsByAgency(Agency $agency) {
        $contacts = $agency->contacts;

        return response($contacts, Response::HTTP_OK);
    }

    public function uploadPhoto(Request $request) {

    }
}
