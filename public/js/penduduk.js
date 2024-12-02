// Count data
function fetchcount(tahun = 1970) {
    fetch(`/api/chart?tahun=${tahun}`)
        .then(response => { return response.json(); })
        .then(data => {
            Render_chart(data);
            let wni = document.getElementById('total_penduduk');
            let gender_cwo = document.getElementById('laki-laki');
            let gender_cwe = document.getElementById('perempuan');
            let wna = document.getElementById('wna');
            gender_cwo_value = data.gender[0][0];
            gender_cwe_value = data.gender[0][1];
            wni_value = data.kwn[0][0];
            wna_value = data.kwn[0][1];

            function getValue(data) {
                return data ? data.total || 0 : 0;
            }

            gender_cwo.innerHTML = getValue(gender_cwo_value);
            gender_cwe.innerHTML = getValue(gender_cwe_value);
            wni.innerHTML = getValue(wni_value) + getValue(wna_value);
            wna.innerHTML = getValue(wna_value);


        })
}


// Pendatang Chart
let persebaranKelahiran = null;
function Render_chart(data_penduduk) {
    var total = data_penduduk.data_kelahiran[0].length;
    labels = [];
    values = [];
    for (i = 0; i < total; i++) {
        data = data_penduduk.data_kelahiran[0][i];
        labels.push(data.tahun);
        values.push(data.total);
    }

    if (persebaranKelahiran) {
        persebaranKelahiran.destroy();
    }

    var ctxHum = document.getElementById('persebaranKelahiran').getContext('2d');
    persebaranKelahiran = new Chart(ctxHum, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Persebaran Data',
                data: values,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, 
        }
    });
}

function filterChart() {
    let tahun = document.getElementById('tahun').value;
    fetchcount(tahun);
}

document.addEventListener('DOMContentLoaded', () => {

    fetchcount();
});
// Get data
function get_data(page = 1, nik = filternik) {
    fetch(`/api/penduduk?nik=${nik}&page=${page}`)
        .then(response => response.json())
        .then(data => {
            updateTable(data); // Fungsi untuk memperbarui tabel
            updatePagination(data); // Fungsi untuk memperbarui kontrol pagination
        })
        .catch(error => console.error('Error:', error));
}
function updatePagination(data) {
    let pagination = document.getElementById('pagination');
    pagination.innerHTML = ''; // Hapus pagination sebelumnya

    // Tombol Previous
    if (data.current_page > 1) {
        let prevButton = document.createElement('button');
        prevButton.textContent = '<';
        prevButton.addEventListener('click', () => get_data(data.current_page - 1, filternik));
        pagination.appendChild(prevButton);
    }

    if (data.last_page >= 3) {
        // Halaman pertama hingga ketiga
        for (let page = 1; page <= Math.min(3, data.last_page); page++) {
            let button = document.createElement('button');
            button.textContent = page;
            button.disabled = page === data.current_page; // Nonaktifkan tombol halaman aktif
            button.addEventListener('click', () => get_data(page, filternik));
            pagination.appendChild(button);
        }
    }

        // Ellipsis jika ada halaman di tengah
        if (data.current_page > 4) {
            let ellipsis = document.createElement('span');
            ellipsis.textContent = '...';
            pagination.appendChild(ellipsis);
        }

        // Halaman aktif atau dekat aktif di tengah
        for (let page = Math.max(4, data.current_page - 1);
            page <= Math.min(data.last_page - 3, data.current_page + 1);
            page++) {
            let button = document.createElement('button');
            button.textContent = page;
            button.disabled = page === data.current_page;
            button.addEventListener('click', () => get_data(page, filternik));
            pagination.appendChild(button);
        }

        // Ellipsis jika ada halaman sebelum akhir
        if (data.current_page < data.last_page - 3) {
            let ellipsis = document.createElement('span');
            ellipsis.textContent = '...';
            pagination.appendChild(ellipsis);
        }

        // Halaman terakhir 3
        for (let page = Math.max(data.last_page - 2, 1); page <= data.last_page; page++) {
            let button = document.createElement('button');
            button.textContent = page;
            button.disabled = page === data.current_page;
            button.addEventListener('click', () => get_data(page, filternik));
            pagination.appendChild(button);
        }

    // Tombol Next
    if (data.current_page < data.last_page) {
        let nextButton = document.createElement('button');
        nextButton.textContent = '>';
        nextButton.addEventListener('click', () => get_data(data.current_page + 1, filternik));
        pagination.appendChild(nextButton);
    }

}

function updateTable(penduduk) {

    let tableBody = document.getElementById('TablePenduduk');
    tableBody.innerHTML = ''; // Hapus isi tabel sebelumnya
    penduduk.data.forEach(item => {
        let row = `<tr>
            <td>${item.nik}</td>
            <td>${item.nama}</td>
            <td>${item.tmp_lahir}</td>
            <td>${item.tgl_lahir}</td>
            <td>${item.jns_kel}</td>
            <td>${item.gol_d}</td>
            <td>${item.alamat}</td>
            <td>${item.agama}</td>
            <td>${item.stt_kawin}</td>
            <td>${item.pekerjaan}</td>
            <td>${item.kwn}</td>
            <td>
            <a class="btn btn-sm btn-warning" href="/dashboard/ubah/${item.nik}">
            <i class="fas fa-edit"></i>
            </a>

            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-nik="${item.nik}" >
            <i class="fas fa-trash"></i>
            </button>
            </td>
        </tr>`;
        tableBody.innerHTML += row;
    });
}
let filternik = "";
function applyFilter() {
    filternik = document.getElementById('searchInput').value;
    get_data(1, filternik);
}

document.addEventListener('DOMContentLoaded', () => {
    get_data();
});

// Fungsi untuk me-refresh halaman
function refreshPage() {
    location.reload(); // Reload halaman saat tombol Refresh diklik
}

// Fungsi untuk mencetak tabel
function printTable() {
    const table = document.getElementById('pendudukTable').outerHTML;
    const newWindow = window.open('', '_blank');
    newWindow.document.write(`
               <html>
                   <head>
                       <title>Cetak Data Penduduk</title>
                       <style>
                           table {
                               width: 100%;
                               border-collapse: collapse;
                           }
                           table, th, td {
                               border: 1px solid black;
                           }
                           th, td {
                               padding: 8px;
                               text-align: left;
                           }
                       </style>
                   </head>
                   <body>
                       ${table}
                   </body>
               </html>
           `);
    newWindow.document.close();
    newWindow.print();
}

document.addEventListener('DOMContentLoaded', function () {
    var confirmDeleteModal = document.getElementById('confirmDeleteModal');
    confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Tombol yang memicu modal
        var nik = button.getAttribute('data-nik'); // Ambil nik dari tombol
        var deleteForm = document.getElementById('deleteForm');
        var deletenik = document.getElementById('deletenik'); // Elemen untuk menampilkan nik
        deleteForm.action = "/dashboard/hapus/" + nik;
        deletenik.textContent = nik; // Set nik ke elemen
    });
});