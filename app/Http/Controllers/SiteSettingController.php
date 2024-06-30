<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SiteSettingController extends Controller
{
    public function index()
    {
        $site = SiteSetting::first();

        if ($site) {
            $site_image = SiteSetting::SiteImage($site->image);
        } else {
            $site_image = null;
        }
        return view("Admin.pages.site_setting.index", compact("site_image"));
    }

    public function store(Request $request)
    {
        $rules = [
            'image' => 'required|file|mimes:ico',
        ];

        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = [
            
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/site_img', $imageName);
            $data['image'] = $imageName;
        }

        $site = SiteSetting::first();

        if ($site) {
            // If a new image is uploaded, delete the old image
            if ($request->hasFile('image')) {
                $oldImage = $site->image;
                if ($oldImage) {
                    Storage::delete('public/site_img/' . $oldImage);
                }
            }

            $site->update($data);
            return response()->json(['message' => 'Site updated successfully!'], 200);
        } else {
            $site = SiteSetting::create($data);
            if (!$site) {
                return response()->json(['message' => 'Something went wrong!'], 500);
            }
            return response()->json(['message' => 'Site created successfully!'], 201);
        }
    }


}
