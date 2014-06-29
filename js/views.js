var ListView = Backbone.View.extend({
	initialize: function() {
		this.listenTo(this.model, 'add, remove', this.render)
		this.listenTo(this.model, 'change', this.render)
		this.render();
	},

	events: {
		'click .remove': 'onClickRemove',
		'click .list': 'onElementClicked'
	},

	onElementClicked: function(e) {
		var id;
		var element = $(e.target);
		while(!(id = element.data('id'))) {
			element = element.parent();

		};
		window.location = '/l/' + id;
		e.preventDefault();
		e.stopPropagation();
	},

	onClickRemove: function(e) {
		var id = $(e.toElement).parent().data('id');
		var model = this.model._byId[id];
		model.destroy();
		e.preventDefault();
		e.stopPropagation();

	},

	render: function() {
		this.$el.html('');
		var self = this;
		console.log(this.model);
		this.model.forEach(function(m) {
			var code = self.template(m.attributes);
			self.$el.append(code);
		});
		console.log('rendered', this.model);
	}
});


var TodoCollectionView = Backbone.View.extend({
	initialize: function() {
		this.listenTo(this.model, 'add, remove', this.render);
		this.render();
	},

	events: {
		'click .done': 'onClickDone',
		'click .remove': 'onClickRemove'
	},

	onClickRemove: function(e) {
		var id = $(e.toElement).parent().data('id');
		var model = list._byId[id];
		model.destroy();
		this.render();
		e.preventDefault();
	},

	onClickDone: function(e) {
		var id = $(e.toElement).parent().data('id');
		var model = list._byId[id];
		model.set({'done': !model.get('done')});
		model.save();
		this.render();
		e.preventDefault();
	},

	render: function() {
		this.$el.html('');
		var self = this;
		console.log(self.model)
		this.model.forEach(function(m) {
			var template = _.template($('#task_template').html(), {id: m.get('id'), listId: listId, name: m.get('name'), done: m.get('done')});
			self.$el.append(template);
		});
	}
});