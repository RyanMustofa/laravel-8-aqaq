<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact = Contact::all();
        return response()->json($contact, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contact = new Contact();
        $contact->user_id = $request->user_id;
        $contact->link_whatsapp = $request->link_whatsapp;
        $contact->link_instagram = $request->link_instagram;
        $contact->link_telegram = $request->link_telegram;
        $contact->link_facebook = $request->link_facebook;
        $contact->save();
        if ($contact) {
            return response()->json(["success" => "success add"], 201);
        } else {
            return response()->json(["error" => "error add"], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::find($id);
        return response()->json($contact, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contact = Contact::find($id);
        $contact->user_id = $request->user_id;
        $contact->link_whatsapp = $request->link_whatsapp;
        $contact->link_instagram = $request->link_instagram;
        $contact->link_telegram = $request->link_telegram;
        $contact->link_facebook = $request->link_facebook;
        $contact->save();
        if ($contact) {
            return response()->json(["success" => "success update"], 201);
        } else {
            return response()->json(["error" => "error update"], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        return response()->json(["success" => "success delete"], 200);
    }
}
