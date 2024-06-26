<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;    
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function index()
    {
        $service = Service::first();

        if ($service) {
            $image = Service::ServiceImage($service->image);
        } else {
            $image = null;
        }

        return view("Admin.pages.service.index", compact("service", "image"));
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'max:100'],
            'image' => ['nullable', 'file', 'mimes:svg'],
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
            $image->storeAs('public/service_img', $imageName);
            $data['image'] = $imageName;
        }

        $service = Service::create($data);

        if ($service) {
            return response()->json(['message' => 'Service created successfully!'], 201);
        } else {
            return response()->json(['message' => 'Something went wrong!'], 500);
        }
    }

    public function dataTable(Request $request)
    {
        $ajaxData = dataTableRequests($request->all());
        // Total records
        $query = Service::query();
        $totalRecords = $query->count();

        // search filter
        if (!empty($ajaxData['searchValue'])) {
            $query->where('name', 'like', '%' . $ajaxData['searchValue'] . '%');
        }
        $totalRecordswithFilter = $query->count();

        $records = $query->orderBy('id', 'DESC')
            ->skip($ajaxData['start'])
            ->take($ajaxData['rowperpage'])
            ->get();

        $data_arr = array();
        $sl = 1;
        foreach ($records as $record) {

            $button = "";

            $button .= '<a href="javascript:void(0);" class="link-primary fs-18" onclick="right_canvas(\'' . route('service.edit', encrypt($record->id)) . '\')"><i class="ri-edit-2-line"></i></a>';
            $button .= '<a href="javascript:void(0);" class="link-danger mx-2 mt-2 fs-18" onclick="cofirm_modal(\'' . route('service.delete', encrypt($record->id)) . '\', \'' . "datatable" . '\')"><i class="ri-delete-bin-2-line"></i></a>';

            $image = ' <a target="_blank" href="' . Service::ServiceImage($record->image) . '" class="avatar-group-item"  data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="service">
        <img src="' . Service::ServiceImage($record->image) . '" alt="service" class="rounded-circle avatar-xxs">
        </a>';

            $data_arr[] = array(
                "sl" => $sl,
                "title" => $record->title,
                "description" => $record->description,
                "image" => $image,
                "action" => $button
            );
            $sl++;
        }

        $response = array(
            "draw" => intval($ajaxData['draw']),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        return response()->json($response);
    }

    public function edit($id)
    {
        $service = Service::where('id', decrypt($id))->first();
        return view('Admin.pages.service.edit', compact('service'));
    }

    public function update(Request $request)
    {
        $rules = [
            'title' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'max:100'],
            'image' => ['nullable', 'file', 'mimes:svg'],
        ];

        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $service_id = decrypt($request->service_id);

        $service = Service::find($service_id);
        if (!$service) {
            return response()->json(['message' => 'Service not found!'], 404);
        }

        $service_data = [
            'title' => $request->title,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            // Handle image upload
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/service_img', $imageName);

            $service_data['image'] = $imageName;

            if ($service->image) {
                Storage::delete('public/service_img/' . $service->image);
            }
        }

        $update_service = $service->update($service_data);

        if (!$update_service) {
            return response()->json(['message' => 'Something went wrong!'], 500);
        }

        return response()->json(['message' => 'Service updated successfully!'], 200);
    }


    public function delete($service_id)
    {
        $service_id = decrypt($service_id);

        $delete_service = Service::where('id', $service_id)->delete();

        if (!$delete_service)
            return response()->json(['message' => 'Something went wrong!'], 500);


        return response()->json(['message' => 'Service deleted successfully!'], 200);
    }

}
