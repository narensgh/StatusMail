define(['jquery', 'backbone', 'handlebars', 'collections/message/conversationCollection', 'models/message/conversationModel', "text!tpl/message/messageForm.html"],
        function($, Backbone, Handlebars, ConversationCollection, ConversationModel, Template) {
            MessageFormView = Backbone.View.extend({
                el: $('body'),
                messageFormContainer: $('#message-form-container'),
                template: Handlebars.compile(Template),
                initialize: function() {
                    this.collection = new ConversationCollection();
                    this.messageFormContainer.html(this.template);
                }
            });
            return MessageFormView;
        });