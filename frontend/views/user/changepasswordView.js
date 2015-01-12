define(['jquery', 'backbone', 'handlebars', 'collections/user/userCollection', 'text!tpl/user/changepassword.html', 'md5', 'utf8_encode'], function($, Backbone, Handlebars, UserCollection, Template, MD5) {
    var changePassword = Backbone.View.extend({
        el: $("#content"),
        container: $("#content"),
        msgContainer: $('#msgContent'),
        template: Handlebars.compile(Template),
        events: {
            'click #btnUpdatePwd': 'updatePassword'
        },
        els: {
            curPassword: '#curPassword',
            newPassword: '#newPassword',
            confPassword: '#confPassword'
        },
        initialize: function() {
            this.collection = new UserCollection();
            this.render();
        },
        render: function() {
            this.container.html(this.template);
        },
        updatePassword: function() {
            var curPassword = $(this.els.curPassword).val();
            var newPassword = $(this.els.newPassword).val();
            var confPassword = $(this.els.confPassword).val();
            this.validateCurrentPassword(curPassword);
            this.validatePassword(newPassword, confPassword);
        },
        setErrorMsg: function(message) {
            this.msgContainer.addClass('error-message');
            this.msgContainer.html(message);
        },
        validateCurrentPassword: function(currentPassword) {
            var password = md5(currentPassword);
            if (!currentPassword) {
                var message = 'Please Enter Current Password...!!!';
                this.setErrorMsg(message);
                return false;
            }
            var self = this;
            this.collection.fetch({
                data: {
                    userId: 2,
                    password: password
                },
                success: function(response) {
                    var resp = response.models[0].attributes;
                    if (resp.userId === 2 && resp.passoword === password) {
                        return true;
                    } else {
                        message = 'Invalid current password..!!';
                        self.setErrorMsg(message);
                        return false;
                    }
                }
            });
        },
        validatePassword: function(newPassword, confPassword) {
            var message;
             if (newPassword !== confPassword) {
                message = 'Password mis-matched...!!!';
            }
            if (message) {
                this.setErrorMsg(message);
                return false;
            } else {
                return true;
            }

        }
    });
    return changePassword;

});

