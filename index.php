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

	var default_font_weight = '700';
	var default_font_weight_smallest = '400';

	var default_font_size = '150px';
	var default_font_size_small = '100px';
	var default_font_size_smallest = '80px';

	var default_font_family = 'UniversRoman,Arial';

	var default_gradient_color_base = '#2F65A7';
	var default_gradient_dark_color = '#00274C';

	var vertical_line_color = '#CC0000';

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
					<th>
						Line 1:
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
					<th>
						Line 2:
					</th>
					<td>
						<input type="text" id="line2" placeholder="e.g. lastname" tabindex="2">
					</td>
				</tr>
				<tr>
					<th>
						Line 3:
					</th>
					<td>
						<input type="text" id="line3" placeholder="e.g. pronouns" tabindex="3">
					</td>
				</tr>
				<tr id="styleoptions">
					<th>
						Style:
					</th>
					<td>
						<input type="radio" id="fill1" name="fillStyle" value="1" checked="checked">
						<label for="fill1">1</label>
						<input type="radio" id="fill2" name="fillStyle" value="2">
						<label for="fill2">2</label>
						<input type="radio" id="fill3" name="fillStyle" value="3">
						<label for="fill3">3</label>
						<input type="radio" id="fill4" name="fillStyle" value="4">
						<label for="fill4">4</label>
						<input type="radio" id="fill5" name="fillStyle" value="5">
						<label for="fill5">5</label>
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
		$placeLeft, $placeRight,

		$nameTxt, $line1, $line2, $line3,
		$radialParm,
		$fill1, $fill2, $fill3, $fill4, $fill5;



	function init () {

		canvas = document.getElementById('cvs');
		canvashd = document.getElementById('cvshd');


		ctxorig = canvas.getContext('2d');
		ctxhd = canvashd.getContext('2d');


		$createimage = document.getElementById('createimage');
		$optionHD = document.getElementById('optionHD');
		$option43 = document.getElementById('option43');
		$fill1 = document.getElementById('fill1');
		$fill2 = document.getElementById('fill2');
		$fill3 = document.getElementById('fill3');
		$fill4 = document.getElementById('fill4');
		$fill5 = document.getElementById('fill5');


		$imgs = document.getElementById('imgs');

		$line1 = document.getElementById('line1');
		$line2 = document.getElementById('line2');
		$line3 = document.getElementById('line3');

		//$placeLeft = document.getElementById('placeLeft');
		//$placeRight = document.getElementById('placeRight');


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

		$option43.oninput = function (e) {
			updateImage();
		}
		$optionHD.oninput = function (e) {
			updateImage();
		}
		$fill1.oninput = function (e) {
			updateImage();
		}
		$fill2.oninput = function (e) {
			updateImage();
		}
		$fill3.oninput = function (e) {
			updateImage();
		}
		$fill4.oninput = function (e) {
			updateImage();
		}
		$fill5.oninput = function (e) {
			updateImage();
		}

	}


	function requestedFillStyle(ctx, w, h) {

		if ($fill1.checked) {

			var radialGrd = ctx.createRadialGradient(w/2, h*.9, 400, w/2, h*.9, h);
			radialGrd.addColorStop(0, default_gradient_color_base);
			radialGrd.addColorStop(1, default_gradient_dark_color);

			return radialGrd;

		} else if ($fill2.checked) {

			var grd = ctx.createLinearGradient(0,0,0,h);
			grd.addColorStop(0, default_gradient_dark_color);
			grd.addColorStop(0.75, default_gradient_color_base);

			return grd;

		} else if ($fill3.checked) {

			var radialGrd = ctx.createRadialGradient(w/2, h*.9, 400, w/2, h*.9, h);
			radialGrd.addColorStop(0.75, default_gradient_dark_color);
			radialGrd.addColorStop(0.75, default_gradient_color_base);
			radialGrd.addColorStop(1, default_gradient_dark_color);

			return radialGrd;

		} else if ($fill4.checked) {

			var grd = ctx.createLinearGradient(0,0,0,h);
			grd.addColorStop(0, default_gradient_dark_color);
			grd.addColorStop(0.8, default_gradient_color_base);

			return grd;

		}
		else {
			return default_gradient_color_base;
		}

	}


	function draw(ctx, w, h) {

		var rightMargin = 50;
		var topMargin = 50;
		var verticalLineWidth = 8;

		var line1Base = 160;
		var line2Base = 280;
		var line3Base = 390;

		var default_font = default_font_weight + ' ' + default_font_size + ' ' + default_font_family;
		var default_font_small = default_font_weight + ' ' + default_font_size_small + ' ' + default_font_family;
		var default_font_smallest = default_font_weight_smallest + ' ' + default_font_size_smallest + ' ' + default_font_family;

		ctx.fillStyle = requestedFillStyle(ctx, w, h);
		ctx.fillRect(0,0,w,h);

		ctx.fillStyle = '#ffffff';

		if ($fill1.checked || $fill2.checked) {
			ctx.fillStyle = '#ffffff';
		}

		// measure lines

		ctx.font = default_font;
		var line1Measurement = ctx.measureText($line1.value).width;

		ctx.font = default_font_small;
		var lastMeasurement = ctx.measureText($line2.value).width;

		var maxWidth = Math.max(line1Measurement, lastMeasurement);

		// limit max width of lines to a percentage width of the canvas
		maxWidth = Math.min(maxWidth, w * 0.36);

		ctx.font = default_font;
		ctx.fillText($line1.value, w - maxWidth - rightMargin, line1Base, maxWidth);

		ctx.font = default_font_small;
		ctx.fillText($line2.value, w - maxWidth - rightMargin, line2Base, maxWidth);

		ctx.font = default_font_smallest;
		ctx.fillText($line3.value, w - maxWidth - rightMargin, line3Base, maxWidth);

		ctx.fillStyle = vertical_line_color;
		ctx.fillRect(w - maxWidth - 80, topMargin, verticalLineWidth, line2Base - 30);

		if ($line3.value) {
			ctx.fillRect(w - maxWidth - 80, topMargin, verticalLineWidth, line3Base - 30);
		}
	}

	onload = init;

</script>
</body>
</html>

