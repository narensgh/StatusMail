var $ = require('jquery'),
    Backbone = require('backbone'),
    Handlebars = require('handlebars');
Template = require('../../templates/crud/index.hbs');

var ProjectView = Backbone.View.extend({
    el: $('body'),
    container: "#content",
    template: Template,
    events: {
        "click #saveproject1": "saveProject",
    },
    els: {
        'projectName': '#projectname'
    },
    initialize: function() {
        this.collection = new ProjectCollection();
        this.collection.bind("reset", this.render, this);
        this.collection.fetch({reset: true});
        this.render();

    },
    render: function() {
        $(this.container).html(this.template({pmProject: this.collection}));
        return true;
    },
});