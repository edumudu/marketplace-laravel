<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'name'         => 'required',
          'description'  => 'required|min:30',
          'body'         => 'required',
          'price'        => 'required|numeric',
          'photos.*'       => 'image'
        ];
    }

    public function messages()
    {
      return [
        'required' => 'O campo :attribute é obrigatorio',
        'min'      => 'O campo :attribute deve ter no minimo :min caracteres',
        'numeric'  => 'O campo :attribute deve ser numerico',
        'photos'   => 'O arquivo nao é uma imagem valida'
      ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name'        => 'nome',
            'description' => 'descrição',
            'price'       => 'preço',
            'body'        => 'conteudo',
            'photos'      => 'imagens'
        ];
    }
}
