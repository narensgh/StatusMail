define(['models/baseModel'], function(BaseModel) {
    var ConversationModel = BaseModel.extend({
        defaults: {
            message: '',
        },
        initialize: function() {
            console.log('ConversationModel');
        },
        sync: function(method, model, options)
        {
            alert(method);
            options.url = this.apiBaseUrl + "release?" + this.buildParam();
            Backbone.sync.apply(this, arguments);
        },
        buildParam: function()
        {
            var response = {};
            _.extend(response, {"id": this.get("releaseId")});
            return $.param(response);
        }
    });
    return ConversationModel;
});