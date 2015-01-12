var $ = require('jquery'),
    Backbone = require('backbone');
Backbone.$ = window.$;
var BaseRouter = Backbone.Router.extend({
    el: $('body'),
});
module.exports = BaseRouter;