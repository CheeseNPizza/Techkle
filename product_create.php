<?php
    include("staff_header.php");
    require('database.php');
$status = "";
if(isset($_POST['new']) && $_POST['new']==1){
    $allowedExtensions=['png','jpeg','jpg'];
    $uploadedFileName = $_FILES['image']['name'];
    $fileExtension=strtolower(pathinfo($uploadedFileName, PATHINFO_EXTENSION));

    if(in_array($fileExtension, $allowedExtensions)){
        $targetDirectory = "product_image/";
        $targetFilePath = $targetDirectory . $uploadedFileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
            $product_name =$_REQUEST['product_name'];
            $product_desc =$_REQUEST['product_desc'];
            $product_price =$_REQUEST['product_price'];
            $product_cat =$_REQUEST['product_category'];
            $product_quantity = $_REQUEST['product_quantity'];
            $date_record = date("Y-m-d H:i:s");
            $submittedby = $_SESSION["customer_ID"];
            $ins_query="INSERT into product (`product_name`,`product_desc`,`product_price`,`product_cat`,`product_quantity`,`product_image`,`product_reg_date`,`submittedby`)values
            ('$product_name','$product_desc','$product_price','$product_cat','$product_quantity','$uploadedFileName','$date_record','$submittedby')";
            mysqli_query($con,$ins_query) or die(mysqli_error($con));
            $status = "New product inserted successfully.";
            header("Location: product_record.php");
        }else{
            $status = "Product insert failed.";
        }
    }else{
        $status = "Invalid file type.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Insert New Product</title>
    <link rel="stylesheet" href="css/product_create.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> <!--to use boxicons icons-->
</head>

<body>
<div class="container">
    <div class="child">
        <div class="wrapper">
            <form enctype="multipart/form-data" action="" method="post" name="form">
                <h1>Insert New Product</h1>
                <!-- Specify this form as a new submission -->
                <input type="hidden" name="new" value="1" /> 
                <!-- product_name -->
                <div class="input-box">
                    <input type="text" name="product_name" placeholder="Enter Product Name" required/>
                    <i class='bx bx-devices'></i>
                </div>
                <!-- product_description -->
                <div class="input-box">
                    <input type="text" name="product_desc" placeholder="Enter Product Description" required/>
                    <i class='bx bx-message-square-detail'></i>
                </div>
                <!-- product_price -->
                <div class="input-box">
                    <input type="number" name="product_price" step="0.01" min="0" placeholder="Enter Product Price (RM)" required/>
                    <i class='bx bx-purchase-tag'></i>
                </div>
                <!-- product_category -->
                <div class="input-box">
                    <select name="product_category" id="category" required>
                        <option value="" disabled selected>Select a Category</option>
                        <option value="Charging Accessories">Charging Accessories</option>
                        <option value="Protection and Cases">Protection and Cases</option>
                        <option value="Audio Accessories">Audio Accessories</option>
                        <option value="Storage Accessories">Storage Accessories</option>
                        <option value="Mounts and Stands">Mounts and Stands</option>
                        <option value="Cleaning and Maintenance">Cleaning and Maintenance</option>
                        <option value="Gaming Accessories">Gaming Accessories</option>
                        <option value="Fitness and Health Accessories">Fitness and Health Accessories</option>
                    </select>     
                </div>          
                <!-- product_quantity -->
                <div class="input-box">
                    <input type="number" name="product_quantity" placeholder="Enter Product Quantity" required/>
                    <i class='bx bx-list-check'></i>
                </div>
                <!-- product_picture -->
                <!-- <input type="file" name="file" id="fileInput" required/>
                <label for="fileInput">Upload Product Image<i class='bx bx-upload' ></i></label> -->
                <label>Upload Product Image<i class='bx bx-upload' ></i></label>
                <input type="file" class="uploadbtn" name="image" required/>
                <!-- submit button -->
                <div class="registerbtn">
                    <input type="submit" name="submit" value="Submit">
                </div>
                <div class="register">
                    <p>View product record? <a href="product_record.php"> Click here </a></p>
                </div>
            </form>
            <p style="color:#008000;"><?php echo $status; ?></p>   
        </div>
    </div>
</div>

</body>
</html>