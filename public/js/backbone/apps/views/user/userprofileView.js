define(['jquery', 'backbone', 'handlebars', 'collections/user/userCollection', 'text!tpl/user/userprofile.html'],
        function($, Backbone, Handlebars, UserCollection, Template) {
            var userProfile = Backbone.View.extend({
                el: $('#content'),
                container: $('#content'),
                msgContainer: $('#msgContent'),
                events: {
                    'click #btnUpdateProfile': 'updateProfile'
                },
                els: {
                    'firstName': '#firstName',
                    'lastName': '#lastName',
                    'contactNo': '#contactNo',
                    'email': '#email'
                },
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
                },
                updateProfile: function() {
                    var user = this.collection.where({userId: 2})[0];
                    userProfile.firstName = $(this.els.firstName).val();
                    userProfile.lastName = $(this.els.lastName).val();
                    userProfile.contactNo = $(this.els.contactNo).val();
                    userProfile.email = $(this.els.email).val();
                    user.set(userProfile);
                    user.save(user, {
                        success: function(response, models) {
                            console.log(response);
                        },
                        error: function(xhr) {
                            console.log(xhr);
                        }
                    });
                }
            });
            return userProfile;
        });

