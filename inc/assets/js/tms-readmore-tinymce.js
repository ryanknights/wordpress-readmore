(function (window, document, $)
{
	tinymce.PluginManager.add('readmore_button', function (editor, url)
	{
		editor.addButton('readmore_button',
		{
			text : 'Read More',
			icon : false,
			onclick : function ()
			{	
				var currentSelection = editor.selection.getContent(),
					toAdd            = '';

				if (currentSelection.indexOf('[readmore]') !== -1 || currentSelection.indexOf('[/readmore]') !== -1)
				{
					toAdd = currentSelection.replace(new RegExp('\\[(/)?readmore\\]', 'g'), '');
				}
				else
				{
					toAdd = '[readmore]' + editor.selection.getContent() + '[/readmore]';
				}
				
				editor.insertContent(toAdd);
			}
		});
	});

}(window, document, jQuery));