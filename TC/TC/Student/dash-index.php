<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Educational Dashboard</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="profile-section">
                <img src="profile.jpg" alt="Profile Picture">
                <h3>Onky</h3>
                <p>Available for work</p>
            </div>
            <nav>
                <ul>
                    <li><a href="#">Master</a></li>
                    <li><a href="#">Lecturer</a></li>
                    <li><a href="#">Student</a></li>
                    <li><a href="#">Academic</a></li>
                    <li><a href="#">Presence</a></li>
                    <li><a href="#">Settings</a></li>
                    <li><a href="#">Feedback</a></li>
                    <li><a href="#">Helpdesk</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header>
                <h1>Dashboard</h1>
            </header>

            <section class="financial-overview">
                <div class="card">
                    <h2>Total Revenue</h2>
                    <p>$23,000.00</p>
                    <span class="percentage positive">+7.25%</span>
                </div>
                <div class="card">
                    <h2>Total Expenses</h2>
                    <p>$42,560.00</p>
                    <span class="percentage negative">-2.16%</span>
                </div>
            </section>

            <section class="enrollment-overview">
                <div class="statistics">
                    <h2>Enrolled Students</h2>
                    <div class="bar-chart">
                        <div class="bar" style="height: 32%;">32%</div>
                    </div>
                    <ul>
                        <li>Total Students: 4,120</li>
                        <li>Faculty: 5</li>
                        <li>Study Programs: 12</li>
                    </ul>
                </div>
            </section>

            <section class="live-class-tracker">
                <h2>Live Class Tracker</h2>
                <div class="assignment">
                    <h3>Mathematics Assignment</h3>
                    <p>Solve problems 1-10</p>
                    <span>Due June 5th, 2023</span>
                </div>
                <div class="assignment">
                    <h3>Computer Architecture</h3>
                    <p>CA Assignment</p>
                    <span>Due June 5th, 2023</span>
                </div>
                <div class="attendance-rate">
                    <h3>Attendance Rate</h3>
                    <p>87%</p>
                    <span class="percentage positive">+5.25%</span>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
