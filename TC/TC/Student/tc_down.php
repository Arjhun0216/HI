<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download PDF</title>
</head>
<body>
    <h1>Transfer Certificate</h1>
    <p>The PDF has been generated successfully.</p>
    <button id="downloadButton">Download PDF</button>

    <script>
        document.getElementById('downloadButton').addEventListener('click', function() {
            const filename = "<?php echo $filename; ?>";
            const filePath = "<?php echo 'generated_pdfs/' . $filename; ?>";
            window.location.href = filePath;
        });
    </script>
</body>
</html>
