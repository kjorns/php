<?php
ini_set("date.timezone", "America/Chicago");

require_once('../includes/connection.php');
require_once('../includes/utility-funcs.php');

$conn = dbConnect('read');
$sql = 'SELECT *, 
        DATE_FORMAT(created, "%W &mdash; %e %M %Y") AS created_date 
        FROM php_fp_blog 
        LEFT JOIN php_fp_images
        USING (image_id)
        ORDER BY created DESC'; //sorting by created 20xx-xx-xx not the alias
$result = $conn->query($sql);

$nav = "final-project";
$title_section = "Final Project";

include("includes/title-page-name.php");
include("includes/header.php");
?>

<main>
    
        <h2>
                  <?= $title_section; ?>
            <span><?= $title_page_name; ?></span>
        </h2>

<?php
    while ($row = $result->fetch_assoc()) {
        // echo "<pre>";
        // print_r($row);
        // echo "</pre><hr>";
        // clean db content
        $c_title = htmlentities($row['title'], ENT_COMPAT, 'utf-8');
        $c_article = htmlentities($row['article'], ENT_COMPAT, 'utf-8');
        $c_caption = htmlentities($row['caption'], ENT_COMPAT, 'utf-8');
?>
    <h2>
        <?php echo $c_title; ?>
        <span><?php echo $row['created_date']; ?></span>
    </h2>
        <p>
            <?php if ( ($row['filename']) && (file_exists ($_SERVER['DOCUMENT_ROOT'] . '/php/final-project/images/thumbs/' . $row['filename'])) ) { 
                echo "<img src=\"/php/final-project/images/thumbs/{$row['filename']}\" alt=\"{$c_caption}\">";
            }
            ?>
                    
            <?php 
            $extract = getFirst($row['article'], 2);
            // echo "<pre>";
            // print_r($extract);
            // echo "</pre><hr>";
                  
            echo htmlentities($extract[0], ENT_COMPAT, 'utf-8');
            if ($extract[1]) {
                echo '<a href="details.php?article_id=' .$row['article_id']. '">View More&hellip;</a>';
            } 
            ?>
        </p>
    <?php } ?>
    
</main>

<?php
include("includes/footer.php");
?>