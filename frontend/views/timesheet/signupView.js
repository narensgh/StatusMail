define(['jquery', 'backbone', 'handlebars', 'models/timesheet/userModel', "text!tpl/timesheet/signup.html"],
        function($, Backbone, Handlebars, UserModel, Template) {
            SignupView = Backbone.View.extend({
                params: {},
                el: $('body'),
                container: $('#content'),
                events: {
                    'click #save': 'save'
                },
                template: Handlebars.compile(Template),
                initialize: function() {
                    this.params = {};
                    this.render();
                },
                render: function() {
                    this.container.html(this.template);
                    return this;
                },
                save: function() {
                    var user = {};
                    user.name = $('#name').val();
                    user.contact = $('#contact').val();
                    var User = new UserModel(user);
                    User.save(user, {
                        success: function(response) {
                            window.location.hash = "userinfo";
                        },
                        error: function(xhr) {
                        }
                    });
                }
            });
            return SignupView;
        });