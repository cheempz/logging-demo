'use strict'

const {version} = require('appoptics-apm/package.json');

module.exports = {
  enabled: true,
  hostnameAlias: '',
  domainPrefix: false,
  insertTraceIdsIntoLogs: false,
  probes: {
    fs: {
      enabled: true
    }
  }
};
