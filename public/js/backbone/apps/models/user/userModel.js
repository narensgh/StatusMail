define(['models/baseModel'], function(BaseModel) {
    var UserModel = BaseModel.extend({
        defaults: {
            userId: '0',
            email: '',
            firstName: '',
            lastName: '',
            username: ''
        },
        idAttribute: "userId",
        sync: function(method, model, options)
        {
            options.url = this.apiBaseUrl + "user?" + this.buildParam();
            Backbone.sync.apply(this, arguments);
        },
        buildParam: function()
        {
            var response = {};
            _.extend(response, {"userId": this.get("userId")});
            return $.param(response);
        }
    });
    return UserModel;
});

