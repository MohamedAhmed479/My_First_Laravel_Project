<head>
    <meta charset="UTF-8">
    <title>Congratulations and Order Details</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f06, #4a90e2);
            color: #fff;
            overflow: hidden;
        }

        /* شاشة التحميل */
        .loading-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #fff;
        }

        .hidden {
            display: none;
        }

        #congratulations {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            position: relative;
            flex-direction: column;
        }

        #order-details {
            display: none;
            padding: 20px;
            background: rgba(0, 0, 0, 0.8);
            border-radius: 10px;
            margin: auto;
            width: 80%;
            max-width: 600px;
            text-align: center;
        }

        .shape {
            width: 50px;
            height: 50px;
            background-color: #f39c12;
            position: absolute;
            animation: flyingShapes 10s linear infinite;
        }

        .shape.circle {
            border-radius: 50%;
            background-color: #3498db;
        }

        .shape.square {
            background-color: #2ecc71;
        }

        .shape.triangle {
            width: 0;
            height: 0;
            border-left: 25px solid transparent;
            border-right: 25px solid transparent;
            border-bottom: 50px solid #e74c3c;
        }

        @keyframes flyingShapes {
            0% {
                transform: translateY(100vh) rotate(0deg);
            }

            100% {
                transform: translateY(-100vh) rotate(360deg);
            }
        }

        h1 {
            font-size: 3em;
            margin: 20px 0;
        }

        h2 {
            font-size: 2em;
            margin-bottom: 10px;
        }

        p {
            font-size: 1.2em;
            margin: 5px 0;
        }

        .download-btn {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 1.2em;
            background-color: #4a90e2;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .download-btn:hover {
            background-color: #357abd;
        }

        .back-btn {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 1.2em;
            background-color: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-btn:hover {
            background-color: #c0392b;
        }

        /* Animation and SVG Loading Styles */
        .ip {
            width: 16em;
            height: 8em;
        }

        .ip__track {
            stroke: hsl(var(--hue), 90%, 90%);
        }

        .ip__worm1,
        .ip__worm2 {
            animation: worm1 2s linear infinite;
        }

        .ip__worm2 {
            animation-name: worm2;
        }

        @keyframes worm1 {
            from {
                stroke-dashoffset: 0;
            }

            50% {
                animation-timing-function: steps(1);
                stroke-dashoffset: -358;
            }

            to {
                stroke-dashoffset: 0;
            }
        }

        @keyframes worm2 {
            from {
                stroke-dashoffset: 358;
            }

            50% {
                stroke-dashoffset: 0;
            }

            to {
                stroke-dashoffset: -358;
            }
        }
    </style>
</head>

<body>
    <!-- شاشة التحميل -->
    <div class="loading-container" id="loading-screen">
        <svg class="ip" viewBox="0 0 256 128" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <linearGradient id="grad1" x1="0" y1="0" x2="1" y2="0">
                    <stop offset="0%" stop-color="#5ebd3e" />
                    <stop offset="33%" stop-color="#ffb900" />
                    <stop offset="67%" stop-color="#f78200" />
                    <stop offset="100%" stop-color="#e23838" />
                </linearGradient>
                <linearGradient id="grad2" x1="1" y1="0" x2="0" y2="0">
                    <stop offset="0%" stop-color="#e23838" />
                    <stop offset="33%" stop-color="#973999" />
                    <stop offset="67%" stop-color="#009cdf" />
                    <stop offset="100%" stop-color="#5ebd3e" />
                </linearGradient>
            </defs>
            <g fill="none" stroke-linecap="round" stroke-width="16">
                <g class="ip__track" stroke="#ddd">
                    <path d="M8,64s0-56,60-56,60,112,120,112,60-56,60-56" />
                    <path d="M248,64s0-56-60-56-60,112-120,112S8,64,8,64" />
                </g>
                <g stroke-dasharray="180 656">
                    <path class="ip__worm1" stroke="url(#grad1)" stroke-dashoffset="0"
                        d="M8,64s0-56,60-56,60,112,120,112,60-56,60-56" />
                    <path class="ip__worm2" stroke="url(#grad2)" stroke-dashoffset="358"
                        d="M248,64s0-56-60-56-60,112-120,112S8,64,8,64" />
                </g>
            </g>
        </svg>
    </div>

    <!-- صفحة التهنئة وتفاصيل الطلب -->
    <div id="congratulations" class="hidden">
        <div class="shape circle" style="left: 10%; top: 90%; animation-duration: 8s;"></div>
        <div class="shape square" style="left: 30%; top: 90%; animation-duration: 9s;"></div>
        <div class="shape triangle" style="left: 50%; top: 90%; animation-duration: 10s;"></div>
        <div class="shape circle" style="left: 70%; top: 90%; animation-duration: 7s;"></div>
        <div class="shape square" style="left: 90%; top: 90%; animation-duration: 6s;"></div>
        <h1>Congratulations!</h1>
    </div>


    <script>
        // عرض شاشة التحميل أولاً
        setTimeout(() => {
            // إخفاء شاشة التحميل وعرض التهنئة
            document.getElementById('loading-screen').style.display = 'none';
            document.getElementById('congratulations').classList.remove('hidden');

            // تحديد مدة عرض التهنئة قبل إعادة التوجيه
            setTimeout(() => {
                // تغيير 'your-target-page.html' إلى عنوان الصفحة التي تريد إعادة التوجيه إليها
                window.location.href = '/';
            }, 1000); // مدة 3 ثوانٍ للتهنئة
        }, 4000); // مدة 5 ثوانٍ لشاشة التحميل
    </script>
</body>

</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
