<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuctionResource;
use App\Models\Auction;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
    public function index()
    {
        $auctions = Auction::select('id', 'name')->get();
        return AuctionResource::collection($auctions);
    }

    public function show(Auction $auction)
    {
        return new AuctionResource($auction);
    }
}
