// Pendatang Chart
let persebaranPendatang = null;
function Render_chart_domisili(data_penduduk) {
    var total = data_penduduk.length;
    labels = [];
    values = [];
    for (i = 0; i < total; i++) {
        data = data_penduduk[i];
        labels.push(data.tahun);
        values.push(data.total);
    }

    if (persebaranPendatang) {
        persebaranPendatang.destroy();
    }

    var ctxHum = document.getElementById('persebaranPerpindahan').getContext('2d');
    persebaranPendatang = new Chart(ctxHum, {
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
    fetchcountdomisili(tahun);
}

document.addEventListener('DOMContentLoaded', () => {
    fetchcountdomisili();
});

// Get data
// Count data
function fetchcountdomisili(tahun = 2007) {
    fetch(`/api/domisili/chart?tahun=${tahun}`)
        .then(response => { return response.json(); })
        .then(data => {
            Render_chart_domisili(data.Pindah);
        })
}

// Kelahiran Chart
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

function fetchcount(tahun = 1970) {
    fetch(`/api/chart?tahun=${tahun}`)
        .then(response => { return response.json(); })
        .then(data => {
            Render_chart(data);
        })
}