var _ = require('underscore'),
    Backbone = require('backbone');
//    BaseModel = require('./baseModel');
var SessionModel = Backbone.Model.extend({
    defaults: {
        pageId: '00'
    },
    url: "/taskmanager/management/pm/setsession",
//    sync: function(method, model, options)
//    {
//        alert(' sync tested123 ');
//        options.url = "/taskmanager/management/pm/setsession?" + this.buildParam(method);
////        console.log(this.buildParam(method));
//        Backbone.sync.apply(this, arguments);
//    },
    toJSON: function() {
        console.log('tested123 ');
        return JSON.parse(JSON.stringify(this.attributes));
    },
    buildParam: function(method)
    {
        var response = {};
        switch (method)
        {
            case 'create' :
                _.extend(response, {"projectId": this.get("projectId")});
                return $.param(response);
        }
    }
});
module.exports = SessionModel;