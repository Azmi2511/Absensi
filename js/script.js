const barChart = new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
    labels: ['20/4', '21/4', '22/4'],
    datasets: [
        { label: 'Hadir', data: [2, 2, 1], backgroundColor: 'green' },
        { label: 'Alpa', data: [0, 0, 1], backgroundColor: 'red' }
    ]
    },
    options: { responsive: true, scales: { y: { beginAtZero: true } } }
});

const lineChart = new Chart(document.getElementById('lineChart'), {
    type: 'line',
    data: {
    labels: ['Mar', 'Apr', 'Mei'],
    datasets: [{ label: 'Hadir', data: [3, 2, 4], borderColor: 'green', fill: false }]
    },
    options: { responsive: true, scales: { y: { beginAtZero: true } } }
});

setInterval(() => {
    const now = new Date();
    const jam = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
    document.getElementById("jam").innerText = "Jam: " + jam + " WIB";
}, 1000);

$(document).ready(function () {
    $('table').DataTable();
});

if (!$.fn.DataTable.isDataTable('#tabelSiswa')) {
    $('#tabelSiswa').DataTable({
        "paging": true,
        "pageLength": 5, // tampilkan 5 baris per halaman
        "lengthMenu": [5, 10, 25, 50, 100],
        "searching": true, // aktifkan pencarian
        "ordering": true   // aktifkan pengurutan
    });
}