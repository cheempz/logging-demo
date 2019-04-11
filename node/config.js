'use strict'

const {version} = require('appoptics-apm/package.json');

module.exports = {
  enabled: true,
  hostnameAlias: '',
  domainPrefix: false,
  serviceKey: '<changeme>:node-service',
  insertTraceIdsIntoLogs: false,
  probes: {
    fs: {
      enabled: true
    }
  }
};
