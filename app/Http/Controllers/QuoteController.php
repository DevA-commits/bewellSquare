<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
        return view("Admin.pages.quote.index");
    }

    public function dataTable(Request $request)
    {
        $ajaxData = dataTableRequests($request->all());
        // Total records
        $query = Quote::query();
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

            $button .= '<a href="javascript:void(0);" class="link-primary fs-18" onclick="right_canvas(\'' . route('quote.edit', encrypt($record->id)) . '\')"><i class="ri-edit-2-line"></i></a>';
            // $button .= '<a href="javascript:void(0);" class="link-danger mx-2 mt-2 fs-18" onclick="cofirm_modal(\'' . route('quote.delete', encrypt($record->id)) . '\', \'' . "datatable" . '\')"><i class="ri-delete-bin-2-line"></i></a>';

            $data_arr[] = array(
                "sl" => $sl,
                "fullname" => $record->fullname,
                "email" => $record->email,
                "phone" => $record->phone,
                "interior_design" => $record->interior_design,
                "subject" => $record->subject,
                "message" => $record->message,
                "status" => $record->status,
                "action" => $button,
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
        $quote = Quote::where('id', decrypt($id))->first();
        return view('Admin.pages.quote.edit', compact('quote'));
    }
}
