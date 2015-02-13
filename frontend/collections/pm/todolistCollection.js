var BaseCollection = require('../baseCollection'),
    TodolistModel = require('../../models/pm/todolistModel');

var TodoListCollection = BaseCollection.extend({
    model: TodolistModel,
    url: function() {
        return this.apiBaseUrl + "todolist";
    }

});
module.exports = TodoListCollection;