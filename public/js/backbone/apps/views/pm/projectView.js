define(['jquery', 'backbone', 'handlebars', 'apps/collections/pm/projectCollection', 'apps/models/pm/projectModel', 'text!tpl/pm/project.html'],
        function($, Backbone, Handlebars, ProjectCollection, ProjectModel, Template) {
            var ProjectView = Backbone.View.extend({
                el: $('#content'),
                container: $("#content"),
                template: Handlebars.compile(Template),
                events: {
                    "click #saveproject1": "saveProject"
                },
                els: {
                    'projectName': '#projectname'
                },
                initialize: function() {
                    this.collection = new ProjectCollection();
                    this.collection.bind("reset", this.render, this);
                    this.collection.fetch();
                },
                render: function() {
                    this.container.html(this.template({pmProject: this.collection}));
                    return true;
                },
                saveProject: function() {
					var projectName = $(this.els.projectName).val();
                    var project = {};
                    project.projectName = projectName;
                    var newproject = new ProjectModel(project);
                    newproject.save(newproject,{
                        success: function(model, response, options) {
                            window.location.hash = "template";
                        }
                    });
                    this.collection.add({project: project});
                }
            });
            return ProjectView;
        });