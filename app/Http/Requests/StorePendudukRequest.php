<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StorePendudukRequest extends FormRequest
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
            'nik' => 'required|string|size:16|regex:/^[0-9]+$/|unique:penduduks,nik',
            'nama' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'tmp_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|date|before_or_equal:' . now()->subYears(17)->format('Y-m-d'),
            'jns_kel' => 'required|string|in:Laki-laki,Perempuan',
            'gol_d' => 'required|string|in:A,B,AB,O',
            'alamat' => 'required|string|max:255',
            'agama' => 'required|string|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'stt_kawin' => 'required|string|in:kawin,belum kawin',
            'pekerjaan' => 'required|string|max:255',
            'kwn' => 'required|string|in:WNI,WNA',
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
            'tgl_lahir.before_or_equal' => 'Umur maximal 17 tahun.',
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
        ];
    }
}
