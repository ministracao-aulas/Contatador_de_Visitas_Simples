<?php
$themes = require __DIR__.'/themes.php';
$page_title = "Generate a counter";
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
    <link rel="stylesheet"
        href="https://mdbootstrap.com/wp-content/themes/mdbootstrap4/css/mdb5/3.10.1/compiled.min.css">

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
    <div class="row g-3 m-5">

        <div class="col-12">
            <h4><?= $page_title ?></h4>
        </div>

        <div class="col-8">
            <label for="counter_name" class="form-label">Counter name</label>
            <input required type="text" class="form-control" id="counter_name" placeholder="My first counter"
                value="My first counter">
        </div>

        <div class="col-4">
            <label for="set_count" class="form-label">Counter start in <small class="text-muted">(valid only in
                    generation)</small> </label>
            <input required type="number" class="form-control" id="set_count" value="0">
        </div>

        <div class="col-12">
            <div class="row">
                <div class="col-4">
                    <label for="label" class="form-label">Counter label</label>
                    <input required type="text" class="form-control" id="label" placeholder="Visitors"
                        value="Visitors">
                </div>

                <div class="col-4">
                    <label for="label_color" class="form-label">Label color</label>
                    <input required type="color" class="form-control btn btn-lg h-50 p-2 py-1 rounded rounded-pill"
                        id="label_color">
                </div>

                <div class="col-4">
                    <label for="count_color" class="form-label">Total count color</label>
                    <input required type="color" class="form-control btn btn-lg h-50 p-2 py-1 rounded rounded-pill"
                        id="count_color">
                </div>
            </div>
        </div>

        <div class="col-8">
            <label for="url" class="form-label">URL to count</label>
            <input required type="url" class="form-control" id="url"
                placeholder="http://mysite.com or http://mysite.com/post1">
            <div class="error-feedback" for="url">Message</div>
        </div>
        <div class="col-md-4">
            <label for="template" class="form-label">Template</label>
            <select id="template" class="form-select" onchange="updateByTheme()">
                <option disabled>Choose...</option>
                <?php foreach(array_keys($themes) as $theme): ?>
                <?="<option value=\"{$theme}\" ". ($theme == 'custom' ? 'selected' : '') .">{$theme}</option>"?>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-12">
            <div class="row">
                <h5>Counter color</h5>

                <div class="col-md-2 col-sm-4">
                    <label for="color_1" class="form-label">Color 1</label>
                    <input required type="color" class="form-control btn btn-lg h-50 p-2 py-1 rounded rounded-pill"
                        id="color_1">
                </div>
                <div class="col-md-3 col-sm-6">
                    <label for="color_1_opacity" class="form-label">Opacity</label>
                    <select id="color_1_opacity" class="form-select">
                        <option disabled>Choose...</option>
                        <option>0.1</option>
                        <option>0.3</option>
                        <option selected>0.5</option>
                        <option>0.7</option>
                        <option>0.9</option>
                        <option>1</option>
                    </select>
                </div>

                <div class="col-md-2 col-sm-12">
                    <label for="radius" class="form-label">Radius</label>
                    <input type="number" class="form-control btn btn-lg h-50 p-2 py-1 rounded rounded-pill"
                        id="radius"
                        value="5">
                </div>

                <div class="col-md-2 col-sm-4">
                    <label for="color_2" class="form-label">Color 2</label>
                    <input type="color" class="form-control btn btn-lg h-50 p-2 py-1 rounded rounded-pill"
                        id="color_2">
                </div>
                <div class="col-md-3 col-sm-6">
                    <label for="color_2_opacity" class="form-label">Opacity</label>
                    <select id="color_2_opacity" class="form-select">
                        <option disabled>Choose...</option>
                        <option>0.1</option>
                        <option>0.3</option>
                        <option selected>0.5</option>
                        <option>0.7</option>
                        <option>0.9</option>
                        <option>1</option>
                    </select>
                </div>

            </div>
        </div>

        <div class="col-12 d-flex flex-row justify-content-center">
            <button type="button" class="btn btn-primary mx-5" id="preview_counter"
                onclick="previewCounter()">Preview</button>
            <a href="#link" target="_blank" title="Open image link" id="preview_image_link">
                <img src="./counter.php?template=custom" class="img-fluid" alt="Visitor count" id="preview_image">
            </a>
        </div>

        <div class="col-12">
            <div class="row">
                <div class="col-12 d-flex justify-content-center my-4">
                    <button type="button" class="btn btn-primary" id="generate_counter" onclick="generateCounter()">Generate</button>
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="btn btn-primary" onclick="copyCounterIframe()">Copy iframe</button>
                            <h4>Preview iframe</h4>
                            <div id="container_counter_iframe"></div>
                            <textarea class="form-control" id="counter_iframe_code" disabled readonly style="min-height: 12rem;"></textarea>
                        </div>

                        <div class="col-6">
                            <button type="button" class="btn btn-primary" onclick="copyCounterImage()">Copy image TAG</button>
                            <h4>Preview image</h4>
                            <div id="container_counter_image" class="mb-3"></div>
                            <textarea class="form-control" id="counter_image_code" style="min-height: 12rem;margin-top: 1rem;"
                            disabled readonly></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript"
        src="https://mdbootstrap.com/api/snippets/static/download/MDB5-Free_3.10.1/js/mdb.min.js"></script>
    <script>

        var themes = <?=json_encode($themes)?>;

        function getInputs(input)
        {
            var inputs = {
                "counter_name"    : document.getElementById('counter_name'),
                "set_count"       : document.getElementById('set_count'),
                "label"           : document.getElementById('label'),
                "label_color"     : document.getElementById('label_color'),
                "count_color"     : document.getElementById('count_color'),
                "url"             : document.getElementById('url'),
                "template"        : document.getElementById('template'),
                "color_1"         : document.getElementById('color_1'),
                "color_1_opacity" : document.getElementById('color_1_opacity'),
                "color_2"         : document.getElementById('color_2'),
                "color_2_opacity" : document.getElementById('color_2_opacity'),
                "radius"          : document.getElementById('radius'),
            };

            if(input)
            {
                return inputs[input];
            }

            return inputs;
        }

        serialize = function (object)
        {
            /*
            var str = [];
            for (var p in obj)
                if (obj.hasOwnProperty(p))
                {
                    str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                }
            return str.join("&");
            */
            return new URLSearchParams(object).toString();
        }

        function htmlEntities(s)
        {
            return s.replace(/[\u00A0-\u9999<>\&]/gim, function(i) {
                return '&#' + i.charCodeAt(0) + ';';
            });
        }

        function previewCounter()
        {
            var inputs = getInputs();

            var _query = {
                counter_name:       inputs.counter_name.value,
                set_count:          inputs.set_count.value,
                label:              inputs.label.value,
                label_color:        inputs.label_color.value,
                count_color:        inputs.count_color.value,
                // url:                inputs.url.value,//Preview não atualiza a imagem
                template:           inputs.template.value,
                color_1:            inputs.color_1.value,
                color_1_opacity:    inputs.color_1_opacity.value,
                color_2:            inputs.color_2.value,
                color_2_opacity:    inputs.color_2_opacity.value,
                radius:             inputs.radius.value
            };

            var new_url = "./counter.php?" + serialize(_query);

            document.getElementById('preview_image_link').href = new_url;
            document.getElementById('preview_image').src = new_url;
        }

        function generateCounter()
        {
            var inputs = getInputs();

            var _query = {
                counter_name:       inputs.counter_name.value,
                set_count:          inputs.set_count.value,
                label:              inputs.label.value,
                label_color:        inputs.label_color.value,
                count_color:        inputs.count_color.value,
                url:                inputs.url.value,
                template:           inputs.template.value,
                color_1:            inputs.color_1.value,
                color_1_opacity:    inputs.color_1_opacity.value,
                color_2:            inputs.color_2.value,
                color_2_opacity:    inputs.color_2_opacity.value,
                radius:             inputs.radius.value
            };

            var url_validation = document.querySelector('.error-feedback[for="url"]');

            if(!_query.url)
            {
                url_validation.innerHTML = 'The URL is required to generate';
                url_validation.setAttribute('show', 'show');
                inputs.url.focus();
                return;
            }

            url_validation.removeAttribute('show');
            url_validation.innerHTML = '';

            var new_url = "./counter.php?" + serialize(_query);

            window.generated_url = new_url;

            document.getElementById('preview_image_link').href = new_url;

            document.getElementById('preview_image').src = new_url;

            var iframe_embed_code = `<iframe src="${new_url}" title="${counter_name}"`
                +`style="width: 13rem; height: 3rem; padding: 0.25rem 0 0 0.25rem;"></iframe>`

            var image_embed_code = ``+
            `<img src="${window.generated_url}" class="img-fluid" title="${counter_name}" alt="${counter_name}" id="generated_preview_image">`

            var textarea_iframe = document.getElementById('counter_iframe_code')
            textarea_iframe.setAttribute('disabled', 'disabled');
            textarea_iframe.setAttribute('readonly', 'readonly');
            textarea_iframe.innerHTML = htmlEntities(iframe_embed_code);

            document.getElementById('container_counter_iframe').innerHTML = iframe_embed_code;

            var textarea_image = document.getElementById('counter_image_code')
            textarea_image.setAttribute('disabled', 'disabled');
            textarea_image.setAttribute('readonly', 'readonly');
            textarea_image.innerHTML = htmlEntities(image_embed_code);

            document.getElementById('container_counter_image').innerHTML = image_embed_code;
        }

        function updateByTheme()
        {
            var inputs = getInputs();
            var old_color_1         = inputs.color_1.value;
            var old_color_1_opacity = inputs.color_1_opacity.value;
            var old_color_2         = inputs.color_2.value;
            var old_color_2_opacity = inputs.color_2_opacity.value;
            var old_count_color     = inputs.count_color.value;
            var old_label_color     = inputs.label_color.value;

            var theme = themes[inputs.template.value];

            if (!theme)
            {
                return;
            }

            inputs.color_1.value         = theme["color_1"]         //? theme[color_1]         : old_color_1;
            inputs.color_1_opacity.value = theme["color_1_opacity"] //? theme[color_1_opacity] : old_color_1_opacity;
            inputs.color_2.value         = theme["color_2"]         //? theme[color_2]         : old_color_2;
            inputs.color_2_opacity.value = theme["color_2_opacity"] //? theme[color_2_opacity] : old_color_2_opacity;
            inputs.count_color.value     = theme["count_color"]     //? theme[count_color]     : old_count_color;
            inputs.label_color.value     = theme["label_color"]     //? theme[label_color]     : old_label_color;
            previewCounter();
        }

        function copyToClipboard(content)
        {
            if (!content)
            {
                return null;
            }

            var temp_textarea = document.createElement("textarea");
            temp_textarea.stylesheet = 'position: absolute; left: -9999px;; width: 1px; height: 1px;';
            temp_textarea.value = content;
            document.body.appendChild(temp_textarea);
            temp_textarea.select();
            document.execCommand("copy");
            document.body.removeChild(temp_textarea);
            console.log('Copied Text');
        }

        function copyCounterIframe()
        {
            var content = document.getElementById('counter_iframe_code').innerHTML;
            copyToClipboard(content);
        }

        function copyCounterImage()
        {
            if(!window.generated_url)
                return;
            var content = `<img src="${window.generated_url}" class="img-fluid" alt="Visitor count" id="preview_image">`;

            copyToClipboard(content);
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateByTheme();
        });
    </script>
</body>

</html>
