<h1>Dashboard</h1>
<hr>

<div class="row">
	<div class="col-md-4">
		<h3>Actions</h3>
		<hr>
		<ul>
			<li>{{ _view.Html.link('Add user', {'prefix':'dashboard', 'plugin':'CodeBlastr/Users', 'controller':'Users', 'action': 'add'}, {'class':'myclass'})|raw }}</li>
			<li>{{ _view.Html.link('Logout', {'plugin':'CodeBlastr/Users', 'controller':'Users', 'action': 'logout'}, {'class':'myclass'})|raw }}</li>
		</ul>
	</div>
	<div class="col-md-4">
		<h3>Loaded Plugins</h3>
		<hr>
		<ul>
			{% for plugin in plugins %}
			<li>{{ plugin|e }}</li>
			{% endfor %}
		</ul>
	</div>
</div>
