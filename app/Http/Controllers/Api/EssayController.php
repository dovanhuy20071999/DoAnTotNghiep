<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Essay\EssayRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EssayController extends BaseController
{
    protected $essayRepository;
    
    public function __construct(EssayRepositoryInterface $essayRepository)
    {
        $this->essayRepository = $essayRepository;
    }

    public function rules()
    {
        return [
            'title' => 'required|string',
            'content' => 'required|string',
        ];
    }

    public function createEssay(Request $request)
    {
        $rules = $this->rules();
        $validator = Validator::make($request->all(), $rules);
        $errors = $validator->errors();
        if ($errors->first()) {
            return $this->sendError($errors->first());
        }
        $essay = $this->essayRepository->create($request->all());
        if ($essay) {
           return $this->sendSuccessResponse(__('app.success'));
        } 
        return $this->sendError(__('app.system_error'));
    }
}
