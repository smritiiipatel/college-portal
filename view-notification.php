<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Notifications - Study-Sphere</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <style>
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
        ul {
            list-style: none;
            padding: 0;
            width: 100%;
            max-width: 700px;
        }
        li {
            background: #fff;
            margin-bottom: 12px;
            padding: 18px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(33,65,194,0.1);
            font-size: 1.05rem;
            font-weight: 500;
        }
        .timestamp {
            font-size: 0.85rem;
            color: #888;
            margin-top: 6px;
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
        body.dark li {
            background: #2c3e50;
            color: #e0e7ef;
        }
        body.dark .timestamp {
            color: #aaa;
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
    <button class="dark-toggle" id="darkToggleBtn" aria-label="Toggle dark mode" title="Toggle dark mode">
        <span id="darkIcon">&#9788;</span>
    </button>

    <h2>Latest Notifications</h2>
    <ul>
        <?php
        $con = mysqli_connect('localhost', 'root', 'goodluck', 'notes');
        if (!$con) {
            echo "<li>Connection failed: " . mysqli_connect_error() . "</li>";
            exit;
        }

        $createTable = "CREATE TABLE IF NOT EXISTS notification (
            id INT AUTO_INCREMENT PRIMARY KEY,
            note TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        mysqli_query($con, $createTable);

        $result = mysqli_query($con, "SELECT * FROM notification ORDER BY created_at DESC");
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li>
                        {$row['note']}
                        <div class='timestamp'>Posted on: " . date("d M Y, h:i A", strtotime($row['created_at'])) . "</div>
                      </li>";
            }
        } else {
            echo "<li>No notifications available at the moment.</li>";
        }
        ?>
    </ul>

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
</body>
</html>
