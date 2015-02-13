var Backbone = require('backbone'),
    relBackbone = require('backbone-relational'),
    TodoCollection = require('../../collections/pm/todoCollection'),
    TodoModel = require('./todoModel');
var TodoListModel = Backbone.RelationalModel.extend({
    defaults: {
        todoListId: '',
        listname: '',
        projectId: '1'
    },
    idAttribute: 'todoId',
    relations: [{
            type: Backbone.HasMany,
            key: 'todos',
            relatedModel: TodoModel,
            collectionType: TodoCollection,
            reverseRelation: {
                key: 'todoList',
                includeInJSON: 'todoListId',
                autoFetch: TodoModel,
            }
        }],
    urlRoot: function() {
        return this.apiBaseUrl + "todolist";
    }
});
module.exports = TodoListModel;
