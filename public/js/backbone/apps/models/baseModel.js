/**
 * 
 */
define(['backbone', 'apps/config'],function (Backbone, Config) {                 
	var BaseModel = Backbone.Model.extend({
		 apiBaseUrl: Config.baseUrl,
	});
	return BaseModel;
});