<?php
header('Content-type: text/plain');

include 'appoptics.php';
include 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\JsonFormatter;

// create a log channel
$log = new Logger('monolog');
$stream = new StreamHandler('php://stdout', Logger::INFO);
$stream->setFormatter(new JsonFormatter());
$log->pushHandler($stream);

function ao_processor ($record) {
    $record['context']['ao'] = array('traceId' => appoptics_get_log_trace_id());
    return $record;
}

/////// $log->pushProcessor('ao_processor');

// add records to the log
$log->info('Adding a new user', array('username' => 'Seldaek'));

// do some stuff
include('errors/1.php');

if (error_get_last()) {
    $log->warning('Some errors happened');
}		    
?>