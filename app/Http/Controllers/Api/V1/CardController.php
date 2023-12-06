<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CardRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Card;

class CardController extends Controller{

    public function index(Request $request){

        $query = Card::with(['types', 'rarity', 'expansion']);

        if ($request->has('tipo')) {
            $query->whereHas('types', function ($query) use ($request) {
                $query->where('name', $request->input('tipo'));
            });
        }

        // Filtrar por rareza test
        if ($request->has('rareza')) {
            $query->whereHas('rarity', function ($query) use ($request) {
                $query->where('name', $request->input('rareza'));
            });
        }

         // Filtrar por expansión
         if ($request->has('expansion')) {
            $query->whereHas('expansion', function ($query) use ($request) {
                $query->where('name', $request->input('expansion'));
            });
        }
         // Filtrar por nombre de la carta
         if ($request->has('nombre')) {
            $query->where('name', 'LIKE', '%' . $request->input('nombre') . '%');
        }

        // Filtrar por hp
        if ($request->has('hp')) {
            $query->where('hp', $request->input('hp'));
        }

        // Filtrar por first_edition
        if ($request->has('first_edition')) {
            $query->where('first_edition', $request->input('first_edition'));
        }

        $cards = $query->get();

        return response()->json($cards, 200);
    }

    public function store(CardRequest $request){

        $data = $request->validated();

        $data['img'] = $request->hasFile('img') ? $this->uploadImg($request->file('img')) : null;

        $types = $data['type_ids'] ?? [];
        unset($data['type_ids']);

        try {
            $card = Card::create($data);
            $card->types()->sync($types);
        } catch (\Exception $error) {
             // Elimina la imagen en caso de que falle la creación de la carta
             if ($data['img'] !== null) {
                $this->deleteImg(parse_url($data['img'], PHP_URL_PATH));
            }
            return response()->json([
                'msg' => 'Error al crear la carta',
                'error' => $error->getMessage(),
            ], 500);
        }

        return response()->json([
            'data' => $card->load(['types', 'rarity', 'expansion'])
        ], 201);

    }

    public function update(CardRequest $request, Card $card){

        $data = $request->validated();

        // Elimina la imagen actual si se proporciona una nueva imagen
        if ($request->hasFile('img')) {
            $this->deleteImg(parse_url($card->img, PHP_URL_PATH));
            $data['img'] = $this->uploadImg($request->file('img'));
        }

        $types = $data['type_ids'] ?? [];
        unset($data['type_ids']);

        try {
            $card->update($data);
            $card->types()->sync($types);
        } catch (\Exception $error) {
            // En caso de error, eliminar la imagen si se cargó
            if (isset($data['img'])) {
                $this->deleteImg(parse_url($data['img'], PHP_URL_PATH));
            }

            return response()->json([
                'msg' => 'Error al actualizar la carta',
                'error' => $error->getMessage(),
            ], 500);
        }

        return response()->json([
            'data' => $card->load(['types', 'rarity', 'expansion'])
        ], 200);

    }

    public function show(Card $card){
        return response()->json(
            $card->load(['types', 'rarity', 'expansion'])
        , 200);
    }

    public function destroy(Card $card){
        try {

            if ($card->img !== null) {
                $this->deleteImg(parse_url($card->img, PHP_URL_PATH));
            }

            $card->delete();

        } catch (\Exception $error) {
            return response()->json([
                'msg' => 'Error al eliminar la carta',
                'error' => $error->getMessage(),
            ], 500);
        }

        return response()->json([
            'msg' => 'Carta eliminada exitosamente',
        ], 200);
    }

    private function uploadImg($img){
        $path = $img->store('public/pokemons/imgs');
        return asset(Storage::url($path));
    }

    private function deleteImg($path_img){
        $newUrl = str_replace('storage', 'public', $path_img);
        Storage::delete($newUrl);
    }
}
