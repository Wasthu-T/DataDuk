function get_provinsi() {
    fetch(`/api/alamat/provinsi`)
        .then(response => { return response.json(); })
        .then(data => {
            let provinsi = document.getElementById('provinsi');
            data.forEach(elemen => {
                let opsi = createOpsi(elemen.kode_provinsi, elemen.nama_provinsi);
                provinsi.innerHTML += opsi;
            });
        })
}

function get_kabupaten(kode) {
    fetch(`/api/alamat/kabupaten/${kode}`)
        .then(response => { return response.json(); })
        .then(data => {
            let kabupaten = document.getElementById('kabupaten');
            kabupaten.innerHTML = `<option value="">Pilih Kabupaten</option>`;
            data.forEach(elemen => {
                let opsi = createOpsi(elemen.kode_kabupaten, elemen.nama_kabupaten);
                kabupaten.innerHTML += opsi;
            });
        })
}

function get_kecamatan(kode) {
    fetch(`/api/alamat/kecamatan/${kode}`)
        .then(response => { return response.json(); })
        .then(data => {
            let kecamatan = document.getElementById('kecamatan');
            kecamatan.innerHTML = `<option value="">Pilih Kecamatan</option>`;
            data.forEach(elemen => {
                let opsi = createOpsi(elemen.kode_kecamatan, elemen.nama_kecamatan);
                kecamatan.innerHTML += opsi;
            });
        })
}

function get_desa(kode) {
    if (!kode) {
        resetDropdown('desa', "Desa");
        return;
    }
    fetch(`/api/alamat/desa/${kode}`)
        .then(response => { return response.json(); })
        .then(data => {
            let desa = document.getElementById('desa');
            desa.innerHTML = `<option value="">Pilih Desa</option>`;
            data.forEach(elemen => {
                let opsi = createOpsi(elemen.kode_desa, elemen.nama_desa);
                desa.innerHTML += opsi;
            });
        })
}

// Event listener untuk dropdown provinsi
const provinsi = document.getElementById('provinsi');
provinsi.addEventListener('change', function () {
    resetDropdown('kabupaten', "Kabupaten");
    resetDropdown('kecamatan', "Kecamatan");
    resetDropdown('desa', "Desa");
    const selectedId = this.value;
    const selectedOption = this.selectedOptions[0]; 
    const kode = selectedOption.getAttribute('kode'); 
    get_kabupaten(kode); 
});

// Event listener untuk dropdown kabupaten
const kabupaten = document.getElementById('kabupaten');
kabupaten.addEventListener('change', function () {
    resetDropdown('kecamatan', "Kecamatan");
    resetDropdown('desa', "Desa");
    const selectedId = this.value;
    const selectedOption = this.selectedOptions[0]; 
    const kode = selectedOption.getAttribute('kode'); 
    get_kecamatan(kode); 
});

// Event listener untuk dropdown kecamatan
const kecamatan = document.getElementById('kecamatan');
kecamatan.addEventListener('change', function () {
    resetDropdown('desa', "Desa");
    const selectedId = this.value;
    const selectedOption = this.selectedOptions[0]; 
    const kode = selectedOption.getAttribute('kode'); 
    get_desa(kode); 
});


function resetDropdown(elementId, alamat) {
    const dropdown = document.getElementById(elementId);
    dropdown.innerHTML = `<option value="">Pilih ${alamat}</option>`; // Reset dengan opsi default
}

function createOpsi(id, nama) {
    return id ? ` <option value="${nama}" kode="${id}">${nama}</option>` : '';
}

get_provinsi();