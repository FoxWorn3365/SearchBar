<?php
// Configurazione
if (file_exists("conf.json")) {
    $conf = json_decode(file_get_contents("conf.json"));
} else {
    die("File <code>conf.json</code> <b>NOT FOUND</b>");
}

if (!empty($conf->header)) {
   require_once($conf->header);
}
 
// Pick up data
$search = $_POST["search"];

if (empty($search)) {
   die($conf->errorMessages->errorEmptyVar);
}

if (!empty($conf->specificFile)) {
    $ext = "*.$conf->specificFile";
} else {
    $ext = "*";
}

if ($conf->goDown === true) {
   $dow = "<br>";
} else {
   $dow = "";
}

$dir = $conf->searchDir;

$rep = 0;
// Load options
foreach (glob("$dir/*$search$ext") as $filea) {
    if (!empty($conf->limitOutput) && $conf->limitOutput > 0 && $rep < $conf->limitOutput) {
      if ($conf->underlined === true) {
        $file = str_replace($search, '<u>' .$search. '</u>', $filea);
      }
      if ($conf->showDir === false) {
        $file = str_replace("$dir/", "", $file);
      }
      if (!empty($conf->redi)) {
         $fileredi = str_replace("%file%", $filea, $conf->redi);
         echo "<a href='$fileredi'>$file</a>$dow";
      } else {
         echo "$file$down";
      }
      $rep++;
     }
}
