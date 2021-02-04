<!doctype html>
<html>
<head>
	<title>NC State Zoom Virtual Background Generator</title>
	<meta charset="utf-8" />
	<script src="canvas2image.js"></script>
	<script src="https://use.typekit.net/dhg1qiw.js" type="text/javascript"></script>
	<script type="text/javascript">/*<![CDATA[*/try{Typekit.load({ async: false });}catch(e){}/*]]>*/</script>
	<link rel="stylesheet" href="https://cdn.ncsu.edu/brand-assets/fonts/include.css">
	<link rel="stylesheet" href="styles.css">
<script>

	var default_font_family = 'UniversRoman,Arial';		// text font family

	var default_font_weight_line1 = '700';				// line 1 font weight
	var default_font_weight_line2 = '700';				// line 2 font weight
	var default_font_weight_line3 = '400';				// line 3 font weight

	var default_font_size_line1 = '150px';				// line 1 font size
	var default_font_size_line2 = '100px';				// line 2 font size
	var default_font_size_line3 = '80px';				// line 3 font size

	var default_font_color_line1 = '#FFFFFF';			// line 1 text color
	var default_font_color_line2 = '#FFFFFF';			// line 2 text color
	var default_font_color_line3 = '#FFFFFF';			// line 3 text color

	var base_line1 = 160;								// line 1 baseline
	var base_line2 = 280;								// line 2 baseline
	var base_line3 = 390;								// line 3 baseline

	var side_margin = 50;								// text margin from top
	var top_margin = 50;								// text margin from side

	var default_gradient_color_main = '#427E93';		// gradient main color
	var default_gradient_color_dark = '#000000';		// gradient darker color

	var vertical_line_width = 8;						// width of vertical bar
	var vertical_line_color = '#CC0000';				// color of vertical bar
	var vertical_line_margin = 100;						// vertical bar margin away from text
	var vertical_line_extra_height = -30;				// vertical bar height added to last line base

</script>
</head>
<body>


<div class="doc">
	<h1>NC State Zoom Virtual Background Generator</h1>

	<canvas width="1920" height="1080" id="cvshd"></canvas>
	<canvas width="1600" height="1200" id="cvs"></canvas>

	<p>
		This tool creates a virtual background to use during class Zoom sessions.
		When using this background, situate yourself in such a way to minimize overlap with your name.
	</p>
	<p>
		Note: If your name appears backwards to you, don't worry! It displays correctly to others.
		If you want your name to read correctly to you, uncheck &ldquo;Mirror my video&rdquo; in your Zoom video settings.
	</p>

	<div>
		<p>
			<table>
				<tr>
					<th class="label">
						<label for="line1">Line 1:</label>
					</th>
					<td>
						<input type="text" id="line1" placeholder="e.g. firstname" tabindex="1">
					</td>
					<td rowspan="2" align="center" >
						<button id="createimage" tabindex="4">Save Image</button>

						<div id="ratioOptions">
							<input type="radio" id="optionHD" name="imageStyle" value="HD" checked="checked">
							<label for="optionHD">HD</label>
							<input type="radio" id="option43" name="imageStyle" value="43">
							<label for="option43">4:3</label>
							<div id="ratioTooltip">
								Leave the ratio as HD by default.  ONLY choose 4:3 if you are
								using the lower ratio video in Zoom and your name is being cut off.
							</div>
					   </div>
					</td>
				</tr>
				<tr>
					<th class="label">
						<label for="line2">Line 2:</label>
					</th>
					<td>
						<input type="text" id="line2" placeholder="e.g. lastname" tabindex="2">
					</td>
				</tr>
				<tr>
					<th class="label">
						<label for="line3">Line 3:</label>
					</th>
					<td>
						<input type="text" id="line3" placeholder="e.g. pronouns" tabindex="3">
					</td>
				</tr>
				<tr>
					<th class="label">
						<label for="fill">Background:</label>
					</th>
					<td>
						<select id="fill" class="select-css" tabindex="4">
							<option selected="selected" value="radial">Radial Gradient</option>
							<option value="vertical1">Vertical Gradient Light</option>
							<option value="vertical2">Vertical Gradient Dark</option>
							<option value="circle">Gradient with Circle</option>
							<option value="solid">Solid Color</option>
						</select>
					</td>
				</tr>
			</table>
		</p>
	</div>

	<div id="imgs" width="800" height="600">

	</div>
	<div id="explanation" style="display:none">
		<p>
			After you are happy with your new virtual background use the &ldquo;Save Image&rdquo; button to save it to your local machine.
			Set it as your virtual background in your Zoom settings.
			(<a href="howto.html">How do I set a virtual background in Zoom?</a>)
		</p>
	</div>
	<a id="downloadlink" download="zoombackground.jpg" href="">Download Background</a>
</div>


<script>
	var canvas, canvashd, ctxorig, ctxhd,
		$createhd, $createorig, $createimage, $optionHD, $option43,
		$imgs,

		$nameTxt, $line1, $line2, $line3,
		$radialParm,
		$fill;



	function init () {

		canvas = document.getElementById('cvs');
		canvashd = document.getElementById('cvshd');

		ctxorig = canvas.getContext('2d');
		ctxhd = canvashd.getContext('2d');

		$createimage = document.getElementById('createimage');
		$optionHD = document.getElementById('optionHD');
		$option43 = document.getElementById('option43');
		$fill = document.getElementById('fill');

		$imgs = document.getElementById('imgs');

		$line1 = document.getElementById('line1');
		$line2 = document.getElementById('line2');
		$line3 = document.getElementById('line3');

		var queryString = window.location.search;
		var urlParams = new URLSearchParams(queryString);
		var firstVal = urlParams.get('first');
		var lastVal = urlParams.get('last');
		$radialParm = urlParams.get('r');

		if (firstVal) {
			$line1.value = firstVal;
		};

		if (lastVal) {
			$line2.value = lastVal;
		};

		bind();

		if (firstVal && lastVal) {
			updateImage();
		}
	}


	function drawHD() {

		draw(ctxhd, 1920, 1080);

		document.getElementById('explanation').style = "display:block";

		var type = 'jpg',
			w = 1920,
			h = 1080;

		$imgs.innerHTML = '';
		$imgs.appendChild(Canvas2Image.convertToImage(canvashd, w, h, type))

	}


	function draw43() {

		draw(ctxorig, 1600, 1200);

		document.getElementById('explanation').style = "display:block";

		var type = 'jpg',
			w = 1600,
			h = 1200;
		$imgs.innerHTML = '';
		$imgs.appendChild(Canvas2Image.convertToImage(canvas, w, h, type))

	}


	function updateImage() {
		if ($optionHD.checked) {
			drawHD();
		} else {
			draw43();
		}
	}


	function bind () {

		$createimage.onclick = function (e) {

			updateImage();
			if ($optionHD.checked) {
				Canvas2Image.saveAsImage(canvashd, 1920, 1080, 'jpg');
			} else {
				Canvas2Image.saveAsImage(canvas, 1600, 1200, 'jpg');
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

		$option43.oninput = function(e) {
			updateImage();
		}
		$optionHD.oninput = function(e) {
			updateImage();
		}
		$fill.oninput = function(e) {
			updateImage();
		}

	}


	function fillBackground(ctx, w, h) {

		if ($fill.value == 'radial') {

			var radialGrd = ctx.createRadialGradient(w/2, h*.9, 400, w/2, h*.9, h);
			radialGrd.addColorStop(0, default_gradient_color_main);
			radialGrd.addColorStop(1, default_gradient_color_dark);

			ctx.fillStyle = radialGrd;
			ctx.fillRect(0, 0, w, h);

		} else if ($fill.value == 'vertical1') {

			var grd = ctx.createLinearGradient(0, 0, 0, h);
			grd.addColorStop(0, default_gradient_color_dark);
			grd.addColorStop(0.5, default_gradient_color_main);

			ctx.fillStyle = grd;
			ctx.fillRect(0, 0, w, h);

		} else if ($fill.value == 'circle') {

			var radialGrd = ctx.createRadialGradient(w/2, h*.9, 400, w/2, h*.9, h);
			radialGrd.addColorStop(0.75, default_gradient_color_dark);
			radialGrd.addColorStop(0.75, default_gradient_color_main);
			radialGrd.addColorStop(1, default_gradient_color_dark);

			ctx.fillStyle = radialGrd;
			ctx.fillRect(0, 0, w, h);

		} else if ($fill.value == 'vertical2') {

			var grd = ctx.createLinearGradient(0, 0, 0, h);
			grd.addColorStop(0, default_gradient_color_dark);
			grd.addColorStop(0.9, default_gradient_color_main);

			ctx.fillStyle = grd;
			ctx.fillRect(0, 0, w, h);

		} else if ($fill.value == 'solid') {

			// solid color
			ctx.fillStyle = default_gradient_color_main;
			ctx.fillRect(0, 0, w, h);
		}

	}


	function draw(ctx, w, h) {

		var default_font_line1 = default_font_weight_line1 + ' ' + default_font_size_line1 + ' ' + default_font_family;
		var default_font_line2 = default_font_weight_line2 + ' ' + default_font_size_line2 + ' ' + default_font_family;
		var default_font_line3 = default_font_weight_line3 + ' ' + default_font_size_line3 + ' ' + default_font_family;

		fillBackground(ctx, w, h);

		ctx.font = default_font_line1;
		var line1Measurement = ctx.measureText($line1.value).width;

		ctx.font = default_font_line2;
		var line2Measurement = ctx.measureText($line2.value).width;

		ctx.font = default_font_line3;
		var line3Measurement = ctx.measureText($line3.value).width;

		var maxWidth = Math.max(line1Measurement, line2Measurement, line3Measurement);
		maxWidth = Math.min(maxWidth, w * 0.85);

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
		ctx.fillStyle = vertical_line_color;
		ctx.fillRect(w - maxWidth - vertical_line_margin, top_margin, vertical_line_width, base_line2 + vertical_line_extra_height);

		if ($line3.value) {
			ctx.fillRect(w - maxWidth - vertical_line_margin, top_margin, vertical_line_width, base_line3 + vertical_line_extra_height);
		}
	}

	onload = init;

</script>
</body>
</html>

