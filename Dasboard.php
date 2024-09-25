<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="Dasboard.css"> <!-- Gaya CSS untuk dashboard -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js -->
</head>
<body>
    <div class="sidebar">
        <h2>Admin</h2>
        <ul>
            <li><a href="Dasboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="inventory.php"><i class="fas fa-chalkboard-teacher"></i> Inventory</a></li>
            <li><a href="storage.php"><i class="fas fa-building"></i> Storage</a></li>
            <li><a href="vendor.php"><i class="fas fa-user-graduate"></i> Vendor</a></li>
            <li><a href="logout.php"><i class="fas fa-user-graduate"></i> Logout</a></li>
            

          
        </ul>
    </div>
    <div class="main-content">
        <header>
           <center> <h1>Welcome to the Dashboard</h1></center>
        </header>
       

    <script>
    // Chart.js setup
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June'],
            datasets: [{
                label: 'Number of Logins',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
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
    });
    </script>
</body>
</html>
