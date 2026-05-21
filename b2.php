<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Login - Study-Sphere</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            min-height: 100vh;
            font-family: 'Roboto', Arial, sans-serif;
            background: linear-gradient(135deg, #0093E9 0%, #80D0C7 100%);
            color: #2c3e50;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow: auto;
            transition: background 0.5s, color 0.5s;
        }
        /* Animated floating stationery SVGs */
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
        .stationery.book1 { top: 10%; left: 10%; width: 70px; animation-delay: 0s;}
        .stationery.book2 { top: 60%; left: 15%; width: 55px; animation-delay: 1.1s;}
        .stationery.pencil1 { top: 37%; left: 80%; width: 45px; animation-delay: 1.5s;}
        .stationery.pen1 { bottom: 12%; left: 60%; width: 40px; animation-delay: 2.5s;}
        .stationery.eraser1 { bottom: 18%; right: 14%; width: 32px; animation-delay: 2.8s;}
        .stationery.ruler1 { top: 20%; right: 10%; width: 55px; animation-delay: 1.9s;}
        @keyframes float {
            0% { transform: translateY(0) scale(1) rotate(0deg);}
            100% { transform: translateY(-20px) scale(1.09) rotate(7deg);}
        }
        .login-container {
            background: #fff;
            border-radius: 26px;
            box-shadow: 0 10px 32px rgba(33,65,194,0.13), 0 3px 16px rgba(41,128,185,0.10);
            padding: 60px 38px 52px 38px;
            width: 98%;
            max-width: 480px;
            margin: 60px auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
            transition: background 0.5s, color 0.5s;
        }
        .login-container h2 {
            margin-top: 0;
            margin-bottom: 32px;
            letter-spacing: 2px;
            font-size: 2.2rem;
            color: #2141c2;
            font-weight: 700;
            transition: color 0.5s;
        }
        .login-container form {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 26px;
        }
        .login-container input[type="text"] {
            width: 95%;
            padding: 18px 20px;
            border-radius: 22px;
            border: 2.5px solid #a0c3d2;
            font-size: 1.22rem;
            background: #f4f8fb;
            transition: border-color 0.2s, background 0.3s, color 0.3s;
        }
        .login-container input[type="text"]:focus {
            border-color: #2141c2;
            outline: none;
            background: #fff;
        }
        .login-container input[type="submit"] {
            width: 70%;
            padding: 18px 0;
            border-radius: 22px;
            border: none;
            font-size: 1.19rem;
            font-weight: 700;
            background: linear-gradient(90deg, #2141c2 0%, #26d0ce 100%);
            color: #fff;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(33,65,194,0.09);
            letter-spacing: 1.2px;
            margin-top: 8px;
            transition: background 0.2s, transform 0.17s;
        }
        .login-container input[type="submit"]:hover {
            background: linear-gradient(90deg, #26d0ce 0%, #2141c2 100%);
            transform: scale(1.06);
        }
        .login-container .register-link {
            display: block;
            margin: 32px auto 0 auto;
            text-align: center;
            color: #2141c2;
            text-decoration: none;
            font-style: italic;
            font-size: 1.16rem;
            font-weight: 600;
            padding: 10px 26px;
            border-radius: 14px;
            transition: background 0.18s, color 0.5s;
        }
        .login-container .register-link:hover {
            background: #e9ecef;
            color: #26d0ce;
            text-decoration: underline;
        }
        /* Dark mode styles */
        body.dark {
            background: linear-gradient(135deg, #232a3d 0%, #273c47 100%);
            color: #e0e7ef;
        }
        body.dark .login-container {
            background: #232a3f;
            color: #e0e7ef;
        }
        body.dark .login-container h2 {
            color: #80d0c7;
        }
        body.dark .login-container input[type="text"] {
            background: #242a35;
            color: #e0e7ef;
            border-color: #80d0c7;
        }
        body.dark .login-container input[type="text"]:focus {
            background: #1c222b;
        }
        body.dark .login-container input[type="submit"] {
            background: linear-gradient(90deg, #80d0c7 0%, #2141c2 100%);
            color: #232a3d;
        }
        body.dark .login-container .register-link {
            color: #80d0c7;
        }
        body.dark .login-container .register-link:hover {
            background: #232a3d;
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
        @media (max-width: 600px) {
            .login-container {
                padding: 16px 3vw;
                max-width: 99vw;
            }
            .login-container h2 {
                font-size: 1.25rem;
                margin-bottom: 18px;
            }
            .login-container input[type="submit"] {
                width: 90%;
                font-size: 1rem;
                padding: 12px 0;
            }
            .login-container input[type="text"] {
                font-size: 1rem;
                padding: 12px 14px;
            }
            .login-container .register-link {
                font-size: 1rem;
                padding: 8px 10px;
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
        <svg class="stationery book2" viewBox="0 0 65 55"><rect x="7" y="10" width="51" height="36" rx="6" fill="#26d0ce"/><rect x="13" y="16" width="39" height="24" rx="4" fill="#fff"/></svg>
        <svg class="stationery pencil1" viewBox="0 0 65 65"><rect x="15" y="20" width="10" height="35" rx="4" fill="#2141c2"/><polygon points="15,20 25,10 35,20" fill="#f7ca88"/><rect x="25" y="20" width="10" height="35" rx="4" fill="#26d0ce"/><polygon points="35,20 45,10 55,20" fill="#f7ca88"/></svg>
        <svg class="stationery pen1" viewBox="0 0 75 75"><rect x="20" y="15" width="10" height="45" rx="5" fill="#80d0c7"/><rect x="30" y="15" width="10" height="45" rx="5" fill="#2141c2"/><ellipse cx="25" cy="60" rx="7" ry="5" fill="#334443"/></svg>
        <svg class="stationery eraser1" viewBox="0 0 52 34"><rect x="6" y="8" width="40" height="18" rx="7" fill="#faeab1"/><rect x="29" y="12" width="11" height="10" rx="3" fill="#2141c2"/></svg>
        <svg class="stationery ruler1" viewBox="0 0 75 20"><rect x="8" y="5" width="60" height="10" rx="3" fill="#faeab1"/><rect x="15" y="7" width="2" height="6" fill="#2141c2"/><rect x="25" y="7" width="2" height="6" fill="#2141c2"/><rect x="35" y="7" width="2" height="6" fill="#2141c2"/><rect x="45" y="7" width="2" height="6" fill="#2141c2"/><rect x="55" y="7" width="2" height="6" fill="#2141c2"/></svg>
    </div>
    <div class="login-container">
        <h2>TEACHER LOGIN</h2>
        <form action="b2action.php">
            <input type="text" name="t1" placeholder="Enter your name" required>
            <input type="text" name="t2" placeholder="Enter your ID" required>
            <input type="submit" value="Login">
        </form>
        <a href="b3.php" class="register-link">Registration Form</a>
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
        // On load, use saved preference or system preference
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