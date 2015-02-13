var Backbone = require('backbone'),
    _ = require('underscore');
var TodoModel = Backbone.RelationalModel.extend({
    defaults: {
        todoListId: '',
        description: '',
        active: 'yes',
        assignedTo: '1'
    },
    idAttribute: 'todoId',
    urlRoot: function() {
        return this.apiBaseUrl + "todo";
    },
    sync: function(method, model, options)
    {
        var idAttribute = {};
        idAttribute.todoId = this.get("todoId");
        options.url = "/taskmanager/application/todo" + this.buildParam(method, idAttribute);
        Backbone.sync.apply(this, arguments);
    },
    buildParam: function(method, idAttribute)
    {
        var response = {};
        switch (method) {
            case 'update':
            case 'delete':
                _.extend(response, idAttribute);
                return '?' + $.param(response);
            case 'create':
                return '';
        }
    }
});
module.exports = TodoModel;