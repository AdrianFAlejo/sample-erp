<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImpactAnalysisPriorityRequest extends FormRequest
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
   /*  public static function rules()
    {
        return [
            'transaction_no' => 'required|string',
            'transaction_date' => 'required|string',
            'branch_id' => 'required|integer',
            'customer_id' => 'required|integer',
            'cash_receipt_type_id' => 'required|integer'
        ];
    } */
}
