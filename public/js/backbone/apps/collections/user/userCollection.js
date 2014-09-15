define(['collections/baseCollection'], function(BaseCollection) {
    var userCollection = BaseCollection.extend({
        initialize: function() {
            this.url = this.apiBaseUrl + "user";
        }
    });
    return userCollection;
});

