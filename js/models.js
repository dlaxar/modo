var Todo = Backbone.Model.extend({
	defaults: {
		done: false,
		name: ''
	},
	initialize: function() {
	}
});

var List = Backbone.Model.extend({
	urlRoot: '/list',
	defaults: {
		name: ''
	},
	initialize: function() {

	}
});

var ListCollection = Backbone.Collection.extend({
	url: '/list',
	model: List,
	initialize: function() {
	}
});

