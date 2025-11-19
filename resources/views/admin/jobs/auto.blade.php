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
                        <label for="slug">Slug:</label>
                        <input id='jobID' name="jobID" type="text" value="{{ $j->id }}" hidden>
                        <input id='slug' name="slug" type="text" value="{{ $j->slug }}" readonly>
                        <a href="{{ route('job-single', ['slug' => $j->slug]) }}" target="_blank"
                            title="{{ $j->title }}" class="aply-btn">See More</a>
                        <button class="head-btn" data-job_id="{{ $j->id }}">Head</button>
                        <button id="fb-btn" class="fb-btn" data-job_id="{{ $j->id }}">FB</button>
                        <button id="generate-btn" class="generate-btn"
                            data-job_id="{{ $j->id }}">Generate</button>

                    </div>
                    <div class="info-item">
                        <label for="title">Title:</label>
                        <!-- <input id='title_{{ $j->id }}' name="title" type="text" value="{{ $j->title }}"> -->
                        <input id='title_{{ $j->id }}' name="title" type="text"
                            value="{{ $j->title }}" style="width: 550px; font-size: 18px; padding: 2px;">
                        <input hidden id='department_{{ $j->id }}' name="department" type="text"
                            value="{{ $j->department }}" style="width: 400px; font-size: 18px; padding: 2px;">
                        <input hidden id='url_{{ $j->id }}' name="department" type="text"
                            value="{{ $j->slug }}" style="width: 400px; font-size: 18px; padding: 2px;">
                    </div>

                    <div class="info-item">
                        <label for="meta_description">Meta Description:</label>

                        <input id='meta_description_{{ $j->id }}' name="meta_description" type="text"
                            value="{{ $j->meta_description }}" style="width: 400px; font-size: 18px; padding: 2px;">
                    </div>

                    <div class="info-item">
                        <label for="meta_keywords">Meta Keywords:</label>
                        <!-- <input id='meta_keywords_{{ $j->id }}' name="meta_keywords" type="text" value="{{ $j->meta_keywords }}"> -->
                        <input id='meta_keywords_{{ $j->id }}' name="meta_keywords" type="text"
                            value="{{ $j->meta_keywords }}" style="width: 400px; font-size: 18px; padding: 2px;">
                    </div>
                    <!-- <button class="save-btn" data-job_id="{{ $j->id }}">Save</button> -->
                    <button class="save-btn" data-job_id="{{ $j->id }}"
                        style="font-size: 20px; padding: 10px 20px; width: 150px;">Save</button>
                </div>
            </div>
        @endforeach

        <a class="prev" onclick="plusSlides(-1)">❮</a>
        <a class="next" onclick="plusSlides(1)">❯</a>
        <input type="text" id="inputField" placeholder="Press delete key">
    </div>
    <br>

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
            //  setTimeout(function() {
            //             document.querySelector('.generate-btn').click();
            //         }, 3000); // 2000 milliseconds = 2 seconds
        }

        // Function to navigate to a specific slide
        function currentSlide(n) {
            showSlides(slideIndex = n);
        }


        showSlides(slideIndex);

        $(document).ready(function() {
            // var job_id = "123"; // Replace this with actual job_id from loop or DOM
            // var id = $(this).attr("data-job_id");
            // var id = $(this).attr("data-job_id");
            var id = $('#jobID').val();

            console.log(id);


             setTimeout(function() {
                      generateMeta(id);
                    }, 4000);
        });

        function generateMeta(job_id) {
            var title = $("#title_" + job_id).val();
            var meta_description = $("#meta_description_" + job_id).val();
            var meta_keywords = $("#meta_keywords_" + job_id).val();

                    console.log("Job ID:", job_id);
                    console.log("Title:", title);
                    console.log("Description:", meta_description);
                    console.log("Keywords:", meta_keywords);

            $('#title_' + job_id).val('');
            $('#meta_description_' + job_id).val('');
            $('#meta_keywords_' + job_id).val('');
            $('.generate-btn').text('Loading...');

            $.ajax({
                url: "{{ route('admin.job.generate') }}", // Laravel route
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: job_id,
                    title: title,
                    meta_description: meta_description,
                    meta_keywords: meta_keywords
                },
                success: function(response) {
                    $('.generate-btn').text('Generate');

                    if (response.success) {
                        $('#title_' + job_id).val(response.title);
                        $('#meta_description_' + job_id).val(response.description);
                        $('#meta_keywords_' + job_id).val(response.keywords);
                        console.log("--------------------------------------------------");
                        console.log("Title:", response.title);
                        console.log("Description:", response.description);
                        console.log("Keywords:", response.keywords);
                        // ✅ Auto Save after 2 seconds
                        setTimeout(function() {
                            $('.save-btn[data-job_id="' + job_id + '"]').click();
                        }, 2000);
                    } else {
                        console.log("Error:", response.error);
                    }
                },

                error: function(xhr) {
                    alert(xhr);
                    console.log(xhr);

                      location.reload();
                }
            });
        }




        $(document).on("click", ".save-btn", function() {
            var job_id = $(this).attr("data-job_id");
            $('.save-btn').text('Loading...');

            // var slug = $("#slug_" + job_id).val();
            var title = $("#title_" + job_id).val();
            var meta_description = $("#meta_description_" + job_id).val();
            var meta_keywords = $("#meta_keywords_" + job_id).val();

            $.ajax({

                url: "{{ route('admin.job.updatetwo') }}", // Laravel route
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: job_id,
                    title: title,
                    meta_description: meta_description,
                    meta_keywords: meta_keywords
                },
                success: function(response) {
                    $('.save-btn').text('Save');
                    setTimeout(function() {
                        // document.querySelector('.next').click();
                        location.reload();
                    }, 2000); // 2000 milliseconds = 2 seconds
                    // alert("Job details updated successfully!");
                },
                error: function(xhr) {
                    var response = JSON.parse(xhr.responseText);
                    console.log(response.message);

                    $('.save-btn').text('Save');
                    location.reload();
                    //  document.querySelector('.generate-btn').click();

                    //  return false;

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
                    let contentToCopy =
                        "Write me an SEO friendly content on this data. the articel should be human friendly, it should not seem like it is written by AI, and should be 100% unique and 0% plaglarims free, which get ranked in Google also. write only title Description and keyword \n\n"; // 🎯 Sabse pehle ye line likh raha hai

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

                    // Get the title and department values using their IDs
                    let contentToCopy =
                        "High Ranking Fb post on fb post Hashtags\n\n"; // 🎯 Sabse pehle ye line likh raha hai

                    const title = document.getElementById(`title_${jobId}`).value;
                    const department = document.getElementById(`department_${jobId}`).value;
                    const url = document.getElementById(`url_${jobId}`).value;
                    const staticUrl = "https://thejobz.pk/job-single/";
                    const fullUrl = staticUrl + url;
                    // Combine the title and department into one text to copy
                    const textToCopy =
                        `${contentToCopy}\nTitle: ${title}\nDepartment: ${department}\nApply Now: ${fullUrl}`;
                    // Create a temporary textarea element to copy the text
                    const tempTextArea = document.createElement("textarea");
                    tempTextArea.value = textToCopy;
                    document.body.appendChild(tempTextArea);
                    tempTextArea.select();
                    document.execCommand("copy");
                    document.body.removeChild(tempTextArea);

                    // Show an alert indicating the copy was successful
                    // alert("Copied to clipboard! ✅");
                } catch (err) {
                    console.error("Failed to copy: ", err);
                    alert("Failed to copy! ❌");
                }
            }
        });
    </script>



</body>

</html>
