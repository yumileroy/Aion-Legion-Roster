<?php

/* Checks for presence of the zlib extension and enables zlib compression if zlib exists. */
if (in_array  ('zlib', get_loaded_extensions())) {
    ini_set('zlib.output_compression', '1');
    ini_set('zlib.output_compression_level', '9');
}

?>
