<style>
    .chart-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .chart-content {
        position: relative;
        display: block;
        width: 194px;
        height: 194px;
    }

    .chart-content canvas {
        display: block;
        max-width: 100%;
        max-height: 100%;
        border-radius: 50%;
        z-index: 2;
    }

    .chart-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 58, 41, .25);
        border-radius: 50%;
        z-index: 1;
        pointer-events: none;
    }

    .chart-percentage {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 32px;
        font-weight: bold;
        color: white;
        z-index: 5;
    }

    .chart-circle-colored {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 86px;
        height: 86px;
        border-radius: 50%;
        background-color: red;
        z-index: 4;
    }

    .chart-circle-white {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 165px;
        height: 165px;
        border-radius: 50%;
        background-color: white;
        z-index: 3;
    }
</style>

<div class="row">
    <div class="chart-container">
        <div class="chart-content">
            <canvas id="myChart2"></canvas>
            <div class="chart-background"></div>
            <div class="chart-circle-white"></div>
            <div class="chart-circle-colored"></div>
            <div class="chart-percentage">65%</div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous" async></script>


<script>
    var ctx1 = document.getElementById('myChart2').getContext('2d');
    var data1 = [50, 50];
    var colors1 = ['rgba(255, 58, 41, 1)', 'rgba(0, 0, 0, 0)'];
    var cutout1 = '85%';
    var myChart1 = new Chart(ctx1, {
        type: 'doughnut',
        data: {
            labels: ['Verifikasi', 'kosong'],
            datasets: [{
                label: 'Total',
                data: data1,
                backgroundColor: colors1,
                cutout: cutout1,
                borderRadius: 50,
                borderWidth: 0,
                hoverOffset: 0
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            layout: {
                padding: 0
            },
            plugins: {
                legend: false
            }
        }
    });
</script>