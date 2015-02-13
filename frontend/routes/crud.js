var BaseRouter = require('./baseRouter'),
    CrIndexView = require('../views/crud/index');
var CrudRouter = BaseRouter.extend({
    routes: {
        "crud": "index"
    },
    crud: function() {
        new CrIndexView();
    }
});
module.exports = CrudRouter;


