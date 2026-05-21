<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Quick Actions - Study-Sphere</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            margin: 0;
            font-family: 'Roboto', Arial, sans-serif;
            background: linear-gradient(135deg, #e9ecef 0%, #a0c3d2 100%);
            color: #2c3e50;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow: auto;
        }
        .bg-anim {
            position: fixed;
            inset: 0;
            width: 100vw;
            height: 100vh;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }
        .stationery {
            position: absolute;
            opacity: 0.14;
            animation: float 7s ease-in-out infinite alternate;
        }
        .stationery.book1 { top: 12%; left: 8%; width: 70px; animation-delay: 0s;}
        .stationery.pencil1 { top: 35%; left: 80%; width: 40px; animation-delay: 1.5s;}
        .stationery.pen1 { bottom: 12%; left: 60%; width: 33px; animation-delay: 2.5s;}
        .stationery.eraser1 { bottom: 18%; right: 14%; width: 30px; animation-delay: 2.8s;}
        .stationery.ruler1 { top: 20%; right: 10%; width: 40px; animation-delay: 1.9s;}
        @keyframes float {
            0% { transform: translateY(0) scale(1) rotate(0deg);}
            100% { transform: translateY(-20px) scale(1.09) rotate(7deg);}
        }
        .quick-actions-container {
            display: flex;
            flex-wrap: wrap;
            gap: 24px;
            justify-content: center;
            align-items: center;
            margin-top: 32px;
            z-index: 2;
        }
        .quick-action {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 20px rgba(33,65,194,0.10), 0 2px 8px rgba(41,128,185,0.09);
            min-width: 170px;
            max-width: 210px;
            padding: 30px 18px 22px 18px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            font-size: 1.11rem;
            font-weight: 600;
            letter-spacing: 1px;
            color: #2141c2;
            transition: transform 0.13s, box-shadow 0.13s, background 0.15s;
            position: relative;
        }
        .quick-action .icon {
            font-size: 2.1rem;
            margin-bottom: 8px;
        }
        .quick-action a {
            text-decoration: none;
            color: #fff;
            font-size: 1.04rem;
            font-weight: 500;
            background: linear-gradient(90deg, #2141c2 0%, #26d0ce 100%);
            padding: 0.5em 1.3em;
            border-radius: 8px;
            margin-top: 10px;
            transition: background 0.2s, box-shadow 0.2s;
            box-shadow: 0 2px 8px rgba(33,65,194,0.09);
            display: inline-block;
        }
        .quick-action a:hover {
            background: linear-gradient(90deg, #26d0ce 0%, #2141c2 100%);
            box-shadow: 0 4px 14px rgba(33,65,194,0.13);
            color: #fff;
        }
        .quick-action:hover, .quick-action:focus-within {
            transform: translateY(-4px) scale(1.03);
            box-shadow: 0 8px 22px rgba(33,65,194,0.13), 0 2px 10px rgba(41,128,185,0.07);
            background: #f7fafc;
        }
        /* Dark mode support */
        body.dark {
            background: linear-gradient(135deg, #232a3d 0%, #273c47 100%);
            color: #e0e7ef;
        }
        body.dark .quick-action {
            background: #232a3f;
            color: #80d0c7;
            box-shadow: 0 4px 22px rgba(63, 105, 158, 0.14);
        }
        body.dark .quick-action a {
            background: linear-gradient(90deg, #80d0c7 0%, #2141c2 100%);
            color: #232a3d;
        }
        body.dark .quick-action a:hover {
            background: linear-gradient(90deg, #2141c2 0%, #80d0c7 100%);
            color: #fff;
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
        body.dark .dark-toggle {
            background: #232a3d;
            color: #80d0c7;
        }
        body.dark .dark-toggle:hover {
            background: #273c47;
        }
        @media (max-width: 1000px) {
            .quick-actions-container {
                gap: 16px;
            }
            .quick-action {
                min-width: 130px;
                max-width: 170px;
                padding: 16px 8px 14px 8px;
                font-size: 1rem;
            }
        }
        @media (max-width: 700px) {
            .quick-actions-container {
                flex-wrap: wrap;
                gap: 10px;
            }
            .quick-action {
                min-width: 100px;
                max-width: 97vw;
                padding: 12px 3vw 10px 3vw;
                font-size: 0.96rem;
            }
        }
    </style>
</head>
<body>
    <!-- Dark mode toggle button -->
    <button class="dark-toggle" id="darkToggleBtn" aria-label="Toggle dark mode" title="Toggle dark mode">
        <span id="darkIcon">&#9788;</span>
    </button>
    <div class="bg-anim" aria-hidden="true">
        <svg class="stationery book1" viewBox="0 0 80 65"><rect x="8" y="10" width="62" height="45" rx="7" fill="#2141c2"/><rect x="14" y="16" width="50" height="32" rx="4" fill="#fff"/><rect x="31" y="18" width="4" height="28" rx="1.5" fill="#26d0ce"/><rect x="46" y="18" width="4" height="28" rx="1.5" fill="#26d0ce"/></svg>
        <svg class="stationery pencil1" viewBox="0 0 65 65"><rect x="15" y="20" width="10" height="35" rx="4" fill="#2141c2"/><polygon points="15,20 25,10 35,20" fill="#f7ca88"/><rect x="25" y="20" width="10" height="35" rx="4" fill="#26d0ce"/><polygon points="35,20 45,10 55,20" fill="#f7ca88"/></svg>
        <svg class="stationery pen1" viewBox="0 0 75 75"><rect x="20" y="15" width="10" height="45" rx="5" fill="#80d0c7"/><rect x="30" y="15" width="10" height="45" rx="5" fill="#2141c2"/><ellipse cx="25" cy="60" rx="7" ry="5" fill="#334443"/></svg>
        <svg class="stationery eraser1" viewBox="0 0 52 34"><rect x="6" y="8" width="40" height="18" rx="7" fill="#faeab1"/><rect x="29" y="12" width="11" height="10" rx="3" fill="#2141c2"/></svg>
        <svg class="stationery ruler1" viewBox="0 0 75 20"><rect x="8" y="5" width="60" height="10" rx="3" fill="#faeab1"/><rect x="15" y="7" width="2" height="6" fill="#2141c2"/><rect x="25" y="7" width="2" height="6" fill="#2141c2"/><rect x="35" y="7" width="2" height="6" fill="#2141c2"/><rect x="45" y="7" width="2" height="6" fill="#2141c2"/><rect x="55" y="7" width="2" height="6" fill="#2141c2"/></svg>
    </div>
    <header>
        <h2 style="margin: 35px 0 18px 0; color: #2141c2; letter-spacing:2px; text-align:center;">Teacher Panel</h2>
    </header>
    <div class="quick-actions-container">
        <div class="quick-action">
            <div class="icon">📝</div>
            <div>Add Marks</div>
            <a href="add-marks.php">Go</a>
        </div>
        <div class="quick-action">
            <div class="icon">📚</div>
            <div>Add Notes</div>
            <a href="b5.php">Go</a>
        </div>
        <div class="quick-action">
            <div class="icon">📅</div>
            <div>Timetable</div>
            <a href="view-timetable.php">View</a>
        </div>
        <div class="quick-action">
            <div class="icon">🔔</div>
            <div>Notification</div>
            <a href="manage-notification.php">View</a>
        </div>
    </div>
    <script>
        // Dark mode toggle logic
        const darkToggleBtn = document.getElementById('darkToggleBtn');
        const darkIcon = document.getElementById('darkIcon');
        function setDarkMode(on) {
            if (on) {
                document.body.classList.add('dark');
                darkIcon.innerHTML = '&#9790;'; // moon
                localStorage.setItem('studysphere-darkmode', 'on');
            } else {
                document.body.classList.remove('dark');
                darkIcon.innerHTML = '&#9788;'; // sun
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