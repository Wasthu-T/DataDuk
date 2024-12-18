<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoredomisiliRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->admin == '1';

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nik' => 'required|string|size:16|regex:/^[0-9]+$/',
            'alamat_asal' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'desa' => 'required|string|max:255',
            'alamat_tujuan' => 'required|string|max:255',
            'tanggal_pindah' => 'required|date',
            'alasan_pindah' => 'required|string',
            'link' => 'file|mimetypes:application/pdf|max:2048',
            'status' => 'required|string|max:255'
        ];
    }
    public function messages(): array
    {
        return [
            'nik.required' => 'NIK wajib diisi.',
            'nik.size' => 'NIK harus terdiri dari 16 karakter.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'nik.regex' => 'NIK hanya boleh berisi angka.',
            'nama.required' => 'Nama wajib diisi.',
            'nama.regex' => 'Nama hanya boleh berisi huruf dan spasi.',
            'tmp_lahir.required' => 'Tempat lahir wajib diisi.',
            'tgl_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tgl_lahir.date' => 'Tanggal tidak valid.',
            'jns_kel.required' => 'Jenis kelamin wajib diisi.',
            'jns_kel.in' => 'Jenis kelamin yang dimasukkan tidak valid.',
            'gol_d.required' => 'Golongan darah wajib diisi.',
            'gol_d.in' => 'Golongan darah yang dimasukkan tidak valid.',
            'alamat.required' => 'Alamat wajib diisi.',
            'agama.required' => 'Agama wajib diisi.',
            'agama.in' => 'Agama yang dimasukkan tidak valid.',
            'stt_kawin.in' => 'Status kawin yang dimasukkan tidak valid.',
            'pekerjaan.required' => 'Pekerjaan wajib diisi.',
            'kwn.required' => 'Kewarganaan wajib diisi.',
            'kwn.in' => 'Kewarganaan yang dimasukkan tidak valid.',
            'link.required' => 'Documen wajib diisi.',
            'link.mimetypes' => 'Tipe documen yang diunggah harus berupa PDF.',
            'link.max' => 'Ukuran dokumen maksimal adalah 2MB.',
        ];
    }
}
