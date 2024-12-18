function get_nama(nik) {
    let nama = document.getElementById('nama');
    let alamat_asal = document.getElementById('alamat_asal');
    fetch(`/api/penduduk/${nik}`)
        .then(response => {
            if (!response.ok) { // Cek apakah response sukses
                if (response.status === 404) {
                    nama.value = "Nama tidak ditemukan";
                    alamat_asal.value = "Alamat tidak ditemukan";
                    throw new Error('Data tidak ditemukan');
                }
                throw new Error('Terjadi kesalahan pada server');
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            nama.value = data.data.nama;
            alamat_asal.value = data.data.alamat;
        })
}

// nik
const nik = document.getElementById('nik');
nik.addEventListener('change', function () {
    const value_nik = this.value;
    get_nama(value_nik);
});

let stt_aktif = document.getElementById('status');
provinsi.addEventListener('change', function () {
    const value_provinsi = this.value;
    if (value_provinsi == "DI Yogyakarta"){
        stt_aktif.value = "tetap"
    }else {
        stt_aktif.value = "pindah"
    }
});