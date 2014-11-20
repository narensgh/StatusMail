define(['jquery', 'backbone', 'handlebars', 'collections/pm/fieldCollection', 'text!tpl/pm/pmfield.html'],
        function($, Backbone, Handlebars, FieldCollection, Template) {
            var TemplateView = Backbone.View.extend({
				container: $('#content'),
				template: Handlebars.compile(Template),
                initialize: function(){
					this.collection = new FieldCollection();
					this.collection.fetch({async: false});
                    this.render();
                },
				render: function(){
					console.log(this.collection);
					this.container.html(this.template({pmFields : this.collection.models[0].attributes.pmfields}));
					return this;
				}
            });
            return TemplateView;
        });


