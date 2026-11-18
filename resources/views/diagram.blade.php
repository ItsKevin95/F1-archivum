<x-mainpage title="Diagram">
    <div class="container section">
        <h1>Diagramok</h1>
        <p class="muted">Az adatbázis adatai alapján készült diagramok (Chart.js).</p>

        <div class="chart-grid">
            <div class="chart-card chart-wide">
                <h2>A 10 legtöbb futamgyőzelmet szerző pilóta (1950–1960)</h2>
                <div class="chart-box"><canvas id="gyoztesChart"></canvas></div>
            </div>
            <div class="chart-card">
                <h2>Nagydíjak száma évenként</h2>
                <div class="chart-box"><canvas id="evenkentChart"></canvas></div>
            </div>
            <div class="chart-card">
                <h2>Kiesések leggyakoribb okai (1950–1960)</h2>
                <div class="chart-box"><canvas id="hibakChart"></canvas></div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
        <script>
            const adat = @json($diagramok);
            const szinek = ['#e10600', '#111827', '#f59e0b', '#2563eb', '#16a34a', '#9333ea', '#0891b2', '#db2777'];

            new Chart(document.getElementById('gyoztesChart'), {
                type: 'bar',
                data: {
                    labels: adat.gyoztesek.cimkek,
                    datasets: [{ label: 'Győzelmek', data: adat.gyoztesek.ertekek, backgroundColor: '#e10600' }]
                },
                options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
            });

            new Chart(document.getElementById('evenkentChart'), {
                type: 'line',
                data: {
                    labels: adat.evenkent.cimkek,
                    datasets: [{ label: 'Nagydíjak', data: adat.evenkent.ertekek, borderColor: '#111827', backgroundColor: '#111827', tension: 0.25 }]
                },
                options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
            });

            new Chart(document.getElementById('hibakChart'), {
                type: 'doughnut',
                data: {
                    labels: adat.hibak.cimkek,
                    datasets: [{ data: adat.hibak.ertekek, backgroundColor: szinek }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });
        </script>
    @endpush
</x-mainpage>
