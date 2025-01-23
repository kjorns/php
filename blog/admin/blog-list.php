<?php
ini_set("date.timezone", "America/Chicago");

require_once('../../includes/blog-session-timeout.php');
require_once('../../includes/connection.php');
// create database connection
$conn = dbConnect('read');
$sql = 'SELECT *, DATE_FORMAT(created, "%a, %b %D, %Y") AS date_created FROM php_blog_blog ORDER BY created DESC';
$result = $conn->query($sql) or die(mysqli_error());

$numRows = $result->num_rows;

$nav = "blog-admin";
$title_section = "Blog: Admin - List";

include("../../includes/title-page-name.php");
include("../../includes/header.php");
?>

<main>
        <h2>
                  <?= $title_section; ?>
            <span><?= $title_page_name; ?></span>
        </h2>
    
<p><a href="blog-insert.php">Insert New Entry</a></p>
    
<?php
#######################################
# Display message if no records found #
#######################################
if ($numRows == 0) {
?>
  <p>No Records Found</p>
<?php
##################################
# Otherwise, display the results #
##################################
} else {
?>
<table>
  <tr>
    <th scope="col">Created</th>
    <th scope="col">Title</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
  </tr>
  <?php while($row = $result->fetch_assoc()) { ?>
  <tr>
    <td><?php echo $row['date_created']; ?></td>
    <td><?php echo $row['title']; ?></td>
    <td><a href="blog-update.php?article_id=<?php echo $row['article_id']; ?>">EDIT</a></td>
    <td><a href="blog-delete.php?article_id=<?php echo $row['article_id']; ?>">DELETE</a></td>
  </tr>
  <?php } ?>
</table>
<?php
####################################################
# Close the else clause wrapping the results table #
####################################################
}
?>

<?php
if ( $_SESSION['authenticated'] == "robert99" ) {
    // Loading code to CRUD pages
    include('blog-page-list-inc.php'); 
}
?>
    
<br>
            
<?php include('../../includes/blog-logout.php'); ?>
    
</main>
        
<?php
include("../../includes/sidebar.php");
include("../../includes/footer.php");
?>