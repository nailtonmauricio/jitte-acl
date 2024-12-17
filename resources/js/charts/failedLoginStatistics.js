import { Chart, registerables } from 'chart.js';
Chart.register(...registerables);

document.addEventListener('DOMContentLoaded', function () {
    //const ctxArea = document.getElementById('myAreaChart').getContext('2d');
    //const ctxBar = document.getElementById('myBarChart').getContext('2d');

    /*const myAreaChart = new Chart(ctxArea, {
        type: 'line', // ou 'area' dependendo da versão do Chart.js que você está usando
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June'],
            datasets: [{
                label: 'Dataset 1',
                data: [10, 20, 30, 40, 50, 60],
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Chart.js Line Chart'
                }
            }
        }
    });*/

    /*const myBarChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June'],
            datasets: [{
                label: 'Dataset 1',
                data: [10, 20, 30, 40, 50, 60],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });*/


});
