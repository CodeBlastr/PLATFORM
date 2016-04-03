
<p>This needs to be something plugins can add on to (BY USER ROLE).</p>
<hr>

<div class="row">
	<div class="col-md-4">
		<h3>Actions</h3>
		<hr>
		<p>These should be injected (BY USER ROLE) into this instead of hardcoded.</p>
		<ul>
			<li>{{ _view.Html.link('Add user', {'prefix':'dashboard', 'plugin':'CodeBlastrUsers', 'controller':'Users', 'action': 'add'}, {'class':'myclass'})|raw }}</li>
			<li>{{ _view.Html.link('Logout', {'plugin':'CodeBlastrUsers', 'controller':'Users', 'action': 'logout'}, {'class':'myclass'})|raw }}</li>
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
