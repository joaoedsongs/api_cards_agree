<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rarity;

class RarityController extends Controller{

    public function index(){
        $rarities = Rarity::all(['id', 'name']);

        $formattedRarities = $rarities->pluck('name', 'id')->toArray();

        return response()->json($formattedRarities);
    }
}
