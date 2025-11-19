<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box
        }

        body {
            font-family: Verdana, sans-serif;
            margin: 0
        }

        .mySlides {
            display: none
        }

        img {
            vertical-align: middle;
        }

        /* Slideshow container */
        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
        }

        /* Next & previous buttons */
        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Caption text */
        .text {
            color: #f2f2f2;
            font-size: 15px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
        }

        /* Number text (1/3 etc) */
        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        /* The dots/bullets/indicators */
        .dot {
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active,
        .dot:hover {
            background-color: #717171;
        }

        .prev {
            background-color: #000;
        }

        .next {
            background-color: #000;
        }

        img {
            width: 700px !important;
            height: 600px !important;
            transition: transform 0.3s;
            /* Add a smooth transition */
        }

        /* Fading animation */
        .fade {
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @keyframes fade {
            from {
                opacity: .4
            }

            to {
                opacity: 1
            }
        }

        /* On smaller screens, decrease text size */
        @media only screen and (max-width: 300px) {

            .prev,
            .next,
            .text {
                font-size: 11px
            }
        }

        .text {
            color: #000 !important;
            font-size: 15px;
            font-weight: bold;
            padding: 5px;
        }

        .text span {
            border: 1px solid white;
            background-color: #fff !important;
            padding: 2px;
            /* Optional: Add padding to ensure the border doesn't overlap with the text */
        }
    </style>
</head>

<body>

    <div class="slideshow-container">
        @php
            $total = count($jobs);
        @endphp
        @foreach ($jobs as $key => $j)
            <div class="mySlides fade">
                <img src="{{ asset('storage/app/public/jobs/') . '/' . $j->img }}" style="width:100%" class="zoom-img">
                <div class="text">
                    <span>Total {{ $total }} This: {{ $key }}</span>
                    <span>Job ID:{{  $j->id }}</span>
                    <span data-job_id="{{ $j->id }}" data-job_img="{{ $j->img }}" id="delete">
                        Delete</span>
                </div>
            </div>
        @endforeach



        <a class="prev" onclick="plusSlides(-1)">❮</a>
        <a class="next" onclick="plusSlides(1)">❯</a>
        <input type="text" id="inputField" placeholder="Press delete key">
    </div>
    <br>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script>
        // Declare the slideIndex variable only once
        let slideIndex = 1;

        // Function to show slides
        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {
                slideIndex = 1;
            }
            if (n < 1) {
                slideIndex = slides.length;
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            // dots[slideIndex - 1].className += " active";
        }


        // Function to navigate to the next or previous slide
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        // Function to navigate to a specific slide
        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        // Function to zoom image
        function zoomImage() {
            let img = document.querySelector('.mySlides.fade .zoom-img');
            img.style.transform = 'scale(1.2)'; // Increase the scale to zoom in
        }

        // Function to unzoom image
        function unzoomImage() {
            let img = document.querySelector('.mySlides.fade .zoom-img');
            img.style.transform = 'scale(1)'; // Reset the scale to unzoom
        }

        // Add event listener for scroll
        document.addEventListener('wheel', function(event) {
            // Check if the event is triggered inside the slideshow container
            if (event.target.closest('.slideshow-container')) {
                // Check if the event is a scroll up or down
                if (event.deltaY > 0) {
                    // Scroll down, unzoom
                    unzoomImage();
                } else {
                    // Scroll up, zoom
                    zoomImage();
                }
                // Prevent default scroll behavior
                event.preventDefault();
            }
        }, {
            passive: false
        }); // Set passive option to false


        // Initial call to showSlides
        showSlides(slideIndex);

        $(document).on('click', '#delete', function() {
            var id = $(this).attr("data-job_id");
            var img = $(this).attr("data-job_img");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.job.delete_two') }}",
                method: 'GET',
                data: {
                    id: id,
                    img: img,
                    "_token": "{{ csrf_token() }}",
                },
                success: function() {
                    // alert('Jobs deleted successfully');
                    // toastr.success('Jobs deleted successfully');
                    // location.reload();
                }
            });
            // });
        });

        $(document).ready(function() {
            $(document).keydown(function(event) {
                console.log('Keydown event detected'); // Debugging line
                console.log('Key code:', event.which); // Debugging line
                if (event.which === 46) { // 46 is the key code for the delete key
                    // alert('Delete key pressed!');
                    $("#delete").trigger("click");
                }
                if (event.which === 39) { // 46 is the key code for the delete key
                    // alert('Delete key pressed!');
                    $(".next").trigger("click");
                }
                if (event.which === 37) { // 46 is the key code for the delete key
                    // alert('Delete key pressed!');
                    $(".prev").trigger("click");
                }
            });
        });
    </script>

</body>

</html>
