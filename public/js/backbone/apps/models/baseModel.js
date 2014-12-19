/**
 *
 */
define(['backbone', 'apps/config', 'backbone-relational'], function(Backbone, Config) {
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
    return BaseModel;
});