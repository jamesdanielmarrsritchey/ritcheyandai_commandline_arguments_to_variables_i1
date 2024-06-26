<?php
function convertCommandLineArgsToVariablesAndCreateThem($argv) {
    $argc = count($argv);
    for ($i = 1; $i < $argc; $i++) {
        if (preg_match('/^--(.+)/', $argv[$i], $matches)) {
            $key = $matches[1];
            $value = $argv[++$i] ?? null;

            // Check for TRUE, FALSE, or NULL
            if ($value === "TRUE") {
                $value = true;
            } elseif ($value === "FALSE") {
                $value = false;
            } elseif ($value === "NULL") {
                $value = null;
            } elseif (is_numeric($value)) {
                // Convert numeric strings to int
                $value = $value + 0;
            } elseif (strpos($value, '=>') !== false) {
                // Convert string with "=>" to array, expecting keys and values to be wrapped in quotes
                $valueArray = [];
                preg_match_all('/\'(.*?)\'\s*=>\s*\'(.*?)\'/', $value, $matches, PREG_SET_ORDER);
                foreach ($matches as $match) {
                    $arrayKey = $match[1];
                    $arrayValue = $match[2];

                    // Convert "true", "false", "null" to their respective types
                    if ($arrayValue === "TRUE") {
                        $arrayValue = true;
                    } elseif ($arrayValue === "FALSE") {
                        $arrayValue = false;
                    } elseif ($arrayValue === "NULL") {
                        $arrayValue = null;
                    } elseif (is_numeric($arrayValue)) {
                        // Convert numeric strings to int
                        $arrayValue = $arrayValue + 0;
                    }

                    $valueArray[$arrayKey] = $arrayValue;
                }
                $value = $valueArray;
            }

            // Create variable with the name of the key and assign the value
            global $$key;
            $$key = $value;
        }
    }
}
?>