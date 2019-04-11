<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 0);

$mode = empty($_GET['mode']) ? 'default' : $_GET['mode'];
printf("Testing mode: %s\n", $mode);

// Use of this produces a known E_STRICT error in PHP 5.2 and higher, which is reclassified
// in PHP 7 to E_DEPRECATED, more info at http://php.net/manual/en/migration70.incompatible.php
class foo {
   function bar() { 1; }
}

// Function to generate some errors
function generate_errors() {
  fopen();      // An E_WARNING will be generated (parameter mismatch)
  foo::bar();   // An E_STRICT (E_DEPRECATED in PHP 7) will be generated (static call to non-static)
  trigger_error('Your attention please (1)', E_USER_WARNING);
  $baz++;       // An E_NOTICE will be generated (undefined variable)

  // same set of errors as above, but suppressed due to "@" operator
  // instrumentation should only report these if appoptics.report_suppressed_errors is enabled
  @fopen();
  @foo::bar();
  @trigger_error('Your attention please (2)', E_USER_WARNING);
  @$baz++;

  // make RPC call to another endpoint that throws exception
  file_get_contents('http://localhost/errors/2.php');
}

// Record current configuration
$error_settings = array('appoptics.enable_error_callback', 'appoptics.report_suppressed_errors', 'appoptics.use_error_reporting');
$orig_appoptics_settings = ini_get_all('appoptics');

// Set oboe error settings and initialize PHP error levels
switch ($mode) {
 case 'all_enabled':
   error_reporting(E_ALL | E_STRICT);
   ini_set('appoptics.enable_error_callback', 1);
   ini_set('appoptics.report_suppressed_errors', 1);
   ini_set('appoptics.use_error_reporting', 1);
   break;
 case 'callback_disabled':
   error_reporting(E_ALL);
   ini_set('appoptics.enable_error_callback', 0);
   break;
 case 'custom_error_reporting':
   error_reporting(E_WARNING | E_NOTICE);
   ini_set('appoptics.use_error_reporting', 1);
   break;
 default:
   error_reporting(E_ALL);
}

// display PHP error levels and oboe error settings
$err_map = array('E_STRICT' => E_STRICT,
                 'E_USER_NOTICE' => E_USER_NOTICE,
                 'E_USER_WARNING' => E_USER_WARNING,
                 'E_NOTICE' => E_NOTICE,
                 'E_WARNING' => E_WARNING);
// E_DEPRECATED is defined only for PHP 5.3 and up
// add it to the beginning of the list
if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
  $err_map = array_merge(array('E_DEPRECATED' => E_DEPRECATED), $err_map);
}
foreach ($err_map as $key => $value) {
  if (error_reporting() & $value) {
      printf("%s is enabled\n", $key);
  }
}
foreach ($error_settings as $setting) {
  printf("%s: %d\n", $setting, ini_get($setting));
}

// finally get what we're after
$log->info('About to generate errors');
generate_errors();

// restore settings
foreach ($error_settings as $setting) {
  ini_restore($setting);
}
printf("Oboe settings reset to orig: %s\n", $orig_appoptics_settings == ini_get_all('appoptics') ? 'true' : 'false');
ini_restore('html_errors');
ini_restore('display_errors');
?>
