<!-- Main Content -->
<div class="p-4 md:p-8 flex-1 animate-fade-in">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white p-6 rounded-lg shadow-md card-hover transition-transform duration-300">
            <h5 class="text-lg font-semibold text-blue-800">Total Sales</h5>
            <p class="mt-2 text-2xl text-gray-700">$15,000</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md card-hover transition-transform duration-300">
            <h5 class="text-lg font-semibold text-green-800">Products Sold</h5>
            <p class="mt-2 text-2xl text-gray-700">500</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md card-hover transition-transform duration-300">
            <h5 class="text-lg font-semibold text-purple-800">Active Users</h5>
            <p class="mt-2 text-2xl text-gray-700">150</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md card-hover transition-transform duration-300">
            <h5 class="text-lg font-semibold text-red-800">Pending Orders</h5>
            <p class="mt-2 text-2xl text-gray-700">25</p>
        </div>
    </div>

    <!-- Daily Sales Chart -->
    <div class="bg-white p-6 rounded-lg shadow-md card-hover transition-transform duration-300 mb-8">
        <h5 class="text-lg font-semibold text-blue-800">Daily Sales</h5>
        <canvas id="dailySalesChart" class="mt-4 h-32"></canvas>
    </div>

    <!-- Total Income Chart -->
    <div class="bg-white p-6 rounded-lg shadow-md card-hover transition-transform duration-300 mb-8">
        <h5 class="text-lg font-semibold text-blue-800">Total Income</h5>
        <canvas id="totalIncomeChart" class="mt-4 h-32"></canvas>
    </div>

</div>

<?php include('footer.php'); ?>

<script>
    // Daily Sales Chart
    const dailySalesCtx = document.getElementById('dailySalesChart').getContext('2d');
    const dailySalesChart = new Chart(dailySalesCtx, {
        type: 'line',
        data: {
            labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
            datasets: [{
                label: 'Sales',
                data: [120, 190, 300, 500, 200, 300, 450],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Total Income Chart
    const totalIncomeCtx = document.getElementById('totalIncomeChart').getContext('2d');
    const totalIncomeChart = new Chart(totalIncomeCtx, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'Income',
                data: [5000, 10000, 15000, 20000, 25000, 30000, 35000],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>