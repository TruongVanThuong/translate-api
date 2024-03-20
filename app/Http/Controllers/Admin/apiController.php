<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\apiModel;

class apiController extends Controller
{
    //
    public function index()
    {
        return view('Admin.Page.Api.index');
    }

    public function GetApiData()
    {
        $data_api = apiModel::orderBy('id', 'desc')->get();
        $compact = compact('data_api');
        return response()->json($compact);
    }

    public function AddApi(Request $request)
    {
        $data = $request->all();
        $data['status'] = 0;
        // dd($data);
        apiModel::create($data);
        return response()->json([
            'status' => true,
            'message' => 'Thêm api thành công'
        ]);
    }

    public function DeleteApi(Request $request) {
        $xoa = apiModel::find($request->id);
        $xoa->delete();
        return response()->json([
            'status' => true,
            'message' => 'Đã xóa api thành công !'
        ]);
    }
}