// // Ambil konteks canvas dan buat chart baru
// var ctx = document.getElementById('myChart').getContext('2d');
// var chart = new Chart(ctx, {
//     type: 'bar',
//     data: {
//         labels: [],
//         datasets: [
//             {
//                 label: 'Tuya Smart Plug 1',
//                 backgroundColor: 'red',
//                 data: []
//             },
//             {
//                 label: 'Tuya Smart Plug 2',
//                 backgroundColor: 'green',
//                 data: []
//             },
//             {
//                 label: 'Tuya Smart Plug 3',
//                 backgroundColor: 'blue',
//                 data: []
//             }
//         ]
//     },
//     options: {
//         responsive: true,
//         scales: {
//             y: {
//                 beginAtZero: true
//             }
//         }
//     }
// });

// // Ambil data dari tabel dan perbarui chart
// function fetchData() {
//     fetch('./pages/summary/new-query.php')
//         .then(response => response.json())
//         .then(data => {
//             data.forEach(row => {
//                 var time = row.time;
//                 var voltage1 = row.voltage;
//                 var voltage2 = row.voltage;
//                 var voltage3 = row.voltage;

//                 chart.data.labels.push(time);
//                 chart.data.datasets[0].data.push(voltage1);
//                 chart.data.datasets[1].data.push(voltage2);
//                 chart.data.datasets[2].data.push(voltage3);
//             });
//             chart.update();
//         })
//         .catch(error => console.error(error));
// }

// // Panggil fungsi fetchData saat halaman dimuat
// document.addEventListener('DOMContentLoaded', fetchData);
