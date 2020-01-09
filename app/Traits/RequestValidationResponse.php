<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;

trait RequestValidationResponse 
{

	/**
     * Handle a failed validation attempt.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        header("Access-Control-Allow-Origin:*");
        $response['status'] = trans('api.failed');
        $response['message'] = $validator->errors()->all();
        response()->json($response)->send();
        exit;
    }	
}