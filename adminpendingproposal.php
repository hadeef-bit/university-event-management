<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Event Management</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    position: relative;
    min-height: 100vh;
}

body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('uniten.jpg') no-repeat center center fixed;
    background-size: cover;
    opacity: 0.5; /* Adjust this value for lighter/darker overlay */
    z-index: -2;
}

body::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); /* Adjust this value for lighter/darker overlay */
    z-index: -1;
}

.header, .main-nav, .form-box {
    position: relative;
    z-index: 1;
}
        .header {
            background-color: #2c3670;
            color: white;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header-content {
            display: flex;
            align-items: center;
        }
        .header img {
            height: 70px;
            margin-right: 20px;
        }
        .nav-bar {
            background-color: #c9a4db;
            color: white;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .nav-items {
            display: flex;
            align-items: center;
            margin-left: auto; /* This shifts the navigation items to the right */
        }
        .nav-item {
            margin-right: 10px;
        }
        .button {
            background-color: transparent;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
        }
        .button a {
            text-decoration: none;
            color: white;
        }
        .button:hover {
            color: #ccc;
        }
        .logout-button {
            background-color: #ff3465;
            color: white;
        }
        .logout-button:hover {
            background-color: #ff3465;
        }
    .nav-item {
        margin: 0 1rem;
    }
    .event-description {
        padding: 2rem;
    }
    .event-title {
        font-size: 2rem;
        margin-bottom: 1rem;
    }
    .event-date {
        font-size: 1.2rem;
        margin-bottom: 1rem;
    }
    .event-description-text {
        line-height: 1.5;
    }
    .nav-button {
        background-color: transparent;
        border: none;
        padding: 0;
        margin: 0;
        cursor: pointer;
        display: flex;
        align-items: center;
    }
    .nav-button a {
        text-decoration: none;
        color: #333;
        padding: 0 1rem;
    }
    .nav-button:hover a {
        color: #e6f5d0;
    }
    .nav-button:hover {
        background-color: #ddd;
    }
    .pending {
        background-color: #3e973b;
        color: white;
    }
    .approve-button, .reject-button {
        padding: 0.5rem 1rem;
        border: none;
        cursor: pointer;
        margin: 0.5rem;
    }
    .approve-button {
        background-color: #4CAF50;
        color: white;
    }
    .reject-button {
        background-color: #f44336;
        color: white;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: white; /* Set background color of the table */
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
</style>
    <script>
        function updateStatus(proposalID, newStatus, score = '', reason = '') {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "adminpendingproposal.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        alert(response.message);
                        document.getElementById(`status-${proposalID}`).innerText = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
                        if (newStatus === 'rejected') {
                            document.getElementById(`reason-${proposalID}`).innerText = reason;
                        }
                    } else {
                        alert(response.message);
                    }
                }
            };
            xhr.send(`proposalID=${proposalID}&status=${newStatus}&score=${encodeURIComponent(score)}&reason=${encodeURIComponent(reason)}`);
        }

        function updateApprove(proposalID) {
            const score = prompt("Please enter the Scorun worth:");
            if (score !== null) {
                updateStatus(proposalID, 'approved', score);
            }
        }

        function updateReject(proposalID) {
            const reason = prompt("Please enter the reason for rejection:");
            if (reason !== null) {
                updateStatus(proposalID, 'rejected', '', reason);
            }
        }
    </script>
</head>
<body>
<header class="header">
    <div class="header-content">
        <img src="unitenlogo.png" alt="UNIVERSITI TENAGA NASIONAL logo">
        <h1>University Event Management System</h1>
    </div>
    <div class="nav-item">
        <button class="button"><a href="adminhomepage.php">Homepage</a></button>
    </div>
    <div class="nav-item">
        <button class="button"><a href="adminpendingproposal.php">Pending Proposal</a></button>
    </div>
    <div class="nav-item">
        <button class="button"><a href="adminapproved.php">Approved Proposal</a></button>
    </div>
    <div class="nav-item">
        <button class="button"><a href="adminrejected.php">Rejected Proposal</a></button>
    </div>
    <div class="nav-item">
        <button class="button"><a href="admincontactus.html">Contact Us</a></button>
    </div>
    <div class="nav-item">
        <button class="button"><a href="users.php">Users</a></button>
    </div>
    <div class="nav-item">
            <button class="button logout-button" onclick="location.href='page1.html'">Logout</button>
        </div>
    </header>

<div class="event-description">
    <table>
        <tr>
            <th>ProposalID</th>
            <th>UserID</th>
            <th>Venue</th>
            <th>Date</th>
            <th>Time</th>
            <th>Title</th>
            <th>Description</th>
            <th>Image</th>
            <th>College</th>
            <th>Name</th>
            <th>Capacity</th>
            <th>Status</th>
            <th>Reason</th>
            <th>Scorun</th> <!-- Added Scorun column -->
            <th>Action</th>
        </tr>
        <?php
        // Sample database connection (replace this with your actual connection code)
        $con = mysqli_connect("localhost", "root", "", "eventuser") or die("Cannot connect to server: " . mysqli_error($con));

        // Check the connection
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Handle POST request for updating status
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $proposalID = $_POST['proposalID'];
            $status = $_POST['status'];
            $reason = isset($_POST['reason']) ? $_POST['reason'] : '';
            $score = isset($_POST['score']) ? $_POST['score'] : '';

            // Update the proposal status, reason, and score in the database
            $updateQuery = "UPDATE proposal SET Status='$status', Reason='$reason', Scorun='$score' WHERE proposalID='$proposalID'";
            if (mysqli_query($con, $updateQuery)) {
                echo json_encode(['success' => true, 'message' => 'Status updated successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error updating record: ' . mysqli_error($con)]);
            }
            mysqli_close($con);
            exit;
        }

        // Fetch pending proposals
        $query = "SELECT * FROM proposal WHERE Status='pending'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['proposalID']) . "</td>";
                echo "<td>" . htmlspecialchars($row['UserID']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Venue']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Date']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Time']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Title']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Description']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Image']) . "</td>";
                echo "<td>" . htmlspecialchars($row['College']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Capacity']) . "</td>";
                echo "<td id='status-" . $row['proposalID'] . "'>" . htmlspecialchars($row['Status']) . "</td>";
                echo "<td id='reason-" . $row['proposalID'] . "'>" . htmlspecialchars($row['Reason']) . "</td>";
                echo "<td id='scorun-" . $row['proposalID'] . "'>" . htmlspecialchars($row['Scorun']) . "</td>"; // Display Scorun
                echo "<td>";
                echo "<button class='approve-button' onclick=\"updateApprove(" . $row['proposalID'] . ")\">Approve</button>";
                echo "<button class='reject-button' onclick=\"updateReject(" . $row['proposalID'] . ")\">Reject</button>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='15'>No proposals found.</td></tr>";
        }

        // Close the connection
        mysqli_close($con);
        ?>
    </table>
</div>

</body>
</html>