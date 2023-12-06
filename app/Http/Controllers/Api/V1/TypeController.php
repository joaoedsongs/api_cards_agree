<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;

class TypeController extends Controller{

    public function index(){
        $types = Type::all(['id', 'name']);

        $formattedTypes = $types->pluck('name', 'id')->toArray();

        return response()->json($formattedTypes);
    }
}
