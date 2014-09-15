define(['jquery', 'backbone', 'handlebars', 'collections/user/userCollection', 'text!tpl/user/userprofile.html'], function($, Backbone, Handlebars, UserCollection, Template) {
    var userProfile = Backbone.View.extend({
        el: $('#content'),
        container: $('#content'),
        msgContainer: $('#msgContent'),
        template: Handlebars.compile(Template),
        initialize: function() {
            this.collection = new UserCollection();
            this.collection.bind("reset", this.render, this);
            this.collection.fetch({
                data: {
                    userId: 2
                }
            });
        },
        render: function() {
            var userdata = this.collection.models[0].attributes;
            this.container.html(this.template({userdata: userdata}));
        }
    });
    return userProfile;
});

