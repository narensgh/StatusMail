/**
 *
 * @param {type} BaseModel
 * @returns {unresolved}Project model
 */
var Backbone = require('backbone');
var ProjectModel = Backbone.Model.extend({
    defaults: {
        projectName: ''
    },
    sync: function(method, model, options)
    {
        options.url = "/taskmanager/application/pmproject";
        Backbone.sync.apply(this, arguments);
    }
});
module.exports = ProjectModel;