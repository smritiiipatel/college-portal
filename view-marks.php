<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Marks - Study-Sphere</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <style>
        html, body { margin: 0; padding: 0; box-sizing: border-box; height: 100%; }
        body {
            min-height: 100vh;
            font-family: 'Roboto', Arial, sans-serif;
            background: linear-gradient(135deg, #e9ecef 0%, #a0c3d2 100%);
            color: #2c3e50;
            display: flex; 
            flex-direction: column;
             align-items: center;
             overflow: auto;
        }
        .bg-anim { position: fixed; inset: 0; width: 100vw; height: 100vh; z-index: 0; pointer-events: none; overflow: hidden; }
        .stationery { position: absolute; opacity: 0.14; animation: float 7s ease-in-out infinite alternate; }
        .stationery.book1 { top: 12%; left: 8%; width: 70px; animation-delay: 0s;}
        .stationery.pencil1 { top: 35%; left: 80%; width: 40px; animation-delay: 1.5s;}
        .stationery.pen1 { bottom: 12%; left: 60%; width: 33px; animation-delay: 2.5s;}
        .stationery.eraser1 { bottom: 18%; right: 14%; width: 30px; animation-delay: 2.8s;}
        .stationery.ruler1 { top: 20%; right: 10%; width: 40px; animation-delay: 1.9s;}
        @keyframes float {
            0% { transform: translateY(0) scale(1) rotate(0deg);}
            100% { transform: translateY(-20px) scale(1.09) rotate(7deg);}
        }
        .form-container {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 20px rgba(33,65,194,0.10), 0 1.5px 8px rgba(41,128,185,0.08);
            padding: 28px 22px 20px 22px;
            width: 95%; max-width: 400px; margin: 36px auto 0 auto;
            display: flex; flex-direction: column; align-items: center;
            z-index: 2; transition: background 0.5s, color 0.5s;
        }
        .form-container h2 {
            margin-top: 0; margin-bottom: 18px; letter-spacing: 2px;
            font-size: 1.25rem; color: #2141c2; font-weight: 700;
        }
        form {
            width: 100%; display: flex; flex-direction: column; align-items: center; gap: 14px;
        }
        input[type="text"] {
            width: 94%; padding: 10px 12px; border-radius: 14px; border: 1.5px solid #a0c3d2;
            font-size: 1rem; background: #f4f8fb; margin-bottom: 2px;
            transition: border-color 0.2s, background 0.3s, color 0.3s;
        }
        input[type="text"]:focus {
            border-color: #2141c2; outline: none; background: #fff;
        }
        .sub {
            width: 70%; min-width: 100px; padding: 9px 0; border-radius: 18px; border: none;
            font-size: 1.01rem; font-weight: 600;
            background: linear-gradient(90deg, #2141c2 0%, #26d0ce 100%);
            color: #fff; cursor: pointer; box-shadow: 0 2px 8px rgba(33,65,194,0.09);
            letter-spacing: 1px; margin-top: 10px;
            transition: background 0.2s, transform 0.17s;
        }
        .sub:hover { background: linear-gradient(90deg, #26d0ce 0%, #2141c2 100%); transform: scale(1.04);}
        .marks-table {
            margin-top: 18px; width: 100%; max-width: 360px;
            border-radius: 10px; overflow: hidden;
            border: 1.5px solid #a0c3d2; background: #f7fafc; font-size: 1rem;
        }
        .marks-table th, .marks-table td {
            padding: 9px 7px; text-align: center;
        }
        .marks-table th {
            background: #2141c2; color: #fff; font-weight: 600;
        }
        .marks-table tr:nth-child(even) { background: #eaf5fb; }
        .no-marks {
            margin-top: 16px; color: #c0392b; font-weight: 500;
        }
        /* Dark mode styles */
        body.dark { background: linear-gradient(135deg, #232a3d 0%, #273c47 100%); color: #e0e7ef; }
        body.dark .form-container {
            background: #232a3f; color: #e0e7ef;
            box-shadow: 0 4px 22px rgba(63, 105, 158, 0.14);
        }
        body.dark .form-container h2 { color: #80d0c7; }
        body.dark input[type="text"] { background: #242a35; color: #e0e7ef; border-color: #80d0c7;}
        body.dark input[type="text"]:focus { background: #1c222b;}
        body.dark .sub { background: linear-gradient(90deg, #80d0c7 0%, #2141c2 100%); color: #232a3d;}
        body.dark .marks-table { background: #232a3f; border-color: #80d0c7; color: #e0e7ef;}
        body.dark .marks-table th { background: #80d0c7; color: #232a3d;}
        body.dark .marks-table tr:nth-child(even) { background: #273c47;}
        .dark-toggle {
            position: fixed; top: 22px; right: 22px; z-index: 10;
            background: #fff; color: #2141c2;
            border: none; border-radius: 50%; width: 42px; height: 42px;
            box-shadow: 0 2px 8px rgba(33,65,194,0.12);
            cursor: pointer; display: flex; align-items: center; justify-content: center;
            font-size: 1.45rem; transition: background 0.25s, color 0.25s;
        }
        .dark-toggle:hover { background: #e9ecef; }
        body.dark .dark-toggle { background: #232a3d; color: #80d0c7;}
        body.dark .dark-toggle:hover { background: #273c47;}
        @media (max-width: 500px) {
            .form-container { padding: 10px 2vw 10px 2vw; max-width: 99vw; }
            form input, .sub { font-size: 0.97rem; }
            .marks-table { font-size: 0.93rem; }
        }
    </style>
</head>
<body>
    <button class="dark-toggle" id="darkToggleBtn" aria-label="Toggle dark mode" title="Toggle dark mode"><span id="darkIcon">&#9788;</span></button>
    <div class="bg-anim" aria-hidden="true">
        <svg class="stationery book1" viewBox="0 0 80 65"><rect x="8" y="10" width="62" height="45" rx="7" fill="#2141c2"/><rect x="14" y="16" width="50" height="32" rx="4" fill="#fff"/><rect x="31" y="18" width="4" height="28" rx="1.5" fill="#26d0ce"/><rect x="46" y="18" width="4" height="28" rx="1.5" fill="#26d0ce"/></svg>
        <svg class="stationery pencil1" viewBox="0 0 65 65"><rect x="15" y="20" width="10" height="35" rx="4" fill="#2141c2"/><polygon points="15,20 25,10 35,20" fill="#f7ca88"/><rect x="25" y="20" width="10" height="35" rx="4" fill="#26d0ce"/><polygon points="35,20 45,10 55,20" fill="#f7ca88"/></svg>
        <svg class="stationery pen1" viewBox="0 0 75 75"><rect x="20" y="15" width="10" height="45" rx="5" fill="#80d0c7"/><rect x="30" y="15" width="10" height="45" rx="5" fill="#2141c2"/><ellipse cx="25" cy="60" rx="7" ry="5" fill="#334443"/></svg>
        <svg class="stationery eraser1" viewBox="0 0 52 34"><rect x="6" y="8" width="40" height="18" rx="7" fill="#faeab1"/><rect x="29" y="12" width="11" height="10" rx="3" fill="#2141c2"/></svg>
        <svg class="stationery ruler1" viewBox="0 0 75 20"><rect x="8" y="5" width="60" height="10" rx="3" fill="#faeab1"/><rect x="15" y="7" width="2" height="6" fill="#2141c2"/><rect x="25" y="7" width="2" height="6" fill="#2141c2"/><rect x="35" y="7" width="2" height="6" fill="#2141c2"/><rect x="45" y="7" width="2" height="6" fill="#2141c2"/><rect x="55" y="7" width="2" height="6" fill="#2141c2"/></svg>
    </div>
    <div class="form-container">
        <h2>VIEW MARKS</h2>
        <form action="view-marks.php" method="post" autocomplete="off">
            <input type="text" name="name" placeholder="Student Name" required>
            <input type="text" name="rollno" placeholder="Roll Number" required>
            <input type="submit" value="View Marks" class="sub">
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $con = new mysqli('mysql.railway.internal', 'root', 'GJifTuTKslzyFAUQochWGXciqLxvOpEU', 'railway');
            if ($con->connect_error) {
                echo "<div style='color:red;margin-top:10px;'>Database Connection Failed</div>";
                exit();
            }
            $name = $con->real_escape_string(trim($_POST["name"]));
            $rollno = $con->real_escape_string(trim($_POST["rollno"]));

            // First, check the student in studentinfo table
            $check = $con->query("SELECT * FROM studentinfo WHERE name='$name' AND rollno='$rollno'");
            if ($check && $check->num_rows > 0) {
                // Now fetch marks from marks table (roll stored as string, so cast for safety)
                $marksq = "SELECT * FROM marks WHERE name='$name' AND (roll='$rollno' OR roll=LPAD('$rollno',2,'0')) LIMIT 1";
                $result = $con->query($marksq);
                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo '<table class="marks-table">';
                    echo '<tr><th>Subject</th><th>Marks</th></tr>';
                    for ($i = 1; $i <= 5; $i++) {
                        $subject = htmlspecialchars($row["subject$i"]);
                        $marks = htmlspecialchars($row["marks$i"]);
                        echo "<tr><td>$subject</td><td>$marks</td></tr>";
                    }
                    echo '</table>';
                } else {
                    echo "<div class='no-marks'>No marks found for this student.</div>";
                }
            } else {
                echo "<div class='no-marks'>Invalid name or roll number.</div>";
            }
            $con->close();
        }
        ?>
    </div>
    <script>
        // Dark mode toggle logic
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
            if (
                (saved === 'on') ||
                (saved === null && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)
            ) {
                setDarkMode(true);
            }
        })();
        darkToggleBtn.onclick = function() {
            setDarkMode(!document.body.classList.contains('dark'));
        }
    </script>
</body>
</html>