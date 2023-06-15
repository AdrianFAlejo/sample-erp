<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SwotRequest extends FormRequest
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
    public static function rules()
    {
        return [
            
        'title'                 => 'required|string', 
        'rationale'             => 'required|string', 
        'goal'                  => 'required|string',
        'purpose'               => 'required|string',
        'outcome'               => 'required|string', 
        'team'                  => 'required|string',
        'support'               => 'required|string',
        'customer'              => 'required|string',
        'stakeholder'           => 'required|string',
        ];
    }
}
