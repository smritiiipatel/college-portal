<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Download Notes - Study-Sphere</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #e9ecef 0%, #a0c3d2 100%);
            color: #2c3e50;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 20px;
            min-height: 100vh;
			overflow: auto;
        }
        h2 {
            color: #2141c2;
            letter-spacing: 2px;
            margin-bottom: 30px;
        }
        table {
            width: 95%;
            max-width: 1100px;
            border-collapse: collapse;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(33,65,194,0.1);
        }
        th, td {
            padding: 16px 20px;
            text-align: center;
            border-bottom: 1px solid #e0e0e0;
        }
        th {
            background: #2141c2;
            color: #fff;
            font-weight: 600;
        }
        tr:hover {
            background-color: #f1f9ff;
        }
        a.download-link {
            background: linear-gradient(90deg, #2141c2 0%, #26d0ce 100%);
            color: #fff;
            padding: 6px 14px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.2s ease;
        }
        a.download-link:hover {
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
        body.dark table {
            background: #2c3e50;
            color: #e0e7ef;
        }
        body.dark th {
            background: #80d0c7;
            color: #232a3d;
        }
        body.dark tr:hover {
            background-color: #3a4a5f;
        }
        body.dark .dark-toggle {
            background: #232a3d;
            color: #80d0c7;
        }
        body.dark .dark-toggle:hover {
            background: #273c47;
        }
    </style>
</head>
<body>
    <!-- Dark mode toggle -->
    <button class="dark-toggle" id="darkToggleBtn" aria-label="Toggle dark mode" title="Toggle dark mode">
        <span id="darkIcon">&#9788;</span>
    </button>

    <h2>Available Notes</h2>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Branch</th>
                <th>Semester</th>
                <th>Subject</th>
                <th>Download</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $con = mysqli_connect('mysql.railway.internal', 'root', 'GJifTuTKslzyFAUQochWGXciqLxvOpEU', 'railway');
            if (!$con) {
                echo "<tr><td colspan='5'>Connection failed: " . mysqli_connect_error() . "</td></tr>";
            } else {
                $q = "SELECT * FROM form";
                $re = mysqli_query($con, $q);
                while ($row = mysqli_fetch_array($re)) {
                    echo "<tr>
                            <td>{$row['date']}</td>
                            <td>{$row['branch']}</td>
                            <td>{$row['sem']}</td>
                            <td>{$row['subject']}</td>
                            <td><a class='download-link' href='{$row['topic']}' download>Download</a></td>
                          </tr>";
                }
            }
            ?>
        </tbody>
    </table>

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
