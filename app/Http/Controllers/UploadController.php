<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemDetail;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    // REF : https://youtu.be/DIdjdcJyvSg
    public function upload(Request $request)
    {
        $request->validate(
            [
                'image_file.*' => 'required|mimes:jpg,jpeg,png,bmp|max:20000'
            ],
            [
                'image_file.*.required' => 'Please upload an image',
                'image_file.*.mimes' => 'Only jpeg,png and bmp images are allowed',
                'image_file.*.max' => 'Sorry! Maximum allowed size for an image is 20MB',
            ]
        );


        $service_image = $request->file('selectedImage')[0];
        $img_ext = strtolower($service_image->getClientOriginalExtension());    // ดึงนามสกุลไฟล์ภาพ
        $img_name = $request->input('name') . "." . $img_ext;
        $full_path = $service_image->storeAs('public/' . $request->input('name'), $img_name);

        return response()->json([
            'status' => 'success',
            'data' => $full_path,
            'image_name' => $img_name,
        ], 200);
    }

    public function uploadBlock(Request $request, $item)
    {
        $request->validate(
            [
                'image_file.*' => 'required|mimes:jpg,jpeg,png,bmp|max:20000'
            ],
            [
                'image_file.*.required' => 'Please upload an image',
                'image_file.*.mimes' => 'Only jpeg,png and bmp images are allowed',
                'image_file.*.max' => 'Sorry! Maximum allowed size for an image is 20MB',
            ]
        );
        foreach ($request->file('selectedImage') as $key => $file) {

            $detail = new ItemDetail();
            $detail->item_id = $item->id;
            // call upload API 
            $service_image = $file;
            $img_ext = strtolower($service_image->getClientOriginalExtension());    // ดึงนามสกุลไฟล์ภาพ
            $img_name = $item->name . '-' . ($key + 1) . "." . $img_ext;
            $full_path = $service_image->storeAs('public/' . $request->input('name'), $img_name);

            $detail->name = $img_name;
            $detail->image_path = Str::replace('public', 'storage', $full_path);
            $detail->save();
        }
        return response()->json([
            'status' => 'success',
            'data' => $detail,
        ], 200);
    }
}
