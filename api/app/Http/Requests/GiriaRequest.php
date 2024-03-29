<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class GiriaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required|max:255|regex:/^[A-Za-zÀ-ÖØ-öø-ÿçÇ.\(\),\-\s]{2,}$/',
            'local' => 'required|array|min:1',
            'local.*' => 'required|max:255|regex:/^[A-Za-zÀ-ÖØ-öø-ÿçÇ.,\-\s]{2,}$/',
            'significado' => 'required|array|min:1',
            'significado.*' => 'required|max:1024|regex:/^[A-Za-zÀ-ÖØ-öø-ÿçÇ\.\,\(\)\s\-\;]{2,}$/',
            'etimologia' => 'nullable|max:1024|regex:/^[A-Za-zÀ-ÖØ-öø-ÿçÇ.,\(\)\"\-\s]{2,}$/',
            // 'imagem' => 'nullable|max:255|regex:/^https?\:\/\/[A-Za-z0-9.\-\/_\?\=]{2,}$/',
            'url' => 'nullable|max:255|regex:/^https\:\/\/(www\.)?youtube\.com\/watch\?v\=[a-zA-Z0-9_-]{11}$/'
        ];
    }

    public function messages(): array{
        return [
            'nome.required' => "O campo nome é obrigatório",
            'nome.regex' => 'O campo nome só pode conter letras, hífens, vírgulas e pontos',
            'url.regex' => 'A URL deve ser um link válido do YouTube',
            'local.*.regex' => 'Os campos Local devem conter apenas letras, hífens, vírgulas e pontos',
            'significado.*.regex' => 'Os campos Significado devem conter apenas letras, hífens, vírgulas e pontos'
        ];
    }
}
