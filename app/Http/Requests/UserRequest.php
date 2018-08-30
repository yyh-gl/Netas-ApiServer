<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
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
            'user_id'      => 'required|max:200|unique:users,user_id',
            'name'         => 'required|max:200',
            'email'        => 'required|email|max:255|unique:users,email',
            'avatar'       => 'required|max:200|unique:users,avatar',
            'introduction' => 'max:200',
            'password'     => 'required|max:200',
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
            'user_id.required'  => 'ユーザIDが未入力です。',
            'user_id.max'       => 'ユーザIDは200文字までです。',
            'user_id.unique'    => '既に存在するユーザIDです。',
            'name.required'     => 'タグ名が未入力です。',
            'name.max'          => 'タグ名は200文字までです。',
            'email.required'    => 'メールアドレスが未入力です。',
            'email.email'       => '不正な形式です。',
            'email.max'         => 'メールアドレスは255文字までです。',
            'email.unique'      => '既に存在するメールアドレスです。',
            'avatar.required'   => 'アバター画像が未設定です。',
            'avatar.max'        => 'アバター画像のURLは200文字までです。',
            'avatar.unique'     => '既に存在するアバター画像です。',
            'introduction.max'  => '紹介文は200文字までです。',
            'password.required' => 'パスワードが未入力です。',
            'password.max'      => 'パスワードは200文字までです。',
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

        if (!empty($errors->get('user_id'))) {
            $code = config('const_request.ERROR_CODE.user_id');
            $error = $errors->first('user_id');

        } else if (!empty($errors->get('name'))) {
            $code = config('const_request.ERROR_CODE.name');
            $error = $errors->first('name');

        } else if (!empty($errors->get('email'))) {
            $code = config('const_request.ERROR_CODE.email');
            $error = $errors->first('email');

        } else if (!empty($errors->get('avatar'))) {
            $code = config('const_request.ERROR_CODE.avatar');
            $error = $errors->first('avatar');

        } else if (!empty($errors->get('introduction'))) {
            $code = config('const_request.ERROR_CODE.introduction');
            $error = $errors->first('introduction');

        } else if (!empty($errors->get('password'))) {
            $code = config('const_request.ERROR_CODE.password');
            $error = $errors->first('password');

        } else {
            $code = config('const_request.ERROR_CODE.unknown');
            $error = 'Unknown Error';
        }

        $response['error'] = [
            'code' => $code,
            'error' => $error,
        ];

        throw new HttpResponseException(
            response()->json($response, config('const_http.STATUS_CODE.bad_request'))
        );
    }
}
