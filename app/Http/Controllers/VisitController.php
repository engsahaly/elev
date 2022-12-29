<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVisitRequest;
use App\Http\Requests\UpdateVisitRequest;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    const DIRECTORY = 'dashboard.visits';

    function __construct()
    {
        $this->middleware('check_permission:add_visits')->only(['store']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVisitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVisitRequest $request)
    {
        $data = $request->validated();
        $record = Visit::create($data);
        return response()->json(['success'=>__('messages.sent')]);
    }
}
