<?php

namespace App\Api\V1\Requests;

use Config;
use Dingo\Api\Http\FormRequest;

class BillRequest extends FormRequest
{
    public function rules()
    {
        return Config::get('job.request.validation_rules');
    }

    public function authorize()
    {
        return true;
    }
}
