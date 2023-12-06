@include('admin.layouts.main')

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="bi bi-speedometer"></i> Dashboard</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        </ul>
    </div>

    <div class="row">

        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-user fa-3x"></i>
                <div class="info">
                    <h4>User</h4>
                    <p><b>{{ $usersCount }}</b></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-money fa-3x"></i>
                <div class="info">
                    <h4>Pending</h4>
                    <p><b>{{ $orderPending }}</b></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-money fa-3x"></i>
                <div class="info">
                    <h4>Diterima</h4>
                    <p><b>{{ $orderDiterima }}</b></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="widget-small warning coloured-icon"><i class="icon fa fa-money fa-3x"></i>
                <div class="info">
                    <h4>Diproses</h4>
                    <p><b>{{ $orderDiproses }}</b></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-list-alt fa-3x"></i>
                <div class="info">
                    <h4>Kategori</h4>
                    <p><b>{{ $categoriesCount }}</b></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-coffee fa-3x"></i>
                <div class="info">
                    <h4>Menu</h4>
                    <p><b>{{ $menusCount }}</b></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="widget-small warning coloured-icon"><i class="icon fa fa-credit-card fa-3x"></i>
                <div class="info">
                    <h4>Rekening</h4>
                    <p><b>{{ $metodePembayaranCount }}</b></p>
                </div>
            </div>
        </div>


        <div class="col-md-6 col-lg-3">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-square fa-3x"></i>
                <div class="info">
                    <h4>Stok</h4>
                    <p><b>{{ $stocksCount }}</b></p>
                </div>
            </div>
        </div>



    </div>


    <div class="row">
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Weekly Sales - Last week</h3>
                <div class="ratio ratio-16x9">
                    <div id="salesChart"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Transaction</h3>
                <div class="ratio ratio-16x9">
                    <div id="supportRequestChart"></div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Page specific javascripts-->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>
<script type="text/javascript">
    const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    const salesDataPHP = @json($salesData);
    const salesData = {
        xAxis: {
            type: 'category',
            data: days
        },
        yAxis: {
            type: 'value',
            axisLabel: {
                formatter: 'Rp. {value}'
            }
        },
        series: [{
            data: days.map(day => salesDataPHP[day] ?? 0),
            type: 'line',
            smooth: true
        }],
        tooltip: {
            trigger: 'axis',
            formatter: function(params) {
                return "<b>" + params[0].name + ":</b> " + new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }).format(params[0].value);
            }
        }


    };

    const supportRequests = {
        tooltip: {
            trigger: 'item'
        },
        legend: {
            orient: 'vertical',
            left: 'left'
        },
        series: [{
            name: 'Transaction',
            type: 'pie',
            radius: '50%',
            data: [{
                    value: {{ $orderPending }},
                    name: 'Pending'
                },
                {
                    value: {{ $orderDiterima }},
                    name: 'Diterima'
                },
                {
                    value: {{ $orderDiproses }},
                    name: 'Diproses'
                }
            ],
            emphasis: {
                itemStyle: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
        }]
    };

    const salesChartElement = document.getElementById('salesChart');
    const salesChart = echarts.init(salesChartElement, null, {
        renderer: 'svg'
    });
    salesChart.setOption(salesData);
    new ResizeObserver(() => salesChart.resize()).observe(salesChartElement);

    const supportChartElement = document.getElementById("supportRequestChart")
    const supportChart = echarts.init(supportChartElement, null, {
        renderer: 'svg'
    });
    supportChart.setOption(supportRequests);
    new ResizeObserver(() => supportChart.resize()).observe(supportChartElement);
</script>

@include('admin.layouts.footer')
