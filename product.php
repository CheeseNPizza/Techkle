<?php
require('database.php');
require('main_header.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Product Records</title>
    <link rel="stylesheet" href="css/product.css">
</head>
<body>
    <div class="container">
        <div>
            <div class="techkle_big_img">
                <img src="css/techkle banner.jpeg">
                <button id="scrollDownBtn">Let's get started!</button>
            </div>
            <div id="content">
                <div class="techkle_animate">
                    <h2>Techkle</h2>
                    <h2>Techkle</h2>
                </div>
                <h3>Explore a world of gadgets. Start browsing now!</h3>
                <div class="nav_bar">
                    <p>Category</p>
                    <div class="flex-container">
                        <div id="ca"><img src="css/category_image/ca.jpg"></div>
                        <div id="pc"><img src="css/category_image/pc.jpg"></div>
                        <div id="aa"><img src="css/category_image/aa.jpg"></div>
                        <div id="sa"><img src="css/category_image/sa3.jpg"></div>
                        <div id="ms"><img src="css/category_image/ms.jpg"></div>
                        <div id="cm"><img src="css/category_image/cm.jpg"></div>
                        <div id="ga"><img src="css/category_image/ga2.jpg"></div>
                        <div id="fh"><img src="css/category_image/fh2.jpg"></div>
                        <div id="fh"><img src="css/category_image/fh2.jpg"></div>
                    </div>
                </div>
                <div id="ca_content" class="ca">
                    <p>Charging Accessories</p>
                    <div class="line"></div>
                    
                        <div class="flexbox-container">
                            
                            <div>Content 1</div>
                            <div>Content 2</div>
                            <div>Content 3</div>
                            <div>Content 4</div>
                            <div>Content 4</div>
                            <!-- Add more divs as needed -->
                        </div>
                    
                </div>
                <div id="pc_content" class="ca">
                    <p>Protection and Cases</p>
                    <div class="line"></div>
                </div>
                <div id="aa_content" class="ca">
                    <p>Audio Accessories</p>
                    <div class="line"></div>
                </div>
                <div id="sa_content" class="ca">
                    <p>Storage Accessories</p>
                    <div class="line"></div>
                </div>
                <div id="ms_content" class="ca">
                    <p>Mounts and Stands</p>
                    <div class="line"></div>
                </div>
                <div id="cm_content" class="ca">
                    <p>Cleaning and Maintenance</p>
                    <div class="line"></div>
                </div>
                <div id="ga_content" class="ca">
                    <p>Gaming Accessories</p>
                    <div class="line"></div>
                </div>
                <div id="fh_content" class="ca">
                    <p>Fitness and Health Accessories</p>
                    <div class="line"></div>
                </div>
            </div>
        </div>
        

    </div>
    <script>
        //navigate user with slide down animation to content below
        document.getElementById("scrollDownBtn").addEventListener("click", function() {
            document.getElementById("content").scrollIntoView({ behavior: "smooth", block: "start" });
        });

        document.getElementById("ca").addEventListener("click", function() {
            document.getElementById("ca_content").scrollIntoView({ behavior: "smooth", block: "start" });
        });
        
        document.getElementById("pc").addEventListener("click", function() {
            document.getElementById("pc_content").scrollIntoView({ behavior: "smooth", block: "start" });
        });
        
        document.getElementById("aa").addEventListener("click", function() {
            document.getElementById("aa_content").scrollIntoView({ behavior: "smooth", block: "start" });
        });
        
        document.getElementById("sa").addEventListener("click", function() {
            document.getElementById("sa_content").scrollIntoView({ behavior: "smooth", block: "start" });
        });
        
        document.getElementById("ms").addEventListener("click", function() {
            document.getElementById("ms_content").scrollIntoView({ behavior: "smooth", block: "start" });
        });
        
        document.getElementById("cm").addEventListener("click", function() {
            document.getElementById("cm_content").scrollIntoView({ behavior: "smooth", block: "start" });
        });
        
        document.getElementById("ga").addEventListener("click", function() {
            document.getElementById("ga_content").scrollIntoView({ behavior: "smooth", block: "start" });
        });
        
        document.getElementById("fh").addEventListener("click", function() {
            document.getElementById("fh_content").scrollIntoView({ behavior: "smooth", block: "start" });
        });
    </script>
</body>

</html>