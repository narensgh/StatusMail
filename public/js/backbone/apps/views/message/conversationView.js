define(['jquery', 'backbone', 'handlebars', 'collections/message/conversationCollection', 'models/message/conversationModel', "text!tpl/message/conversation.html"],
        function($, Backbone, Handlebars, ConversationCollection, ConversationModel, Template) {
            ConversationView = Backbone.View.extend({
                params: {},
                el: $('body'),
                conversation: $('#conversation-container'),
                template: Handlebars.compile(Template),
                els: {
                    messageBox: '#messageBox'
                },
                events: {
                    "click a.friend-list": "getMessageByFriend",
                    'click span#submit-post': 'addMessage'
                },
                initialize: function() {
                    this.params = {};
                    this.collection = new ConversationCollection();
                    this.render();
                },
                render: function() {
//                    this.params.userId = 2;
                    this.params.accessToken = "d07076fc73210d878b335fb92c230ae3";
                    var self = this;
                    this.collection.fetch({
                        async: false,
                        data: self.params
                    });
                    var conversations = this.collection.models[0].attributes.messages;
                    this.conversation.html(this.template({conversations: conversations, userId: this.params.userId}));
                    return this;
                },
                getMessageByFriend: function(e) {
                    var friendParam = e.target.id.split("_");
                    this.params.frndId = friendParam[1];
                    this.render();
                },
                addMessage: function() {
                    var message = {};
                    message.toId = 2;
                    message.fromId = 7;
                    message.message = $(this.els.messageBox).val();
                    this.collection.add({messages: message});
                    console.log(this.collection);
                    alert('posted');
                }
            });
            return ConversationView;
        });