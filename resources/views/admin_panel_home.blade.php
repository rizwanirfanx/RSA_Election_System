<x-layout>

    <x-admin_dashboard.starting_time_card />
    <div class="w-1/4">
        <canvas id="myChart"></canvas>
    </div>
    <x-slot:script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('myChart');

            const data = {
                labels: [
                    'Red (Unverified Users)',
                    'Blue (Verified Users)',
                ],
                datasets: [{
                    label: 'Verified Users',
                    data: [300, 50],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                    ],
                    hoverOffset: 4
                }]
            };
            const config = {
                type: 'doughnut',
                data: data,
            };
            new Chart(ctx, {
                type: 'doughnut',
                data: data,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

    </x-slot:script>
</x-layout>
