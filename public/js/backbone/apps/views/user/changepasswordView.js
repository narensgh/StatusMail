define(['jquery', 'backbone', 'handlebars', 'text!tpl/user/changepassword.html'], function($, Backbone, Handlebars, Template) {
    var changePassword = Backbone.View.extend({
        el: $("#content"),
        container: $("#content"),
        msgContainer: $('#msgContent'),
        template: Handlebars.compile(Template),
        events: {
            'click #btnUpdatePwd': 'updatePassword'
        },
        els: {
            curPassword: $('#curPassword'),
            newPassword: $('#newPassword'),
            confPassword: $('#confPassword')
        },
        initialize: function() {
            this.render();
        },
        render: function() {
            this.container.html(this.template);
        },
        updatePassword: function() {
            var validate = this.validatePassword();
            if (validate) {

            }
        },
        validatePassword: function() {
            var message;
            var curPassword = $(this.els.curPassword).val();
            var newPassword = $(this.els.newPassword).val();
            var confPassword = $(this.els.confPassword).val();
            if (!curPassword) {
                message = 'Please Enter Current Password...!!!';
            }
            else if (newPassword !== confPassword) {
                message = 'Password mis-matched...!!!';
            }
            if (message) {
                this.msgContainer.addClass('error-message');
                this.msgContainer.html(message);
                return false;
            } else {
                return true;
            }

        }
    });
    return changePassword;

});

