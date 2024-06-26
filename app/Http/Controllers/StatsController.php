<?php

namespace App\Http\Controllers;

use App\Models\Stats;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StatsController extends Controller
{
    public function index()
    {

        $stats = Stats::first();

        if ($stats) {
            $image = Stats::StatsImage($stats->image);
        } else {
            $image = null;
        }

        return view("Admin.pages.stats.index", compact('stats', 'image'));
    }

    public function store(Request $request)
    {
        $rules = [
            'experience' => ['required'],
            'projects' => ['required'],
            'repeat_customer' => ['required'],
            'client_satisfaction' => ['required'],
            'worker' => ['required'],
        ];

        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = [
            'experience' => $request->experience,
            'projects' => $request->projects,
            'repeat_customer' => $request->repeat_customer,
            'client_satisfaction' => $request->client_satisfaction,
            'worker' => $request->worker,
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/stats_img', $imageName);
            $data['image'] = $imageName;
        }

        $stats = Stats::first();

        if ($stats) {
            $stats->update($data);
            return response()->json(['message' => 'Stats updated successfully!'], 200);
        } else {
            $stats = Stats::create($data);
            if (!$stats) {
                return response()->json(['message' => 'Something went wrong!'], 500);
            }
            return response()->json(['message' => 'Stats created successfully!'], 201);
        }
    }
}
