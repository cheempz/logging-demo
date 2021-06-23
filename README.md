# logging-demo

## Setup

Spin up an EC2 host to run the demo apps.  It should have Docker, Docker Compose and the AppOptics Snap agent installed.

Clone this repo onto the EC2 host.

## Sending to Loggly

The demo apps run in containers, their logs are sent to Loggly via the [Snap agent Docker logs collector]( https://documentation.solarwinds.com/en/success_center/loggly/content/admin/ao-integration-setup.htm#Docker). See [the example Snap task config](./task-logs-docker.yaml) in this project. 

So application log messages go through this pipeline:
```docker json-files log driver --> snap agent --> loggly```

## Enable/disable Trace Context in Log

Python:
* docker-compose environment variable `APPOPTICS_LOG_TRACE_ID`

PHP:
* the line `$log->pushProcessor('ao_processor');` in the `logging.php` script
* config file setting `appoptics.log_trace_id`

## Run

Set a valid `APPOPTICS_API_TOKEN` environment variable, then run the demo script:

```
export APPOPTICS_API_TOKEN=mysecretaoppopticsapitoken
cd logging-demo
./demo.sh
```

ctl-c to stop
