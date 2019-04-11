<?php
/**
 * AppOptics SDK API for PHP
 *
 * This can be used for autocompletion in many major PHP editors
 * provides documentation for the code
 * and can be used on systems where the appoptics extension is not loaded
 * to provide no-op versions of functionality
 */

if(!extension_loaded('appoptics') && !function_exists('appoptics_set_context')) {

    /**
     * Get string representation of current global context (X-trace) being used
     * if request is not tracing, will return false
     *
     * @return string|false
     */
    function appoptics_get_context() {
        return false;
    }

    /**
     * Set a string value for the current global context (X-trace) being used
     * will not start a trace, but will set the context to use for tracing even
     * if not currently tracing
     *
     * @return bool true for valid set, false for invalid x-trace sent
     */
    function appoptics_set_context($context) {
        return true;
    }
    
    /**
     * Check if AppOptics is ready for receiving traces and optionally wait for a given 
     * time. 'Ready' here means AppOptics has connected to the collector and has 
     * successfully received settings.
     * Note: The ini config option 'appoptics.max_ready_wait_time' can set this on the
     * global application level.
     * 
     * @param int timeout (optional) to wait for becoming ready (in milli seconds).
     *            A value of 0 will turn off waiting for timeout.
     *
     * @return bool true if ready, false otherwise
     */
    function appoptics_is_ready($timeout = 0) {
        return true;
    }

    /**
     * Attempts to start a new trace
     * Uses appoptics and feeds in optional incoming xtrace edge
     * xmeta header, and PHP set sample mode or sample rate if applicable
     *
     * If it returns false then tracing is not started
     *
     * if context is set before a trace is started the context provided will be used
     * otherwise a new random context is generated
     *
     * Will throw a PHP Notice if start trace has already been called or autotracing is on
     *
     * @param string layer name for custom tracing
     * @param string xtrace (optional) incoming xtrace edge (default = null)
     * @param mixed info (optional) if arrayaccess (array or object with hashtable) is sent then the items in the key
     *              value pairs that aren't reserved are sent with the beginning trace
         * @param mixed backtrace (optional) if arrayaccess (array or object with hashtable) that is used as a backtrace
     *               if true is passed PHP generated backtrace is sent, if false
     *               is passed then no backtrace is sent
     *
     * @return array('sample_rate' => value
     *               'sample_source' => value) or false
     */
    function appoptics_start_trace($layer, $xtrace = null, $info = null, $backtrace = true) {
        return false;
    }

    /**
     * Stops a trace
     *
     * If it returns false then tracing was never started or an error occurred
     *
     * @param mixed info (optional) if arrayaccess (array or object with hashtable) is sent then the items in the key
     *              value pairs that aren't reserved are sent with the beginning trace
         * @param mixed backtrace (optional) if arrayaccess (array or object with hashtable) that is used as a backtrace
     *               if true is passed PHP generated backtrace is sent, if false
     *               is passed then no backtrace is sent
     * @param mixed edge (optional) if arrayaccess (array or object with hashtable) is sent then the items are treated
     *              as additional edges to add, if it's a single string the string is added
     * @param string transaction_name (optional) the transaction name to be set for this trace
     *
     * @return boolean (true on success, false on failure)
     */
    function appoptics_end_trace($info = null, $backtrace = true, $edge = null, $transaction_name = null) {
        return false;
    }
    
    /**
     * Sets a custom transaction name
     * Can only be called on an active trace (e.g. between appoptics_start_trace() and appoptics_end_trace(), 
     * or when autotracing is on)
     * 
     * @param string transaction_name the transaction name to be set for this trace
     * 
     * @return boolean (true on success, false on failure (e.g. empty $transaction_name passed in))
     */
    function appoptics_set_transaction_name($transaction_name) {
        return false;
    }

    /**
     * Is this request/script currently tracing
     *
     * @return boolean (true on success, false on failure)
     */
    function appoptics_is_tracing() {
        return false;
    }

    /**
     * Has tracing been started? either by normal means (when use_custom_start_trace is off) or a call to appoptics_start_trace
     *
     * @return boolean (true on success, false on failure)
     */
    function appoptics_trace_started() {
        return false;
    }

    /**
     * Creates an event
     *
     * @param string layer (optional) layer name to use (may be null)
     * @param string label label name to trace (entry, exit, info, etc)
     * @param mixed info (optional) if arrayaccess (array or object with hashtable) is sent then the items in the key
     *              value pairs that aren't reserved are sent with the beginning trace
         * @param mixed backtrace (optional) if arrayaccess (array or object with hashtable) that is used as a backtrace
     *               if true is passed PHP generated backtrace is sent, if false
     *               is passed then no backtrace is sent
     * @param mixed edge (optional) if arrayaccess (array or object with hashtable) is sent then the items are treated
     *              as additional edges to add, if it's a single string the string is added
     * @return boolean (true on success, false on failure)
     */
    function appoptics_log($layer, $label, $info = null, $backtrace = true, $edge = null) {
        return false;
    }

    /**
     * Creates a new entry event
     *
     * @param string layer layer name to use
     * @param mixed info (optional) if arrayaccess (array or object with hashtable) is sent then the items in the key
     *              value pairs that aren't reserved are sent with the beginning trace
     * @param mixed backtrace (optional) if arrayaccess (array or object with hashtable) that is used as a backtrace
     *               if true is passed PHP generated backtrace is sent, if false
     *               is passed then no backtrace is sent
     *
     * @return boolean (true on success, false on failure)
     */
    function appoptics_log_entry($layer, $info = null, $backtrace = true) {
        return false;
    }

    /**
     * Creates a new exit event
     *
     * @param string layer layer name to use
     * @param mixed info (optional) if arrayaccess (array or object with hashtable) is sent then the items in the key
     *              value pairs that aren't reserved are sent with the beginning trace
     * @param mixed backtrace (optional) if arrayaccess (array or object with hashtable) that is used as a backtrace
     *               if true is passed PHP generated backtrace is sent, if false
     *               is passed then no backtrace is sent
     * @param mixed edge (optional) if arrayaccess (array or object with hashtable) is sent then the items are treated
     *              as additional edges to add, if it's a single string the string is added
     * @return boolean (true on success, false on failure)
     */
    function appoptics_log_exit($layer, $info = null, $backtrace = true, $edge = null) {
        return false;
    }

    /**
     * Creates an error event
     *
     * @param string layer layer name to use
     * @param string message error message
     * @param int PHP error code
     * @param mixed info (optional) if arrayaccess (array or object with hashtable) is sent then the items in the key
     *              value pairs that aren't reserved are sent with the beginning trace
     * @param mixed backtrace (optional) if arrayaccess (array or object with hashtable) that is used as a backtrace
     * @param mixed edge (optional) if arrayaccess (array or object with hashtable) is sent then the items are treated
     *              as additional edges to add, if it's a single string the string is added
     * @return boolean (true on success, false on failure)
     */
    function appoptics_log_error($layer, $message, $code, $info = null, $backtrace = null, $edge = null) {
        return false;
    }

    /**
     * Creates an event from a PHP exception
     *
     * @param string layer layer name to use
     * @param object instanceof Exception exception
     * @param mixed info (optional) if arrayaccess (array or object with hashtable) is sent then the items in the key
     *              value pairs that aren't reserved are sent with the beginning trace
     * @param mixed backtrace (optional) if arrayaccess (array or object with hashtable) that is used as a backtrace
     * @param mixed edge (optional) if arrayaccess (array or object with hashtable) is sent then the items are treated
     *              as additional edges to add, if it's a single string the string is added
     * @return boolean (true on success, false on failure)
     */
    function appoptics_log_exception($layer, Exception $e, $info = null, $backtrace = null, $edge = null) {
        return false;
    }
    
    /**
     * Creates a new or adds to an existing Summary Metric
     * 
     * @param string name the name of the metrics, a part of the "metric key"
     * @param float value a value to be recorded associated with this "metric key"
     * @param int count (optional) default as 1
     * @param boolean host_tag (optional) default as false, whether host information should be included
     * @param string service_name (optional) default as empty, custom service name
     * @param array tags (optional) default as empty, a part of the "metric key"
     *              (e.g. array("region"=>"us-west", "name"=>"web-prod-3", "db"=>"db-prod-1"))
     * @return boolean (true on success, false on failure)
     */
    function appoptics_metric_summary($name, $value, $count = 1, $host_tag = false, $service_name = null, $tags = null) {
        return false;
    }
    
    /**
     * Creates a new or adds to an existing Increment Metric
     * 
     * @param string name the name of the metrics, a part of the "metric key"
     * @param int count (optional) default as 1
     * @param boolean host_tag (optional) default as false, whether host information should be included
     * @param string service_name (optional) default as empty, custom service name
     * @param array tags (optional) default as empty, a part of the "metric key"
     *              (e.g. array("region"=>"us-west", "name"=>"web-prod-3", "db"=>"db-prod-1"))
     * @return boolean (true on success, false on failure)
     */
    function appoptics_metric_increment($name, $count = 1, $host_tag = false, $service_name = null, $tags = null) {
        return false;
    }
    
    /**
     * Get the Trace Id with the sample flag ('-0' for not sampled, '-1' for sampled) of the currently running request.
     * This Trace Id is also appended to log messages if the INI option 'appoptics.log_trace_id' is enabled.
     * 
     * @return trace id with sample flag
     */
    function appoptics_get_log_trace_id() {
        return "0000000000000000000000000000000000000000-0";
    }
}
