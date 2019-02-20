<script type="text/javascript" src="webcam.js"></script>
    <script>
        webcam.set_api_url( '/upload.php' );
        webcam.set_quality( 100 ); // JPEG quality (1 - 100)
        webcam.set_shutter_sound( true ); // play shutter click sound
        
        webcam.set_hook( 'onComplete', 'my_completion_handler' );
        
        function take_snapshot() {
            // take snapshot and upload to server
            document.getElementById('upload_results').innerHTML = '<img src="uploading.gif">';
            webcam.snap();
        }
        
        function my_completion_handler(msg) {
            // extract URL out of PHP output
            if (msg.match(/(http\:\/\/\S+)/)) {
                var image_url = RegExp.$1;
                // show JPEG image in page
                document.getElementById('upload_results').innerHTML = 
                    '<input type="hidden" name="cltpictures" id="cltpictures" value="'+image_url+'">' + 
                    '<img src="' + image_url + '">';
                
                // reset camera for another shot
                webcam.reset();
            }
            
            else alert("PHP Error: " + msg);
        }
    </script>  <div class="form-group">
                  <label for="firstname">First Name</label>  <script>
                document.write(webcam.get_html(320, 240));
                </script>
                <br/>
                <br/><center><input type="button" class="snap btn btn-success btn-lg" value="CAPTURE" onClick="take_snapshot()">
            </center>
                </div>
                <div class="form-group">
                  <label for="username">Username</label><div class="col-sm-5">
                <div id="upload_results" class="border">
                <input type="hidden"  name="cltpictures">
                    <img src="logo.jpg" />
                </div>
                </div>