<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LpmdkRequest extends FormRequest
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
            'rt_rw_desa_id' => 'required',
            'jumlah_pengurus' => 'required|numeric',
            'jumlah_anggota' => 'required|  numeric',
            'jumlah_kegiatan' => 'required|numeric',
            'jumlah_buku_administrasi' => 'required|numeric',
            'jumlah_dana' => 'required|numeric',
            'created_by' => 'required|string',
            'updated_by' => 'string',
            'status' => 'required',
            'approved_by' => 'string',
            'approved_at' => 'string',

        ];
    }
}
