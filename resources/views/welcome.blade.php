<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('imgs/logo-sm.png') }}">

    <title>SOFTMAKING</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway&family=Roboto&display=swap" rel="stylesheet">
    <link href="css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>
</head>

<body>
    <div id="app">

    <script>

        function toggleElement(element) {
            document.getElementById(`${element}`).classList.toggle("hidden");
        }

       /*  let prevScrollpos = window.pageYOffset;
        window.onscroll = function() {
            let currentScrollPos = window.pageYOffset;
            if (prevScrollpos > currentScrollPos) {
                document.getElementById("navbar").style.top = "0";
            } else {
                document.getElementById("navbar").style.top = "-80px";
                let navbar_content = document.getElementById('nav-content');

                if(!navbar_content.classList.contains('hidden')) {
                    toggleElement('nav-content')
                }
            }
            prevScrollpos = currentScrollPos;
        } */
    </script>
</body>
<script src="{{ mix('js/app.js') }}"></script>

</html>
