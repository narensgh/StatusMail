/**
 * 
 */

define(['jquery', 'backbone', 'apps/config'],function ($, Backbone, Config) {
	var BaseCollection = Backbone.Collection.extend({
	        apiBaseUrl: Config.baseUrl,
	});
	return BaseCollection;
});