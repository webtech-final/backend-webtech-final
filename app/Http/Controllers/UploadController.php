<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    // REF : https://youtu.be/DIdjdcJyvSg
    public function upload(Request $request)
    {
        $request->validate(
            [
                'selectedImage' => 'required|mimes:jpg,jpeg,png'
            ],
            [
                'selectedImage.required' => "กรุณาใส่รูปภาพ"
            ]
        );
        $service_image = $request->file('selectedImage');

        $name_gen = date("YmdHis");                                             // Generate ชื่อภาพ
        $img_ext = strtolower($service_image->getClientOriginalExtension());    // ดึงนามสกุลไฟล์ภาพ
        $img_name = $name_gen . "." . $img_ext;

        $upload_location = 'images/';
        $full_path = $upload_location . $img_name;
        $service_image->move($upload_location, $img_name);
        return response()->json([
            'status' => '200',
            'data' => $full_path,
        ]);
        // return redirect()->route('')->with('success', json_encode([
        //     'success' => '200',
        //     'image path' => $full_path
        // ]));
    }
}
