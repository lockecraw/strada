/* Custom Short Codes Admin Buttons */
(function() {
		  
	// Featured Paragraph
    tinymce.create('tinymce.plugins.featured_paragraph', {
        init : function(ed, url) {
            ed.addButton('featured_paragraph', {
                title : 'Add a Featured Paragraph',
                image : url+'/images/buttons/icon-paragraph-featured.png',
                onclick : function() {
                     ed.selection.setContent('[featured_paragraph]' + ed.selection.getContent() + '[/featured_paragraph]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('featured_paragraph', tinymce.plugins.featured_paragraph);
	
	// Divider
    tinymce.create('tinymce.plugins.divider', {
        init : function(ed, url) {
            ed.addButton('divider', {
                title : 'Add a Divider',
                image : url+'/images/buttons/icon-divider-line.png',
                onclick : function() {
                     ed.selection.setContent('[divider]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('divider', tinymce.plugins.divider);
	
	// Divider - Dotted
    tinymce.create('tinymce.plugins.divider_dotted', {
        init : function(ed, url) {
            ed.addButton('divider_dotted', {
                title : 'Add a Dotted Divider',
                image : url+'/images/buttons/icon-divider-dottedline.png',
                onclick : function() {
                     ed.selection.setContent('[divider_dotted]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('divider_dotted', tinymce.plugins.divider_dotted);
	
	// Button - Small
    tinymce.create('tinymce.plugins.button_small', {
        init : function(ed, url) {
            ed.addButton('button_small', {
                title : 'Add a Small Button',
                image : url+'/images/buttons/icon-button-small.png',
                onclick : function() {
                     ed.selection.setContent('[button size="small" color="#508273" link="#" align="left"]' + ed.selection.getContent() + '[/button]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('button_small', tinymce.plugins.button_small);
	
	// Button - Medium
    tinymce.create('tinymce.plugins.button_medium', {
        init : function(ed, url) {
            ed.addButton('button_medium', {
                title : 'Add a Medium Button',
                image : url+'/images/buttons/icon-button-medium.png',
                onclick : function() {
                     ed.selection.setContent('[button size="medium" color="#508273" link="#" align="left"]' + ed.selection.getContent() + '[/button]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('button_medium', tinymce.plugins.button_medium);
	
	// Button - Large
    tinymce.create('tinymce.plugins.button_large', {
        init : function(ed, url) {
            ed.addButton('button_large', {
                title : 'Add a Large Button',
                image : url+'/images/buttons/icon-button-large.png',
                onclick : function() {
                     ed.selection.setContent('[button size="large" color="#508273" link="#" align="left"]' + ed.selection.getContent() + '[/button]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('button_large', tinymce.plugins.button_large);
	
	// Blockquote
    tinymce.create('tinymce.plugins.blockquote', {
        init : function(ed, url) {
            ed.addButton('blockquote', {
                title : 'Add a Blockquote',
                image : url+'/images/buttons/icon-blockquote.png',
                onclick : function() {
                     ed.selection.setContent('[blockquote]' + ed.selection.getContent() + '[/blockquote]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('blockquote', tinymce.plugins.blockquote);
	
	// Code
    tinymce.create('tinymce.plugins.code', {
        init : function(ed, url) {
            ed.addButton('code', {
                title : 'Add a Code',
                image : url+'/images/buttons/icon-code.png',
                onclick : function() {
                     ed.selection.setContent('[code]' + ed.selection.getContent() + '[/code]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('code', tinymce.plugins.code);
	
	// Images
    tinymce.create('tinymce.plugins.image', {
        init : function(ed, url) {
            ed.addButton('image', {
                title : 'Add an Image',
                image : url+'/images/buttons/icon-image.png',
                onclick : function() {
                     ed.selection.setContent('[image src="' + ed.selection.getContent() + '" align="left" alt="Image"]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('image', tinymce.plugins.image);
	
	// Lightbox Images
    tinymce.create('tinymce.plugins.lightbox_image', {
        init : function(ed, url) {
            ed.addButton('lightbox_image', {
                title : 'Add an Image with Opening of Big Image in the Lightbox.',
                image : url+'/images/buttons/icon-image-lightbox.png',
                onclick : function() {
                     ed.selection.setContent('[lightbox_image src="' + ed.selection.getContent() + '" bigimage="" align="left" alt="Image"]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('lightbox_image', tinymce.plugins.lightbox_image);
	
	// Alert White
    tinymce.create('tinymce.plugins.alert_white', {
        init : function(ed, url) {
            ed.addButton('alert_white', {
                title : 'Add a White Alert',
                image : url+'/images/buttons/icon-alert-white.png',
                onclick : function() {
                     ed.selection.setContent('[alert_white]' + ed.selection.getContent() + '[/alert_white]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('alert_white', tinymce.plugins.alert_white);
	
	// Alert Yellow
    tinymce.create('tinymce.plugins.alert_yellow', {
        init : function(ed, url) {
            ed.addButton('alert_yellow', {
                title : 'Add a Yellow Alert',
                image : url+'/images/buttons/icon-alert-yellow.png',
                onclick : function() {
                     ed.selection.setContent('[alert_yellow]' + ed.selection.getContent() + '[/alert_yellow]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('alert_yellow', tinymce.plugins.alert_yellow);
	
	// Alert Green
    tinymce.create('tinymce.plugins.alert_green', {
        init : function(ed, url) {
            ed.addButton('alert_green', {
                title : 'Add a Green Alert',
                image : url+'/images/buttons/icon-alert-green.png',
                onclick : function() {
                     ed.selection.setContent('[alert_green]' + ed.selection.getContent() + '[/alert_green]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('alert_green', tinymce.plugins.alert_green);
	
	// Alert Red
    tinymce.create('tinymce.plugins.alert_red', {
        init : function(ed, url) {
            ed.addButton('alert_red', {
                title : 'Add a Red Alert',
                image : url+'/images/buttons/icon-alert-red.png',
                onclick : function() {
                     ed.selection.setContent('[alert_red]' + ed.selection.getContent() + '[/alert_red]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('alert_red', tinymce.plugins.alert_red);
	
	// Alert Blue
    tinymce.create('tinymce.plugins.alert_blue', {
        init : function(ed, url) {
            ed.addButton('alert_blue', {
                title : 'Add a Blue Alert',
                image : url+'/images/buttons/icon-alert-blue.png',
                onclick : function() {
                     ed.selection.setContent('[alert_blue]' + ed.selection.getContent() + '[/alert_blue]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('alert_blue', tinymce.plugins.alert_blue);
	
	// Alert Custom
    tinymce.create('tinymce.plugins.alert_custom', {
        init : function(ed, url) {
            ed.addButton('alert_custom', {
                title : 'Add a Main Color Alert',
                image : url+'/images/buttons/icon-alert-custom.png',
                onclick : function() {
                     ed.selection.setContent('[alert_custom]' + ed.selection.getContent() + '[/alert_custom]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('alert_custom', tinymce.plugins.alert_custom);

})();