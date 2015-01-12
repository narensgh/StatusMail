define(['jquery', 'backbone', 'handlebars', 'libraries/chart', 'collections/user/userCollection', 'text!tpl/user/userprofile.html'],
    function($, Backbone, Handlebars, chart, UserCollection, Template) {
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
                var categories = ["26-11-2014", "25-11-2014", "24-11-2014", "23-11-2014", "22-11-2014", "21-11-2014", "20-11-2014", "19-11-2014", "18-11-2014", "17-11-2014", "16-11-2014", "15-11-2014", "14-11-2014"];
                categories.reverse();
                var series = [{
                        name: 'Tokyo',
                        data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
                        color: 'red'

                    }, {
                        name: 'New York',
                        data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

                    }, {
                        name: 'London',
                        data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

                    }, {
                        name: 'Berlin',
                        data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

                    }];
                chart.render('#container-chart', categories, series);
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

