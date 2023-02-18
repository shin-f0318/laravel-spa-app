<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpaRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'spa_lat' => [
                'required',
            ],
            'spa_lng' => [
                'required',
            ],            
            'spa_address' => [
                'required',
            ],            
            'spa_name' => [
                'required',
            ],            
            'spa_type' => [
                'required',
            ],            
            'spa_price' => [
                'required',
                'integer',
            ],            
            'spa_point' => [
                'required',
            ],            

        ];
    }
}
