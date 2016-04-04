
<div class="row">

	{{ _view.fetch('tiles.top')|raw }}

	<div class="col-md-4">
		<h3>Loaded Plugins</h3>
		<hr>
		<ul>
			{% for plugin in plugins %}
			<li>{{ plugin|e }}</li>
			{% endfor %}
		</ul>
	</div>

	{{ _view.fetch('tiles.bottom')|raw }}
</div>
