define(['collections/baseCollection', 'models/user/userModel'], function(BaseCollection, UserModel) {
    var userCollection = BaseCollection.extend({
        model: UserModel,
        initialize: function() {
            this.url = this.apiBaseUrl + "user";
        }
    });
    return userCollection;
});

