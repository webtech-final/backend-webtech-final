<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name' => ['required', 'unique:items'],
            'point' => ['required', 'regex:/^[1-9]+[0-9]*/'],
            'blockS' => ['required', 'mimes:jpg,jpeg,png', 'max:100'],
            'blockZ' => ['required', 'mimes:jpg,jpeg,png', 'max:100'],
            'blockL' => ['required', 'mimes:jpg,jpeg,png', 'max:100'],
            'blockJ' => ['required', 'mimes:jpg,jpeg,png', 'max:100'],
            'blockT' => ['required', 'mimes:jpg,jpeg,png', 'max:100'],
            'blockO' => ['required', 'mimes:jpg,jpeg,png', 'max:100'],
            'blockI' => ['required', 'mimes:jpg,jpeg,png', 'max:100'],
            // 'backgroundImage' => ['required', 'mimes:jpg,jpeg,png', 'max:2000']
        ];
    }
    public function messages()
    {
        return [
            'required' => 'กรุณาใส่รูปภาพ',
            'mimes' => 'นามสกุลไฟล์ jpg, jpeg, png',
            'max' => 'ไฟล์ขนาดไม่เกิน :max kilobytes',
            'name.required' => 'กรุณาระบุชื่อไอเท็ม',
            'point.required' => 'กรุณาระบุจำนวนแต้มที่ต้องการเพื่อใช้แลกไอเท็ม',
            'name.unique' => 'ชื่อไอเท็มนี้ถูกใช้ไปแล้ว',
            'regex' => 'คะแนนที่ใช้แลกต้องเป็นจำนวนเต็มบวก ex. 1, 2, 10, 20 '
        ];
    }
}
