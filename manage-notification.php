<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Notifications - Study-Sphere</title>
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
        form {
            background: #fff;
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(33,65,194,0.1);
            width: 100%;
            max-width: 600px;
            margin-bottom: 30px;
        }
        input[type="text"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 16px;
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
        ul {
            list-style: none;
            padding: 0;
            width: 100%;
            max-width: 600px;
        }
        li {
            background: #fff;
            margin-bottom: 12px;
            padding: 16px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(33,65,194,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .actions button {
            margin-left: 8px;
            padding: 6px 12px;
            font-size: 0.9rem;
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
        body.dark form, body.dark li {
            background: #2c3e50;
            color: #e0e7ef;
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
    <button class="dark-toggle" id="darkToggleBtn" aria-label="Toggle dark mode" title="Toggle dark mode">
        <span id="darkIcon">&#9788;</span>
    </button>

    <h2>Manage Notifications</h2>

    <form method="POST">
        <input type="text" name="note" placeholder="Enter notification..." required>
        <button type="submit" name="add">Add Notification</button>
    </form>

    <ul>
        <?php
        $con = mysqli_connect('mysql.railway.internal', 'root', 'GJifTuTKslzyFAUQochWGXciqLxvOpEU', 'railway');
        if (!$con) {
            echo "<li>Connection failed: " . mysqli_connect_error() . "</li>";
            exit;
        }

        // Create table if not exists
        $createTable = "CREATE TABLE IF NOT EXISTS notification (
            id INT AUTO_INCREMENT PRIMARY KEY,
            note TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        mysqli_query($con, $createTable);

        // Add notification
        if (isset($_POST['add'])) {
            $note = mysqli_real_escape_string($con, $_POST['note']);
            mysqli_query($con, "INSERT INTO notification (note) VALUES ('$note')");
        }

        // Delete notification
        if (isset($_GET['delete'])) {
            $id = intval($_GET['delete']);
            mysqli_query($con, "DELETE FROM notification WHERE id=$id");
        }

        // Edit notification
        if (isset($_POST['update'])) {
            $id = intval($_POST['id']);
            $note = mysqli_real_escape_string($con, $_POST['note']);
            mysqli_query($con, "UPDATE notification SET note='$note' WHERE id=$id");
        }

        // Display notifications
        $result = mysqli_query($con, "SELECT * FROM notification ORDER BY created_at DESC");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li>
                    <form method='POST' style='flex:1; display:flex; justify-content:space-between; align-items:center;'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <input type='text' name='note' value=\"" . htmlspecialchars($row['note']) . "\" style='flex:1; margin-right:10px;'>
                        <div class='actions'>
                            <button type='submit' name='update'>Save</button>
                            <a href='?delete={$row['id']}'><button type='button'>Delete</button></a>
                        </div>
                    </form>
                  </li>";
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
