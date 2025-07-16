<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TempatTinggalDesaRequest extends FormRequest
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
            'id_kategori' => 'required',
            'desa_id' => 'required',
            'rt_rw_desa_id' => 'required',
            'tahun' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 5),
            'jenis_tempat_tinggal' => 'required',
            'jumlah' => 'required',
            'created_by' => 'required|string',
            'updated_by' => 'string',
            'status' => 'required',
            'approved_by' => 'string',
            'approved_at' => 'string',
        ];
    }
}
