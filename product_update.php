<?php
    include("staff_header.php");
    require('database.php');
    $id=$_REQUEST['id'];
    $query = "SELECT * FROM product where id='".$id."'"; 
    $result = mysqli_query($con, $query) or die ( mysqli_error($con));
    $row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Update Product Record</title>
    <link rel="stylesheet" href="css/product_update.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> <!--to use boxicons icons-->
</head>
</head>
<body>
    <?php
        $status = "";
        if(isset($_POST['new']) && $_POST['new']==1){
            $product_name =$_REQUEST['product_name'];
            $product_desc =$_REQUEST['product_desc'];
            $product_price =$_REQUEST['product_price'];
            $product_cat =$_REQUEST['product_category'];
            $product_quantity = $_REQUEST['product_quantity'];
            $date_record = date("Y-m-d H:i:s");
            $submittedby = $_SESSION["customer_ID"];

            if ($_FILES['new_image']['size']>0){
                $allowedExtensions=['png','jpeg','jpg'];
                $newUploadedFileName = $_FILES['new_image']['name'];
                $fileExtension=strtolower(pathinfo($newUploadedFileName, PATHINFO_EXTENSION));
            
                if(in_array($fileExtension, $allowedExtensions)){
                    $targetDirectory = "product_image/";
                    $targetFilePath = $targetDirectory . $newUploadedFileName;
            
                    if (move_uploaded_file($_FILES['new_image']['tmp_name'], $targetFilePath)) {
                        $selectQuery = "SELECT product_image FROM product WHERE id = $id";
                        $result = mysqli_query($con, $selectQuery);
                        $row = mysqli_fetch_assoc($result);
                        $oldFilename = $row['product_image'];
                        $oldFilePath = "product_image/" . $oldFilename;
                        if (file_exists($oldFilePath) && !is_dir($oldFilePath)) {        
                            unlink($oldFilePath);//remove the file
                        }

                        $updateFileQuery="UPDATE product SET product_name = '$product_name', product_desc = '$product_desc', product_price = '$product_price', product_cat = '$product_cat', product_quantity = '$product_quantity', product_image = '$newUploadedFileName', product_reg_date = '$date_record', submittedby = '$submittedby' WHERE id = $id";
                        mysqli_query($con, $updateFileQuery) or die(mysqli_error($con));
                        $status = "Product updated successfully.";
                        header("Location: product_record.php?update=success");
                    }else{
                        $status = "Product update failed.";
                    }
                }else{
                    $status = "Invalid file type.";
                }
            }else{
                $update_query="UPDATE product SET product_name = '$product_name', product_desc = '$product_desc', product_price = '$product_price', product_cat = '$product_cat', product_quantity = '$product_quantity', product_reg_date = '$date_record', submittedby = '$submittedby' WHERE id = $id";
                mysqli_query($con, $update_query) or die(mysqli_error($con));
                $status = "Product details updated successfully.";
                header("Location: product_record.php");
            }
        }else{
    ?>

    <div class="container">
        <div class="child">
            <div class="wrapper">
                <form enctype="multipart/form-data" action="" method="post" name="form">
                    <h1>Update Product Record</h1> 
                    <!-- Specify this form as a new submission -->
                    <input type="hidden" name="new" value="1" /> 
                    <!-- product_name -->
                    <div class="input-box">
                        <input type="text" name="product_name" placeholder="Enter Product Name" required value="<?php echo $row['product_name'];?>"/>
                        <i class='bx bx-devices'></i>
                    </div>
                    <!-- product_description -->
                    <div class="input-box">
                        <input type="text" name="product_desc" placeholder="Enter Product Description" required value="<?php echo $row['product_desc'];?>"/>
                        <i class='bx bx-message-square-detail'></i>
                    </div>
                    <!-- product_price -->
                    <div class="input-box">
                        <input type="number" name="product_price" step="0.01" min="0" placeholder="Enter Product Price (RM)" required value="<?php echo $row['product_price'];?>"/>
                        <i class='bx bx-purchase-tag'></i>
                    </div>
                    <!-- product_category -->
                    <div class="input-box">
                        <select name="product_category" id="category" required>
                            <option value="<?php echo $row['product_cat'];?>"><?php echo $row['product_cat'];?></option>
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
                        <input type="number" name="product_quantity" placeholder="Enter Product Quantity" required value="<?php echo $row['product_quantity'];?>"/>
                        <i class='bx bx-list-check'></i>
                    </div>
                    <!-- product_picture -->
                    <!-- <input type="file" name="file" id="fileInput" required/>
                    <label for="fileInput">Upload Product Image<i class='bx bx-upload' ></i></label> -->
                    <label>Upload Product Image<i class='bx bx-upload' ></i></label>
                    <input type="file" class="uploadbtn" name="new_image" value="<?php echo $row['product_image'];?>"/>
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
    <?php } ?>
</body>
</html>