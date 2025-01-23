<?php
ini_set("date.timezone", "America/Chicago");

// Set $title_page_name based on the actual name of the PHP file
$title_page_name = basename($_SERVER['SCRIPT_FILENAME'], '.php');
if($title_page_name != 'index') {
    $title_page_name = str_replace('-', ' ', $title_page_name);
    $title_page_name = ucwords($title_page_name);
} else {
    $title_page_name = null;
}

$nav = "final-project";
$title_section = "Contact Us";

include("../includes/title-page-name.php");
include("../includes/header.php");
?>

    <main>

        <h2>
           <?php echo $title_section; ?>
           <span><?php echo $title_page_name; ?></span>
        </h2>
        
        <h3>Thank You For Your Message!</h3>
                
    </main>

<?php
include("../includes/footer.php");
?>