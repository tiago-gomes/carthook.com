<?php

function recursiveScan($dir) {
    $tree = glob(rtrim($dir, '/') . '/*');
    if (is_array($tree)) {
        foreach($tree as $file) {
            if (is_dir($file)) {
                recursiveScan($file);
            } elseif (is_file($file)) {
                echo $file . "\n";
				$regex = "/0aH*/";
				if(preg_match($regex, $file, $matche)) {
					echo $matches[0]."\n";
				}
            }
        }
    }
}

echo recursiveScan('test/');
