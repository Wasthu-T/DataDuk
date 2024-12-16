@extends('admin.dashboard.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/style_adddata.css') }}">
@endsection

@section('container')
<div class="container">

    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="text-center mb-5 mt-2">Tambah Data Penduduk</h3>
            <form method="post" id="tambahDataForm" action="/dashboard/tambah">
                @csrf
                <div class="mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <div class="input-group">
                        <span class="input-group-text">🆔</span>
                        <input value="{{old('nik')}}" minlength="16" maxlength="16" pattern="\d{16}" onkeypress="return /[0-9]/i.test(event.key)" required name="nik" type="text" class="form-control" id="nik" placeholder="Masukkan NIK">
                    </div>
                    @error('nik')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                    <!-- <div class="invalid-feedback">NIK harus diisi.</div> -->
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <div class="input-group">
                        <span class="input-group-text">👤</span>
                        <input value="{{old('nama')}}" onkeydown="return /[a-zA-Z]/i.test(event.key)" required name="nama" type="text" class="form-control" id="nama" placeholder="Masukkan Nama">
                    </div>
                    @error('nama')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                    <!-- <div class="invalid-feedback">Nama harus diisi.</div> -->
                </div>
                <div class="mb-3">
                    <label for="tmp_lahir" class="form-label">Tempat Lahir</label>
                    <div class="input-group">
                        <span class="input-group-text">🏙</span>
                        <input value="{{old('tmp_lahir')}}" required name="tmp_lahir" type="text" class="form-control" id="tempatLahir" placeholder="Masukkan Tempat Lahir">
                    </div>
                    @error('tmp_lahir')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                    <!-- <div class="invalid-feedback">Tempat Lahir harus diisi.</div> -->
                </div>
                <div class="mb-3">
                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                    <div class="input-group">
                        <span class="input-group-text">🎂</span>
                        <input value="{{old('tgl_lahir')}}" required name="tgl_lahir" type="date" class="form-control" id="tanggalLahir">
                    </div>
                    @error('tgl_lahir')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                    <!-- <div class="invalid-feedback">Tanggal Lahir harus diisi.</div> -->
                </div>
                <div class="mb-3">
                    <label for="jns_kel" class="form-label">Jenis Kelamin</label>
                    <div class="input-group">
                        <span class="input-group-text">🚻</span>
                        <select required name="jns_kel" class="form-control" id="jenisKelamin">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    @error('jns_kel')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                    <!-- <div class="invalid-feedback">Jenis Kelamin harus dipilih.</div> -->
                </div>
                <div class="mb-3">
                    <label for="gol_d" class="form-label">Golongan Darah</label>
                    <div class="input-group">
                        <span class="input-group-text">🩸</span>
                        <select required name="gol_d" class="form-control" id="golonganDarah">
                            <option value="">Pilih Golongan Darah</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="AB">AB</option>
                            <option value="O">O</option>
                        </select>
                    </div>
                    @error('gol_d')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="provinsi" class="form-label">Provinsi</label>
                    <div class="input-group">
                        <span class="input-group-text">🏡</span>
                        <select required name="provinsi" class="form-control" id="provinsi">
                            <option value="">Pilih Provinsi</option>
                        </select>
                    </div>
                    @error('provinsi')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror

                    <label for="kabupaten" class="form-label">Kabupaten</label>
                    <div class="input-group">
                        <span class="input-group-text">🏡</span>
                        <select required name="kabupaten" class="form-control" id="kabupaten">
                            <option value="">Pilih Kabupaten</option>
                        </select>
                    </div>
                    @error('kabupaten')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror

                    <label for="kecamatan" class="form-label">Kecamatan</label>
                    <div class="input-group">
                        <span class="input-group-text">🏡</span>
                        <select required name="kecamatan" class="form-control" id="kecamatan">
                            <option value="">Pilih Kecamatan</option>
                        </select>
                    </div>
                    @error('kecamatan')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror

                    <label for="desa" class="form-label">Desa</label>
                    <div class="input-group">
                        <span class="input-group-text">🏡</span>
                        <select required name="desa" class="form-control" id="desa">
                            <option value="">Pilih Desa</option>
                        </select>
                    </div>
                    @error('desa')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror

                    <div class="input-group">
                        <span class="input-group-text">🏡</span>
                        <textarea required name="alamat" class="form-control" id="alamat" placeholder="Masukkan Alamat" rows="3">{{old('alamat')}}</textarea>
                    </div>
                    @error('alamat')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="agama" class="form-label">Agama</label>
                    <div class="input-group">
                        <span class="input-group-text">🛐</span>
                        <select required name="agama" class="form-control" id="agama">
                            <option value="">Pilih Agama</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Konghucu">Konghucu</option>
                        </select>
                    </div>
                    @error('agama')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                    <!-- <div class="invalid-feedback">Status Perkawinan harus dipilih.</div> -->
                </div>

                <div class="mb-3">
                    <label for="stt_kawin" class="form-label">Status Perkawinan</label>
                    <div class="input-group">
                        <span class="input-group-text">💍</span>
                        <select required name="stt_kawin" class="form-control" id="statusPerkawinan">
                            <option value="">Pilih Status Perkawinan</option>
                            <option value="belum kawin">Belum Kawin</option>
                            <option value="kawin">Kawin</option>
                        </select>
                    </div>
                    @error('stt_kawin')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                    <!-- <div class="invalid-feedback">Status Perkawinan harus dipilih.</div> -->
                </div>
                <div class="mb-3">
                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                    <div class="input-group">
                        <span class="input-group-text">💼</span>
                        <input value="{{old('pekerjaan')}}" required name="pekerjaan" type="text" class="form-control" id="pekerjaan" placeholder="Masukkan Pekerjaan">
                    </div>
                    @error('pekerjaan')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                    <!-- <div class="invalid-feedback">Pekerjaan harus diisi.</div> -->
                </div>
                <div class="mb-3">
                    <label for="kwn" class="form-label">Kewarganegaraan</label>
                    <div class="input-group">
                        <span class="input-group-text">🌍</span>
                        <select required name="kwn" class="form-control" id="kewarganegaraan">
                            <option value="">Pilih Kewarganaan</option>
                            <option value="WNI">WNI</option>
                            <option value="WNA">WNA</option>
                        </select>
                    </div>
                    @error('kwn')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                    <!-- <div class="invalid-feedback">Kewarganegaraan harus diisi.</div> -->
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-custom">Tambah Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/alamat.js') }}"></script>
@endsection