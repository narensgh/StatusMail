/**
 * Project collection
 * @type type
 *
 */

var BaseCollection = require('../baseCollection');
var Config = require('../../app-config');
var ProjectCollection = BaseCollection.extend({
    initialize: function() {
        this.url = "/taskmanager/application/pmproject";
    }
});
module.exports = ProjectCollection;
