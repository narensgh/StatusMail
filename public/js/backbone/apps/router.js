define(['jquery', 'backbone', 'apps/views/timesheet/signupView', 'apps/views/timesheet/userinfoView',
    'apps/views/pm/templateView', 'apps/views/pm/projectView'],
        function($, Backbone, SignupView, UserinfoView, PmTemplateView, PmProjectView) {
            var Router = Backbone.Router.extend({
                routes: {
                    "": "index",
					"project": "project",
                    "template": "template",
                    'userinfo': 'userinfo'
                },
                el: $('body'),
                index: function() {
                    new SignupView();
                },
                userinfo: function(){
                    new UserinfoView();
                },
				project: function() {
					new PmProjectView();
				},
                template: function() {
                    new PmTemplateView();
                }
            });
            return Router;
        });