/**
 * Frontline V1.0
 *
 * Session controller to manage PHP(Zend) Session
 * in jquery by hitting controller->function for the session data
 */

define(['collections/baseCollection', 'apps/models/sessionModel'], function(BaseCollection, SessionModel) {
    var SessionCollection = BaseCollection.extend({
        model: SessionModel,
        url: "/taskmanager/management/pm/getsession",
    });
    return SessionCollection;
});


