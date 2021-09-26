<?php
// Configurazione
$conf = json_decode(file_get_contents("conf.json"));

if (!empty($conf->header)) {
   require_once($conf->header);
}
 
// Pick up data
$search = $_POST["search"];
if (!empty($conf->specificFile)) {
    $ext = "*.$conf->specificFile";
} else {
    $ext = "*";
}

if ($conf->goDown === true) {
   $dow = "<br>";
} else {
   $down = "";
}

$dir = $conf->searchDir;

// Load options
foreach (glob("$dir/*$ext") as $file) {
    if (!empty($conf->limitOutput) && $conf->limitOutput > 0 && $rep < $limitOutput) {
      if ($conf->underlined === true) {
        $file = str_replace($search, '<u>' .$search. '</u>', $file);
      }
      if ($conf->showDir === false) {
        $file = str_replace($dir, "", $file);
      }
      if (!empty($conf->redi)) {
         $fileredi = str_replace("%file%", $file, $conf->redi);
         echo "<a href='$fileredi'>$file</a>$down";
      } else {
         echo "$file$down";
      }
     }
}
