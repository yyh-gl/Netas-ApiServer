<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TagRequest extends FormRequest
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
            'name' => 'required|max:200|unique:tags,name',
        ];
    }

    /**
     * [Override] 定義済みバリデーションルールのエラーメッセージ取得
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'タグ名が未入力です。',
            'name.max'  => 'タグ名は200文字までです。',
            'name.unique'  => '既に存在するタグ名です。',
        ];
    }

    /**
     * [Override] バリデーション失敗時のJSONレスポンス
     *
     * @param Validator $validator
     * @throw HttpResponseException
     *
     * @return void
     */
    protected function failedValidation( Validator $validator )
    {
        $errors = $validator->errors();

        if (!empty($errors->get('name'))) {
            $response['error'] = [
                'code' => config('const_request.ERROR_CODE.name'),
                'error' => $errors->first('name'),
            ];
        }
        throw new HttpResponseException(
            response()->json($response, config('const_http.STATUS_CODE.bad_request'))
        );
    }
}
