define(['models/baseModel'], function(BaseModel) {
    var ProjectModel = BaseModel.extend({
        defaults: {
            projectName: ''
        },
        sync: function(method, model, options)
        {
            alert(method);
            options.url = this.apiBaseUrl + "pmproject";
            Backbone.sync.apply(this, arguments);
        }
    });
    return ProjectModel;
});