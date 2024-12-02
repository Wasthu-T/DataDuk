<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StorePendudukRequest extends FormRequest
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
            'nik' => 'required|string|size:16|unique:penduduks,nik', 
            'nama' => 'required|string|max:255',                     
            'tmp_lahir' => 'required|string|max:255',                
            'tgl_lahir' => 'required|date|before:today',            
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
            'nama.required' => 'Nama wajib diisi.',
            'tmp_lahir.required' => 'Tempat lahir wajib diisi.',
            'tgl_lahir.before' => 'Tanggal lahir harus sebelum hari ini.',
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
