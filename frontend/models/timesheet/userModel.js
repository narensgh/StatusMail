define(['models/baseModel'], function(BaseModel) {
    var UserModel = BaseModel.extend({
        defaults: {
            name: '',
            contact: ''
        },
        sync: function(method, model, options)
        {
            options.url = this.apiBaseUrl + "user";
            Backbone.sync.apply(this, arguments);
        }
    });
    return UserModel;
});