<?php

namespace Virutmath\LaravelErrorManage;

use Illuminate\Http\Response;

class ErrorManage
{
    protected $messages;
    public function __construct($messages) {
        $this->messages = $messages;
    }

    public function response($errID) {
        $err = [
            'level' => 'error',
            'status' => 500,
            'type' => 'InternalServerError',
            'code' => '900000500000',
            'internal_message' => 'ErrorID not found',
            'message' => 'Internal Server Error',
            'message_detail' => 'An unknown internal error occurred. If the error persists, please contact service provider to figure out what has happened and how to fix it.'
        ];
        if(isset($this->messages[$errID])) {
            $err = $this->messages[$errID];
        }
        return new Response($this->formatError($err), $err['status']);
    }

    protected function formatError($err) {
        return [
            'error' => [
                'code' => $err['code'],
                'message' => $err['message_detail'],
                'type' => $err['type'],
                'status' => $err['status']
            ]
        ];
    }
}