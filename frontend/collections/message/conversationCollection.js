define(['collections/baseCollection', 'models/message/conversationModel'], function(BaseCollection, ConversationModel) {
    var ConversationCollection = BaseCollection.extend({
        model: ConversationModel,
        initialize: function() {
            this.url = this.apiBaseUrl + "message";
        }
    });
    return ConversationCollection;
});