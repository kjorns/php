<?php
require_once('../includes/google-recaptcha-library.php');
$g_recaptcha_key_site = '6Lfix7oUAAAAAMY4quueZTa0AAzS7a-VPjqCNSQJ';
$g_recaptcha_key_secret = '6Lfix7oUAAAAAIjds-M5qZYh-2uS7i8uIuxYU1ZB';
$js_head = '<script src="https://www.google.com/recaptcha/api.js"></script>';

# Email Validation and Sending
$errors = array();
$missing = array();
// var_dump($_POST);
// check if the form has been submitted
if (isset($_POST['send'])) {
    // email processing script
    $to = 'robert@nwtc-web.com';
    $subject = 'Final Project - Contact Us';
    // list expected fields
    $expected = array('name', 'email', 'comments');
    // set required fields
    $required = array('name', 'email', 'comments');
    // create additional headers
    $headers = "From: Kaitlyn Jorns<kaitlyn.jorns@mymail.nwtc.edu>\r\n";
    $headers .= 'Content-Type: text/plain; charset=utf-8';
  
    // Place results of g_recaptcha_request() in $g_recaptcha_response
    $g_recaptcha_response = g_recaptcha_request();
    //var_dump($g_recaptcha_response);exit;
    if (!$g_recaptcha_response->success) {
      $errors['recaptcha'] = true;
    }

require('../includes/process-email.php');
    
  if ($mailSent) {
    header('Location: thank-you.php');
    exit;
  }
} // close: if (isset($_POST['send']))

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
        
        <form name="contactform" method="post">
            <fieldset>
                    <legend><?php echo $title_page_name; ?></legend>
                    <ol>
                        
                        <li <?php if ($missing && in_array('name', $missing)) echo ' class="error"'; ?>>
                            <?php if ($missing && in_array('name', $missing)) { ?>
                              <strong>Please enter your name</strong>
                            <?php } ?>
                            <label for="name">Name:</label>
                            <input name="name" id="name" type="text" class="formbox"
                            <?php if (isset($name)) { 
                             echo 'value="' . htmlentities($name, ENT_COMPAT, 'UTF-8') . '"';
                            } ?>>
                        </li>
                        
                        <li <?php if ( ($missing && in_array('email', $missing)) || (isset($errors['email'])) ) echo ' class="error"'; ?>>
                            <?php if ($missing && in_array('email', $missing)) { ?>
                              <strong>Please Enter Your E-Mail</strong>
                            <?php } elseif (isset($errors['email'])) { ?>
                              <strong>Invalid E-Mail Address</strong>
                            <?php } ?>
                            <label for="email">E-Mail:</label>
                            <input name="email" id="email" type="text" class="formbox"
                            <?php if (isset($email)) { 
                             echo 'value="' . htmlentities($email, ENT_COMPAT, 'UTF-8') . '"';
                            } ?>>
                        </li>
                        
                        <li <?php if ($missing && in_array('comments', $missing)) echo ' class="error"'; ?>>
                            <?php if ($missing && in_array('comments', $missing)) { ?>
                              <strong>Please Enter Your Comments</strong>
                            <?php } ?>
                            <label for="comments">Comments:</label>
                            <textarea name="comments" id="comments" cols="60" rows="8"><?php
                            if (isset($comments)) {
                                echo htmlentities($comments, ENT_COMPAT, 'UTF-8');
                            } ?></textarea>
                        </li>
                        
                        <li <?php if (isset($errors['recaptcha'])) echo ' class="error"'; ?>>
                            <?php if (isset($errors['recaptcha'])) { ?>
                            <strong>Incorrect Response</strong>
                            <?php }
                            echo "<label>Answer Challenge Question</label>";
                            echo g_recaptcha_get_form_control(); ?>
                        </li>
                        
                        <li>
                            <input name="send" id="send" type="submit" value="Send message">
                        </li>
                        
                    </ol>
                </fieldset>
            
        </form>
        
        </br>
                
    </main>

<?php
include("../includes/footer.php");
?>