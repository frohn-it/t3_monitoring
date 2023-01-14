import Chart from 'chart.js/auto';

(() => {
    document.querySelectorAll('.graph-container').forEach((element) => {

        let data = {
            labels: JSON.parse(element.dataset.labels),
            datasets: [{
                label: element.dataset.valueLabel,
                backgroundColor: 'rgb(238,238,238)',
                borderColor: 'rgb(238,238,238)',
                data: JSON.parse(element.dataset.values),
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        display: false,
                        beginAtZero: true,
                        grid: {
                            display: false
                        }
                    },
                    x : {
                        display: false,
                        grid: {
                            display: false
                        }
                    }
                },
                legend: {
                    display: false
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            },
        };
        new Chart(
            element,
            config
        );
    })
})();