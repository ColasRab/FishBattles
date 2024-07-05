<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yu-Gi-Oh Card Field</title>
    <style>
        .battlefield {
            display: grid;
            grid-template-columns: repeat(5, 1fr); /* Adjust the number of columns as needed */
            gap: 10px; /* Add spacing between cards */
        }

        .card {
            width: 120px;
            height: 180px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
            font-size: 14px;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="battlefield">
            <!-- Example cards (you can dynamically generate these using PHP) -->
            <div class="card">Card 1</div>
            <div class="card">Card 2</div>
            <div class="card">Card 3</div>
            <div class="card">Card 4</div>
            <div class="card">Card 5</div>
            <!-- Add more cards here -->
        </div>
    </div>
</body>
</html>