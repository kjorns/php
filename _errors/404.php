<?php
include("includes/404_header.php");
?>

    <main>

    <h2>
        Error
        <span>404</span>
    </h2>
        
    <img src="/php/_errors/images/404.jpg" alt="Error 404">

<?php
if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){
$refuri = parse_url($_SERVER['HTTP_REFERER']);
if($refuri['host'] == "kjorns.bitweb1.nwtc.edu"){


}
else{

}
}
else{

}
?>
    
    </main>

<?php
include("includes/404_sidebar.php");
include("includes/404_footer.php");
?>