/**
 *
 * @param {type} BaseModel
 * @returns {unresolved}Project model
 */
var BaseModel = require('../baseModel');
var ProjectModel = BaseModel.extend({
    defaults: {
        projectName: ''
    },
    sync: function(method, model, options)
    {
        options.url = this.apiBaseUrl + "pmproject";
        Backbone.sync.apply(this, arguments);
    }
});
module.exports = ProjectModel;