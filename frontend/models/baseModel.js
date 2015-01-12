/**
 *
 */
var Backbone = require('backbone'),
    Config = require('../app-config'),
    RrBackbone = require('backbone-relational');
var BaseModel = Backbone.RelationalModel.extend({
    apiBaseUrl: Config.baseUrl,
    /**
     *
     * @param {string} method
     * @param {json Object} idAttribute
     * @returns {String}
     */
    buildParam: function(method, idAttribute)
    {
        var response = {};
        switch (method) {
            case 'update':
            case 'delete':
                _.extend(response, idAttribute);
                return '?' + $.param(response);
            case 'create':
                return '';
        }
    }
});
module.exports = BaseModel;