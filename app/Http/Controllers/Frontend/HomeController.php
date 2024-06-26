<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Contact;
use App\Models\Faq;
use App\Models\Feature;
use App\Models\Product;
use App\Models\Quote;
use App\Models\Service;
use App\Models\Stats;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        $banner = Banner::first();

        if ($banner) {
            $image = Banner::BannerImage($banner->image);
        } else {
            $image = null;
        }

        $stats = Stats::first();

        if ($stats) {
            $stats_image = Stats::StatsImage($stats->image);
        } else {
            $stats_image = null;
        }

        $services = Service::all();

        foreach ($services as $service) {
            $service->icon = Service::ServiceImage($service->image);
        }

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

        $products = Product::all();

        // Fetch unique categories
        $categories = Product::select('category')->distinct()->get();
        
        foreach ($products as $product) {
            $product->image = Product::ProductImage($product->image);
        }

        if ($feature) {
            $image_three = Feature::FeatureImageThree($feature->image3);
        } else {
            $image_three = null;
        }

        $faqs = Faq::get();

        $contact = Contact::first();


        return view("Frontend.home", compact('banner', 'image', 'stats', 'stats_image', 'services', 'feature', 'image_one', 'image_two', 'image_three', "faqs", "products", "categories", "contact"));
    }

    public function create()
    {
        return view('Frontend.form_quote');
    }

    public function quote(Request $request)
    {
        $rules = [
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'interior_design' => 'required|string',
            'subject' => 'required|string',
            'message' => 'nullable|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = [
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'interior_design' => $request->interior_design,
            'subject' => $request->subject,
            'message' => $request->message,
        ];

    
        $save = Quote::create($data);

        if ($save) {
            return response()->json(['message' => 'Your Request Send Successfully, We Will Connect You Soon!'], 201);
        } else {
            return response()->json(['message' => 'Something went wrong!'], 500);
        }
    }



}
