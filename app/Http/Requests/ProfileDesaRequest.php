<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileDesaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'desa_id' => 'required',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'program_unggulan' => 'required|string',
            'batas_wilayah' => 'required|string',
            'alamat' => 'required|string',
            'telepon' => 'required|string',
        ];
    }
}
