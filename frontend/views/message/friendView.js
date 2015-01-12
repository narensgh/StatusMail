define(['jquery', 'backbone', 'handlebars', 'collections/friendCollection', "text!tpl/message/friend.html"],
        function($, Backbone, Handlebars, FriendCollection, Template) {
            FriendView = Backbone.View.extend({
                params: {},
                el: $('body'),
                friendRow: $('#friends-container'),
                template: Handlebars.compile(Template),
                initialize: function() {
                    this.params = {};
                    this.collection = new FriendCollection();
                    this.collection.fetch({
                        async: false
                    });
                    this.render();
                },
                render: function() {
                    var friends = this.collection.models;
                    this.friendRow.html(this.template({friends: friends}));
                    return this;
                },
            });
            return FriendView;
        });