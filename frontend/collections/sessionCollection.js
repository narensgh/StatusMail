/**
 * Frontline V1.0
 *
 * Session controller to manage PHP(Zend) Session
 * in jquery by hitting controller->function for the session data
 */

var BaseCollection = require('./baseCollection'),
    SessionModel = require('../models/sessionModel');
var SessionCollection = BaseCollection.extend({
    model: SessionModel,
    url: "/taskmanager/management/pm/getsession",
});
module.exports = SessionCollection;
