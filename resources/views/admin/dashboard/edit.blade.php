@extends('admin.dashboard.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/style_adddata.css') }}">
@endsection

@section('container')

<div class="card shadow-sm">
    <div class="card-body">
        <h3 class="text-center mb-5 mt-2">Update Data Penduduk</h3>
        <form method="post" id="tambahDataForm" action="/dashboard/ubah/{{$data->nik}}">
            @csrf
            <div class="mb-3">
                <label for="nik" class="form-label">NIK</label>
                <div class="input-group">
                    <span class="input-group-text">🆔</span>
                    <input minlength="16" maxlength="16" pattern="\d{16}" onkeypress="return /[0-9]/i.test(event.key)" value="{{$data->nik}}" readonly name="nik" type="text" class="form-control" id="nik">
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
                    <input onkeydown="return /[a-zA-Z]/i.test(event.key)" value="{{$data_status->nama}}" required name="nama" type="text" class="form-control" id="nama">
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
                    <input value="{{$data->tmp_lahir}}" readonly name="tmp_lahir" type="text" class="form-control" id="tempatLahir" placeholder="Masukkan Tempat Lahir">
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
                    <input value="{{$data->tgl_lahir}}" readonly name="tgl_lahir" type="date" class="form-control" id="tanggalLahir">
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
                        <option value="Laki-laki" {{ $data->jns_kel == "Laki-laki" ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ $data->jns_kel == "Perempuan" ? 'selected' : '' }}>Perempuan</option>
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
                        <option value="A" {{ $data->gol_d == "A" ? 'selected' : '' }}>A</option>
                        <option value="B" {{ $data->gol_d == "B" ? 'selected' : '' }}>B</option>
                        <option value="AB" {{ $data->gol_d == "AB" ? 'selected' : '' }}>AB</option>
                        <option value="O" {{ $data->gol_d == "O" ? 'selected' : '' }}>O</option>
                    </select>
                </div>
                @error('gol_d')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                @php
                $location = $data_status->alamat;
                $locationParts = explode(", ", $location);
                @endphp
                <label for="provinsi" class="form-label">Provinsi</label>
                <div class="input-group">
                    <span class="input-group-text">🏡</span>
                    <select required name="provinsi" class="form-control" id="provinsi">
                        @if($data_status->alamat)
                        <option value="{{ $locationParts[4] }}">{{ $locationParts[4] }}</option>
                        @else
                        <option value="">Pilih Provinsi</option>
                        @endif
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
                        @if($data_status->alamat)
                        <option value="{{$locationParts[3]}}">{{ $locationParts[3] }}</option>
                        @else
                        <option value="">Pilih Kabupaten</option>
                        @endif
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
                        @if($data_status->alamat)
                        <option value="{{$locationParts[2]}}">{{ $locationParts[2] }}</option>
                        @else
                        <option value="">Pilih Kecamatan</option>
                        @endif
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
                        @if($data_status->alamat)
                        <option value="{{$locationParts[1]}}">{{ $locationParts[1] }}</option>
                        @else
                        <option value="">Pilih Desa</option>
                        @endif
                    </select>
                </div>
                @error('desa')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror

                <div class="input-group">
                    <span class="input-group-text">🏡</span>
                    <textarea required name="alamat" class="form-control" id="alamat" placeholder="Masukkan Alamat" rows="3">{{$locationParts[0]}}</textarea>
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
                        <option value="Islam" {{ $data_status->agama == "Islam" ? 'selected' : '' }}>Islam</option>
                        <option value="Kristen" {{ $data_status->agama == "Kristen" ? 'selected' : '' }}>Kristen</option>
                        <option value="Katolik" {{ $data_status->agama == "Katolik" ? 'selected' : '' }}>Katolik</option>
                        <option value="Hindu" {{ $data_status->agama == "Hindu" ? 'selected' : '' }}>Hindu</option>
                        <option value="Budha" {{ $data_status->agama == "Budha" ? 'selected' : '' }}>Budha</option>
                        <option value="Konghucu" {{ $data_status->agama == "Konghucu" ? 'selected' : '' }}>Konghucu</option>
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
                        <option value="belum kawin" {{ $data_status->stt_kawin == "belum kawin" ? 'selected' : '' }}>Belum Kawin</option>
                        <option value="kawin" {{ $data_status->stt_kawin == "kawin" ? 'selected' : '' }}>Kawin</option>
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
                    <input value="{{$data_status->pekerjaan}}" required name="pekerjaan" type="text" class="form-control" id="pekerjaan" placeholder="Masukkan Pekerjaan">
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
                    <select required name="kwn" class="form-control" id="statusKewarganaan">
                        <option value="">Pilih Status Kewarganaan</option>
                        <option value="WNI" {{ $data_status->kwn == "WNI" ? 'selected' : '' }}>WNI</option>
                        <option value="WNA" {{ $data_status->kwn == "WNA" ? 'selected' : '' }}>WNA</option>
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
                <button type="submit" class="btn btn-custom">Update Data</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/alamat.js') }}"></script>
@endsection