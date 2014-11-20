define(['jquery', 'backbone', 'apps/views/timesheet/signupView', 'apps/views/timesheet/userinfoView',
    'apps/views/pm/templateView', 'apps/views/pm/projectView', 'apps/views/user/changepasswordView',
    'apps/views/user/userprofileView'],
        function($, Backbone, SignupView, UserinfoView, PmTemplateView, PmProjectView, UserchangepasswordView,
                UserprofileView) {
            var Router = Backbone.Router.extend({
                routes: {
                    "": "index",
					"project": "project",
                    "template": "template",
                    'userinfo': 'userinfo',
                    'changepassword': 'changepassword',
                    'userprofile': 'userprofile'
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
                },
                changepassword: function() {
                    new UserchangepasswordView();
                },
                userprofile: function() {
                    new UserprofileView();
                }
            });
            return Router;
        });