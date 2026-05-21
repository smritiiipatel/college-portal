<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Timetable - Study-Sphere</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <style>
        /* Theme styles (same as your Study-Sphere aesthetic) */
        body {
            margin: 0;
            font-family: 'Roboto', Arial, sans-serif;
            background: linear-gradient(135deg, #e9ecef 0%, #a0c3d2 100%);
            color: #2c3e50;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 20px;
            overflow: auto;
        }
        h2 {
            color: #2141c2;
            letter-spacing: 2px;
            margin-bottom: 30px;
        }
        form {
            background: #fff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(33,65,194,0.1);
            width: 100%;
            max-width: 500px;
            z-index: 2;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2141c2;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 1rem;
        }
        button {
            background: linear-gradient(90deg, #2141c2 0%, #26d0ce 100%);
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s ease;
        }
        button:hover {
            background: linear-gradient(90deg, #26d0ce 0%, #2141c2 100%);
        }
        .dark-toggle {
            position: fixed;
            top: 22px;
            right: 22px;
            z-index: 10;
            background: #fff;
            color: #2141c2;
            border: none;
            border-radius: 50%;
            width: 42px;
            height: 42px;
            box-shadow: 0 2px 8px rgba(33,65,194,0.12);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.45rem;
            transition: background 0.25s, color 0.25s;
        }
        .dark-toggle:hover {
            background: #e9ecef;
        }
        body.dark {
            background: linear-gradient(135deg, #232a3d 0%, #273c47 100%);
            color: #e0e7ef;
        }
        body.dark form {
            background: #2c3e50;
            color: #e0e7ef;
        }
        body.dark label {
            color: #80d0c7;
        }
        body.dark input {
            background: #3a4a5f;
            color: #fff;
            border: 1px solid #80d0c7;
        }
        body.dark button {
            background: linear-gradient(90deg, #80d0c7 0%, #2141c2 100%);
            color: #232a3d;
        }
        body.dark button:hover {
            background: linear-gradient(90deg, #2141c2 0%, #80d0c7 100%);
            color: #fff;
        }
    </style>
</head>
<body>
    <!-- Dark mode toggle -->
    <button class="dark-toggle" id="darkToggleBtn" aria-label="Toggle dark mode" title="Toggle dark mode">
        <span id="darkIcon">&#9788;</span>
    </button>

    <h2>Upload Timetable</h2>
    <form method="POST" enctype="multipart/form-data">
        <label for="branch">Branch</label>
        <input type="text" name="branch" id="branch" required>

        <label for="semester">Semester</label>
        <input type="text" name="semester" id="semester" required>

        <label for="date">Date</label>
        <input type="date" name="date" id="date" required>

        <label for="file">Upload File</label>
        <input type="file" name="file" id="file" required>

        <button type="submit" name="submit">Upload</button>
    </form>

    <script>
        const darkToggleBtn = document.getElementById('darkToggleBtn');
        const darkIcon = document.getElementById('darkIcon');
        function setDarkMode(on) {
            if (on) {
                document.body.classList.add('dark');
                darkIcon.innerHTML = '&#9790;';
                localStorage.setItem('studysphere-darkmode', 'on');
            } else {
                document.body.classList.remove('dark');
                darkIcon.innerHTML = '&#9788;';
                localStorage.setItem('studysphere-darkmode', 'off');
            }
        }
        (() => {
            const saved = localStorage.getItem('studysphere-darkmode');
            if ((saved === 'on') || (saved === null && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                setDarkMode(true);
            }
        })();
        darkToggleBtn.onclick = function() {
            setDarkMode(!document.body.classList.contains('dark'));
        }
    </script>

<?php
if (isset($_POST['submit'])) {
    $con = mysqli_connect('localhost', 'root', 'goodluck', 'notes');
    if (!$con) {
        echo "<p style='color:red;'>Connection failed: " . mysqli_connect_error() . "</p>";
        exit;
    }

    // Create table if not exists
    $createTable = "CREATE TABLE IF NOT EXISTS timetable (
        id INT AUTO_INCREMENT PRIMARY KEY,
        branch VARCHAR(100) NOT NULL,
        semester VARCHAR(50) NOT NULL,
        date DATE NOT NULL,
        file_path VARCHAR(255) NOT NULL,
        uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    mysqli_query($con, $createTable);

    // Handle file upload
    $branch = $_POST['branch'];
    $semester = $_POST['semester'];
    $date = $_POST['date'];
    $fileName = $_FILES['file']['name'];
    $fileTmp = $_FILES['file']['tmp_name'];
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir);
    }
    $targetFile = $targetDir . basename($fileName);

    if (move_uploaded_file($fileTmp, $targetFile)) {
        $insert = "INSERT INTO timetable (branch, semester, date, file_path) 
                   VALUES ('$branch', '$semester', '$date', '$targetFile')";
        if (mysqli_query($con, $insert)) {
            echo "<p style='color:green;'>Timetable uploaded successfully!</p>";
        } else {
            echo "<p style='color:red;'>Error saving to database.</p>";
        }
    } else {
        echo "<p style='color:red;'>File upload failed.</p>";
    }
}
?>
</body>
</html>
