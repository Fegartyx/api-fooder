<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseJson;
use App\Http\Services\AuthenticationService;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    private $request = [
        'name',
        'email',
        'password',
    ];
    private $service;

    public function __construct(AuthenticationService $service)
    {
        $this->service = $service;
    }
    public function register(Request $request)
    {
        $data = $request->only($this->request);

        try {
            $result = $this->service->register($data);
        } catch(\Exception $e) {
            return ResponseJson::error( $e->getMessage());
        }

        return ResponseJson::success($result, 'User created successfully');
    }
}
