<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrainingRequest extends FormRequest
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


   
                    'title'=>'required|min:3',
                    'description'=>'required|min:5',
                    'trainer'=>'required',
                    
                

            //
        ];
    }

    public function messages(){
        return[
            'title.required'=>'sila isi tajuk',
            'title.min'=>'Minimum 3',
            'desription.required'=>'sila isi deskripsi',

        ];
    }
}
