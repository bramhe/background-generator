
<!doctype html>
<html>
<head>
    <title>SEAS Zoom Virtual Background Generator</title>
    <meta charset="utf-8" />
    <script src="canvas2image.js"></script>
    <script src="https://use.typekit.net/dhg1qiw.js" type="text/javascript"></script>
    <script type="text/javascript">/*<![CDATA[*/try{Typekit.load({ async: false });}catch(e){}/*]]>*/</script>
    <link rel="stylesheet" href="styles.css">
</head>
<body>


<div class="doc">
    <h1>SEAS Zoom Virtual Background Generator</h1>

    <canvas width="1920" height="1080" id="cvshd"></canvas>
    <canvas width="1600" height="1200" id="cvs"></canvas>

    <p>
        This tool creates a virtual background to use during class Zoom sessions. When using this background, situate yourself in such a way to minimize overlap with your name.
</p><p>
Note: If your name appears backwards to you, don't worry! It displays correctly to others. If you want your name to read correctly to you, uncheck “Mirror my video” in your Zoom video settings.
</p><p>
Options: Add a phonetic pronunciation, an area affiliation, and preferred pronouns.
    </p>

    <div>
        <p>
            <table>
                <tr>
                    <th>
                        First Name:
                    </th>
                    <td>
                        <input type="text" id="first" placeholder="firstname" tabindex="1">
                    </td>
                    <td rowspan="2" align="center" >
                        <button id="createimage" tabindex="4">Save Image</button>

                        <div id="ratioOptions">
                            <input type="radio" id="optionHD" name="imageStyle" value="HD" checked="checked">
                            <label for="optionHD">HD</label>
                            <input type="radio" id="option43" name="imageStyle" value="43">
                            <label for="option43">4:3</label>
                            <div id="ratioTooltip">Leave the ratio as HD by default.  ONLY choose 4:3 if you are
                                                   using the lower ratio video in Zoom and your name is being cut off.
                            </div>
                       </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        Last Name:
                    </th>
                    <td>
                        <input type="text" id="last" placeholder="lastname" tabindex="2">
                    </td>
                </tr>
                <tr>
                    <th>
                         Preferred Pronouns:<br/>
                         (optional)
                    </th>
                    <td>
                        <input type="text" id="pronoun" placeholder="pronouns" tabindex="3">
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
        After you are happy with your new virtual background use the "Save" button to save it to your local machine. Set it as your virtual background in your Zoom settings.
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

        $nameTxt, $first, $last, $pronoun,
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

        $first =document.getElementById('first');
        $last = document.getElementById('last');
        $pronoun = document.getElementById('pronoun');

        //$placeLeft = document.getElementById('placeLeft');
        //$placeRight = document.getElementById('placeRight');



        var queryString = window.location.search;
        var urlParams = new URLSearchParams(queryString);
        var firstVal  = urlParams.get('first');
        var lastVal = urlParams.get('last');
        $radialParm = urlParams.get('r');

        if (firstVal){$first.value = firstVal};
        if (lastVal){$last.value = lastVal};


        bind();

        if (firstVal && lastVal){
            updateImage();
        }
    }


    function drawHD(){
        draw(ctxhd, 1920, 1080);
            document.getElementById('explanation').style="display:block";

            var type = 'jpg',
                w = 1920,
                h = 1080;
            $imgs.innerHTML = '';
            $imgs.appendChild(Canvas2Image.convertToImage(canvashd, w, h, type))
    }


    function draw43(){
        draw(ctxorig, 1600, 1200);
            document.getElementById('explanation').style="display:block";


            var type = 'jpg',
                w = 1600,
                h = 1200;
            $imgs.innerHTML = '';
            $imgs.appendChild(Canvas2Image.convertToImage(canvas, w, h, type))
    }

    function updateImage(){
        if ($optionHD.checked){
            drawHD();
        }else{
            draw43();
        }

    }


    function bind () {

        $createimage.onclick = function (e) {
            updateImage();
            if ($optionHD.checked){
                Canvas2Image.saveAsImage(canvashd, 1920, 1080, 'jpg');
            }else {
                Canvas2Image.saveAsImage(canvas, 1600, 1200, 'jpg');

            }
        }

        $last.oninput = function (e) {
            updateImage();
        }
        $first.oninput = function (e) {
            updateImage();
        }
        $pronoun.oninput = function (e) {
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

        if ($fill1.checked){
            var radialGrd = ctx.createRadialGradient(w/2, h*.9, 400, w/2, h*.9, h);
            radialGrd.addColorStop(0, "#2F65A7");
            radialGrd.addColorStop(1, "#00274C");

            return radialGrd;
        }else if ($fill2.checked){
            var grd = ctx.createLinearGradient(0,0,0,h);
            grd.addColorStop(0,"#00274C");
            grd.addColorStop(0.75,"#2F65A7");
            return grd;
        }else if ($fill3.checked){
            var radialGrd = ctx.createRadialGradient(w/2, h*.9, 400, w/2, h*.9, h);
            radialGrd.addColorStop(0.75, "#00274C");
            radialGrd.addColorStop(0.75, "#2F65A7");
            radialGrd.addColorStop(1, "#00274C");

            return radialGrd;
        }else  if ($fill4.checked){
            var grd = ctx.createLinearGradient(0,0,0,h);
            grd.addColorStop(0,"#00274C");
            grd.addColorStop(0.8,"#2F65A7");
            return grd;
        }else {
            return  '#2F65A7'; // uva blue

        }


    }


    function draw(ctx, w, h) {



        ctx.fillStyle = requestedFillStyle(ctx, w, h);
        ctx.fillRect(0,0,w,h);



        ctx.fillStyle = '#ffffff';

        if ($fill1.checked || $fill2.checked){
            ctx.fillStyle = '#ffffff';
        }
        ctx.font = "bold 150px franklin-gothic-urw,Arial";

        var rightMargin = 50;
        var topMargin = 50;
        var verticalLineWidth = 8;

        var firstMeasurement = ctx.measureText($first.value).width;

        // last name will be smaller
        ctx.font = "bold 100px franklin-gothic-urw,Arial";

        var lastMeasurement = ctx.measureText($last.value).width;
        var maxWidth = firstMeasurement > lastMeasurement ? firstMeasurement : lastMeasurement;

        var firstLineBase = 160;
        var secondLineBase = 280;
        var thirdLineBase = 400;

        //maxWidth = w*.36;
        if (maxWidth > (w*.36)){
            maxWidth = w*.36;
        }


        ctx.font = "bold 150px franklin-gothic-urw,Arial";


        ctx.fillText($first.value, w - maxWidth - rightMargin, firstLineBase, maxWidth );

        ctx.font = "bold 100px franklin-gothic-urw,Arial";
        ctx.fillText($last.value, w - maxWidth - rightMargin, secondLineBase, maxWidth );

        ctx.font = "normal 80px franklin-gothic-urw,Arial";

        ctx.fillText($pronoun.value, w - maxWidth - rightMargin, thirdLineBase, maxWidth );


        ctx.fillStyle = '#FFCB05'; //uva maize
        ctx.fillRect(w - maxWidth - 80, topMargin, verticalLineWidth, secondLineBase - 30);

        if ($pronoun.value){
            ctx.fillRect(w - maxWidth - 80, topMargin, verticalLineWidth, thirdLineBase - 30);
        }


    }






    onload = init;
</script>
</body>
</html>

