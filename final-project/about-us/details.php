<?php
ini_set("date.timezone", "America/Chicago");

require_once('../../includes/utility-funcs.php');
require_once('../includes/connection.php');
// connect to the database
$conn = dbConnect('read');
// check for article_id in query string
if (isset($_GET['article_id']) && is_numeric($_GET['article_id'])) {
  $article_id = (int) $_GET['article_id'];
} else {
  $article_id = 0;
}
$sql = "SELECT title, article, DATE_FORMAT(updated, '%W, %M %D, %Y') AS updated, filename, caption
        FROM php_fp_about_us
        LEFT JOIN php_fp_images 
        USING (image_id)
        WHERE php_fp_about_us.article_id = $article_id";
        
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$nav = "final-project";
$title_section = "About Us: Details";

include("../includes/title-page-name.php");
include("../includes/header.php");
?>
        
<main>
        
            <h2><?php if ($row) {;
            echo $row['title'];
            echo "<span>" . $row['updated'] . "</span>";
            } else {
            echo 'No Record Found';
            }
            ?>
            </h2>
            
            <?php
            if ($row && !empty($row['filename'])) {
              $filename = "/php/final-project/images/{$row['filename']}";
              
              $imageSize = getimagesize($_SERVER['DOCUMENT_ROOT'] . $filename);
              
            ?>
            <figure>
                <img src="<?php echo $filename; ?>" alt="<?php echo $row['caption']; ?>" <?php echo $imageSize[3]; ?>>
                <figcaption><?php echo $row['caption']; ?></figcaption>
            </figure>
            <?php } if ($row) { 
            $htmleArticle = htmlentities($row['article'], ENT_COMPAT, 'utf-8');
            echo convertToParas($htmleArticle); 
            
            } ?>
            <p><a href="/php/final-project/">Back To About Us </a></p>
            
</main>

<?php
include("../includes/footer.php");
?>