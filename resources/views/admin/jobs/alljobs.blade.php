<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>title</title>
    <meta name="keywords" content="  " />
    <meta name="description" content=" " />
    <link rel="canonical" href="https://thejobz.pk/job-single/combined-military-hospital-cmh-peshawar-jobs-2025" />

    @yield('JSON_D_Schema')
</head>
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

    .head_test {
        display: block !important;
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
                    <span>Job ID:{{ $j->id }}</span>

                    <span data-job_id="{{ $j->id }}" data-job_img="{{ $j->img }}" id="delete">
                        Delete</span>
                </div>
                <div class="info-container">
                    <div class="info-item">
                        <a href="{{ route('job-single', ['slug' => $j->slug]) }}" target="_blank"
                            title="{{ $j->title }}" class="aply-btn">See More</a>
                        <button class="head-btn" data-job_id="{{ $j->id }}">Head</button>
                        <button id="fb-btn" class="fb-btn" data-job_id="{{ $j->id }}">FB </button>{{$j->facebook}}

                    </div>
                    <div class="info-item">
                        {{-- <label for="title">Title:</label>  --}}
                        {{--
                            <input hidden id='url_{{ $j->id }}' name="department" type="text"
                            value="{{ $j->slug }}" style="width: 400px; font-size: 18px; padding: 2px;"> --}}
                        <p id='title_2{{ $j->id }}' name="title" type="text">{{ $j->title }}</p>
                        <p id='city_{{ $j->id }}' name="city" type="text">{{ $j->city }}</p>
                        <p id='date_{{ $j->id }}' name="date" type="text">{{ $j->posted }}</p>

                    </div>
                    <div class="info-item" hidden>
                        <input id='title_{{ $j->id }}' name="title" type="text"
                            value="{{ $j->title }}" style="width: 400px; font-size: 18px; padding: 2px;">
                        <input hidden id='department_{{ $j->id }}' name="department" type="text"
                            value="{{ $j->department }}" style="width: 400px; font-size: 18px; padding: 2px;">
                        <input hidden id='url_{{ $j->id }}' name="slug" type="text"
                            value="{{ $j->slug }}" style="width: 400px; font-size: 18px; padding: 2px;">

                    </div>

                    <div class="info-item" hidden>
                        <label for="meta_description">Meta Description:</label>
                        <!-- <input id='meta_description_{{ $j->id }}' name="meta_description" type="text" value="{{ $j->meta_description }}"> -->
                        <input id='meta_description_{{ $j->id }}' name="meta_description" type="text"
                            value="{{ $j->meta_description }}" style="width: 400px; font-size: 18px; padding: 2px;">
                    </div>

                    <div class="info-item" hidden>
                        <label for="meta_keywords">Meta Keywords:</label>
                        <!-- <input id='meta_keywords_{{ $j->id }}' name="meta_keywords" type="text" value="{{ $j->meta_keywords }}"> -->
                        <input id='meta_keywords_{{ $j->id }}' name="meta_keywords" type="text"
                            value="{{ $j->meta_keywords }}" style="width: 400px; font-size: 18px; padding: 2px;">
                    </div>
                </div>
            </div>
        @endforeach

        <a class="prev" onclick="plusSlides(-1)">❮</a>
        <a class="next" onclick="plusSlides(1)">❯</a>
    </div>
    <br>

    <script>
        let slideIndex = 1;

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

            let activeSlide = slides[slideIndex - 1];
            let title = activeSlide.querySelector("input[name='title']").value;
            let metaDescription = activeSlide.querySelector("input[name='meta_description']").value;
            let metaKeywords = activeSlide.querySelector("input[name='meta_keywords']").value;

            // ✅ Update <title>
            document.title = title;

            // ✅ Function to update or create meta tag
            function updateMeta(name, content) {
                let meta = document.querySelector(`meta[name='${name}']`);
                if (meta) {
                    meta.setAttribute("content", content.trim());
                } else {
                    meta = document.createElement("meta");
                    meta.name = name;
                    meta.content = content.trim();
                    document.head.appendChild(meta);
                }
            }

            // ✅ Update meta tags
            updateMeta("description", metaDescription);
            updateMeta("keywords", metaKeywords);
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






        document.addEventListener("click", async function(event) {
            if (event.target.classList.contains("head-btn")) {
                try {
                    // ✅ Get <title> tag
                    let titleTag = document.head.querySelector("title");

                    // ✅ Get specific <meta> tags
                    let metaDescription = document.head.querySelector("meta[name='description']");
                    let metaKeywords = document.head.querySelector("meta[name='keywords']");

                    // ✅ Prepare content to copy
                    let contentToCopy = "High Ranking SEO\n\n"; // 🎯 Sabse pehle ye line likh raha hai

                    // ✅ Ensure <title> is copied
                    let pageTitle = document.title;
                    if (titleTag) {
                        contentToCopy += titleTag.outerHTML + "\n";
                    } else if (pageTitle) {
                        contentToCopy += `<title>${pageTitle}</title>\n`;
                    }

                    if (metaDescription) {
                        contentToCopy += metaDescription.outerHTML + "\n";
                    }
                    if (metaKeywords) {
                        contentToCopy += metaKeywords.outerHTML + "\n";
                    }

                    // ✅ Copy filtered content to clipboard
                    await navigator.clipboard.writeText(contentToCopy);

                    // alert("High Ranking SEO + Title, Meta Tags copied successfully! ✅");
                } catch (err) {
                    console.error("Failed to copy: ", err);
                    alert("Failed to copy! ❌");
                }
            }
        });

       document.addEventListener("click", async function(event) {
            if (event.target.classList.contains("fb-btn")) {
                try {
                    // Get the job ID from the button's data attribute
                    const jobId = event.target.getAttribute("data-job_id");
        
                    // Get the title, department, and url dynamically based on the jobId
                    const title = document.getElementById(`title_2${jobId}`).innerText;
                    const department = document.getElementById(`department_${jobId}`) ? document.getElementById(
                        `department_${jobId}`).value : '';
                    const url = document.getElementById(`url_${jobId}`) ? document.getElementById(
                        `url_${jobId}`).value : '';
        
                    // Prepare content to copy
                    let contentToCopy = "High Ranking Fb post on fb post Hashtags\n\n";
                    contentToCopy += `Title: ${title}\nDepartment: ${department}\nApply Now: https://thejobz.pk/job-single/${url}\n\n`;
        
                    // WhatsApp channel link add karein
                    contentToCopy += "📢 Follow karein hamara WhatsApp channel aur paayein instant job alerts:\n";
                    contentToCopy += "👉 https://www.whatsapp.com/channel/0029VatdEVhEquiMEWJ1Ex1t";
        
                    // Create a temporary textarea element to copy the text
                    const tempTextArea = document.createElement("textarea");
                    tempTextArea.value = contentToCopy;
                    document.body.appendChild(tempTextArea);
                    tempTextArea.select();
                    document.execCommand("copy");
                    document.body.removeChild(tempTextArea);
        
                    // Update job fb status in backend
                    $.ajax({
                        url: "{{ route('admin.job.updatefb') }}", // Laravel route
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: jobId
                        },
                        success: function(response) {
                            // console.log("Job details updated successfully!");
                        },
                        error: function(xhr) {
                            alert("Error updating job details.");
                        }
                    });
                } catch (err) {
                    console.error("Failed to copy: ", err);
                    alert("Failed to copy! ❌");
                }
            }
        });

    </script>



</body>

</html>
