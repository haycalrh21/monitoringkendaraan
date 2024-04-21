<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <p>
                Halaman Admin
            </p>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div id="chart">
                        Grafik pemakaian kendaraan
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        document.addEventListener('alpine:initialized', () => {
            const chart = new ApexCharts(document.querySelector("#chart"), {
                chart: {
                    type: 'line'
                },
                series: [{
                    name: 'pemakaian kendaraan',
                    data: {!! json_encode($dataChart) !!}
                }],
                xaxis: {
                    categories: {!! json_encode(array_values($bulanLabels)) !!}
                },
                markers: {
                    size: 10
                }
            });

            chart.render();
        });
    </script>


</x-app-layout>
