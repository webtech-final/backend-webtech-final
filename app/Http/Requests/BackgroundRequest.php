<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BackgroundRequest extends FormRequest
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
            'backgroundImage' => 'required|mimes:jpg,jpeg,png|max:2000',
            'name' => ['required', 'unique:items,name,NULL,id,type,background,deleted_at,NULL'],
            'price' => ['required', 'regex:/^[1-9]+[0-9]*/'],
        ];
    }
    public function messages()
    {
        return [

            'required' => 'กรุณาใส่รูปภาพ',
            'mimes' => 'นามสกุลไฟล์ jpg, jpeg, png',
            'max' => 'ไฟล์ขนาดไม่เกิน :max kilobytes',
            'name.required' => 'กรุณาระบุชื่อไอเท็ม',
            'price.required' => 'กรุณาระบุจำนวนแต้มที่ต้องการเพื่อใช้แลกไอเท็ม',
            'name.unique' => 'ชื่อไอเท็มนี้ถูกใช้ไปแล้ว',
            'regex' => 'คะแนนที่ใช้แลกต้องเป็นจำนวนเต็มบวก ex. 1, 2, 10, 20 '

        ];
    }
}
