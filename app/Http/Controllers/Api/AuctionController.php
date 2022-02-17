<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAuctionRequest;
use App\Http\Resources\AuctionResource;
use App\Models\Auction;
use Symfony\Component\HttpFoundation\Response;

class AuctionController extends Controller
{
    public function index()
    {
        $auctions = Auction::with('category')->get();

        return AuctionResource::collection($auctions);
    }

    public function show(Auction $auction)
    {
        return new AuctionResource($auction);
    }

    public function store(StoreAuctionRequest $request)
    {
        $auction = Auction::create($request->all());

        return new AuctionResource($auction);
    }

    public function update(Auction $auction, StoreAuctionRequest $request)
    {
        $auction->update($request->all());

        return new AuctionResource($auction);
    }

    public function destroy(Auction $auction)
    {
        $auction->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
