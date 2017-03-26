(function() {
	tinymce.PluginManager.add( 'tinymce_kf_class', function( editor, url ) {
		// Add Button to Visual Editor Toolbar
		editor.addButton('tinymce_kf_class', {
			title: kfTranslations['kf_add_button'],
			id: 'mce-wp-kf',
			stateSelector: 'kf',
			onclick: function() {
				editor.windowManager.open({
					title: 'Insert key figure',
					body: [{
						type: 'textbox',
						name: 'figure',
						label: 'Figure'
					},{
						type: 'textbox',
						name: 'text',
						label: 'Text'
					}],
					onsubmit: function( e ) {
						editor.insertContent( '<span data-figure="' + e.data.figure + '" class="keyfigure_bloc"><span class="keyfigure_bloc_figure">' + e.data.figure + '</span><span class="keyfigure_bloc_text">' + e.data.text + '</span></span>' );
					}
				});				
			}
		});		

	});
})();