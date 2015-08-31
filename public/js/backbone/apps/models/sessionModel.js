define(['models/baseModel'], function(BaseModel) {
    var SessionModel = BaseModel.extend({
        defaults: {
            pageId: '0'
        },
        url: "/taskmanager/management/pm/setsession",
        sync: function(method, model, options)
        {
            options.url = "/taskmanager/management/pm/setsession?" + this.buildParam(method);
            Backbone.sync.apply(this, arguments);
        },
        buildParam: function(method)
        {
            var response = {};
            switch(method)
            {
                case 'create' :
                    _.extend(response, {"projectId": this.get("projectId")});
                return $.param(response);
            }
        }
    });
    return SessionModel;
});