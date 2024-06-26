<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    public function index()
    {
        $banner = Banner::first();

        if ($banner) {
            $image = Banner::BannerImage($banner->image);
        } else {
            $image = null;  
        }

        return view("Admin.pages.banner.index", compact("banner", "image"));
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'max:400'],
        ];

        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = [
            'title' => $request->title,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');   
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/banner_img', $imageName);
            $data['image'] = $imageName;
        }

        $banner = Banner::first();

        if ($banner) {
            $banner->update($data);
            return response()->json(['message' => 'Banner updated successfully!'], 200);
        } else {
            $banner = Banner::create($data);
            if (!$banner) {
                return response()->json(['message' => 'Something went wrong!'], 500);
            }
            return response()->json(['message' => 'Banner created successfully!'], 201);
        }
    }
}
