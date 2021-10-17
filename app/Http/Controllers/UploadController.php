<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemDetail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{

    public function updateBlock(Request $request, $blockName)
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
        $service_image = $request->file($blockName);
        $img_ext = strtolower($service_image->getClientOriginalExtension());    // ดึงนามสกุลไฟล์ภาพ
        $img_name = $blockName . "." . $img_ext;
        // Storage::delete([$blockName]);
        // ddd("DEBUG");
        $full_path = $service_image->storeAs('public/' . $request->input('name'), $img_name);
        $full_path = Str::replace('public', 'storage', $full_path);

        return response()->json([
            'status' => 'success',
            'data' => $full_path,
            'image_name' => $blockName,
        ], 200);
    }

    // REF : https://youtu.be/DIdjdcJyvSg
    public function uploadBlock(Request $request, $blockName, $id)
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
        $service_image = $request->file($blockName);
        $img_ext = strtolower($service_image->getClientOriginalExtension());    // ดึงนามสกุลไฟล์ภาพ
        $img_name = $blockName . "." . $img_ext;
        $full_path = $service_image->storeAs('public/' . $id, $img_name);
        $full_path = Str::replace('public', 'storage', $full_path);

        return response()->json([
            'status' => 'success',
            'data' => $full_path,
            'image_name' => $blockName,
        ], 200);
    }

    public function uploadProfile(Request $request)
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
        $img_ext = strtolower($service_image->getClientOriginalExtension());    // ดึงนามสกุลไฟล์ภาพ
        $img_name = "profile-" . $request->input('id') . "." . $img_ext;
        $full_path = $service_image->storeAs('public/profile', $img_name);
        $full_path = Str::replace('public', 'storage', $full_path);
        return response()->json([
            'status' => '200',
            'data' => $full_path,
        ]);
    }

    public function uploadBlock2(Request $request, $item)
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
