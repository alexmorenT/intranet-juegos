<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveScoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 1 = Wordle, 2 = TypeSpeed, 3 = BombParty
            'game_id' => ['required', 'integer', Rule::in([1, 2, 3])],
            // Tope de cordura: evita valores absurdos, no sustituye a un juego autoritativo en servidor
            'points' => ['required', 'integer', 'min:0', 'max:10000'],
            'time_taken' => ['nullable', 'integer', 'min:0', 'max:86400'],
        ];
    }
}
