var BaseCollection = require('../baseCollection'),
    TodoModel = require('../../models/pm/todoModel');

var TodoCollection = BaseCollection.extend({
    model: TodoModel,
    url: function() {
        return this.apiBaseUrl + "todo";
    }
});
module.exports = TodoCollection;