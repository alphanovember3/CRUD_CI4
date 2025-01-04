<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   
    <style>
        body { 
            background-color: #000; 
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
        .chart-container { 
            position: relative; 
        }
        .card {
            background-color: #18181b;
            border-radius: 1rem;
        }
        .progress-bar {
            height: 0.3rem;
            border-radius: 1rem;
            background-color: #27272a;
        }
        .progress-fill {
            height: 100%;
            border-radius: 1rem;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }
        .modal-content {
            background-color: #18181b;
            border-radius: 1rem;
            max-width: 500px;
            margin: 2rem auto;
            padding: 2rem;
            position: relative;
        }
        @media (max-width: 1024px) {
            .grid-cols-3 {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 768px) {
            .grid-cols-3 {
                grid-template-columns: 1fr;
            }
            .col-span-2 {
                grid-column: span 1;
            }
        }
        .btn-primary {
            background-color: #3b82f6;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: background-color 0.2s;
        }
        .btn-primary:hover {
            background-color: #2563eb;
        }
        .form-input {
            width: 100%;
            background-color: #27272a;
            border: 1px solid #374151;
            color: white;
            padding: 0.5rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }
        .form-label {
            color: #9ca3af;
            margin-bottom: 0.5rem;
            display: block;
        }
    </style>
</head>
<body class="p-4 md:p-8 bg-black text-white">
    <!-- Add Data Button -->
    <!-- Navbar -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark " style="gap:18px">
	<a class="navbar-brand" href="/" style="color:aqua; margin-right:10px">Dashboard</a>
	<a class="navbar-brand" href="/" style="color:aqua; margin-right:10px">Admin</a>
	<a class="navbar-brand" href="/campaign" style="color:aqua; margin-right:10px">Campaign</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		<div class="navbar-nav">
			<a class="nav-item nav-link active" href="/">Admin </a>
			<a class="nav-item nav-link active" href="/campaign">Campaign </a>
		

		</div>		
<!-- input  -->

<form class="form" action="<?php echo site_url('uploadfile')?>" method="post" enctype="multipart/form-data">
<div class="mb-1 form-group myclass-defined">
	

	<a class="btn-danger" href="/logout" role="button" >Logout</a>

</div> 


<div class="mb-3 form-group myclass-defined">
	
</div>

</form>
</div>
	</div>
</nav>

    <!-- Modal Form -->
    <div id="dataModal" class="modal">
        <div class="modal-content">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold">Add Dashboard Data</h2>
                <button onclick="closeModal()" class="text-gray-400 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="dashboardForm" onsubmit="handleFormSubmit(event)">
                <!-- Expenses Section -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium mb-4">Expenses & Income</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="form-label">calling</label>
                            <input type="number" name="income" class="form-input" required>
                        </div>
                        <div>
                            <label class="form-label"> </label>
                            <input type="number" name="expenses" class="form-input" required>
                        </div>
                    </div>
                </div>

                <!-- Health Stats -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium mb-4">Health Statistics</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="form-label"></label>
                            <input type="number" name="calories" class="form-input" required>
                        </div>
                        <div>
                            <label class="form-label">Steps</label>
                            <input type="number" name="steps" class="form-input" required>
                        </div>
                        <div>
                            <label class="form-label">Exercise (minutes)</label>
                            <input type="number" name="exercise" class="form-input" required>
                        </div>
                    </div>
                </div>

                <!-- Savings Goals -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium mb-4">Savings Update</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="form-label">House Saving</label>
                            <input type="number" name="houseSaving" class="form-input" required>
                        </div>
                        <div>
                            <label class="form-label">Laptop Saving</label>
                            <input type="number" name="laptopSaving" class="form-input" required>
                        </div>
                        <div>
                            <label class="form-label">Trip Saving</label>
                            <input type="number" name="tripSaving" class="form-input" required>
                        </div>
                        <div>
                            <label class="form-label">Scooter Saving</label>
                            <input type="number" name="scooterSaving" class="form-input" required>
                        </div>
                    </div>
                </div>

                <!-- Statistics -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium mb-4">Website Statistics</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="form-label">Monthly Visitors</label>
                            <input type="number" name="visitors" class="form-input" required>
                        </div>
                        <div>
                            <label class="form-label">Page Views</label>
                            <input type="number" name="pageViews" class="form-input" required>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-primary w-full">
                    <i class="fas fa-save mr-2"></i>Save Data
                </button>
            </form>
        </div>
    </div>

    <!-- Dashboard Grid -->
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Monthly Expenses Chart -->
        <div class="card p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-gray-400 text-sm font-medium">Monthly Call Logs</h2>
                <div class="flex items-center gap-2">
                    <span class="text-gray-400 text-xs">Mar 1, 2023 - Jul 31, 2024</span>
                    <button class="text-gray-400">
                        <i class="fas fa-ellipsis"></i>
                    </button>
                </div>
            </div>
            <div class="mb-6">
                <h3 class="text-4xl font-semibold">10000<span class="text-sm text-gray-400 ml-1">calls</span></h3>
            </div>
            <div style="height: 120px;">
                <canvas id="expensesChart"></canvas>
            </div>
        </div>

        <!-- Calories Widget -->
        <div class="card p-6">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h2 class="text-sm font-medium mb-1">
                        <i class="fas fa-fire-flame-curved text-orange-500 mr-2"></i>Calories
                    </h2>
                    <div class="text-2xl font-semibold calories-value">1,623/2,000 kcal</div>

                </div>
                <button class="text-gray-400">
                    <i class="fas fa-ellipsis"></i>
                </button>
            </div>
            <div class="space-y-4 mb-6">
                <div>
                    <h3 class="text-sm font-medium mb-1">
                        <i class="fas fa-shoe-prints text-blue-500 mr-2"></i>Steps
                    </h3>
                    <div class="text-2xl font-semibold">8,328/10,000</div>
                </div>
                <div>
                    <h3 class="text-sm font-medium mb-1">
                        <i class="fas fa-dumbbell text-purple-500 mr-2"></i>Exercise
                    </h3>
                    <div class="text-2xl font-semibold">25/120min</div>
                </div>
            </div>
            <div class="flex justify-center" style="height: 160px;">
                <canvas id="caloriesChart"></canvas>
            </div>
        </div>

        <!-- Saving Goals Grid -->
        <div class="grid grid-cols-2 gap-4">
            <!-- House Saving -->
            <div class="card p-4">
                <div class="flex justify-between items-center mb-4">
                    <div class="flex items-center gap-2">
                        <span class="text-yellow-500"></span>
                        <h3 class="text-sm font-medium">Transfer calls</h3>
                    </div>
                    <button class="text-gray-400">•••</button>
                </div>
                <div id="houseProgress">
    <div class="text-xs text-gray-400 mb-2 progress-amount">$45,300 of $150,000</div>
    <div class="progress-bar">
        <div class="progress-fill bg-yellow-500" style="width: 30%"></div>
    </div>
</div>
            </div>

            <!-- Laptop -->
            <div class="card p-4">
                <div class="flex justify-between items-center mb-4">
                    <div class="flex items-center gap-2">
                        <span class="text-purple-500"></span>
                        <h3 class="text-sm font-medium">IVR calls</h3>
                    </div>
                    <button class="text-gray-400">•••</button>
                </div>
                <div class="text-xs text-gray-400 mb-2">$300 of $1,150</div>
                <div class="progress-bar">
                    <div class="progress-fill bg-purple-500" style="width: 26%"></div>
                </div>
            </div>

            <!-- Trip Saving -->
            <div class="card p-4">
                <div class="flex justify-between items-center mb-4">
                    <div class="flex items-center gap-2">
                        <span class="text-gray-100"></span>
                        <h3 class="text-sm font-medium">Recieved Calls</h3>
                    </div>
                    <button class="text-gray-400">•••</button>
                </div>
                <div class="text-xs text-gray-400 mb-2">$5,300 of $15,000</div>
                <div class="progress-bar">
                    <div class="progress-fill bg-gray-100" style="width: 35%"></div>
                </div>
            </div>

            <!-- Scooter Saving -->
            <div class="card p-4">
                <div class="flex justify-between items-center mb-4">
                    <div class="flex items-center gap-2">
                        <span class="text-blue-500"></span>
                        <h3 class="text-sm font-medium">Total calls</h3>
                    </div>
                    <button class="text-gray-400">•••</button>
                </div>
                <div class="text-xs text-gray-400 mb-2">$150 of $350</div>
                <div class="progress-bar">
                    <div class="progress-fill bg-blue-500" style="width: 43%"></div>
                </div>
            </div>
        </div>

        <!-- Monthly Expenses Bar Chart -->
        <div class="card p-6 col-span-2">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-sm font-medium">Monthly Expenses</h2>
                <div class="flex items-center gap-2">
                    <span class="text-gray-400 text-xs">Per Day</span>
                    <button class="text-gray-400">•••</button>
                </div>
            </div>
            <div class="text-4xl font-semibold mb-6">$5,420<span class="text-sm text-gray-400 ml-1">avg.</span></div>
            <div style="height: 200px;">
                <canvas id="dailyExpensesChart"></canvas>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="card p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-sm font-medium">Monthly Visitors</h2>
                <button class="text-gray-400">•••</button>
            </div>
            <div class="text-4xl font-semibold mb-2">56,404</div>
            <div class="text-green-500 text-sm mb-4">↗ 13.3% vs last month</div>
            <div style="height: 100px;">
                <canvas id="visitorsChart"></canvas>
            </div>
        </div>

        <div class="card p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-sm font-medium">Page Views</h2>
                <button class="text-gray-400">•••</button>
            </div>
            <div class="text-4xl font-semibold text-purple-500 mb-2">308,874</div>
            <div class="text-green-500 text-sm mb-4">↗ 3.3% vs last month</div>
            <div style="height: 100px;">
                <canvas id="pageViewsChart"></canvas>
            </div>
        </div>

        <!-- Bottom Stats -->
        <div class="card p-6">
            <h2 class="text-gray-400 text-sm mb-2">Total Revenue</h2>
            <div class="text-3xl font-semibold">$228,441</div>
            <div class="text-green-500 text-sm">↗ 3.3%</div>
        </div>

        <div class="card p-6">
            <h2 class="text-gray-400 text-sm mb-2">Total Expenses</h2>
            <div class="text-3xl font-semibold">$71,887</div>
            <div class="text-yellow-500 text-sm">→ 0.0%</div>
        </div>

        <div class="card p-6">
            <h2 class="text-gray-400 text-sm mb-2">Total Profit</h2>
            <div class="text-3xl font-semibold">$156,554</div>
            <div class="text-red-500 text-sm">↘ 3.3%</div>
        </div>
    </div>

    <script>
      // Initialize all charts globally so we can access them later
let expensesChart, caloriesChart, dailyExpensesChart, visitorsChart, pageViewsChart;

// Function to initialize all charts
function initializeCharts() {
    const darkMode = {
        backgroundColor: '#18181b',
        gridColor: '#27272a',
        textColor: '#9ca3af'
    };

    // Monthly Expenses Chart
    expensesChart = new Chart(document.getElementById('expensesChart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [{
                label: 'Income',
                data: [5200, 5400, 5300, 5500, 5200, 5600, 5300],
                borderColor: '#3b82f6',
                tension: 0.4,
                borderWidth: 2,
                fill: false
            }, {
                label: 'Expenses',
                data: [5000, 5300, 5100, 5200, 5400, 5300, 5100],
                borderColor: '#a855f7',
                tension: 0.4,
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        color: darkMode.textColor,
                        usePointStyle: true,
                        padding: 20
                    }
                }
            },
            scales: {
                y: { display: false },
                x: { display: false }
            }
        }
    });

    // Calories Doughnut Chart
    caloriesChart = new Chart(document.getElementById('caloriesChart'), {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [1623, 377],
                backgroundColor: ['#3b82f6', '#27272a'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '85%',
            plugins: { legend: { display: false } }
        }
    });

    // Daily Expenses Bar Chart
    dailyExpensesChart = new Chart(document.getElementById('dailyExpensesChart'), {
        type: 'bar',
        data: {
            labels: Array(12).fill(''),
            datasets: [{
                data: [5400, 5200, 4800, 5600, 5300, 4900, 4700, 5500, 5100, 4800, 5200, 4900],
                backgroundColor: '#fff',
                barThickness: 8
            }, {
                label: 'Previous',
                data: [5200, 5000, 4600, 5400, 5100, 4700, 4500, 5300, 4900, 4600, 5000, 4700],
                backgroundColor: '#27272a',
                barThickness: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { display: false },
                x: { display: false }
            }
        }
    });

    // Visitors Line Chart
    visitorsChart = new Chart(document.getElementById('visitorsChart'), {
        type: 'line',
        data: {
            labels: Array(10).fill(''),
            datasets: [{
                data: [40000, 42000, 45000, 48000, 50000, 52000, 54000, 56000, 55000, 56404],
                borderColor: '#fff',
                tension: 0.4,
                borderWidth: 2,
                fill: {
                    target: 'origin',
                    above: 'rgba(255, 255, 255, 0.1)'
                }
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { display: false },
                x: { display: false }
            }
        }
    });

    // Page Views Line Chart
    pageViewsChart = new Chart(document.getElementById('pageViewsChart'), {
        type: 'line',
        data: {
            labels: Array(10).fill(''),
            datasets: [{
                data: [280000, 285000, 290000, 295000, 298000, 300000, 303000, 305000, 307000, 308874],
                borderColor: '#a855f7',
                tension: 0.4,
                borderWidth: 2,
                fill: {
                    target: 'origin',
                    above: 'rgba(168, 85, 247, 0.1)'
                }
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { display: false },
                x: { display: false }
            }
        }
    });
}

// Modal functions
function openModal() {
    document.getElementById('dataModal').style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('dataModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Handle form submission
function handleFormSubmit(event) {
    event.preventDefault();
    const formData = new FormData(event.target);
    
    // Update expenses chart with new income and expenses
    const income = parseFloat(formData.get('income'));
    const expenses = parseFloat(formData.get('expenses'));
    
    expensesChart.data.datasets[0].data.shift();
    expensesChart.data.datasets[0].data.push(income);
    expensesChart.data.datasets[1].data.shift();
    expensesChart.data.datasets[1].data.push(expenses);
    expensesChart.update();

    // Update calories chart
    const calories = parseFloat(formData.get('calories'));
    const remainingCalories = 2000 - calories;
    caloriesChart.data.datasets[0].data = [calories, remainingCalories];
    caloriesChart.update();

    // Update health stats display
    document.querySelector('.calories-value').textContent = `${calories}/2000 kcal`;
    document.querySelector('.steps-value').textContent = `${formData.get('steps')}/10,000`;
    document.querySelector('.exercise-value').textContent = `${formData.get('exercise')}/120min`;

    // Update savings progress bars
    updateSavingProgress('house', formData.get('houseSaving'), 150000);
    updateSavingProgress('laptop', formData.get('laptopSaving'), 1150);
    updateSavingProgress('trip', formData.get('tripSaving'), 15000);
    updateSavingProgress('scooter', formData.get('scooterSaving'), 350);

    // Update visitors and page views
    const visitors = parseFloat(formData.get('visitors'));
    const pageViews = parseFloat(formData.get('pageViews'));
    
    visitorsChart.data.datasets[0].data.shift();
    visitorsChart.data.datasets[0].data.push(visitors);
    visitorsChart.update();
    
    pageViewsChart.data.datasets[0].data.shift();
    pageViewsChart.data.datasets[0].data.push(pageViews);
    pageViewsChart.update();

    // Close modal after submission
    closeModal();
    event.target.reset();
}

// Update saving progress bars
function updateSavingProgress(type, current, total) {
    const percentage = (current / total) * 100;
    const progressBar = document.querySelector(`#${type}Progress .progress-fill`);
    const amountText = document.querySelector(`#${type}Progress .progress-amount`);
    
    progressBar.style.width = `${percentage}%`;
    amountText.textContent = `$${current.toLocaleString()} of $${total.toLocaleString()}`;
}

// Initialize everything when the page loads
document.addEventListener('DOMContentLoaded', () => {
    initializeCharts();
    
    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('dataModal');
        if (event.target === modal) {
            closeModal();
        }
    }
});
        const darkMode = {
            backgroundColor: '#18181b',
            gridColor: '#27272a',
            textColor: '#9ca3af'
        };

        // Monthly Expenses Chart
        new Chart(document.getElementById('expensesChart'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                datasets: [{
                    label: 'Income',
                    data: [5200, 5400, 5300, 5500, 5200, 5600, 5300],
                    borderColor: '#3b82f6',
                    tension: 0.4,
                    borderWidth: 2,
                    fill: false
                }, {
                    label: 'Expenses',
                    data: [5000, 5300, 5100, 5200, 5400, 5300, 5100],
                    borderColor: '#a855f7',
                    tension: 0.4,
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            color: darkMode.textColor,
                            usePointStyle: true,
                            padding: 20
                        }
                    }
                },
                scales: {
                    y: { display: false },
                    x: { display: false }
                }
            }
        });

        // Calories Doughnut Chart
        new Chart(document.getElementById('caloriesChart'), {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [1623, 377],
                    backgroundColor: ['#3b82f6', '#27272a'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '85%',
                plugins: { legend: { display: false } }
            }
        });

        // Daily Expenses Bar Chart
        new Chart(document.getElementById('dailyExpensesChart'), {
            type: 'bar',
            data: {
                labels: Array(12).fill(''),
                datasets: [{
                    data: [5400, 5200, 4800, 5600, 5300, 4900, 4700, 5500, 5100, 4800, 5200, 4900],
                    backgroundColor: '#fff',
                    barThickness: 8
                }, {
                    data: [5200, 5000, 4600, 5400, 5100, 4700, 4500, 5300, 4900, 4600, 5000, 4700],
                    backgroundColor: '#27272a',
                    barThickness: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { display: false },
                    x: { display: false }
                }
            }
        });

        // Visitors Line Chart
        new Chart(document.getElementById('visitorsChart'), {
            type: 'line',
            data: {
                labels: Array(10).fill(''),
                datasets: [{
                    data: [40000, 42000, 45000, 48000, 50000, 52000, 54000, 56000, 55000, 56404],
                    borderColor: '#fff',
                    tension: 0.4,
                    borderWidth: 2,
                    fill: {
                        target: 'origin',
                        above: 'rgba(255, 255, 255, 0.1)'
                    }
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { display: false },
                    x: { display: false }
                }
            }
        });

        // Page Views Line Chart
        new Chart(document.getElementById('pageViewsChart'), {
            type: 'line',
            data: {
                labels: Array(10).fill(''),
                datasets: [{
                    data: [280000, 285000, 290000, 295000, 298000, 300000, 303000, 305000, 307000, 308874],
                    borderColor: '#a855f7',
                    tension: 0.4,
                    borderWidth: 2,
                    fill: {
                        target: 'origin',
                        above: 'rgba(168, 85, 247, 0.1)'
                    }
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { display: false },
                    x: { display: false }
                }
            }
        });
    </script>
</body>
</html>