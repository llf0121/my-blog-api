<?php

namespace App\Http\Request;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class BaseRequest extends  FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $message = collect($validator->errors()->toArray())->flatten(1)->toArray()[0];
        throw new HttpResponseException(response()->json(['code'=>422,'msg'=>$message,'data'=>null],
            422));
    }


    protected function failedAuthorization()
    {
        throw new AccessDeniedHttpException('无权进行操作');
    }


    public function expectsJson()
    {
        return true;
    }
    public function wantsJson()
    {
        return true;
    }


    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [];
    }
}
