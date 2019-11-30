<?php require_once(__DIR__ . '/header.php');
 require_once(__DIR__ . '/includes/connection.php'); ;

session_start();
if(!$_SESSION){

    header('Location: login.php ');

}

if(empty($_GET['id'])){
    header('Location: galleries-overview.php');
}

echo $_SESSION['type'];

?>



<h1>Gallery</h1>

<button id="upload_images" type="submit">Upload images</button>


<?php 

$query = 'SELECT photoID, price, photoFile, format FROM tphotos WHERE galleryID = '. $_GET['id'] .'';

$results = mysqli_query($db, $query);

while($row = mysqli_fetch_array($results)){

    echo '<div id="photo_' . $row['photoID'] . '">';

            echo '<div class="photo_price"> ' .$row['price'] . '</div>';
            echo '<img class="img_size" src="data:image/'. $row['format'] .';base64,'. base64_encode($row['photoFile']) .'">';
            if($_SESSION['type'] == 'user'){ echo '<div class="BtnBuyImage" id="'. $row['photoID'] .'">Buy Image</div>'; };
            if($_SESSION['type'] == 'photographer'){ echo '<div class="BtnDeleteImage" id="'. $row['photoID'] .'">Delete Image</div>'; };

    echo '</div>';


}


?>


<div id="select_card" class="hide">

<!-- SOLUTION THAT MAKES IT EASIER TO SELECT CARD WHILE TESTING PAYMENTS -->
        <select>
        <option disabled selected >CHOOSE CARD</option>
                <?php 
                $query = 'SELECT cardID, ibanCode FROM tcards WHERE userID = ' .$_SESSION['ID'] .'';
                $results = mysqli_query($db, $query);
                while($row = mysqli_fetch_array($results)){

                    echo '<option value=" '. $row['cardID'] .' "> '. $row['ibanCode'] .' </option>';
                    
                }
                ?>
        </select>

</div>



<?php

$sLinkToScript4 = '<script src="js/upload-images.js"></script>';
$sLinkToScript3 = '<script src="js/delete-image.js"></script>';
$sLinkToScript2 = '<script src="js/select-card.js"></script>';
$sLinkToScript = '<script src="js/create-payment.js"></script>';


require_once(__DIR__ . '/footer.php'); ?>

