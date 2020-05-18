/**
 * URL to fetch data for borne 4
 */
const API_URL = '/api/v1/bornes/4?interval=';

var config = {
    type: 'line',
    data: {
        labels: [],
        datasets: [
            {
                label: 'Borne 4',
                data: [],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                fill: false,
            },
        ],
    },
    options: {
        responsive: true,
        title: {
            display: true,
            text: 'Puissance des bornes à travers le temps',
        },
        scales: {
            xAxes: [
                {
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Time',
                    },
                    ticks: {
                        major: {
                            fontStyle: 'bold',
                            fontColor: '#FF0000',
                        },
                    },
                },
            ],
            yAxes: [
                {
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Puissance en kW',
                    },
                    ticks: {
                        beginAtZero: true,
                    },
                },
            ],
        },
    },
};

/**
 * Initialize the chart and add listener for selecting intervals
 */
window.addEventListener('DOMContentLoaded', async (event) => {
    /** fetch initial data */
    let initialData = await getBornesData(`${API_URL}900`);
    config.data.labels = initialData.timestamps;
    config.data.datasets[0].data = initialData.powerValues;

    /** initialize chart */
    var ctx = document.getElementById('myChart');
    window.bornesChart = new Chart(ctx, config);

    const intervalSelectElement = document.getElementById('intervalSelect');
    intervalSelectElement.addEventListener('change', updateChart);
});

/**
 * Updates the config with the power values for the selected interval and updates the chart
 * @param {*} event
 */
async function updateChart(event) {
    event.preventDefault();
    const URL = API_URL + event.target.value;

    let data = await getBornesData(URL);
    config.data.labels = data.timestamps;
    config.data.datasets[0].data = data.powerValues;

    window.bornesChart.update(config);
}

/**
 * Makes an API call to fetch the power values for the selected interval
 * @param {*} url
 */
async function getBornesData(url) {
    let bornesData = {
        timestamps: [],
        powerValues: [],
    };

    await fetch(url)
        .then((response) => response.json())
        .then((data) =>
            data.forEach((bornes) => {
                let dateTimeValue = `${bornes.date} ${bornes.time}`;
                bornesData.timestamps.push(dateTimeValue);
                bornesData.powerValues.push(bornes.power.toFixed(2));
            })
        )
        .catch((error) => console.error(error));

    return bornesData;
}
