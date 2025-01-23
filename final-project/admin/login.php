<?php
ini_set("date.timezone", "America/Chicago");

$error = '';
if (isset($_POST['login'])) {
  session_start();
  $username = trim($_POST['username']);
  $password = trim($_POST['pwd']);
  // location to redirect on success
  $redirect = 'index.php';
  require_once('../includes/authenticate-mysqli.php');
}

$nav = "final-project";
$title_section = "Admin - Log In";

include("../includes/title-page-name.php");
include("../includes/header.php");
?>

<main>
        <h2>
                  <?= $title_section; ?>
            <span><?= $title_page_name; ?></span>
        </h2>
    
<?php
if ($error) {
  echo "<p class=\"error\">$error</p>";
} elseif (isset($_GET['expired'])) {
?>
<p class="error">Your Session Has Expired. Please Log In Again.</p>
<?php } ?>
    
        <form id="form1" method="post">
            <fieldset>
                <legend>Log In</legend>
                <ol>
                    <li>
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username">
                    </li>
                    <li>
                        <label for="pwd">Password:</label>
                        <input type="password" name="pwd" id="pwd">
                    </li>
                    <li>
                        <input name="login" type="submit" id="login" value="Log in">
                    </li>
                    </ol>
            </fieldset>
        </form>
    
<br>
</main>

    <aside>
        <h2>Admin Section</h2>
        <nav>
            <ul>
                <li><a class="current" href="/php/final-project/admin/login.php">Log In</a></li>
                <li><a href="/php/final-project/admin/register/register.php">Register</a></li>
            </ul>
        </nav>
    </aside>

<?php
include("../includes/footer.php");
?>