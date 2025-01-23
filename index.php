<?php
ini_set("date.timezone", "America/Chicago");

$nav = "home";
$title_section = "Katie";

include("includes/title-page-name.php");

include("includes/header.php");
?>

    <main>

    <h2>
        Katie
        <span>Home</span>
    </h2>
    
    </main>

    <aside>
        <h2>PHP</h2>
        <nav>
            <ul>
                <li><a class="current" href="/php/">Home</a></li>
                <li><a href="/php/assignments/">Assignments</a></li>
                <li><a href="/php/blog/">Blog</a></li>
                <li><a href="/php/final-project/">Final Project</a></li>
            </ul>
        </nav>
    </aside>

<?php
include("includes/footer.php");
?>