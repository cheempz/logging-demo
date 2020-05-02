# logging-demo

## Demo Apps

On the docker host, clone the following into sibling directories:
* this repo
* https://github.com/bmacnaughton/todo

so that they look like:
```
.
├── logging-demo
└── todo
```

## Sending to Loggly

The demo apps run in containers and are configured to use the docker syslog driver.

Follow this to have syslog sent to Loggly:
https://documentation.solarwinds.com/en/Success_Center/loggly/Content/getting-started/gsg-send_data.htm

So application log messages go through this pipeline:
docker syslog driver --> syslog --> loggly

## Enable/disable

Node:
* config file setting `insertTraceIdsIntoLogs`

PHP:
* uncomment line `$log->pushProcessor('ao_processor');` in the `logging.php` script
* config file setting `appoptics.log_trace_id`

## Run

Set a valid `APPOPTICS_API_TOKEN` in the driver script `demo.sh` then run it:

```
./demo.sh
```

ctl-c to stop
