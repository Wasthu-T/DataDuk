<!-- Tampilan Data Perpindahan Awal -->

@extends('admin.dashboard.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/style_adddata.css') }}">
@endsection

@section('container')
<div class="container">

    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="text-center mb-5 mt-2">Tambah Data Perpindahan</h3>
            <form method="post" id="tambahDataForm" action="/dashboard/pindah">
                @csrf
                <div class="mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <div class="input-group">
                        <span class="input-group-text">🆔</span>
                        <input required name="nik" type="text" class="form-control" id="nik" placeholder="Masukkan NIK">
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
                        <input required name="nama" type="text" class="form-control" id="nama" placeholder="Masukkan Nama">
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
                        <textarea required name="alamat_asal" class="form-control" id="alamat_asal" placeholder="Masukkan Alamat" rows="3"></textarea>
                    </div>
                    @error('alamat_asal')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                    <!-- <div class="invalid-feedback">Alamat harus diisi.</div> -->
                </div>
                <div class="mb-3">
                    <label for="alamat_tujuan" class="form-label">Alamat Tujuan</label>
                    <div class="input-group">
                        <span class="input-group-text">🏡</span>
                        <textarea required name="alamat_tujuan" class="form-control" id="alamat_tujuan" placeholder="Masukkan Alamat" rows="3"></textarea>
                    </div>
                    @error('alamat')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                    <!-- <div class="invalid-feedback">Alamat harus diisi.</div> -->
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
                    @error('alamat_tujuan')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                    <!-- <div class="invalid-feedback">Alasan Pindah harus dipilih.</div> -->
                </div>
                <div class="mb-3">
                    <label for="stt_aktif" class="form-label">Status Keaktifan<label>
                    <div class="input-group">
                        <span class="input-group-text">💍</span>
                        <select required name="stt_aktif" class="form-control" id="stt_aktif">
                            <option value="">Pilih Status Keaktifan</option>
                            <option value="tetap">Tetap</option>
                            <option value="pindah">Pindah</option>
                        </select>
                    </div>
                    @error('stt_aktif')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                    <!-- <div class="invalid-feedback">Alasan Pindah harus dipilih.</div> -->
                </div>
                <div class="mb-3">
                    <label for="dokumen_pindah" class="form-label">Upload Dokumen Surat Pindah</label>
                    <div class="input-group">
                        <span class="input-group-text">📄</span>
                        <input required type="file" name="dokumen_pindah" class="form-control" id="dokumen_pindah" accept=".pdf,.jpg,.jpeg,.png">
                    </div>
                    @error('dokumen_pindah')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                    <!-- <div class="invalid-feedback">Dokumen harus diupload.</div> -->
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-custom">Tambah Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<!-- Tampilan Data Perpindahan Akhir -->