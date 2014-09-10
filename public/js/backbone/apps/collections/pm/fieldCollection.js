define(['collections/baseCollection'], function(BaseCollection){
	var fieldCollection = BaseCollection.extend({
		initialize: function(){
			this.url = this.apiBaseUrl + "pmfield";
		}
	});
	return fieldCollection;
});

