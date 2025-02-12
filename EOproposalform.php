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
            opacity: 0.5;
            z-index: -2;
        }

        body::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }

        .header, .main-nav, .form-box {
            position: relative;
            z-index: 1;
        }

        .header {
            background-color: #7f3a5f;
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
            margin-left: auto;
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

        .main-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background-color: rgba(210, 242, 255, 0.9);
        }

        .main-nav a {
            color: #333;
            text-decoration: none;
            padding: 0 1rem;
        }

        .home-link {
            background-color: #858585;
            color: white;
            padding: 0.5rem 1rem;
            text-decoration: none;
            border-radius: 5px;
        }

        .nav-button:hover {
            background-color: #ddd;
        }

        .home-button {
            background-color: #8aedff;
            color: white;
        }

        .form-box {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.8);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input[type="input"],
        .form-group select {
            width: 100%;
            padding: 6px 12px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .form-group textarea {
            width: 100%;
            padding: 6px 12px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .form__field:required,
        .form__field:invalid {
            box-shadow: none;
        }
    </style>
</head>
<body>
<header class="header">
    <div class="header-content">
        <img src="unitenlogo.png" alt="UNIVERSITI TENAGA NASIONAL logo">
        <h1>University Event Management System</h1>
    </div>
    <div class="nav-items">
        <div class="nav-item">
            <button class="button"><a href="organizerhomepage.php">Homepage</a></button>
        </div>
        <div class="nav-item">
            <button class="button"><a href="organizeravailableevent.php">Available Events</a></button>
        </div>
        <div class="nav-item">
            <button class="button"><a href="EOproposalform.php">Event Management</a></button>
        </div>
        <div class="nav-item">
            <button class="button"><a href="myevent.php">My Event</a></button>
        </div>
        <div class="nav-item">
            <button class="button"><a href="feedback.php">Student's Feedback</a></button>
        </div>
        <div class="nav-item">
            <button class="button"><a href="eventstatus.php">Event Status</a></button>
        </div>
        <div class="nav-item">
            <button class="button"><a href="organizercontactus.html">Contact Us</a></button>
        </div>
        <div class="nav-item">
            <button class="button logout-button" onclick="location.href='page1.html'">Logout</button>
        </div>
    </div>
</header>
    <div class="form-box">
        <h2>Proposal Form</h2>
        <div class="form-group">
            <form action="proposal.php" method="post" enctype="multipart/form-data">
                <div class="input-container">
                    <label>Organizer Name:</label>
                    <input type="input" name="name" id="name" required>
                </div>
                <div class="input-container">
                    <label>Organizer ID:</label>
                    <input type="input" name="userid" id="userid" required>
                </div>
                <div class="input-container">
                    <label>Title:</label>
                    <input type="input" name="title" required>
                </div>
                <div class="input-container">
                    <label>Event Description:</label>
                    <textarea name="description" class="form__field" id="description" rows="8" cols="110" required></textarea>
                </div>
                <div class="input-container">
                    <label>Uploaded Images Here:</label>
                    <br><br>
                    <label style="margin-left:450px;" class="input-file">
                        <input type="file" name="image" class="form__field" id="image" multiple>
                        <br>
                    </label>
                </div>
                <div class="input-container">
                    <label>Category:</label>
                    <select name="college" class="form__field" id="college" required>
                        <option value="">Select an option</option>
                        <option value="Art & Cultural">Art & Cultural</option>
                        <option value="Communication & Entrepreneurship">Communication & Entrepreneurship</option>
                        <option value="Leadership & Intellectual">Leadership & Intellectual</option>
                        <option value="Spiritual Values & Civilizational">Spiritual Values & Civilizational</option>
                        <option value="Sports & Recreational">Sports & Recreational</option>
                        <option value="Exempted">Exempted</option>
                        <option value="Ethics & Humanity">Ethics & Humanity</option>
                        <option value="Leadership & Communication">Leadership & Communication</option>
                        <option value="Sports & Recreation">Sports & Recreation</option>
                        <option value="Arts & Culture">Arts & Culture</option>
                        <option value="Intellectuality">Intellectuality</option>
                        <option value="Entrepreneurship">Entrepreneurship</option>
                    </select>
                </div>
                <div class="input-container">
                    <label>Capacity:</label>
                    <input type="number" name="capacity" class="form__field" id="capacity" min="1" required>
                </div>
                <div class="input-container">
                <label for="venues">Select A Venue:</label>
                <select type="input" name="venues" class="form__field" id="venues" onchange="showAdditionalFields(this.value)" required>
                    <option value="">Select a venue</option>
                    <option value="Online">Online</option>
                    <option value="Sport Arena">Sport Arena</option>
                    <option value="Library">Library</option>
                    <option value="Dewan Seri Saujana">Dewan Seri Saujana</option>
                    <option value="TA Building">TA Building</option>
                    <option value="BA Building">BA Building</option>
                    <option value="UNITEN Food Court">UNITEN Food Court</option>
                </select>
            </div>
            <!-- Additional fields for Online venue -->
            <div id="onlineFields" style="display: none;">
                <div class="input-container">
                    <label for="onlineLink" name="Room" id="Room">Meeting Link:</label>
                    <input type="text" name="onlineLink" id="onlineLink" class="form__field">
                </div>
            </div>
            <!-- Additional fields for Sport Arena venue -->
            <div id="sportArenaFields" style="display: none;">
                <div class="input-container">
                    <label for="sportType" name="Room" id="Room">Select Sport Type:</label>
                    <select type="input" name="sportType" id="sportType" class="form__field">
                        <option value="Futsal Court">Futsal Court</option>
                        <option value="Basketball Court">Basketball Court</option>
                        <option value="Netball Court">Netball Court</option>
                    </select>
                </div>
            </div>
            <!-- Additional fields for Library venue -->
            <div id="libraryFields" style="display: none;">
                <div class="input-container">
                    <label for="libraryType" name="Room" id="Room">Select Library Type:</label>
                    <select type="input" name="libraryType" id="libraryType" class="form__field">
                        <option value="Auditorium 1">Auditorium 1</option>
                        <option value="Auditorium 2">Auditorium 2</option>
                        <option value="24 Hours">24 Hours</option>
                    </select>
                </div>
            </div>
            <!-- Additional fields for Dewan Seri Saujana venue -->
            <div id="dewanSeriSaujanaFields" style="display: none;">
                <!-- Add specific fields as needed -->
            </div>
            <!-- Additional fields for TA Building venue -->
            <div id="taBuildingFields" style="display: none;">
                <div class="input-container">
                <label for="Room" name="Room" id="Room">Select TA Room:</label>
                    <select type="input" name="TARoom" id="TARoom" class="form__field">
                        <option value="TA-1-01">TA-1-01</option>
                        <option value="TA-1-02">TA-1-02</option>
                        <option value="TA-1-03">TA-1-03</option>
                        <option value="TA-1-03">TA-1-04</option>
                        <option value="TA-1-03">TA-1-05</option>
                        <option value="TA-1-03">TA-1-06</option>
                        <option value="TA-1-03">TA-1-07</option>
                        <option value="TA-1-03">TA-1-08</option>
                        <option value="TA-1-03">TA-1-09</option>
                        <option value="TA-1-10">TA-1-10</option>
                    </select>
                </div>
            </div>
            <div id="baBuildingFields" style="display: none;">
            <label for="Room" name="Room" id="Room">Select BA Room:</label>
           <select type="input" name="BARoom" id="BARoom" class="form__field">
                        <option value="BA-1-01">BA-1-01</option>
                        <option value="BA-1-02">BA-1-02</option>
                        <option value="BA-1-03">BA-1-03</option>
                        <option value="BA-1-03">BA-1-04</option>
                        <option value="BA-1-03">BA-1-05</option>
                        <option value="BA-1-03">BA-1-06</option>
                        <option value="BA-1-03">BA-1-07</option>
                        <option value="BA-1-03">BA-1-08</option>
                        <option value="BA-1-03">BA-1-09</option>
                        <option value="BA-1-10">BA-1-10</option>
                    </select>
            </div>
            <!-- Additional fields for UNITEN Food Court venue -->
            <div id="unitenFoodCourtFields" style="display: none;">
                <div class="input-container">
                    <label for="FRoom" name="Room" id="Room">Select Food Court:</label>
                    <select type="input" name="fRoom" id="fRoom" class="form__field">
                        <option value="COE Food Court">COE Food Court</option>
                        <option value="Upten Food Court">Upten Food Court</option>
                    </select>
                </div>
            </div>
            <div class="input-container">
                    <label for="date">Select A Date:</label>
                    <input type="date" name="date" id="date" class="form__field" min="<?php echo date('Y-m-d'); ?>" required>
                </div>
                <div class="input-container">
                    <label for="start-time">Start Time:</label>
                    <input type="time" id="start-time" name="start-time" class="form__field" min="08:00" max="17:00" step="1800" required>
                </div>
                <div class="input-container">
                    <label for="end-time">End Time:</label>
                    <input type="time" id="end-time" name="end-time" class="form__field" min="08:00" max="17:00" step="1800" required>
                </div>
            <input type="submit" value="Submit Proposal">
        </form>
        <p>Status of the Proposal: Pending to be approved by the admin</p>
    </div>
</div>
<script>
    function showAdditionalFields(value) {
        var onlineFields = document.getElementById('onlineFields');
        var sportArenaFields = document.getElementById('sportArenaFields');
        var libraryFields = document.getElementById('libraryFields');
        var dewanSeriSaujanaFields = document.getElementById('dewanSeriSaujanaFields');
        var taBuildingFields = document.getElementById('taBuildingFields');
        var baBuildingFields = document.getElementById('baBuildingFields');
        var unitenFoodCourtFields = document.getElementById('unitenFoodCourtFields');

        // Hide all additional fields by default
        onlineFields.style.display = 'none';
        sportArenaFields.style.display = 'none';
        libraryFields.style.display = 'none';
        dewanSeriSaujanaFields.style.display = 'none';
        taBuildingFields.style.display = 'none';
        baBuildingFields.style.display = 'none';
        unitenFoodCourtFields.style.display = 'none';

        // Show additional fields based on venue selection
        switch (value) {
            case 'Online':
                onlineFields.style.display = 'block';
                break;
            case 'Sport Arena':
                sportArenaFields.style.display = 'block';
                break;
            case 'Library':
                libraryFields.style.display = 'block';
                break;
            case 'Dewan Seri Saujana':
                dewanSeriSaujanaFields.style.display = 'block';
                break;
            case 'TA Building':
                taBuildingFields.style.display = 'block';
                break;
            case 'BA Building':
                baBuildingFields.style.display = 'block';
                break;
            case 'UNITEN Food Court':
                unitenFoodCourtFields.style.display = 'block';
                break;
            default:
                // Hide all if no valid venue selected
                break;
        }
    }
</script>
</body>
</html>
