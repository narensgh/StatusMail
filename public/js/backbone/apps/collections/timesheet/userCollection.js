define(['collections/baseCollection'], function(BaseCollection){
    var UserCollection = BaseCollection.extend({
        initialize: function(){
            this.url = this.apiBaseUrl + "user";
        }
    });
    return UserCollection;
});