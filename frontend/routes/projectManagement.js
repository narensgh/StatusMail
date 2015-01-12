var BaseRouter = require('./baseRouter');
    PmProjectView = require('../views/pm/projectView');
var ProjectManagementRouter = BaseRouter.extend({
    routes: {
        "project": "project",
        "project/todolist": "PmTodoList",
        "template": "template"
    },
    project: function() {
        new PmProjectView();
    }
//    ,
//    template: function() {
//        new PmTemplateView();
//    },
//    PmTodoList: function() {
//        new PmTodoListView();
//    }
});
module.exports = ProjectManagementRouter;


