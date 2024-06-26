<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::first();

        if ($product) {
            $image = Product::ProductImage($product->image);
        } else {
            $image = null;
        }

        return view("Admin.pages.product.index", compact("product", "image"));
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'max:100'],
            'image' => ['required', 'image', 'mimes:jpg,png,jpeg'],
            'category' => ['required', 'string'],
        ];

        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/product_img', $imageName);
            $data['image'] = $imageName;
        }

        $product = Product::create($data);

        if ($product) {
            return response()->json(['message' => 'Product created successfully!'], 201);
        } else {
            return response()->json(['message' => 'Something went wrong!'], 500);
        }
    }

    public function dataTable(Request $request)
    {
        $ajaxData = dataTableRequests($request->all());
        // Total records
        $query = Product::query();
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
        function formatCategory($category)
        {
            // Remove 'filter_' prefix
            $category = str_replace('filter_', '', $category);

            // Capitalize the first letter of each word
            $category = ucwords(str_replace('_', ' ', $category));

            return $category;
        }

        foreach ($records as $record) {
            $button = "";

            $button .= '<a href="javascript:void(0);" class="link-primary fs-18" onclick="right_canvas(\'' . route('product.edit', encrypt($record->id)) . '\')"><i class="ri-edit-2-line"></i></a>';
            $button .= '<a href="javascript:void(0);" class="link-danger mx-2 mt-2 fs-18" onclick="cofirm_modal(\'' . route('product.delete', encrypt($record->id)) . '\', \'' . "datatable" . '\')"><i class="ri-delete-bin-2-line"></i></a>';

            $image = ' <a target="_blank" href="' . Product::ProductImage($record->image) . '" class="avatar-group-item"  data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="product">
            <img src="' . Product::ProductImage($record->image) . '" alt="product" class="rounded-circle avatar-xxs">
            </a>';

            $formattedCategory = formatCategory($record->category);

            $data_arr[] = array(
                "sl" => $sl,
                "title" => $record->title,
                "description" => $record->description,
                "category" => $formattedCategory,
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
        $product = Product::where('id', decrypt($id))->first();
        return view('Admin.pages.product.edit', compact('product'));
    }

    public function update(Request $request)
    {
        $rules = [
            'title' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'max:100'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg'],
        ];

        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product_id = decrypt($request->product_id);

        $product = Product::find($product_id);
        if (!$product) {
            return response()->json(['message' => 'Product not found!'], 404);
        }

        $product_data = [
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
        ];

        if ($request->hasFile('image')) {
            // Handle image upload
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/product_img', $imageName);

            $product_data['image'] = $imageName;

            if ($product->image) {
                Storage::delete('public/product_img/' . $product->image);
            }
        }

        $update_product = $product->update($product_data);

        if (!$update_product) {
            return response()->json(['message' => 'Something went wrong!'], 500);
        }

        return response()->json(['message' => 'Product updated successfully!'], 200);
    }


    public function delete($product_id)
    {
        $product_id = decrypt($product_id);

        $delete_product = Product::where('id', $product_id)->delete();

        if (!$delete_product)
            return response()->json(['message' => 'Something went wrong!'], 500);


        return response()->json(['message' => 'Product deleted successfully!'], 200);
    }
}
