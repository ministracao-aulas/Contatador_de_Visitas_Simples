<?php
$themes = require __DIR__ . '/themes.php';
$page_title = "A visitor simple counter";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>
    <base target="_parent">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&amp;display=swap">
    <link rel="stylesheet" href="https://mdbootstrap.com/wp-content/themes/mdbootstrap4/css/mdb5/3.10.1/compiled.min.css">

    <style>
        .error-feedback[show] {
            display: block;
        }

        .error-feedback {
            display: none;
            margin-top: 0rem;
            position: inherit;
            margin-left: 11px;
            font-family: monospace;
            font-style: italic;
            width: auto;
            color: #f93154;
        }
    </style>
    <style>
        INPUT:-webkit-autofill,
        SELECT:-webkit-autofill,
        TEXTAREA:-webkit-autofill {
            animation-name: onautofillstart
        }

        INPUT:not(:-webkit-autofill),
        SELECT:not(:-webkit-autofill),
        TEXTAREA:not(:-webkit-autofill) {
            animation-name: onautofillcancel
        }

        @keyframes onautofillstart {}

        @keyframes onautofillcancel {}
    </style>
</head>

<body>
    <div class="row g-3 m-5 d-flex justify-content-center">
        <div class="col-12">
            <div class="bg-light p-5 rounded mt-3">
                <h1><?= $page_title ?></h1>
                <p class="lead">This is a example of counter:</p>
                <div class="mb-4">
                    <img src="./counter.php?counter_name=My+first+counter&label=Visitors&label_color=%23000000&count_color=%23000000&url=http://tiagofranca.com%23link&template=custom&color_1=%230af55c&color_1_opacity=0.5&color_2=%232e9b2c&color_2_opacity=0.5&radius=5"
                        class="img-fluid" alt="Visitor count" id="preview_image">

                    <img src="./counter.php?counter_name=My+first+counter&label=My label 2&label_color=%23000000&count_color=%23000000&url=http://tiagofranca.com%23link&template=custom&radius=5"
                        class="img-fluid" alt="Visitor count" id="preview_image">
                </div>

                <div class="mb-4">
                    <a class="btn btn-lg btn-primary" href="./generator.php" role="button">Create your counter »</a>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
