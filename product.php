<?php
require('database.php');
require('main_header.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Product Records</title>
    <!-- css -->
    <link rel="stylesheet" href="css/product.css">
    <!-- swiper css -->
    <link rel="stylesheet" href="css/swiper-bundle.min.css">
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
                    </div>
                </div>
                <div id="ca_content">
                    <p class="cat_title">Charging Accessories</p>
                    <div class="line"></div>
                    
                    <!-- <div class="flexbox-container">     
                        <div>Content 1</div>
                        <div>Content 2</div>
                        <div>Content 3</div>
                        <div>Content 4</div>
                        <div>Content 4</div>
                    </div> -->
                    <div class="largest_box"><!--body-->
                        <div class="content_box swiper"> <!--container-->
                            <div class="slide_container">
                                <div class="card_wrapper swiper-wrapper">
                                    <?php
                                        $count=1;
                                        $sel_query = "SELECT * FROM product WHERE product_cat = 'Charging Accessories' ORDER BY id DESC;";
                                        $result = mysqli_query($con,$sel_query);
                                        $currencySymbol = "RM";
                                        while($row = mysqli_fetch_assoc($result)) { 
                                    ?>
                                        <div class="card swiper-slide">
                                            <div class="image_box"> 
                                                <img src="product_image/<?php echo $row["product_image"]; ?>"/>
                                            </div>
                                            <div class="product_details">
                                                <div class="product_name">
                                                    <p><?php echo $row["product_name"]; ?></p>                                           
                                                </div>
                                                <div class="product_desc">
                                                    <p><?php echo $row["product_desc"]; ?></p>
                                                </div>
                                                <div class="product_price">
                                                    <p><?php echo $currencySymbol . $row["product_price"]; ?></p>
                                                </div>
                                                <div class="order_btn">
                                                    Add to cart
                                                </div>
                                            </div>
                                        </div>
                                    <?php $count++; } ?>
                                </div>
                                <div class="swiper-button-next swiper-navBtn"></div>
                                <div class="swiper-button-prev swiper-navBtn"></div>
                                <!-- <div class="swiper-scrollbar"></div> -->
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
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
    
    <script src="js/swiper-bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>