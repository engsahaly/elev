<?php

namespace App\Http\Controllers;

use App\Models\Call;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCallRequest;
use App\Http\Requests\UpdateCallRequest;
use Illuminate\Http\Request;

class CallController extends Controller
{
    const DIRECTORY = 'dashboard.calls';

    function __construct()
    {
        $this->middleware('check_permission:add_calls')->only(['store']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCallRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCallRequest $request)
    {
        $data = $request->validated();
        $record = Call::create($data);
        return response()->json(['success'=>__('messages.sent')]);
    }
}
