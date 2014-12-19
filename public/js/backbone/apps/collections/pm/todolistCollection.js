define(['collections/baseCollection', 'models/pm/todolistModel'], function(BaseCollection, TodolistModel) {
    var TodoListCollection = BaseCollection.extend({
        model: TodolistModel,
        url: function() {
            return this.apiBaseUrl + "todolist";
        }

    });
    return TodoListCollection;
});