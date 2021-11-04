# background-generator
Tool for generating virtual backgrounds that can be used for Zoom, Panopto or Google Meet.


Based on code from University of Michigan School for Environment and Sustainability (https://seas.umich.edu/assets/background/)

## How to Update background-generator For Your Organization

* Update contents of `<title>` tag for your organization.

* Update `<link rel="icon">` tag to your organization's or other custom favicon.

* Update `<link rel="stylesheet">` tags to your organization's stylesheets.

* Remove the `<script>` linking to the `cdn.ncsu.edu/brand-assets/utility-bar` (or replace with your organization's navigation/identity bar).

* Update fonts and colors in the **styles.css** file to your organization's official fonts and colors.

* Update `default_font_family` to your organization's official fonts.

* Update `default_font_color_line1`, `default_font_color_line2`, and `default_font_color_line3` to one of your organization's colors, or leave as the default, `#FFFFFF` (white).

* Update `default_gradient_color_main` to one of your organization's colors.

* Update `default_gradient_color_dark` to one of your organization's colors.

* Update `vertical_line_color` to one of your organization's colors, or leave as the default, `#000000` (black).

* Remove `<div id="ncstate-utility-bar">` at the top of the `<body>` tag (or replace with your organization's navigation/identity bar).

* Update contents of `<h1>` tag for your organization.

* Edit `<ul id="tab_list">` with content describing your organization's web conferencing tools, or remove the tab framework to just have a standalone background generator.

* Change the colors and color names options in the "Background" `<select id="fill">` to your organization's colors. For example, change `solid_CC0000` which results in `#CC0000` (red) to `solid_0000CC` for `#0000CC` (blue), etc.

* Change the image options in the "Background" `<select id="fill">` to appropriate background images for your organization, and edit the corresponding file path/location and types of those images in the `$fill.oninput` function.

* **Note:** for photographic images, it is recommended to use `img_type = 'jpg'`.  For geometric-type images, use `image_type = 'png'`.

* Update extension of main **index.php** file (e.g. to .html) as needed to match the DirectoryIndex. The background generator runs in the browser and does not require PHP.
