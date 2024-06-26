<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {

        $profile = Profile::first();

        if ($profile) {
            $image = Profile::ProfileImage($profile->image);
        } else {
            $image = null;
        }

        return view("Admin.pages.profile.index", compact('profile', 'image'));
    }

    public function store(Request $request)
    {
        $rules = [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10', 'max:15'],
            'email' => ['required', 'email', 'max:255'],
            'designation' => ['required', 'string', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'zip' => ['required', 'digits:6'],
            'description' => ['nullable', 'string'],
        ];

        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'designation' => $request->designation,
            'website' => $request->website,
            'city' => $request->city,
            'country' => $request->country,
            'zip' => $request->zip,
            'description' => $request->description,
        ];

        if ($request->hasFile('profile-img-file-input')) {
            $image = $request->file('profile-img-file-input');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/profile_img', $imageName);
            $data['image'] = $imageName;
        }

        $profile = Profile::first();

        if ($profile) {
            $profile->update($data);
            return response()->json(['message' => 'Profile updated successfully!'], 200);
        } else {
            $profile = Profile::create($data);
            if (!$profile) {
                return response()->json(['message' => 'Something went wrong!'], 500);
            }
            return response()->json(['message' => 'Profile created successfully!'], 201);
        }
    }
}
