<!-- Tampilan Data Perpindahan Awal -->

@extends('admin.dashboard.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/style_adddata.css') }}">
@endsection

@section('container')
<div class="container">
    @if(session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <strong>{{ session('error') }} </strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="text-center mb-5 mt-2">Tambah Data Perpindahan</h3>
            <form method="post" id="tambahDataForm" action="/dashboard/pindah" enctype="multipart/form-data">
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
                        <input readonly disabled name="nama" type="text" class="form-control" id="nama" placeholder="Masukkan Nama">
                    </div>
                    @error('nama')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                    <!-- <div class="invalid-feedback">Nama harus diisi.</div> -->
                </div>
                <div class="mb-3">
                    <label for="alamat_asal" class="form-label">Alamat Asal</label>
                    <div class="input-group">
                        <span class="input-group-text">🏡</span>
                        <textarea readonly name="alamat_asal" class="form-control" id="alamat_asal" placeholder="Masukkan Alamat" rows="3"></textarea>
                    </div>
                    @error('alamat_asal')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                    <!-- <div class="invalid-feedback">Alamat harus diisi.</div> -->
                </div>
                <!-- alamat tujuan start -->
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
                        <textarea required name="alamat_tujuan" class="form-control" id="alamat_tujuan" placeholder="Masukkan alamat tujuan" rows="3">{{old('alamat_tujuan')}}</textarea>
                    </div>
                    @error('alamat_tujuan')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <!-- alamat tujuan selesai -->
                <div class="mb-3">
                    <label for="tanggal_pindah" class="form-label">Tanggal Pindah</label>
                    <div class="input-group">
                        <span class="input-group-text">📅</span>
                        <input value="{{ old('tanggal_pindah') ?? now()->format('Y-m-d') }}" max="{{now()->format('Y-m-d')}}" required name="tanggal_pindah" type="date" class="form-control" id="tanggalLahir">
                    </div>
                    @error('tanggal_pindah')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                    <!-- <div class="invalid-feedback">Tanggal Lahir harus diisi.</div> -->
                </div>

                <div class="mb-3">
                    <label for="alasan_pindah" class="form-label">Alasan Pindah</label>
                    <div class="input-group">
                        <span class="input-group-text">💍</span>
                        <select required name="alasan_pindah" class="form-control" id="alasanPindah">
                            <option value="">Pilih Alasan Pindah</option>
                            <option value="bekerja">Bekerja</option>
                            <option value="menikah">Menikah</option>
                            <option value="belajar">Belajar</option>
                        </select>
                    </div>
                    @error('alasan_pindah')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status Keaktifan</label>
                    <div class="input-group">
                        <span class="input-group-text">✴️</span>
                        <input readonly value="" name="status" type="text" class="form-control" id="status" placeholder="Status">
                        <!-- <select required name="status" class="form-control" id="alasanPindah">
                            <option value="">Pilih Status Keaktifan</option>
                            <option value="tetap">Tetap</option>
                            <option value="pindah">Pindah</option>
                        </select> -->
                    </div>
                    @error('status')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="link" class="form-label">Upload Dokumen Surat Pindah</label>
                    <div class="input-group">
                        <span class="input-group-text">📄</span>
                        <input required type="file" name="link" class="form-control" id="link" accept=".pdf">
                    </div>
                    @error('link')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
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
<script src="{{ asset('js/check.js') }}"></script>
@endsection