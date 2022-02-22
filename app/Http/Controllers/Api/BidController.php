<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBidRequest;
use App\Http\Resources\BidResource;
use App\Models\Bid;

class BidController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function store(StoreBidRequest $request)
    {
        $bid = Bid::create($request->all());

        return new BidResource($bid);
    }
}
