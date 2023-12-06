<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expansion;

class ExpansionController extends Controller{

    public function index(){
        $expansions = Expansion::all(['id', 'name']);

        $formattedExpansions = $expansions->pluck('name', 'id')->toArray();

        return response()->json($formattedExpansions);
    }
}
