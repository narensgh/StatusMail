var $ = require('jquery'),
    Backbone = require('backbone'),
    Handlebars = require('handlebars'),
    ProjectCollection = require('../../collections/pm/projectCollection'),
    ProjectModel = require('../../models/pm/projectModel'),
    SessionModel = require('../../models/sessionModel');
Template = require('../../templates/pm/project.hbs');

var ProjectView = Backbone.View.extend({
    el: $('body'),
    container: "#content",
    template: Template,
    events: {
        "click #saveproject1": "saveProject",
        'click .project_name': "setProjectId1"
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
    saveProject: function() {
        var projectName = $(this.els.projectName).val();
        var project = {};
        project.projectName = projectName;
        var newproject = new ProjectModel(project);
        newproject.save(project, {
            success: function(model, response, options) {
                window.location.hash = "template";
            }
        });
        this.collection.add({project: project});
    },
    setProjectId1: function(e) {
        var projectId = e.target.id.split('-')[1];
        var session = {};
        session.projectId = projectId;
        window.location.hash = "project/todolist/" + projectId;
    }
});
module.exports = ProjectView;