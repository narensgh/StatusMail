define(['collections/baseCollection', 'models/pm/todoModel'], function(BaseCollection, TodoModel) {
    var TodoCollection = BaseCollection.extend({
        model: TodoModel,
        url: function() {
            return this.apiBaseUrl + "todo";
        }
    });
    return TodoCollection;
});