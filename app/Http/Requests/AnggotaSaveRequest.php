<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnggotaSaveRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'no_kk' => 'required',
            'pekerjaan' => 'required',
            'nik' => 'required|numeric|digits_between:10,11|unique:App\Models\Anggota,nik',
            'nama' => 'required',
            'jenkel' => 'required|in:L,P',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'status_kawin' => 'required|in:belum kawin,kawin',
            'nm_ayah' => 'required',
            'nm_ibu' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'no_kk.required' => 'No. KK tidak boleh kosong.',
            'pekerjaan.required' => 'Pekerjaan tidak boleh kosong.',
            'nik.required' => 'NIK tidak boleh kosong.',
            'nama.required' => 'Nama tidak boleh kosong.',
            'jenkel.required' => 'Jenis Kelamin tidak boleh kosong.',
            'tmp_lahir.required' => 'Tempat Lahir tidak boleh kosong.',
            'tgl_lahir.required' => 'Tanggal lahir tidak boleh kosong.',
            'status_kawin.required' => 'Status perkawinan tidak boleh kosong.',
            'nm_ayah.required' => 'Nama Ayah tidak boleh kosong.',
            'nm_ibu.required' => 'Nama Ibu tidak boleh kosong.',
            'nik.numeric' => 'NIK harus berupa angka.',
            'jenkel.in' => 'Pilih jenis kelamin yang valid.',
            'nik.unique' => 'NIK tidak boleh sama.',
            'nik.min' => 'NIK tidak boleh kurang dari 10.',
        ];
    }
}
