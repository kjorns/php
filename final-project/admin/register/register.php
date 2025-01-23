<?php
ini_set("date.timezone", "America/Chicago");

if (isset($_POST['register'])) {
  $username = trim($_POST['username']);
  $password = trim($_POST['pwd']);
  $retyped = trim($_POST['conf_pwd']);
  require_once('../../includes/register-user-mysqli.php');
}

$nav = "final-project";
$title_section = "Admin - Register";

include("../../includes/title-page-name.php");
include("../../includes/header.php");
?>

<main>
        <h2>
                  <?= $title_section; ?>
            <span><?= $title_page_name; ?></span>
        </h2>
    
<?php
if (isset($success)) {
  echo "<p>$success</p>";
} elseif (isset($errors) && !empty($errors)) {
  echo '<ul>';
  foreach ($errors as $error) {
    echo "<li>$error</li>";
  }
  echo '</ul>';
}
?>
    
    <form id="form1" method="post" novalidate>
        <fieldset>
            <legend><?php echo $title_page_name; ?></legend>
            <ol>
                <li>
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" required>
                </li>
                <li>
                    <label for="pwd">Password:</label>
                    <input type="password" name="pwd" id="pwd" required>
                </li>
                <li>
                    <label for="conf_pwd">Confirm Password:</label>
                    <input type="password" name="conf_pwd" id="conf_pwd" required>
                </li>
                <li>
                    <input name="register" type="submit" id="register" value="Register">
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
                <li><a href="/php/final-project/admin/login.php">Log In</a></li>
                <li><a class="current" href="/php/final-project/admin/register/register.php">Register</a></li>
            </ul>
        </nav>
    </aside>

<?php
include("../../includes/footer.php");
?>