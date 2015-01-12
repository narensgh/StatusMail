define(['jquery', 'backbone', 'handlebars', 'collections/pm/todolistCollection', 'models/pm/todolistModel', 'models/pm/todoModel', 'text!tpl/pm/todoList.html', 'text!tpl/pm/todos.html', 'text!tpl/pm/editTodo.html'],
    function($, Backbone, Handlebars, TodolistCollection, TodolistModel, TodoModel, Template, TodoTemplate, EditTodoTemplate) {
        var ExploreView = Backbone.View.extend({
            el: $('#content'),
            container: $("#content"),
            template: Handlebars.compile(Template),
            todoTemplate: Handlebars.compile(TodoTemplate),
            editTodoTemplate: Handlebars.compile(EditTodoTemplate),
            projectId: null,
            dataList: 'all',
            todolistId: null,
            events: {
                'click #todolistbtn': 'addToDoList',
                'click .todobtn': 'addTodo',
                'change .todo-check': 'toggleCompleted',
                'click .delete-todo': 'deleteTodo',
                'click .edit-todo': 'editTodo',
                'click #cancel-edit-todo': 'cancelEditTodo',
                'click .saveEditTodo': 'saveEditedTodo'
            },
            els: {
                'todolistname': '#todolistname',
                'todosContainer': '#todos-',
                'todolist': '.todo-list',
                'todoDescription': '#tododescription-',
                'todoAssignedTo': '#assignedTo-',
                'editContainer': ".edit-container"
            },
            /**
             *
             * @returns {undefined}
             */
            initialize: function() {
                this.todoListcollection = new TodolistCollection();
                this.fetchTodoList();
                this.fetchTodo();
                this.render();
            },
            /**
             *
             * @returns {undefined}
             */
            fetchTodoList: function() {
                this.todoListcollection.fetch({
                    data: {
                        projectId: 1,
                        limit: 5
                    },
                    async: false
                });
            },
            /**
             *
             * @returns {undefined}
             */
            render: function() {
                this.container.html(this.template({todoLists: this.todoListcollection.models}));
                this.renderTodo();
                return this;
            },
            /**
             * This function saves Dotolists to db
             * @returns {undefined}
             */
            addToDoList: function() {
                var listname = $(this.els.todolistname).val();
                var todoList = {};
                var self = this;
                todoList.listname = listname;
//                todoList.projectId = this.projectId;
                todoList.projectId = 1;
                var newtodo = new TodolistModel(todoList);
                newtodo.save(newtodo, {
                    success: function(models, response) {
                        if ($.isNumeric(response.todoListId)) {
                            self.todoListcollection.add(models);
                            self.render();
                        } else {
                            alert('Some Error Occured..!!');
                        }
                    }
                });
            },
            fetchTodo: function() {
                var self = this;
                _.each(this.todoListcollection.models, function(todoList) {
                    var todo = todoList.get('todos');
                    todo.fetch({
                        data: {
                            todoListId: todoList.get("todoListId")
                        },
                        async: false
                    });
                    var todosContainer = $(self.els.todosContainer + todoList.get("todoListId"));
                    todosContainer.html(self.todoTemplate({todos: todo.models}));
                });
            },
            /**
             * This function renders todos
             * @returns {undefined}
             */
            renderTodo: function() {
                var self = this;
                _.each(this.todoListcollection.models, function(todoList) {
                    var todo = todoList.get('todos');
                    var todosContainer = $(self.els.todosContainer + todoList.get("todoListId"));
                    todosContainer.html(self.todoTemplate({todos: todo.models}));
                });

            },
            /**
             * This function is called to fire save todo event
             * @param {DOMObject} e
             * @returns {undefined}
             */
            addTodo: function(e) {
                var todoListId = e.target.id.split('-')[1];
                var todoDescription = $(this.els.todoDescription + todoListId).val();
                var todoAssignedTo = $(this.els.todoAssignedTo + todoListId).val();
                var todo = {};
                todo.todoListId = todoListId;
                todo.description = todoDescription;
                todo.assignedTo = todoAssignedTo;
                var newTodo = new TodoModel(todo);
                this.saveTodo(newTodo);
            },
            /**
             * This function is called to save new todo or edited.
             * @param {model} todo
             * @returns {undefined}
             */
            saveTodo: function(todo, active) {
                var self = this;
                var todoListId = todo.attributes.todoListId;
                todo.save(todo, {
                    success: function(model, response) {
                        if (active === 'no') {
//                            self.todoCollection.orderByActive();
                            self.render();
                        } else if (active === 'yes') {
                            self.render();
                        } else {
                            var todoList = self.getTodoListById(todoListId);
                            todoList.todos.add(model, {at: 0});
                            self.render();
                        }
                    }
                });
            },
            /**
             *
             * @param {type} todoListId
             * @returns {_L4.Anonym$1.getTodoListById@pro;todoListcollection@call;@arr;where.attributes}
             */
            getTodoListById: function(todoListId) {
                todoListId = {'todoListId': Number(todoListId)};
                var todoList = this.todoListcollection.where(todoListId)[0];
                return todoList.attributes;
            },
            /**
             *
             * @param {type} e
             * @returns {_L4.Anonym$1.getTodoById@pro;todoCollection@call;@arr;where}
             */
            getTodoById: function(todoListId, todoId) {
                var todoList = this.getTodoListById(todoListId);
                todoId =  {todoId: Number(todoId)};
                var todo = todoList.todos.where(todoId)[0];
                return todo;
            },
            /**
             * This function updates the todo as completed
             * @param {type} e
             * @returns {undefined}
             */
            toggleCompleted: function(e) {
                if (e.target.checked) {
                    var todoListId = e.target.id.split('-')[1];
                    var todoId = e.target.id.split('-')[2];
                    var todo = this.getTodoById(todoListId, todoId);
                    var todoStatus = {};
                    var confirmMsg = "Todo will be marked as ";
//                    todoStatus.dateUpdated = todo.getCurrentDateTime();
                    if (todo.attributes.active === "yes") {
                        confirmMsg += "completed.. !!";
                        todoStatus.active = 'no';
                    } else {
                        confirmMsg += "active.. !!";
                        todoStatus.active = 'yes';
                    }
                    if (confirm(confirmMsg)) {
                        todo.set(todoStatus);
                        this.saveTodo(todo, todoStatus.active);
                    }

                }
            },
            editTodo: function(e) {
                var todoListId = e.target.id.split('-')[1];
                var todoId = e.target.id.split('-')[2];
                var todo = this.getTodoById(todoListId, todoId);
                if (this.$el.find(this.els.editContainer).length > 0) {
                    this.cancelEditTodo();
                }
                this.$el.find("#todoli-" + todo.get("todoId")).attr("class", "edit-container").html(this.editTodoTemplate({todo: todo, todoListId: todoListId}));
            },
            cancelEditTodo: function() {
                this.$el.find(this.els.editContainer).remove();
                this.renderTodo();
            },
            saveEditedTodo: function(e) {
                var todoListId = e.target.id.split('-')[1];
                var todoId = e.target.id.split('-')[2];
                var todoDescription = $(this.els.todoDescription + todoListId).val();
                var todoAssignedTo = $(this.els.todoAssignedTo + todoListId).val();
                var todo = this.getTodoById(todoListId, todoId);
                todo.set({
                    todoListId: todoListId,
                    description: todoDescription,
                    assignedTo: todoAssignedTo
                });
                console.log(todo);
                this.saveTodo(todo);
                this.cancelEditTodo();
            },
            /**
             *
             * @param {type} e
             * @returns {undefined}
             */
            deleteTodo: function(e) {
                var todoListId = e.target.id.split('-')[1];
                var todoId = e.target.id.split('-')[2];
                var todo = this.getTodoById(todoListId, todoId);
                var flag = confirm('Are you sure you to delete Todo ?');
                if (flag) {
                    this.destroyTodo(todo);
                }
            },
            /**
             *
             * @param {type} todo
             * @returns {undefined}
             */
            destroyTodo: function(todo) {
                self = this;
                todo.destroy({
                    success: function(status, data) {
                        self.render();
                    },
                    error: function(model, xhr, options) {
                    },
                    wait: true
                });
            }
        });
        return ExploreView;
    });