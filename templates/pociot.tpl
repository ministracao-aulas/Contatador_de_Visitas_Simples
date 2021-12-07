<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
    width="200" height="40"
    style="border-radius: ##RADIUS##px;" >
    <linearGradient id="s" x2="0" y2="100%">
        <stop offset="0" stop-color="##COLOR_1##" stop-opacity="##COLOR_1_OPACITY##"/>
        <stop offset="1" stop-color="##COLOR_2##" stop-opacity="##COLOR_2_OPACITY##"  />
    </linearGradient>
    <clipPath id="r">
        <rect width="200" height="40" rx="3" fill="#fff"/>
    </clipPath>
    <g clip-path="url(#r)">
        <rect width="200" height="40" fill="url(#s)"/>
    </g>
    <g fill="##LABEL_COLOR##" text-anchor="start" font-family="Verdana,Geneva,DejaVu Sans,sans-serif"
        text-rendering="geometricPrecision" font-size="180">
        <text x="50" y="250" transform="scale(.1)"  lengthAdjust="spacing">##LABEL##</text>
    </g>
    <g fill="##COUNT_COLOR##" text-anchor="end" font-family="Verdana,Geneva,DejaVu Sans,sans-serif"
        text-rendering="geometricPrecision" font-size="180">
        <text x="1880" y="250" transform="scale(.1)"  lengthAdjust="spacing">##COUNT##</text>
    </g>
</svg>
