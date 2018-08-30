<?php
return [
    /**
     * HTTPステータスコード
     */
    'STATUS_CODE' => [
        'ok'           => 200,
        'created'      => 201,
        'no_content'   => 204,
        'bad_request'  => 400,
        'unauthorized' => 401,
        'not_found'    => 404,
        'conflict'     => 409,
    ],

    /**
     * HTTPステータスコードに対応するエラーメッセージ
     */
    'ERROR_MESSAGE' => [
        '400' => 'Bad Request',
        '401' => 'Unauthorized',
        '404' => 'Not Found',
        '409' => 'Conflict',
    ],
];