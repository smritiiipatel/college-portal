<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Study-Sphere</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <style>
        html {
            box-sizing: border-box;
            scroll-behavior: smooth;
        }
        *, *:before, *:after {
            box-sizing: inherit;
        }
        body {
            min-height: 100vh;
            margin: 0;
            font-family: 'Roboto', Arial, sans-serif;
            background: linear-gradient(135deg, #e9ecef 0%, #a0c3d2 100%);
            color: #2c3e50;
            display: flex;
            flex-direction: column;
            overflow: auto;
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
        /* Each stationery item has custom position and delay */
        .stationery.book1 { top: 12%; left: 8%; width: 80px; animation-delay: 0s;}
        .stationery.book2 { top: 32%; left: 28%; width: 65px; animation-delay: 1.1s;}
        .stationery.book3 { top: 50%; left: 60%; width: 70px; animation-delay: 2.5s;}
        .stationery.book4 { top: 15%; left: 72%; width: 50px; animation-delay: 3.6s;}
        .stationery.book5 { bottom: 18%; right: 7%; width: 60px; animation-delay: 4.1s;}
        .stationery.book6 { top: 55%; left: 12%; width: 60px; animation-delay: 3.5s;}
        .stationery.book7 { top: 70%; left: 80%; width: 50px; animation-delay: 2.1s;}
        .stationery.book8 { top: 82%; left: 25%; width: 55px; animation-delay: 1.7s;}
        .stationery.book9 { bottom: 8%; right: 20%; width: 65px; animation-delay: 5.1s;}
        .stationery.book10 { top: 8%; right: 12%; width: 55px; animation-delay: 5.8s;}
        .stationery.copy1 { top: 55%; left: 85%; width: 65px; animation-delay: 2.2s;}
        .stationery.copy2 { top: 60%; left: 30%; width: 50px; animation-delay: 2.8s;}
        .stationery.copy3 { bottom: 10%; left: 15%; width: 55px; animation-delay: 3.6s;}
        .stationery.copy4 { top: 70%; right: 25%; width: 40px; animation-delay: 4.6s;}
        .stationery.copy5 { top: 43%; right: 64%; width: 60px; animation-delay: 1.9s;}
        .stationery.pencil1 { top: 37%; left: 13%; width: 65px; animation-delay: 1.5s;}
        .stationery.pencil2 { bottom: 32%; left: 50%; width: 50px; animation-delay: 0.9s;}
        .stationery.pencil3 { top: 20%; right: 48%; width: 40px; animation-delay: 2.2s;}
        .stationery.pencil4 { bottom: 12%; right: 30%; width: 50px; animation-delay: 4.4s;}
        .stationery.pen1 { bottom: 12%; left: 30%; width: 75px; animation-delay: 3.2s;}
        .stationery.pen2 { top: 28%; right: 15%; width: 45px; animation-delay: 4.9s;}
        .stationery.pen3 { bottom: 60%; left: 80%; width: 40px; animation-delay: 2.7s;}
        .stationery.pen4 { top: 80%; left: 55%; width: 50px; animation-delay: 6.2s;}
        .stationery.eraser1 { bottom: 18%; right: 14%; width: 52px; animation-delay: 5.2s;}
        .stationery.eraser2 { top: 42%; right: 32%; width: 38px; animation-delay: 6.2s;}
        .stationery.eraser3 { top: 18%; left: 45%; width: 44px; animation-delay: 3.9s;}
        .stationery.eraser4 { bottom: 35%; left: 18%; width: 30px; animation-delay: 5.8s;}
        .stationery.ruler1 { top: 20%; right: 10%; width: 75px; animation-delay: 4s;}
        .stationery.ruler2 { bottom: 5%; left: 60%; width: 55px; animation-delay: 2.5s;}
        .stationery.ruler3 { top: 5%; left: 35%; width: 50px; animation-delay: 2.0s;}
        .stationery.ruler4 { bottom: 18%; left: 80%; width: 45px; animation-delay: 1.3s;}
        @keyframes float {
            0% { transform: translateY(0) scale(1) rotate(0deg);}
            100% { transform: translateY(-32px) scale(1.09) rotate(7deg);}
        }
        /* Navbar styles */
        .navbar {
            width: 100%;
            background: #2141c2;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 6vw 12px 6vw;
            box-shadow: 0 2px 8px rgba(33,65,194,0.07);
            position: sticky;
            top: 0;
            z-index: 100;
            border-radius: 0 0 20px 20px;
        }
        .navbar .logo {
            font-size: 1.35rem;
            font-weight: bold;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .navbar-links {
            display: flex;
            align-items: center;
            gap: 18px;
        }
        .navbar-links a {
            text-decoration: none;
            color: #fff;
            font-weight: 500;
            font-size: 1rem;
            transition: color 0.2s, background 0.2s;
            padding: 4px 12px;
            border-radius: 12px;
        }
        .navbar-links a:hover,
        .navbar-links a.active {
            background: #26d0ce;
            color: #2141c2;
        }
        .navbar-darkmode {
            margin-left: 15px;
            display: flex;
            align-items: center;
        }
        .navbar-darkmode button {
            background: #fff;
            color: #2141c2;
            border: none;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            box-shadow: 0 2px 8px rgba(33,65,194,0.12);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            transition: background 0.20s, color 0.20s;
        }
        .navbar-darkmode button:hover {
            background: #e9ecef;
            color: #26d0ce;
        }
        body.dark .navbar-darkmode button {
            background: #232a3d;
            color: #80d0c7;
        }
        body.dark .navbar-darkmode button:hover {
            background: #273c47;
        }
        header {
            margin-top: 48px;
            text-align: center;
        }
        .brand {
            font-size: 2.5rem;
            font-weight: bold;
            letter-spacing: 2px;
            color: #2141c2;
            margin-bottom: 0.5rem;
        }
        .subtitle {
            font-size: 1.2rem;
            color: #4b6584;
            margin-bottom: 2.5rem;
        }
        .card-container {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 40px;
            flex-wrap: wrap;
        }
        .role-card {
            background: #fff;
            border-radius: 22px;
            box-shadow: 0 4px 20px rgba(33, 65, 194, 0.10), 0 1.5px 8px rgba(41, 128, 185, 0.09);
            min-width: 220px;
            max-width: 250px;
            padding: 32px 28px 26px 28px;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.18s, box-shadow 0.18s;
            text-align: center;
            position: relative;
            border: 1.5px solid #e1e7ef;
        }
        .role-card:hover, .role-card:focus-within {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 10px 28px rgba(33, 65, 194, 0.18), 0 2.5px 14px rgba(41, 128, 185, 0.10);
            border-color: #2141c2;
        }
        .role-icon {
            font-size: 2.5rem;
            margin-bottom: 12px;
            color: #2141c2;
        }
        .role-title {
            font-size: 1.15rem;
            font-weight: 600;
            margin-bottom: 14px;
            color: #2141c2;
            letter-spacing: 1px;
        }
        .role-link {
            display: inline-block;
            padding: 0.65em 1.8em;
            background: linear-gradient(90deg, #2141c2 0%, #26d0ce 100%);
            color: #fff;
            font-weight: 500;
            font-size: 1rem;
            border-radius: 12px;
            text-decoration: none;
            transition: background 0.2s, box-shadow 0.2s;
            box-shadow: 0 2px 8px rgba(33, 65, 194, 0.09);
            margin-top: 8px;
            letter-spacing: 0.5px;
        }
        .role-link:hover, .role-link:focus {
            background: linear-gradient(90deg, #26d0ce 0%, #2141c2 100%);
            box-shadow: 0 4px 16px rgba(33, 65, 194, 0.18);
        }
        /* Section styles */
        section {
            margin: 0 auto;
            padding: 56px 0 32px 0;
            max-width: 900px;
            width: 95vw;
        }
        .section-title {
            font-size: 2rem;
            font-weight: bold;
            color: #2141c2;
            margin-bottom: 18px;
            text-align: center;
            letter-spacing: 1px;
        }
        body.dark .section-title {
            color: #80d0c7;
        }
        /* Contact styles */
        .contact-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 12px rgba(33,65,194,0.08);
            padding: 28px 18px;
            margin: 0 auto;
            max-width: 500px;
            text-align: center;
            border: 1.5px solid #e1e7ef;
        }
        body.dark .contact-card {
            background: #232a3f;
            color: #e0e7ef;
            border-color: #80d0c7;
        }
        .contact-card h2 {
            font-size: 1.28rem;
            color: #2141c2;
            margin-bottom: 14px;
            letter-spacing: 1px;
        }
        body.dark .contact-card h2 {
            color: #80d0c7;
        }
        .contact-card p {
            font-size: 1rem;
            color: #4b6584;
            margin-bottom: 18px;
        }
        body.dark .contact-card p {
            color: #80d0c7;
        }
        .contact-info {
            font-size: 1.07rem;
            color: #2141c2;
        }
        body.dark .contact-info {
            color: #80d0c7;
        }
        /* Dark mode styles */
        body.dark {
            background: linear-gradient(135deg, #232a3d 0%, #273c47 100%);
            color: #e0e7ef;
        }
        body.dark .navbar {
            background: #232a3f;
        }
        body.dark .navbar-links a {
            color: #e0e7ef;
        }
        body.dark .navbar-links a.active,
        body.dark .navbar-links a:hover {
            background: #80d0c7;
            color: #232a3d;
        }
        body.dark .brand {
            color: #80d0c7;
        }
        body.dark .role-card {
            background: #232a3f;
            color: #e0e7ef;
            border-color: #80d0c7;
        }
        body.dark .role-icon,
        body.dark .role-title {
            color: #80d0c7;
        }
        body.dark .role-link {
            background: linear-gradient(90deg, #80d0c7 0%, #2141c2 100%);
            color: #232a3d;
        }
        body.dark .role-link:hover,
        body.dark .role-link:focus {
            background: linear-gradient(90deg, #2141c2 0%, #80d0c7 100%);
            color: #fff;
        }
        /* Responsive design */
        @media (max-width: 1200px) {
            .navbar {
                padding-left: 3vw;
                padding-right: 3vw;
            }
            .card-container {
                gap: 1.2rem;
            }
        }
        @media (max-width: 900px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
                padding: 10px 2vw;
            }
            .navbar-links {
                width: 100%;
                justify-content: flex-start;
                gap: 7px;
            }
            .brand {
                font-size: 2rem;
            }
            .card-container {
                flex-wrap: wrap;
                gap: 1rem;
            }
        }
        @media (max-width: 650px) {
            .navbar {
                flex-direction: column;
                gap: 10px;
                padding: 8px 1vw;
                border-radius: 0 0 14px 14px;
                align-items: flex-start;
            }
            .navbar .logo {
                font-size: 1.1rem;
            }
            .navbar-links {
                flex-direction: column;
                width: 100%;
                gap: 4px;
                align-items: flex-start;
            }
            .brand {
                font-size: 1.3rem;
            }
            .subtitle {
                font-size: 1rem;
            }
            .card-container {
                flex-direction: column;
                align-items: center;
                gap: 1.2rem;
                margin-top: 20px;
            }
            .role-card {
                width: 95vw;
                min-width: unset;
                max-width: 350px;
                padding: 18px 10px 14px 10px;
            }
        }
        @media (max-width: 400px) {
            .brand {
                font-size: 1rem;
            }
            .card-container {
                gap: 0.5rem;
            }
            .role-card {
                padding: 9px 4px 8px 4px;
            }
            .subtitle {
                font-size: 0.92rem;
            }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('.navbar-links a');
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    links.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                    const href = this.getAttribute('href');
                    if(href && href.startsWith('#')) {
                        e.preventDefault();
                        document.querySelector(href).scrollIntoView({ behavior: 'smooth' });
                    }
                });
            });
            // Dark mode toggle
            const darkToggleBtn = document.getElementById('darkToggleBtn');
            const darkIcon = document.getElementById('darkIcon');
            function setDarkMode(on) {
                const navbarDarkIcon = document.getElementById('navbarDarkIcon');
                if (on) {
                    document.body.classList.add('dark');
                    darkIcon.innerHTML = '&#9790;';
                    if(navbarDarkIcon) navbarDarkIcon.innerHTML = '&#9790;';
                    localStorage.setItem('studysphere-darkmode', 'on');
                } else {
                    document.body.classList.remove('dark');
                    darkIcon.innerHTML = '&#9788;';
                    if(navbarDarkIcon) navbarDarkIcon.innerHTML = '&#9788;';
                    localStorage.setItem('studysphere-darkmode', 'off');
                }
            }
            const navbarDarkBtn = document.getElementById('navbarDarkBtn');
            const navbarDarkIcon = document.getElementById('navbarDarkIcon');
            (function() {
                const saved = localStorage.getItem('studysphere-darkmode');
                if (
                    (saved === 'on') ||
                    (saved === null && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)
                ) {
                    setDarkMode(true);
                }
            })();
            if(navbarDarkBtn && navbarDarkIcon) {
                navbarDarkBtn.onclick = function() {
                    setDarkMode(!document.body.classList.contains('dark'));
                };
            }
            if(darkToggleBtn) {
                darkToggleBtn.onclick = function() {
                    setDarkMode(!document.body.classList.contains('dark'));
                }
            }
        });
    </script>
</head>
<body>
    <!-- Dark mode toggle button (top right, hidden on small screens) -->
    <button class="dark-toggle" id="darkToggleBtn" aria-label="Toggle dark mode" title="Toggle dark mode" style="display: none;">
        <span id="darkIcon">&#9788;</span>
    </button>
    <!-- Animated Stationery SVGs (many instances) -->
    <div class="bg-anim" aria-hidden="true">
        <!-- Books (10) -->
        <svg class="stationery book1" viewBox="0 0 80 65"><rect x="8" y="10" width="62" height="45" rx="7" fill="#2141c2"/><rect x="14" y="16" width="50" height="32" rx="4" fill="#fff"/><rect x="31" y="18" width="4" height="28" rx="1.5" fill="#26d0ce"/><rect x="46" y="18" width="4" height="28" rx="1.5" fill="#26d0ce"/></svg>
        <svg class="stationery book2" viewBox="0 0 65 55"><rect x="7" y="10" width="51" height="36" rx="6" fill="#26d0ce"/><rect x="13" y="16" width="39" height="24" rx="4" fill="#fff"/></svg>
        <svg class="stationery book3" viewBox="0 0 70 58"><rect x="8" y="10" width="54" height="38" rx="7" fill="#2141c2"/><rect x="14" y="16" width="42" height="25" rx="4" fill="#fff"/></svg>
        <svg class="stationery book4" viewBox="0 0 50 45"><rect x="6" y="9" width="38" height="27" rx="5" fill="#26d0ce"/><rect x="11" y="13" width="28" height="17" rx="3" fill="#fff"/></svg>
        <svg class="stationery book5" viewBox="0 0 60 54"><rect x="9" y="11" width="42" height="32" rx="6" fill="#2141c2"/><rect x="13" y="15" width="34" height="22" rx="4" fill="#fff"/></svg>
        <svg class="stationery book6" viewBox="0 0 60 54"><rect x="9" y="11" width="42" height="32" rx="6" fill="#26d0ce"/><rect x="13" y="15" width="34" height="22" rx="4" fill="#fff"/></svg>
        <svg class="stationery book7" viewBox="0 0 55 54"><rect x="9" y="11" width="36" height="32" rx="6" fill="#2141c2"/><rect x="13" y="15" width="28" height="22" rx="4" fill="#fff"/></svg>
        <svg class="stationery book8" viewBox="0 0 60 54"><rect x="9" y="11" width="42" height="32" rx="6" fill="#26d0ce"/><rect x="13" y="15" width="34" height="22" rx="4" fill="#fff"/></svg>
        <svg class="stationery book9" viewBox="0 0 65 55"><rect x="7" y="10" width="51" height="36" rx="6" fill="#2141c2"/><rect x="13" y="16" width="39" height="24" rx="4" fill="#fff"/></svg>
        <svg class="stationery book10" viewBox="0 0 55 54"><rect x="9" y="11" width="36" height="32" rx="6" fill="#26d0ce"/><rect x="13" y="15" width="28" height="22" rx="4" fill="#fff"/></svg>
        <!-- Copies (5) -->
        <svg class="stationery copy1" viewBox="0 0 65 70"><rect x="7" y="10" width="51" height="46" rx="6" fill="#26d0ce"/><rect x="13" y="16" width="39" height="34" rx="4" fill="#fff"/><line x1="20" y1="24" x2="45" y2="24" stroke="#2141c2" stroke-width="2"/><line x1="20" y1="32" x2="45" y2="32" stroke="#2141c2" stroke-width="2"/></svg>
        <svg class="stationery copy2" viewBox="0 0 55 60"><rect x="6" y="9" width="39" height="38" rx="5" fill="#26d0ce"/><rect x="10" y="13" width="29" height="24" rx="3" fill="#fff"/></svg>
        <svg class="stationery copy3" viewBox="0 0 50 48"><rect x="5" y="8" width="32" height="28" rx="5" fill="#26d0ce"/><rect x="9" y="12" width="24" height="16" rx="3" fill="#fff"/></svg>
        <svg class="stationery copy4" viewBox="0 0 50 48"><rect x="5" y="8" width="32" height="28" rx="5" fill="#2141c2"/><rect x="9" y="12" width="24" height="16" rx="3" fill="#fff"/></svg>
        <svg class="stationery copy5" viewBox="0 0 55 60"><rect x="6" y="9" width="39" height="38" rx="5" fill="#2141c2"/><rect x="10" y="13" width="29" height="24" rx="3" fill="#fff"/></svg>
        <!-- Pencils (4) -->
        <svg class="stationery pencil1" viewBox="0 0 65 65"><rect x="15" y="20" width="10" height="35" rx="4" fill="#2141c2"/><polygon points="15,20 25,10 35,20" fill="#f7ca88"/><rect x="25" y="20" width="10" height="35" rx="4" fill="#26d0ce"/><polygon points="35,20 45,10 55,20" fill="#f7ca88"/></svg>
        <svg class="stationery pencil2" viewBox="0 0 40 40"><rect x="7" y="12" width="7" height="22" rx="2" fill="#2141c2"/><polygon points="7,12 14,4 21,12" fill="#f7ca88"/></svg>
        <svg class="stationery pencil3" viewBox="0 0 40 40"><rect x="8" y="10" width="7" height="22" rx="2" fill="#26d0cce"/><polygon points="8,10 12,3 17,10" fill="#f7ca88"/></svg>
        <svg class="stationery pencil4" viewBox="0 0 45 45"><rect x="10" y="10" width="8" height="20" rx="2" fill="#2141c2"/><polygon points="10,10 14,5 18,10" fill="#f7ca88"/></svg>
        <!-- Pens (4) -->
        <svg class="stationery pen1" viewBox="0 0 75 75"><rect x="20" y="15" width="10" height="45" rx="5" fill="#80d0c7"/><rect x="30" y="15" width="10" height="45" rx="5" fill="#2141c2"/><ellipse cx="25" cy="60" rx="7" ry="5" fill="#334443"/></svg>
        <svg class="stationery pen2" viewBox="0 0 40 50"><rect x="9" y="8" width="7" height="28" rx="3" fill="#2141c2"/><ellipse cx="12" cy="36" rx="5" ry="3" fill="#334443"/></svg>
        <svg class="stationery pen3" viewBox="0 0 40 50"><rect x="8" y="8" width="7" height="28" rx="3" fill="#26d0ce"/><ellipse cx="11" cy="36" rx="5" ry="3" fill="#334443"/></svg>
        <svg class="stationery pen4" viewBox="0 0 45 55"><rect x="10" y="12" width="8" height="35" rx="3" fill="#2141c2"/><ellipse cx="14" cy="47" rx="6" ry="3" fill="#334443"/></svg>
        <!-- Erasers (4) -->
        <svg class="stationery eraser1" viewBox="0 0 52 34"><rect x="6" y="8" width="40" height="18" rx="7" fill="#faeab1"/><rect x="29" y="12" width="11" height="10" rx="3" fill="#2141c2"/></svg>
        <svg class="stationery eraser2" viewBox="0 0 38 20"><rect x="2" y="3" width="28" height="12" rx="4" fill="#faeab1"/><rect x="20" y="6" width="8" height="6" rx="2" fill="#2141c2"/></svg>
        <svg class="stationery eraser3" viewBox="0 0 38 20"><rect x="2" y="3" width="28" height="12" rx="4" fill="#2141c2"/><rect x="20" y="6" width="8" height="6" rx="2" fill="#faeab1"/></svg>
        <svg class="stationery eraser4" viewBox="0 0 42 18"><rect x="6" y="4" width="28" height="8" rx="4" fill="#faeab1"/><rect x="24" y="6" width="8" height="6" rx="2" fill="#2141c2"/></svg>
        <!-- Rulers (4) -->
        <svg class="stationery ruler1" viewBox="0 0 75 20"><rect x="8" y="5" width="60" height="10" rx="3" fill="#faeab1"/><rect x="15" y="7" width="2" height="6" fill="#2141c2"/><rect x="25" y="7" width="2" height="6" fill="#2141c2"/><rect x="35" y="7" width="2" height="6" fill="#2141c2"/><rect x="45" y="7" width="2" height="6" fill="#2141c2"/><rect x="55" y="7" width="2" height="6" fill="#2141c2"/></svg>
        <svg class="stationery ruler2" viewBox="0 0 55 15"><rect x="5" y="4" width="40" height="7" rx="2" fill="#faeab1"/><rect x="10" y="5" width="2" height="5" fill="#2141c2"/><rect x="18" y="5" width="2" height="5" fill="#2141c2"/></svg>
        <svg class="stationery ruler3" viewBox="0 0 50 12"><rect x="6" y="3" width="36" height="6" rx="2" fill="#2141c2"/><rect x="10" y="4" width="2" height="4" fill="#faeab1"/></svg>
        <svg class="stationery ruler4" viewBox="0 0 45 8"><rect x="4" y="2" width="30" height="4" rx="1.5" fill="#faeab1"/><rect x="12" y="3" width="1.5" height="3" fill="#2141c2"/></svg>
    </div>
    <nav class="navbar">
        <div class="logo">📚 Study-Sphere</div>
        <div class="navbar-links">
            <a href="#home" class="active">Home</a>
            <a href="#login">Login</a>
            <a href="#contact">Contact</a>
            <span class="navbar-darkmode">
                <button id="navbarDarkBtn" aria-label="Toggle dark mode" title="Toggle dark mode">
                    <span id="navbarDarkIcon">&#9788;</span>
                </button>
            </span>
        </div>
    </nav>
    <!-- Home Section -->
    <section id="home">
        <header>
            <div class="brand">STUDY-SPHERE</div>
            <div class="subtitle">From classroom to your screen – download your notes effortlessly!</div>
        </header>
    </section>
    <!-- Login Section -->
    <section id="login">
        <div class="card-container">
            <div class="role-card">
                <div class="role-icon">👩‍🏫</div>
                <div class="role-title">Teacher</div>
                <a class="role-link" href="b2.php">Enter as Teacher</a>
            </div>
            <div class="role-card">
                <div class="role-icon">🧑‍🎓</div>
                <div class="role-title">Student</div>
                <a class="role-link" href="b6.php">Enter as Student</a>
            </div>
        </div>
    </section>
    <!-- Contact Section -->
    <section id="contact">
        <div class="section-title">Contact Us</div>
        <div class="contact-card">
            <h2>Get in Touch</h2>
            <p>For any queries, feedback, or support, reach out to us.</p>
            <div class="contact-info">
                <strong>Email:</strong> <a href="mailto:studysphere@example.com">studysphere@example.com</a><br>
                <strong>Phone:</strong> +91-98765-43210<br>
                <strong>Address:</strong> 123 Study Lane, Knowledge City, India
            </div>
        </div>
    </section>
</body>
</html>