<?php
$location = realpath(dirname(__FILE__));
require_once $location . '/function.php';
$return = convertCommandLineArgsToVariablesAndCreateThem($argv);

// Access the variables outside the function
if (isset($test_string) === TRUE) {
    var_dump($test_string);
}
if (isset($test_bool) === TRUE) {
    var_dump($test_bool);
}
if (isset($test_int) === TRUE) {
    var_dump($test_int);
}
if (isset($test_array) === TRUE) {
    var_dump($test_array);
}
?>