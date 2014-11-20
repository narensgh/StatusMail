define(['collections/baseCollection'], function(BaseCollection){
	var ProjectCollection = BaseCollection.extend({
		initialize: function(){
			this.url = this.apiBaseUrl + "pmproject";
		}
	});
	return ProjectCollection;
});