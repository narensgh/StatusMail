define(['models/baseModel', 'collections/pm/todoCollection', 'models/pm/todoModel'], function(BaseModel, TodoCollection, TodoModel) {
    var TodoListModel = BaseModel.extend({
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
    return TodoListModel;
});