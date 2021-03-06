<?php
// TITLE: Self extract archive file php.
// AUTHOR: uzulla <zishida@gmail.com>
// LICENSE: MIT
// (Above copyright and license is only self extract part. zip(contents) part is not affected.)

// Run this php, will be extract contain files in same dir.
// IMPORTANT: FILES BE OVERWRITE! BE CAREFULL!
// require ext-zip

ini_set('memory_limit', '512M'); // as you like

const MAX_HEADER_LENGTH = 10 * 1024; // magic
const TMP_ZIP_NAME = __FILE__ . ".zip";

# Read self. and calc offset.
$fh = fopen(__FILE__, 'r') or die("Open myself failed. exit.");
$str = fread($fh, MAX_HEADER_LENGTH);
$offset = strpos($str, '__halt_compiler' . '();') + strlen('__halt_compiler' . '();'."\n");

# Cut out zip file from self. and save zip file
rewind($fh);
fseek($fh, $offset);
$tfh = fopen(TMP_ZIP_NAME, "w");
while($bin = fread($fh,1024)){
    fwrite($tfh, $bin);
}
fclose($tfh);

# extract zip
$zip = new ZipArchive;
$res = $zip->open(TMP_ZIP_NAME);
if ($res === true) {
    if (!$zip->extractTo(__DIR__)) {
        exit('Extract failed. exit.');
    }
    $zip->close();
    echo "File extracted. <br>\n";
} else {
    exit ('Zip open failed. code:' . $res);

}

# clean up files.
if(!@unlink(TMP_ZIP_NAME)){
    echo "Failed delete to ". htmlspecialchars(TMP_ZIP_NAME,ENT_QUOTES) . ". please delete yourself. <br>\n";
}
if(!@unlink(__FILE__)){
    echo "Failed delete to ". htmlspecialchars(TMP_ZIP_NAME,ENT_QUOTES) . ". please delete yourself. <br>\n";
}

# post execute idea
// chmod ( "some/dir" , 777 );

# End of code.

# The file must be end "compiler();\n". not "compiler();" or "compiler();\n[ ]" or whatelse.
__halt_compiler();
