<?php
if (extension_loaded('xdebug')) {
    echo "Xdebug activo\n";
    echo "xdebug.mode = " . ini_get('xdebug.mode') . "\n";
} else {
    echo "Xdebug NO está activo\n";
}
