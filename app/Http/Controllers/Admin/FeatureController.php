<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeatureController extends Controller
{
    public function index()
    {
        $feature = Feature::first();

        if ($feature) {
            $image_one = Feature::FeatureImageOne($feature->image);
        } else {
            $image_one = null;
        }

        if ($feature) {
            $image_two = Feature::FeatureImageTwo($feature->image2);
        } else {
            $image_two = null;
        }

        if ($feature) {
            $image_three = Feature::FeatureImageThree($feature->image3);
        } else {
            $image_three = null;
        }

        return view("Admin.pages.feature.index", compact('feature', 'image_one', 'image_two', 'image_three'));
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'title2' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'description2' => ['required', 'string'],
            'describe_one' => ['required', 'string', 'max:50'],
            'describe_two' => ['required', 'string', 'max:50'],
            'describe_three' => ['required', 'string', 'max:50'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg'],
            'image2' => ['nullable', 'image', 'mimes:jpg,png,jpeg'],
            'image3' => ['nullable', 'image', 'mimes:jpg,png,jpeg']
        ];

        $messages = [
            'image.dimensions' => 'The image must be 1000x700 pixels.',
            'image2.dimensions' => 'The image must be 1000x700 pixels.',
            'image3.dimensions' => 'The image must be 1000x700 pixels.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        $validator->after(function ($validator) use ($request) {
            foreach (['image', 'image2', 'image3'] as $imageField) {
                if ($request->hasFile($imageField)) {
                    $image = $request->file($imageField);
                    $dimensions = getimagesize($image);
                    if ($dimensions[0] != 1000 || $dimensions[1] != 700) {
                        $validator->errors()->add($imageField, 'The ' . $imageField . ' must be 1000x700 pixels.');
                    }
                }
            }
        });

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = [
            'title' => $request->title,
            'title2' => $request->title2,
            'description' => $request->description,
            'description2' => $request->description2,
            'describe_one' => $request->describe_one,
            'describe_two' => $request->describe_two,
            'describe_three' => $request->describe_three,
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/feature_img_one', $imageName);
            $data['image'] = $imageName;
        }

        if ($request->hasFile('image2')) {
            $image = $request->file('image2');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/feature_img_two', $imageName);
            $data['image2'] = $imageName;
        }

        if ($request->hasFile('image3')) {
            $image = $request->file('image3');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/feature_img_three', $imageName);
            $data['image3'] = $imageName;
        }

        $save = Feature::first();

        if ($save) {
            $save->update($data);
            return response()->json(['message' => 'Feature updated successfully!'], 200);
        } else {
            $save = Feature::create($data);
            if (!$save) {
                return response()->json(['message' => 'Something went wrong!'], 500);
            }
            return response()->json(['message' => 'Feature created successfully!'], 201);
        }
    }
}
