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

function get_data(page = 1, search = filtersearch) {
    fetch(`/api/penduduk?search=${search}&page=${page}`)
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
    if (data.current_page >= 1) {
        const prevButton = document.createElement('li');
        prevButton.classList.add('page-item');
        prevButton.innerHTML = `<button class="page-link">Back</button>`;
        pagination.appendChild(prevButton);
        if (data.current_page == 1) {
            prevButton.classList.add('disabled');
        } else {
            prevButton.classList.remove('disabled');
            prevButton.addEventListener('click', () => get_data(data.current_page - 1, filtersearch));
        }
    }

    if (data.last_page >= 3) {
        // Halaman pertama hingga ketiga
        for (let page = 1; page <= Math.min(3, data.last_page); page++) {
            const pageItem = document.createElement('li');
            pageItem.classList.add('page-item');
            if (page == data.current_page) {
                pageItem.classList.add('active');
            } else {
                pageItem.addEventListener('click', () => get_data(page, filtersearch));
            }

            pageItem.disabled = page === data.current_page; // Nonaktifkan tombol halaman aktif
            pageItem.innerHTML = `<button class="page-link">${page}</button>`;
            pagination.appendChild(pageItem);
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
        const pageItem = document.createElement('li');
        pageItem.classList.add('page-item');
        if (page == data.current_page) {
            pageItem.classList.add('active');
        } else {
            pageItem.addEventListener('click', () => get_data(page, filtersearch));
        }

        pageItem.disabled = page === data.current_page; // Nonaktifkan tombol halaman aktif
        pageItem.innerHTML = `<button class="page-link">${page}</button>`;
        pagination.appendChild(pageItem);
    }

    // Ellipsis jika ada halaman sebelum akhir
    if (data.current_page < data.last_page - 3) {
        let ellipsis = document.createElement('span');
        ellipsis.textContent = '...';
        pagination.appendChild(ellipsis);
    }

    // Halaman terakhir 3
    for (let page = Math.max(data.last_page - 2, 1); page <= data.last_page; page++) {
        const pageItem = document.createElement('li');
        pageItem.classList.add('page-item');
        if (page == data.current_page) {
            pageItem.classList.add('active');
        } else {
            pageItem.addEventListener('click', () => get_data(page, filtersearch));
        }

        pageItem.disabled = page === data.current_page; // Nonaktifkan tombol halaman aktif
        pageItem.innerHTML = `<button class="page-link">${page}</button>`;
        pagination.appendChild(pageItem);
    }

    // Tombol Next
    if (data.current_page <= data.last_page) {
        const nextButton = document.createElement('li');
        nextButton.classList.add('page-item');
        nextButton.innerHTML = `<button class="page-link">Next</button>`;
        pagination.appendChild(nextButton);
        if (data.current_page == data.last_page) {
            nextButton.classList.add(data.currentPage == data.totalPages ? 'disabled' : '');
        } else {
            nextButton.addEventListener('click', () => get_data(data.current_page + 1, filtersearch));
        }
    }

}

function createTableCell(content) {
    return content ? `<td>${content}</td>` : '';
}

function createActionButtons(nik) {
    if (!nik) return ''; // Jika NIK tidak valid, tombol tidak dibuat
    return `
        <td>
            <a class="btn btn-sm btn-warning" href="/dashboard/ubah/${nik}">
                <i class="fas fa-edit"></i>
            </a>
            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-nik="${nik}">
                <i class="fas fa-trash"></i>
            </button>
        </td>`;
}

function checkpath(path) {
    return path == '/beranda' ? true : false;
}

function updateTable(penduduk) {
    let tableBody = document.getElementById('TablePenduduk');
    tableBody.innerHTML = ''; // Hapus isi tabel sebelumnya
    let path = window.location.pathname
    penduduk.data.forEach(item => {
        if (checkpath(path) == true) {
            let row = `
            <tr>
                ${createTableCell(item.nama)}
                ${createTableCell(item.tmp_lahir)}
                ${createTableCell(item.tgl_lahir)}
                ${createTableCell(item.jns_kel)}
                ${createTableCell(item.gol_d)}
                ${createTableCell(item.agama)}
                ${createTableCell(item.stt_kawin)}
                ${createTableCell(item.pekerjaan)}
                ${createTableCell(item.kwn)}
            </tr>`;
            tableBody.innerHTML += row;

        } else {
            let row = `
            <tr>
            ${createTableCell(item.nik)}
                ${createTableCell(item.nama)}
                ${createTableCell(item.tmp_lahir)}
                ${createTableCell(item.tgl_lahir)}
                ${createTableCell(item.jns_kel)}
                ${createTableCell(item.gol_d)}
                ${createTableCell(item.alamat)}
                ${createTableCell(item.agama)}
                ${createTableCell(item.stt_kawin)}
                ${createTableCell(item.pekerjaan)}
                ${createTableCell(item.kwn)}
                ${createActionButtons(item.nik)}
                </tr>`;
            tableBody.innerHTML += row;
        }
    });
}

let filtersearch = "";
function applyFilter() {
    filtersearch = document.getElementById('filtersearchInput').value;
    get_data(1, filtersearch);
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