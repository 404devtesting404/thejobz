<!DOCTYPE html>
<html>
<head>
    <title>Generate Text with Cohere</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; padding: 30px; background-color: #f9f9f9; }
        textarea, input[type="submit"] {
            width: 100%; padding: 10px; margin-top: 10px;
        }
        .response-box {
            background: #fff;
            padding: 20px;
            margin-top: 20px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>

    <h2>Generate AI Text using Cohere</h2>

    <form id="textForm">
        <label for="prompt">Enter Prompt:</label>
        <textarea id="prompt" name="prompt" rows="5" placeholder="Type your prompt here..."></textarea>
        <input type="submit" value="Generate">
    </form>

    <div class="response-box" id="result" style="display:none;">
        <h4>Generated Text:</h4>
        <div id="output"></div>
    </div>

    <script>
        document.getElementById('textForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const prompt = document.getElementById('prompt').value;

            const response = await fetch('/generate-text', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ prompt })
            });

            const data = await response.json();

            const outputDiv = document.getElementById('output');
            const resultBox = document.getElementById('result');

            if (data.generations && data.generations.length > 0) {
                outputDiv.innerText = data.generations[0].text;
                resultBox.style.display = 'block';
            } else {
                outputDiv.innerText = 'No response generated.';
                resultBox.style.display = 'block';
            }
        });
    </script>

</body>
</html>
