<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CardRequest extends FormRequest{

    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool

    // {
    //     return true;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'name' => 'required|string|max:55',
            'hp' => 'required|numeric|multiple_of:10',
            'first_edition' => 'required|boolean',
            'expansion_id' => 'required|numeric|exists:expansions,id',
            'rarity_id' => 'required|numeric|exists:rarities,id',
            'price' => 'required|numeric',
            'type_ids' => 'required|array',
            'type_ids.*' => 'numeric|exists:types,id',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function failedValidation(Validator $validator){

        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
