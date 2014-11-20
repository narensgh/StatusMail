define(['models/baseModel'], function(BaseModel) {
    var SessionModel = BaseModel.extend({
        defaults: {
            pageId: '0'
        },
        url: "http://localhost/adarshtech/frontline/socialmedia/sessiondata",
        sync: function(method, model, options)
        {
            options.url = "http://localhost/adarshtech/frontline/socialmedia/setsessiondata?" + this.buildParam(method);
            Backbone.sync.apply(this, arguments);
        },
        buildParam: function(method)
        {
            var response = {};
            switch(method)
            {
                case 'create' :
                _.extend(response, {"pageId": this.get("pageId")});
                return $.param(response);
            }
        }
    });
    return SessionModel;
});