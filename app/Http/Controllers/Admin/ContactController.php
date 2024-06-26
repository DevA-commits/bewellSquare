<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {

        $Contact = Contact::first();

        return view("Admin.pages.contact.index", compact("Contact"));
    }

    public function store(Request $request)
    {
        $rules = [
            'address' => ['required'],
            'phone1' => ['required', 'regex:/^[0-9]{10,15}$/'],
            'phone2' => ['nullable', 'regex:/^[0-9]{10,15}$/'],
            'email1' => ['required', 'email'],
            'email2' => ['nullable', 'email'],
            'opening_time' => ['required'],
            'closing_time' => ['required'],
            'opening_day' => ['required', 'string', 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday'],
            'closing_day' => ['required', 'string', 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday'],
        ];

        $messages = [
            'phone1.required' => 'The primary phone number is required.',
            'phone1.regex' => 'The primary phone number must be a valid number with 10 to 15 digits.',
            'phone2.regex' => 'The secondary phone number must be a valid number with 10 to 15 digits.',
            'email1.required' => 'The primary email address is required.',
            'email1.email' => 'The primary email address must be a valid email.',
            'email2.email' => 'The secondary email address must be a valid email.',
            'opening_time.required' => 'The opening time is required.',
            'opening_time.date_format' => 'The opening time must be in the format HH:mm.',
            'closing_time.required' => 'The closing time is required.',
            'closing_time.date_format' => 'The closing time must be in the format HH:mm.',
            'closing_time.after' => 'The closing time must be after the opening time.',
            'opening_day.required' => 'The opening day is required.',
            'opening_day.in' => 'The opening day must be a valid day of the week.',
            'closing_day.required' => 'The closing day is required.',
            'closing_day.in' => 'The closing day must be a valid day of the week.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = [
            'address' => $request->address,
            'phone1' => $request->phone1,
            'phone2' => $request->phone2,
            'email1' => $request->email1,
            'email2' => $request->email2,
            'opening_time' => $request->opening_time,
            'closing_time' => $request->closing_time,
            'opening_day' => $request->opening_day,
            'closing_day' => $request->closing_day,
        ];

        $contact = Contact::first();

        if ($contact) {
            $contact->update($data);
            return response()->json(['message' => 'Contact updated successfully!'], 200);
        } else {
            $contact = Contact::create($data);
            if (!$contact) {
                return response()->json(['message' => 'Something went wrong!'], 500);
            }
            return response()->json(['message' => 'Contact created successfully!'], 201);
        }
    }
}
