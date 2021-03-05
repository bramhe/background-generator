<!doctype html>
<html lang="en-us">
<head>
<title>NC State Virtual Backgrounds</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8" />
<link rel="icon" type="image/x-icon" href="https://www.ncsu.edu/favicon.ico" />
<link rel="stylesheet" href="https://cdn.ncsu.edu/brand-assets/fonts-2-0/include.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="styles.css?20210211" />
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
	<h1>NC State Virtual Backgrounds</h1>

	<canvas width="1920" height="1080" id="cvshd"></canvas>
	<canvas width="1600" height="1200" id="cvs"></canvas>

	<ul class="nav nav-tabs" id="tab_list" role="tablist">
		<li class="nav-item">
			<a class="nav-link active" id="home-tab" data-toggle="tab" href="#generator" role="tab" aria-controls="home" aria-selected="true">Background Generator</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="zoom-tab" data-toggle="tab" href="#zoom" role="tab" aria-controls="zoom" aria-selected="false">Zoom</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="panopto-tab" data-toggle="tab" href="#panopto" role="tab" aria-controls="panopto" aria-selected="false">Panopto</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="meet-tab" data-toggle="tab" href="#meet" role="tab" aria-controls="meet" aria-selected="false">Google Meet</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="standard-tab" data-toggle="tab" href="#standard" role="tab" aria-controls="standard" aria-selected="false">Standard Backgrounds</a>
		</li>
	</ul>

	<div class="tab-content" id="myTabContent">
		<div class="tab-pane fade show active" id="generator" role="tabpanel" aria-labelledby="home-tab">
			<p>
				This tool creates a virtual background image for use with web conferencing tools.
				Enter text (e.g. your name and pronouns) and choose other parameters to customize the image.
			</p>
			<p>
				When you are happy with your new virtual background, use the &ldquo;Download Image&rdquo; button to save it to your local machine.
			</p>
			<p>
				For information on how to use the downloaded image, visit the tab for
				<a href="#" aria-controls="zoom" onclick="activateTab('zoom');return false;">Zoom</a>,
				<a href="#" aria-controls="panopto" onclick="activateTab('panopto');return false;">Panopto</a>
				or
				<a href="#" aria-controls="meet" onclick="activateTab('meet');return false;">Google Meet</a> on this page.
			</p>

			<fieldset id="settings">
				<legend>Parameters for the virtual background image:</legend>
				<div>
					<label for="line1" class="line1">Large Text:</label>
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
						<option selected="selected" value="radial1">Radial Gradient</option>
						<option value="radial2">Radial Gradient Reversed</option>
						<option value="vertical1">Vertical Gradient Light</option>
						<option value="vertical2">Vertical Gradient Dark</option>
						<option value="solid_CC0000">Solid Color &ndash; Wolfpack Red</option>
						<option value="solid_990000">Solid Color &ndash; Reynolds Red</option>
						<option value="solid_008473">Solid Color &ndash; Carmichael Aqua</option>
						<option value="solid_427E93">Solid Color &ndash; Innovation Blue</option>
						<option value="solid_4156A1">Solid Color &ndash; Bio-indigo</option>
						<option value="image_wolf">Image &ndash; Wolf Head</option>
						<option value="image_hunt">Image &ndash; Hunt Library</option>
						<option value="image_hunt_night">Image &ndash; Hunt Library at Night</option>
						<option value="image_belltower">Image &ndash; Belltower</option>
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
			<img style="display:none" id="bgimg" src="#" alt="" />

		</div>
		<div class="tab-pane fade" id="zoom" role="tabpanel" aria-labelledby="profile-tab">
			<p>
				Use the <a href="#" aria-controls="generator" onclick="activateTab('generator');return false;">Background Generator</a>
				to generate a custom virtual background for use with Zoom.
			</p>
			<p>
				Or, use the additional general-purpose NC State themed backgrounds
				that already appear in your Zoom video
				settings.  (As shown on the
				<a href="#" aria-controls="standard" onclick="activateTab('standard');return false;">Standard Backgrounds tab</a>.)
			</p>
			<p>
				After you download an image, set the image as your virtual background in your Zoom settings.
			</p>
			<p>
				<a class="instructions_link" href="https://support.zoom.us/hc/en-us/articles/210707503-Virtual-Background">How do I set a virtual background in Zoom?</a>
			</p>
			<p>
				If your name appears backwards to you, don't worry! It displays correctly to others.
				If you want your name to read correctly to you, uncheck &ldquo;Mirror my video&rdquo; in your Zoom video settings.
			</p>
			<p>
				Leave the ratio as HD by default. Choose 4:3 ONLY if you are
				using the lower ratio video in Zoom and your text is being cut off.
			</p>
		</div>
		<div class="tab-pane fade" id="panopto" role="tabpanel" aria-labelledby="contact-tab">
			<p>
				Use the <a href="#" aria-controls="generator" onclick="activateTab('generator');return false;">Background Generator</a>
				to generate a custom virtual background for use with Panopto.
			</p>
			<p>
				Or, download additional general-purpose NC State themed backgrounds
				from the <a href="#" aria-controls="standard" onclick="activateTab('standard');return false;">Standard Backgrounds tab</a>.
			</p>
			<p>
				After you download an image, set the image as your virtual background in your Panopto settings.
			</p>
			<p>
				<a class="instructions_link" href="https://support.panopto.com/s/article/Learn-About-Capture-Settings">How do I set a virtual background in Panopto?</a>
			</p>
		</div>
		<div class="tab-pane fade" id="meet" role="tabpanel" aria-labelledby="contact-tab">
			<p>
				Use the <a href="#" aria-controls="generator" onclick="activateTab('generator');return false;">Background Generator</a>
				to generate a custom virtual background for use with Google Meet.
			</p>
			<p>
				Or, download additional general-purpose NC State themed backgrounds
				from the <a href="#" aria-controls="standard" onclick="activateTab('standard');return false;">Standard Backgrounds tab</a>.
			</p>
			<p>
				After you download an image, set the image as your virtual background in your Google Meet settings.
			</p>
			<p>
				<a class="instructions_link" href="https://support.google.com/meet/answer/10058482?co=GENIE.Platform%3DDesktop&hl=en">How do I set a virtual background in Google Meet?</a>
			</p>
		</div>
		<div class="tab-pane fade" id="standard" role="tabpanel" aria-labelledby="contact-tab">
			<p>
				These general-purpose NC State themed backgrounds already appear in your
				Zoom video settings, so there is no need to download them for use with Zoom.
			</p>
			<p>
				For Panopto or Google Meet, download these
				images for use as additional virtual backgrounds.
			</p>
			<p>
				For information on how to use the downloaded image, visit the tab for
				<a href="#" aria-controls="zoom" onclick="activateTab('zoom');return false;">Zoom</a>,
				<a href="#" aria-controls="panopto" onclick="activateTab('panopto');return false;">Panopto</a>
				or
				<a href="#" aria-controls="meet" onclick="activateTab('meet');return false;">Google Meet</a> on this page.
			</p>
			<div id="standard-links">
				<a href="img/NCStateWall_01.png" download="hunt_ncstate_wall.png"><img class="thumbnail" src="img/NCStateWall_01.png" />
				<br/>Download Standard Background 1</a>
				<a href="img/ZoomBelltower__02.png" download="belltower_twilight.png"><img class="thumbnail" src="img/ZoomBelltower__02.png" />
				<br/>Download Standard Background 2</a>
				<a href="img/ZoomStateStack_1920x1080.png" download="state_stack.png"><img class="thumbnail" src="img/ZoomStateStack_1920x1080.png" />
				<br/>Download Standard Background 3</a>
				<a href="img/NCState Zoom BG- Concepts R2-01.png" download="wolf_silhouette.png"><img class="thumbnail" src="img/NCState Zoom BG- Concepts R2-01.png" />
				<br/>Download Standard Background 4</a>
			</div>
		</div>
	</div>
</div>


<script>
	var canvas, canvashd, ctxorig, ctxhd,
		$createhd, $createorig, $createimage,
		$imgs,
		$line1, $line2, $line3,
		$fill, $align, $ratio;

	var img_type = 'png';

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

		$bgimg = document.getElementById('bgimg');


		bind();

		updateImage();

	}


	function drawHD() {

		draw(ctxhd, 1920, 1080);

		document.getElementById('createimage').style = "display:block";

		var w = 1920,
			h = 1080;

		$imgs.innerHTML = '';
		var imgElement = Canvas2Image.convertToImage(canvashd, w, h, img_type);
		imgElement.alt = 'generated background';
		$imgs.appendChild(imgElement);

	}


	function draw43() {

		draw(ctxorig, 1600, 1200);

		document.getElementById('createimage').style = "display:block";

		var w = 1600,
			h = 1200;
		$imgs.innerHTML = '';
		var imgElement = Canvas2Image.convertToImage(canvas, w, h, img_type);
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

	function activateTab(tab_id) {
		$('a[href="#' + tab_id + '"]').click();
	}


	function bind () {

		$createimage.onclick = function (e) {

			updateImage();
			if ($ratio.value === '16x9') {
				Canvas2Image.saveAsImage(canvashd, 1920, 1080, img_type);
			} else {
				Canvas2Image.saveAsImage(canvas, 1600, 1200, img_type);
			}

		}

		$bgimg.onload = function() {
			updateImage();
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
			if ($fill.value == 'image_wolf') {

				img_type = 'png';
				$('#downloadlink').attr('download', 'zoombackground.png');
				$bgimg.src = 'img/Wolf_Head_1920x1280.png';

				// updateImage() will be called by the onload handler after image is loaded

			} else if ($fill.value == 'image_hunt') {

				img_type = 'jpg';
				$('#downloadlink').attr('download', 'zoombackground.jpg');
				$bgimg.src = 'img/_MAH4314hunt_apr_ext-X2.jpg';

				// updateImage() will be called by the onload handler after image is loaded

			} else if ($fill.value == 'image_belltower') {

				img_type = 'jpg';
				$('#downloadlink').attr('download', 'zoombackground.jpg');
				$bgimg.src = 'img/001_BellTowerBluePurple_1920x1280.png';

				// updateImage() will be called by the onload handler after image is loaded

			} else if ($fill.value == 'image_hunt_night') {

				img_type = 'jpg';
				$('#downloadlink').attr('download', 'zoombackground.jpg');
				$bgimg.src = 'img/002_HuntAtNight_1920x1080.png';

				// updateImage() will be called by the onload handler after image is loaded

			} else {
				img_type = 'png';
				$('#downloadlink').attr('download', 'zoombackground.png');
				updateImage();
			}
		}

		$align.oninput = function(e) {
			updateImage();
		}
	}


	function drawBgImageIntoCanvas(ctx) {

		var realWidth = $bgimg.naturalWidth;
		var realHeight = $bgimg.naturalHeight;

		if ($ratio.value == '16x9') {
			canvasWidth = 1920;
			canvasHeight = 1080;
		} else {
			canvasWidth = 1600;
			canvasHeight = 1200;
		}

		var scaleW, scaleH, scale;

		scaleW = canvasWidth / realWidth;
		scaleH = canvasHeight / realHeight;

		if (scaleW < scaleH) {
			scale = scaleH;
		} else {
			scale = scaleW;
		}

		newWidth = Math.ceil(realWidth * scale);
		newHeight = Math.ceil(realHeight * scale)

		originW = (canvasWidth / 2) - (newWidth / 2);
		originH = (canvasHeight / 2) - (newHeight / 2);

		ctx.drawImage($bgimg, originW, originH, newWidth, newHeight);
	}


	function fillBackground(ctx, w, h) {

		if ($fill.value === 'radial1') {

			var radialGrd = ctx.createRadialGradient(w/2, h*.9, 400, w/2, h*.9, h);
			radialGrd.addColorStop(0, default_gradient_color_main);
			radialGrd.addColorStop(1, default_gradient_color_dark);

			ctx.fillStyle = radialGrd;
			ctx.fillRect(0, 0, w, h);

		} else if ($fill.value === 'radial2') {

			var radialGrd = ctx.createRadialGradient(w/2, h*.9, 400, w/2, h*.9, h);
			radialGrd.addColorStop(0, default_gradient_color_dark);
			radialGrd.addColorStop(1, default_gradient_color_main);

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

		} else if ($fill.value.startsWith('solid_')) {

			// solid color
			ctx.fillStyle = '#' + $fill.value.replace('solid_', '');
			ctx.fillRect(0, 0, w, h);

		} else if ($fill.value.startsWith('image_')) {

			drawBgImageIntoCanvas(ctx);

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
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

