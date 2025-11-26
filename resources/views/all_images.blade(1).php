{{-- resources/views/all_images.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Images Auto & Manual Download</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }
        .image-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 15px;
        }
        .image-card {
            background: #fff;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            text-align: center;
            transition: background 0.5s, transform 0.3s;
            cursor: pointer;
        }
        .image-card img {
            max-width: 100%;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
        }
        .image-card p {
            font-size: 12px;
            margin-top: 5px;
            word-break: break-all;
        }
        .downloaded {
            background-color: #d4edda !important; /* green shade */
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <h2>All Images (Auto & Manual Download)</h2>
    <div class="image-grid">
        @foreach($files as $file)
            <div class="image-card" data-file="{{ $file }}">
                <a href="{{ route('download.image', $file) }}" class="download-link">
                    <img src="{{ asset('storage/app/public/jobs/'.$file) }}" alt="{{ $file }}">
                </a>
                <p>{{ $file }}</p>
            </div>
        @endforeach
    </div>

    <script>
        const cards = document.querySelectorAll('.image-card');
        let index = 0;

        // Load previously downloaded files from localStorage
        const downloadedFiles = JSON.parse(localStorage.getItem('downloadedFiles') || '[]');
        downloadedFiles.forEach(file => {
            const card = document.querySelector(`.image-card[data-file='${file}']`);
            if(card) card.classList.add('downloaded');
        });

        // Auto download function
        function autoDownload() {
            if(index >= cards.length) index = 0;

            const card = cards[index];
            const link = card.querySelector('.download-link');
            const fileName = card.dataset.file;

            // Trigger download
            const tempLink = document.createElement('a');
            tempLink.href = link.href;
            tempLink.download = fileName;
            document.body.appendChild(tempLink);
            tempLink.click();
            document.body.removeChild(tempLink);

            markDownloaded(card, fileName);

            index++;
        }

        // Mark card as downloaded and save in localStorage
        function markDownloaded(card, fileName){
            card.classList.add('downloaded');
            if(!downloadedFiles.includes(fileName)){
                downloadedFiles.push(fileName);
                localStorage.setItem('downloadedFiles', JSON.stringify(downloadedFiles));
            }
        }

        // Manual click download
        cards.forEach(card => {
            card.querySelector('.download-link').addEventListener('click', (e)=>{
                e.preventDefault();
                const fileName = card.dataset.file;
                const link = e.currentTarget.href;

                const tempLink = document.createElement('a');
                tempLink.href = link;
                tempLink.download = fileName;
                document.body.appendChild(tempLink);
                tempLink.click();
                document.body.removeChild(tempLink);

                markDownloaded(card, fileName);
            });
        });

        // Auto download every 20 seconds
        setInterval(autoDownload, 10000);
    </script>
</body>
</html>
