<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Deadline\DeadlineRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class DeadlineController extends BaseController
{
    protected $deadlineRepository;

    public function __construct(DeadlineRepositoryInterface $deadlineRepository)
    {
        $this->deadlineRepository = $deadlineRepository;
    }

    public function rules()
    {
        return [
            'deadline_name' => 'required|string',
            'deadline_price' => 'required|integer',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->rules();
        $validator = Validator::make($request->all(), $rules);
        $errors = $validator->errors();
        if ($errors->first()) {
            return $this->sendError($errors->first());
        }
        $deadline = $this->deadlineRepository->create($request->all());
        if ($deadline) {
            return $this->sendSuccessResponse();
        }
        return $this->sendError(__('app.system_error'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
