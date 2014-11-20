/**
 * Frontline V1.0
 * 
 * Session controller to manage PHP(Zend) Session 
 * in jquery by hitting controller->function for the session data 
 */

define(['collections/baseCollection', 'models/sessionModel'], function(BaseCollection, SessionModel) {
    var SessionCollection = BaseCollection.extend({
        model: SessionModel,
        url: "http://localhost/adarshtech/frontline/socialmedia/sessiondata",
        initialize: function() {
            this.fetch({
                async: false
            });
        }
    });
    return SessionCollection;
});


