<?php
function buildFileList($dir, $extensions) {
  if (!is_dir($dir) || !is_readable($dir)) {
	return false;
  } else {
	if (is_array($extensions)) {
	  $extensions = implode('|', $extensions);
	}
	$pattern = "/\.(?:{$extensions})$/i";
	$folder = new DirectoryIterator($dir);
	$files = new RegexIterator($folder, $pattern);
	$filenames = array();
	foreach ($files as $file) {
	  $filenames[] = $file->getFilename();
	}
	natcasesort($filenames);
	return $filenames;
  }
}
$files = buildFileList('./', 'php');
?>
		<aside>
			<h2><?php echo ucwords( str_replace('-', ' ', basename( getcwd() ) ) )?></h2>
				<nav>
					<ul>
						<?php
						foreach($files as $file) {
							if(strstr($file, 'x-') || strstr($file, '_') ) {
								//don't show these files...
							} else {
								$human_name = ucwords(str_replace( '-', ' ', basename($file, ".php")));
								if ($human_name == 'Index') $human_name = 'Home: '.$title_section;
								echo "<li><a href=\"$file\">$human_name</a></li>\n\t\t\t\t\t";
							}
						}
						?>
					</ul>
				</nav>
		</aside>