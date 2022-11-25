<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-dark-5@1.1.3/dist/css/bootstrap-dark.min.css" rel="stylesheet">
    <title>Portal</title>

    <style>
        main {
            position: relative;
            height: 100vh;
        }

        div.tabs {
            padding: 0;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: white;

            border-radius: 1em;

            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        section h3 {
            text-align: center;
        }

        section {
            padding: 1em;
        }
    </style>

</head>

<body>
    <main class="flex two three-1200 center">
        <?= $content ?>
    </main>
</body>

</html>