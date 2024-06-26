<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::first();

        return view("Admin.pages.faq.index", compact("faqs"));
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:200'],
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

        $faq = Faq::create($data);

        if ($faq) {
            return response()->json(['message' => 'Faq created successfully!'], 201);
        } else {
            return response()->json(['message' => 'Something went wrong!'], 500);
        }
    }

    public function dataTable(Request $request)
    {
        $ajaxData = dataTableRequests($request->all());
        // Total records
        $query = Faq::query();
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

            $button .= '<a href="javascript:void(0);" class="link-primary fs-18" onclick="right_canvas(\'' . route('faq.edit', encrypt($record->id)) . '\')"><i class="ri-edit-2-line"></i></a>';
            $button .= '<a href="javascript:void(0);" class="link-danger mx-2 mt-2 fs-18" onclick="cofirm_modal(\'' . route('faq.delete', encrypt($record->id)) . '\', \'' . "datatable" . '\')"><i class="ri-delete-bin-2-line"></i></a>';

            $data_arr[] = array(
                "sl" => $sl,
                "title" => $record->title,
                "description" => $record->description,
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
        $faq = Faq::where('id', decrypt($id))->first();
        return view('Admin.pages.faq.edit', compact('faq'));
    }

    public function update(Request $request)
    {
        $rules = [
            'title' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:200'],
        ];

        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $faq_id = decrypt($request->faq_id);

        $faq = Faq::find($faq_id);
        if (!$faq) {
            return response()->json(['message' => 'Faq not found!'], 404);
        }

        $faq_data = [
            'title' => $request->title,
            'description' => $request->description,
        ];

        $update_faq = $faq->update($faq_data);

        if (!$update_faq) {
            return response()->json(['message' => 'Something went wrong!'], 500);
        }

        return response()->json(['message' => 'Faq updated successfully!'], 200);
    }


    public function delete($faq_id)
    {
        $faq_id = decrypt($faq_id);

        $delete_faq = Faq::where('id', $faq_id)->delete();

        if (!$delete_faq)
            return response()->json(['message' => 'Something went wrong!'], 500);


        return response()->json(['message' => 'Faq deleted successfully!'], 200);
    }
}
