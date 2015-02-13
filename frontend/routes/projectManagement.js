var BaseRouter = require('./baseRouter'),
    PmProjectView = require('../views/pm/projectView'),
    PmTodoListView = require('../views/pm/todoListView');
var ProjectManagementRouter = BaseRouter.extend({
    routes: {
        "project": "project",
        "project/todolist/:projectId": "PmTodoList",
        "template": "template"
    },
    project: function() {
        new PmProjectView();
    },
    PmTodoList: function(projectId) {
        new PmTodoListView(projectId);
    }
});
module.exports = ProjectManagementRouter;


