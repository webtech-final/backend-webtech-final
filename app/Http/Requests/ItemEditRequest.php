<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemEditRequest extends FormRequest
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
            'price' => ['required', 'regex:/^[1-9]+[0-9]*/'],
            'blockS' => ['mimes:jpg,jpeg,png', 'max:100'],
            'blockZ' => ['mimes:jpg,jpeg,png', 'max:100'],
            'blockL' => ['mimes:jpg,jpeg,png', 'max:100'],
            'blockJ' => ['mimes:jpg,jpeg,png', 'max:100'],
            'blockT' => ['mimes:jpg,jpeg,png', 'max:100'],
            'blockO' => ['mimes:jpg,jpeg,png', 'max:100'],
            'blockI' => ['mimes:jpg,jpeg,png', 'max:100'],
        ];
    }
    public function messages()
    {
        return [
            'mimes' => 'นามสกุลไฟล์ jpg, jpeg, png',
            'max' => 'ไฟล์ขนาดไม่เกิน :max kilobytes',
            'point.required' => 'กรุณาระบุจำนวนแต้มที่ต้องการเพื่อใช้แลกไอเท็ม',
            'regex' => 'คะแนนที่ใช้แลกต้องเป็นจำนวนเต็มบวก ex. 1, 2, 10, 20 '
        ];
    }
}
