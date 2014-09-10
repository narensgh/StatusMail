define(['jquery', 'backbone', 'handlebars', 'collections/timesheet/userCollection', "text!tpl/timesheet/userinfo.html"],
        function($, Backbone, Handlebars, UserCollection, Template) {
            UserinfoView = Backbone.View.extend({
                params: {},
                el: $('body'),
                container: $('#content'),
                events: {
                },
                template: Handlebars.compile(Template),
                initialize: function(){
                    this.collection = new UserCollection ();
                    this.collection.fetch({async: false});
                    this.render();
                },
                render: function(){
                    this.container.html(this.template({users: this.collection.models}));
                }                
            });
            return UserinfoView;
        });