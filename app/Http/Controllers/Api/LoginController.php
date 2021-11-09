<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Api\BaseController;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Exception;

class LoginController extends BaseController
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function rules()
    {
        return [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
            'is_remember' => 'required|boolean',
        ];
    }

    public function login(Request $request) 
    {
        try {
            $validator = Validator::make($request->all(), $this->rules());
            $errors = $validator->errors();
            if ($errors->first()) {
                return $this->sendError($errors->first());
            }
            if ($request->is_remember) {
                JWTAuth::factory()->setTTL(525600);
            }
            
            $result_user = $this->userRepository->getInfoUserByEmail($request->email);
            if (count($result_user) > 0) {
                foreach($result_user as $user)
                {   
                    if (Hash::check($request->password, $user->password))
                    {   
                        $token = JWTAuth::fromUser($user);
                        $data = [
                            'token' => $token,
                            'user_info' => new UserResource($user)
                        ];
                        return $this->sendSuccessResponse($data);
                    }
                }
            } 
            return $this->sendError(__('app.login_failed'));
        } catch (Exception $e) {
            //log error
            $this->logCatch('login', 'post' , null, $request->email, $e->getMessage());
            return $this->sendError(__('app.system_error'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
