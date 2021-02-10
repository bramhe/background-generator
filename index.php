<!doctype html>
<html lang="en-us">
<head>
<title>NC State Virtual Background Generator</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8" />
<link rel="icon" type="image/x-icon" href="https://www.ncsu.edu/favicon.ico" />
<link rel="stylesheet" href="https://cdn.ncsu.edu/brand-assets/fonts-2-0/include.css" />
<link rel="stylesheet" href="styles.css" />
<script src="canvas2image.js"></script>
<script src="https://cdn.ncsu.edu/brand-assets/utility-bar/ub-php.js?color=black&amp;showBrick=1"></script>
<script>

	var default_font_family = 'Univers,Arial';		// text font family

	var default_font_weight_line1 = '700';				// line 1 font weight
	var default_font_weight_line2 = '700';				// line 2 font weight
	var default_font_weight_line3 = '400';				// line 3 font weight

	var default_font_size_line1 = '150px';				// line 1 font size
	var default_font_size_line2 = '100px';				// line 2 font size
	var default_font_size_line3 = '80px';				// line 3 font size

	var height_line1 = 160;								// line 1 height
	var height_line2 = 120;								// line 2 height
	var height_line3 = 110;								// line 3 height

	var default_font_color_line1 = '#FFFFFF';			// line 1 text color
	var default_font_color_line2 = '#FFFFFF';			// line 2 text color
	var default_font_color_line3 = '#FFFFFF';			// line 3 text color

	var side_margin = 50;								// text margin from top
	var top_margin = 50;								// text margin from side

	var default_gradient_color_main = '#CC0000';		// gradient main color
	var default_gradient_color_dark = '#990000';		// gradient darker color

	var vertical_line_width = 8;						// width of vertical bar
	var vertical_line_color = '#000000';				// color of vertical bar
	var vertical_line_margin = 100;						// vertical bar margin away from text
	var vertical_line_extra_height = -30;				// vertical bar height added to last line base

</script>
</head>
<body>
<div id="ncstate-utility-bar"></div>


<div class="doc">
	<h1>NC State Virtual Background Generator</h1>

	<canvas width="1920" height="1080" id="cvshd"></canvas>
	<canvas width="1600" height="1200" id="cvs"></canvas>

	<p>
		This tool creates a virtual background to use for web conferencing tools.
		When using this background, situate yourself in such a way to minimize overlap with your name.
	</p>
	<p>
		Note: If your name appears backwards to you, don't worry! It displays correctly to others.
		If you want your name to read correctly to you, uncheck &ldquo;Mirror my video&rdquo; in your Zoom video settings.
	</p>
	<p>
		After you are happy with your new virtual background, use the &ldquo;Download Image&rdquo; button to save it to your local machine.
		Set it as your virtual background in your Zoom settings.
		(<a href="https://support.zoom.us/hc/en-us/articles/210707503-Virtual-Background">How do I set a virtual background in Zoom?</a>)
	</p>
	<p>
		Leave the ratio as HD by default. Choose 4:3 ONLY if you are
		using the lower ratio video in Zoom and your text is being cut off.
	</p>

	<fieldset id="settings">
		<legend>Parameters for the virtual background image:</legend>
		<div>
			<label for="line1" class="line1">Big Text:</label>
			<input type="text" id="line1" placeholder="e.g. first name">
		</div>
		<div>
			<label for="line2" class="line2">Medium Text:</label>
			<input type="text" id="line2" placeholder="e.g. last name">
		</div>
		<div>
			<label for="line3" class="line3">Small Text:</label>
			<input type="text" id="line3" placeholder="e.g. pronouns" autocapitalize="off">
		</div>
		<div>
			<label for="align">Align:</label>
			<select id="align" class="select-css">
				<option selected="selected" value="right_left">Text on Right, Left Aligned</option>
				<option value="right_right">Text on Right, Right Aligned</option>
				<option value="center">Centered</option>
				<option value="left_left">Text on Left, Left Aligned</option>
				<option value="left_right">Text on Left, Right Aligned</option>
			</select>
		</div>
		<div>
			<label for="fill">Background:</label>
			<select id="fill" class="select-css">
				<option selected="selected" value="radial">Radial Gradient</option>
				<option value="vertical1">Vertical Gradient Light</option>
				<option value="vertical2">Vertical Gradient Dark</option>
				<option value="circle">Gradient with Circle</option>
				<option value="solid">Solid Color</option>
			</select>
		</div>
		<div>
			<label for="ratio">Aspect Ratio:</label>
			<select id="ratio" class="select-css">
				<option selected="selected" value="16x9">16:9 / HD</option>
				<option value="4x3">4:3</option>
			</select>
		</div>
	</fieldset>

	<div id="imgs"></div>

	<button id="createimage">Download Image</button>

	<a id="downloadlink" download="zoombackground.png" href="#">Download Background</a>
</div>


<script>
	var canvas, canvashd, ctxorig, ctxhd,
		$createhd, $createorig, $createimage,
		$imgs,
		$line1, $line2, $line3,
		$fill, $align, $ratio;



	function init () {

		canvas = document.getElementById('cvs');
		canvashd = document.getElementById('cvshd');

		ctxorig = canvas.getContext('2d');
		ctxhd = canvashd.getContext('2d');

		$createimage = document.getElementById('createimage');
		$align = document.getElementById('align');
		$fill = document.getElementById('fill');
		$ratio = document.getElementById('ratio');

		$imgs = document.getElementById('imgs');

		$line1 = document.getElementById('line1');
		$line2 = document.getElementById('line2');
		$line3 = document.getElementById('line3');

		bind();

		updateImage();

	}


	function drawHD() {

		draw(ctxhd, 1920, 1080);

		document.getElementById('createimage').style = "display:block";

		var type = 'png',
			w = 1920,
			h = 1080;

		$imgs.innerHTML = '';
		var imgElement = Canvas2Image.convertToImage(canvashd, w, h, type);
		imgElement.alt = 'generated background';
		$imgs.appendChild(imgElement);

	}


	function draw43() {

		draw(ctxorig, 1600, 1200);

		document.getElementById('createimage').style = "display:block";

		var type = 'png',
			w = 1600,
			h = 1200;
		$imgs.innerHTML = '';
		var imgElement = Canvas2Image.convertToImage(canvas, w, h, type);
		imgElement.alt = 'generated background';
		$imgs.appendChild(imgElement);

	}


	function updateImage() {
		if ($ratio.value === '16x9') {
			drawHD();
		} else {
			draw43();
		}
	}


	function bind () {

		$createimage.onclick = function (e) {

			updateImage();
			if ($ratio.value === '16x9') {
				Canvas2Image.saveAsImage(canvashd, 1920, 1080, 'png');
			} else {
				Canvas2Image.saveAsImage(canvas, 1600, 1200, 'png');
			}

		}

		$line1.oninput = function(e) {
			updateImage();
		}
		$line2.oninput = function(e) {
			updateImage();
		}
		$line3.oninput = function(e) {
			updateImage();
		}

		$ratio.oninput = function(e) {
			$imgs.innerHTML = '';
			updateImage();
		}
		$fill.oninput = function(e) {
			updateImage();
		}
		$align.oninput = function(e) {
			updateImage();
		}

	}


	function fillBackground(ctx, w, h) {

		if ($fill.value === 'radial') {

			var radialGrd = ctx.createRadialGradient(w/2, h*.9, 400, w/2, h*.9, h);
			radialGrd.addColorStop(0, default_gradient_color_main);
			radialGrd.addColorStop(1, default_gradient_color_dark);

			ctx.fillStyle = radialGrd;
			ctx.fillRect(0, 0, w, h);

		} else if ($fill.value === 'vertical1') {

			var grd = ctx.createLinearGradient(0, 0, 0, h);
			grd.addColorStop(0, default_gradient_color_dark);
			grd.addColorStop(0.5, default_gradient_color_main);

			ctx.fillStyle = grd;
			ctx.fillRect(0, 0, w, h);

		} else if ($fill.value === 'circle') {

			var radialGrd = ctx.createRadialGradient(w/2, h*.9, 400, w/2, h*.9, h);
			radialGrd.addColorStop(0.70, default_gradient_color_dark);
			radialGrd.addColorStop(0.75, default_gradient_color_main);
			radialGrd.addColorStop(1, default_gradient_color_dark);

			ctx.fillStyle = radialGrd;
			ctx.fillRect(0, 0, w, h);

		} else if ($fill.value === 'vertical2') {

			var grd = ctx.createLinearGradient(0, 0, 0, h);
			grd.addColorStop(0, default_gradient_color_dark);
			grd.addColorStop(0.9, default_gradient_color_main);

			ctx.fillStyle = grd;
			ctx.fillRect(0, 0, w, h);

		} else if ($fill.value === 'solid') {

			// solid color
			ctx.fillStyle = default_gradient_color_main;
			ctx.fillRect(0, 0, w, h);
		}

	}


	function draw(ctx, w, h) {

		var default_font_line1 = default_font_weight_line1 + ' ' + default_font_size_line1 + ' ' + default_font_family;
		var default_font_line2 = default_font_weight_line2 + ' ' + default_font_size_line2 + ' ' + default_font_family;
		var default_font_line3 = default_font_weight_line3 + ' ' + default_font_size_line3 + ' ' + default_font_family;

		var base_line1 = height_line1;
		var base_line2 = height_line2;
		var base_line3 = height_line3;
		var vertical_line_height = vertical_line_extra_height;

		if ($line1.value !== '') {
			base_line2 += height_line1;
			base_line3 += height_line1;
			vertical_line_height += height_line1;
		}

		if ($line2.value !== '') {
			base_line3 += height_line2;
			vertical_line_height += height_line2;
		}

		if ($line3.value !== '') {
			vertical_line_height += height_line3;
		}

		fillBackground(ctx, w, h);

		ctx.font = default_font_line1;
		var line1Measurement = ctx.measureText($line1.value).width;

		ctx.font = default_font_line2;
		var line2Measurement = ctx.measureText($line2.value).width;

		ctx.font = default_font_line3;
		var line3Measurement = ctx.measureText($line3.value).width;

		var maxWidth = Math.max(line1Measurement, line2Measurement, line3Measurement);
		maxWidth = Math.min(maxWidth, w - (side_margin * 3));

		if ($align.value === 'right_left') {

			ctx.textAlign = "start";

			ctx.fillStyle = default_font_color_line1;
			ctx.font = default_font_line1;
			ctx.fillText($line1.value, w - maxWidth - side_margin, base_line1, maxWidth);

			ctx.fillStyle = default_font_color_line2;
			ctx.font = default_font_line2;
			ctx.fillText($line2.value, w - maxWidth - side_margin, base_line2, maxWidth);

			ctx.fillStyle = default_font_color_line3;
			ctx.font = default_font_line3;
			ctx.fillText($line3.value, w - maxWidth - side_margin, base_line3, maxWidth);

			// vertical line next to text
			if (vertical_line_height > 0) {
				ctx.fillStyle = vertical_line_color;
				ctx.fillRect(w - maxWidth - vertical_line_margin, top_margin, vertical_line_width, vertical_line_height);
			}

		} else if ($align.value === 'right_right') {

			ctx.textAlign = "end";

			ctx.fillStyle = default_font_color_line1;
			ctx.font = default_font_line1;
			ctx.fillText($line1.value, w - side_margin, base_line1, maxWidth);

			ctx.fillStyle = default_font_color_line2;
			ctx.font = default_font_line2;
			ctx.fillText($line2.value, w - side_margin, base_line2, maxWidth);

			ctx.fillStyle = default_font_color_line3;
			ctx.font = default_font_line3;
			ctx.fillText($line3.value, w - side_margin, base_line3, maxWidth);

			// vertical line next to text
			if (vertical_line_height > 0) {
				ctx.fillStyle = vertical_line_color;
				ctx.fillRect(w - maxWidth - vertical_line_margin, top_margin, vertical_line_width, vertical_line_height);
			}

		} else if ($align.value === 'center') {

			ctx.textAlign = "center";

			// we have some extra space since we are not drawing the vertical line, so recalculate maxWidth
			maxWidth = Math.max(line1Measurement, line2Measurement, line3Measurement);
			maxWidth = Math.min(maxWidth, w - (side_margin * 2));

			ctx.fillStyle = default_font_color_line1;
			ctx.font = default_font_line1;
			ctx.fillText($line1.value, w / 2, base_line1, maxWidth);

			ctx.fillStyle = default_font_color_line2;
			ctx.font = default_font_line2;
			ctx.fillText($line2.value, w / 2, base_line2, maxWidth);

			ctx.fillStyle = default_font_color_line3;
			ctx.font = default_font_line3;
			ctx.fillText($line3.value, w / 2, base_line3, maxWidth);

			// no vertical line with centered text

		} else if ($align.value === 'left_right') {

			ctx.textAlign = "end";

			ctx.fillStyle = default_font_color_line1;
			ctx.font = default_font_line1;
			ctx.fillText($line1.value, maxWidth + side_margin, base_line1, maxWidth);

			ctx.fillStyle = default_font_color_line2;
			ctx.font = default_font_line2;
			ctx.fillText($line2.value, maxWidth + side_margin, base_line2, maxWidth);

			ctx.fillStyle = default_font_color_line3;
			ctx.font = default_font_line3;
			ctx.fillText($line3.value, maxWidth + side_margin, base_line3, maxWidth);

			// vertical line next to text
			if (vertical_line_height > 0) {
				ctx.fillStyle = vertical_line_color;
				ctx.fillRect(maxWidth + vertical_line_margin, top_margin, vertical_line_width, vertical_line_height);
			}

		} else if ($align.value === 'left_left') {

			ctx.textAlign = "start";

			ctx.fillStyle = default_font_color_line1;
			ctx.font = default_font_line1;
			ctx.fillText($line1.value, side_margin, base_line1, maxWidth);

			ctx.fillStyle = default_font_color_line2;
			ctx.font = default_font_line2;
			ctx.fillText($line2.value, side_margin, base_line2, maxWidth);

			ctx.fillStyle = default_font_color_line3;
			ctx.font = default_font_line3;
			ctx.fillText($line3.value, side_margin, base_line3, maxWidth);

			// vertical line next to text
			if (vertical_line_height > 0) {
				ctx.fillStyle = vertical_line_color;
				ctx.fillRect(maxWidth + vertical_line_margin, top_margin, vertical_line_width, vertical_line_height);
			}
		}
	}

	onload = init;

</script>
</body>
</html>

