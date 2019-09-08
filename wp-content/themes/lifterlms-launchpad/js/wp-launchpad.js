/*global launchpad_vars, wp_ajax_data */

    /*jshint browser:true */
    /*!
    * FitVids 1.1
    *
    * Copyright 2013, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
    * Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
    * Released under the WTFPL license - http://sam.zoy.org/wtfpl/
    *
    */
    
    ;(function( $ ){
    
      'use strict';
    
      $.fn.fitVids = function( options ) {
        var settings = {
          customSelector: null,
          ignore: null
        };
    
        if(!document.getElementById('fit-vids-style')) {
          // appendStyles: https://github.com/toddmotto/fluidvids/blob/master/dist/fluidvids.js
          var head = document.head || document.getElementsByTagName('head')[0];
          var css = '.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}';
          var div = document.createElement("div");
          div.innerHTML = '<p>x</p><style id="fit-vids-style">' + css + '</style>';
          head.appendChild(div.childNodes[1]);
        }
    
        if ( options ) {
          $.extend( settings, options );
        }
    
        return this.each(function(){
          var selectors = [
            'iframe[src*="player.vimeo.com"]',
            'iframe[src*="youtube.com"]',
            'iframe[src*="youtube-nocookie.com"]',
            'iframe[src*="kickstarter.com"][src*="video.html"]',
            'object',
            'embed'
          ];
    
          if (settings.customSelector) {
            selectors.push(settings.customSelector);
          }
    
          var ignoreList = '.fitvidsignore';
    
          if(settings.ignore) {
            ignoreList = ignoreList + ', ' + settings.ignore;
          }
    
          var $allVideos = $(this).find(selectors.join(','));
          $allVideos = $allVideos.not('object object'); // SwfObj conflict patch
          $allVideos = $allVideos.not(ignoreList); // Disable FitVids on this video.
    
          $allVideos.each(function(){
            var $this = $(this);
            if($this.parents(ignoreList).length > 0) {
              return; // Disable FitVids on this video.
            }
            if (this.tagName.toLowerCase() === 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) { return; }
            if ((!$this.css('height') && !$this.css('width')) && (isNaN($this.attr('height')) || isNaN($this.attr('width'))))
            {
              $this.attr('height', 9);
              $this.attr('width', 16);
            }
            var height = ( this.tagName.toLowerCase() === 'object' || ($this.attr('height') && !isNaN(parseInt($this.attr('height'), 10))) ) ? parseInt($this.attr('height'), 10) : $this.height(),
                width = !isNaN(parseInt($this.attr('width'), 10)) ? parseInt($this.attr('width'), 10) : $this.width(),
                aspectRatio = height / width;
            if(!$this.attr('name')){
              var videoName = 'fitvid' + $.fn.fitVids._count;
              $this.attr('name', videoName);
              $.fn.fitVids._count++;
            }
            $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100)+'%');
            $this.removeAttr('height').removeAttr('width');
          });
        });
      };
    
      // Internal counter for unique video names.
      $.fn.fitVids._count = 0;
    
    // Works with either jQuery or Zepto
    })( window.jQuery || window.Zepto );

/**
 * Main Launchpad Namespace
 */
var LaunchPad = window.LaunchPad || {};
(function($){
    'use strict';

    // Set window.launchpad before any other scripts refer to it.
    window.launchpad = window.launchpad || {};
    window.launchpad.ajaxurl = launchpad_vars.ajax_url;

    /**
     * load all app modules
     */
    /* global LaunchPad, $, launchpad_vars */
        /* jshint strict: false */
    
    /**
     * Main Ajax class
     * Handles Primary Ajax connection
     * @type {Object}
     */
    LaunchPad.Ajax = {
    
        /**
         * url
         * @type {String}
         */
        url: window.ajaxurl || window.launchpad.ajaxurl,
    
        /**
         * type
         * @type {[type]}
         */
        type: 'post',
    
        /**
         * data
         * @type {[type]}
         */
        data: [],
    
        /**
         * cache
         * @type {[type]}
         */
        cache: false,
    
        /**
         * dataType
         * defaulted to json
         * @type {String}
         */
        dataType: 'json',
    
        /**
         * async
         * default to false
         * @type {Boolean}
         */
        async: true,
    
        response:[],
    
        /**
         * initilize Ajax methods
         * loads class methods
         */
        init: function(obj) {
    
            //if obj is not of type object or null return false;
            if( obj === null || typeof obj !== 'object' ) {
                return false;
            }
    
            //set object defaults if values are not supplied
            obj.url			= this.url;
            obj.type 		= 'type' 		in obj ? obj.type 		: this.type;
            obj.data 		= 'data' 		in obj ? obj.data 		: this.data;
            obj.cache 		= 'cache' 		in obj ? obj.cache 		: this.cache;
            obj.dataType 	= 'dataType'	in obj ? obj.dataType 	: this.dataType;
            obj.async 		= 'async'		in obj ? obj.async 		: this.async;
    
            //add nonce to data object
            obj.data._ajax_nonce = launchpad_vars.nonce;
    
            //add post id to data object
            var $R = LaunchPad.Rest,
                query_vars = $R.get_query_vars();
            obj.data.post_id = 'post' in query_vars ? query_vars.post : null;
    
            //this.get_launchpad_ajax_url();
    
            return obj;
        },
    
        /**
         * Call
         * Called by external classes
         * Sets up jQuery Ajax object
         * @param  {[object]} [object of ajax settings]
         * @return {[mixed]} [false if not object or this]
         */
        call: function(obj) {
    
            //get default variables if not included in call
            var settings = this.init(obj);
    
            //if init return a response of false
            if (!settings) {
                return false;
            } else {
                this.request(settings);
            }
    
            return this;
    
        },
    
        /**
         * Calls jQuery Ajax on settings object
         * @return {[object]} [this]
         */
        request: function(settings) {
    
            $.ajax(settings);
    
            return this;
    
        }
    
    };
    
        /*global LaunchPad, tb_show, tb_remove, wp */
    
    /**
     * Rest Methods
     * Manages URL and Rest object parsing
     * @type {Object}
     */
    LaunchPad.Customizer = {
    
        /**
         * init
         * loads class methods
         */
        init: function() {
            this.bind();
        },
    
        /**
         * Bind Method
         * Handles dom binding on load
         * @return {[type]} [description]
         */
        bind: function() {
    
        }
    
    };
    
        /*global LaunchPad, tb_show, tb_remove */
    
    /**
     * Rest Methods
     * Manages URL and Rest object parsing
     * @type {Object}
     */
    LaunchPad.Nav = {
    
        /**
         * init
         * loads class methods
         */
        init: function() {
            this.bind();
        },
    
        /**
         * Bind Method
         * Handles dom binding on load
         * @return {[type]} [description]
         */
        bind: function() {
    
            $(document).ready(function() {
                $("#nav-mobile").html($("#responsive-menu").html());
    
                $('#responsive-menu-toggle').click(function() {
                    console.log('I am here');
                   if ($('#nav-mobile').hasClass('expanded')) {
                    $('#nav-mobile.expanded').removeClass('expanded').slideUp(250);
                    $(this).removeClass('open');
                } else {
                    $('#nav-mobile').addClass('expanded').slideDown(250);
                    $(this).addClass('open');
                }
                });
            });
    
    
    
        }
    
    };
    
        /*global LaunchPad */
    /* jshint strict: false */
    
    /**
     * Rest Methods
     * Manages URL and Rest object parsing
     * @type {Object}
     */
    LaunchPad.Rest = {
    
        /**
         * init
         * loads class methods
         */
        init: function() {
            console.log('Initializing Rest Methods ');
            this.bind();
        },
    
        /**
         * Bind Method
         * Handles dom binding on load
         * @return {[type]} [description]
         */
        bind: function() {
            console.log('Rest Methods Bound');
        },
    
        /**
         * Searches for string matches in url path
         * @param  {Array}  strings [Array of strings to search for matches]
         * @return {Boolean}         [Was a match found?]
         */
        is_path: function( strings ) {
    
            var path_exists = false,
                url = window.location.href;
    
            for( var i = 0; i < strings.length; i++ ) {
    
                if ( url.search( strings[i] ) > 0 && !path_exists ) {
    
                    path_exists = true;
                }
            }
    
            return path_exists;
        },
    
        /**
         * Retrieves query variables
         * @return {[Array]} [array object of query variable key=>value pairs]
         */
        get_query_vars: function() {
    
            var vars = [], hash,
                hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    
            for(var i = 0; i < hashes.length; i++) {
                hash = hashes[i].split('=');
                vars.push(hash[0]);
                vars[hash[0]] = hash[1];
            }
    
            return vars;
        }
    
    };
    
        /*global LaunchPad, tb_show, tb_remove */
    
    /**
     * Admin Settings Checkbox Handler
     * Manages checkbox display settings
     * @type {Object}
     */
    LaunchPad.AdminSettingsCheckbox = {
    
        /**
         * init
         * loads class methods
         */
        init: function() {
            this.bind();
        },
    
        /**
         * Bind Method
         * Handles dom binding on load
         * @return {[type]} [description]
         */
        bind: function() {
    
           this.toggle_visibility_settings();
    
        },
    
        /**
         * Toggle Visibility Settings
         * @returns {LaunchPad.AdminSettingsCheckbox}
         */
        toggle_visibility_settings: function() {
    
            // run the visibilty setting methods
            this.show_options_if_checked()
                .hide_options_if_checked();
    
            return this;
        },
    
        /**
         * Toggle checkbox fieldsets within the group based on show_options_if_checked
         * @returns {LaunchPad.AdminSettingsCheckbox}
         */
        show_options_if_checked: function() {
    
            // hide any options that have the class hidden_options
            if ($('.show_options_if_checked').length && $('.show_options_if_checked input[type="checkbox"]').is(':checked') === false) {
                $('.hidden_option').hide();
            }
    
            // check visibility settings on every checkbox change
            $('input[type=checkbox]').on('change', function() {
    
                var current_input = $(this);
    
                // get the parent fieldset of the checkbox
                var parent_fieldset = current_input.parent().parent();
    
                // if fieldset has option show_options_if_checked toggle display settings
                if (parent_fieldset.hasClass('show_options_if_checked')) {
    
                    // check if input is checked
                    if (current_input.is(':checked')) {
                        parent_fieldset.parent().find('.hidden_option').show();
                    } else {
                        parent_fieldset.parent().find('.hidden_option').hide();
                    }
    
                }
            });
    
            return this;
        },
    
        /**
         * Toggle checkbox fieldsets within the group based on hide_options_if_checked
         * @returns {LaunchPad.AdminSettingsCheckbox}
         */
        hide_options_if_checked: function() {
    
            // hide any options that have the class hidden_options
            if ($('.hide_options_if_checked').length && $('.hide_options_if_checked input[type="checkbox"]').is(':checked')) {
                $('.hidden_option').hide();
            }
    
            // check visibility settings on every checkbox change
            $('input[type=checkbox]').on('change', function() {
    
                var current_input = $(this);
    
                // get the parent fieldset of the checkbox
                var parent_fieldset = current_input.parent().parent();
    
                // if fieldset has option hide_options_if_checked toggle display settings
                if (parent_fieldset.hasClass('hide_options_if_checked')) {
    
                    // check if input is checked
                    if (current_input.is(':checked')) {
                        parent_fieldset.parent().find('.hidden_option').hide();
                    } else {
                        parent_fieldset.parent().find('.hidden_option').show();
                    }
    
                }
            });
    
            return this;
        }
    
    };
    
        /*global LaunchPad, tb_show, tb_remove */
    
    /**
     * Admin Settings Image Handler
     * Manages displaying the selected image on the settings tabs
     * @type {Object}
     */
    LaunchPad.AdminSettingsColor = {
    
        /**
         * init
         * loads class methods
         */
        init: function() {
            this.bind();
        },
    
        /**
         * Bind Method
         * Handles dom binding on load
         * @return {[type]} [description]
         */
        bind: function() {
    
    
            jQuery(document).ready(function($){
                $('.color-picker').iris({
                    hide: false,
                    palettes: true,
                    change: function(event, ui) {
                        $('#'+this.id+'_preview').children('div').css( 'background', ui.color.toString());
                        $('#'+this.id+'_preview').css( 'color', ui.color.toString());
                    }
                });
            });
    
        }
    
    };
    
        /*global LaunchPad, tb_show, tb_remove */
    
    /**
     * Admin Settings Image Handler
     * Manages displaying the selected image on the settings tabs
     * @type {Object}
     */
    LaunchPad.AdminSettingsImage = {
    
        /**
         * init
         * loads class methods
         */
        init: function() {
            this.bind();
        },
    
        /**
         * Bind Method
         * Handles dom binding on load
         * @return {[type]} [description]
         */
        bind: function() {
    
            var _this = this;
    
            var btn_id,
                input_id,
                preview_id;
    
            jQuery(document).ready(function($) {
    
                // trigger on any image button click
                $('.image-upload-button').click(function() {
    
                    // store the original send_to_editor temporarily
                    window.original_send_to_editor = window.send_to_editor;
    
                    // find the id's of the button, hidden input and preview elements
                    // Also get the label text to display in the media upload modal header
                    var btn_id = this.id,
                        input_id = btn_id.replace('_upload', ''),
                        preview_id = btn_id.replace('_upload', '_preview'),
                        label = $('label[for="' + input_id + '"]'),
                        btn_remove = btn_id.replace('_upload', '_remove');
    
                    // show the media upload box
                    tb_show('Upload '+label.text(),
                        'media-upload.php?referer=launchpad-settings&type=image&TB_iframe=true&post_id=0',
                        false
                    );
    
                    // modify the send_to_editor with the current input id's.
                    window.send_to_editor = function(html) {
    
                        var $html = $(html),
                            // html might be an image if people don't clear the Link URL
                            $img = ( $html[0].nodeName === 'A' ) ? $html.find('img') : $html,
                            // get the src
                            image_url = $img.attr('src');
    
                        console.log( image_url );
    
                        // append the url to the input
                        $('#'+input_id).val(image_url);
    
                        // close the media upload box
                        tb_remove();
    
                        // output a preview
                        $('#'+preview_id+' img').attr('src',image_url);
    
                        // show the remove button
                        $('#'+btn_remove).removeClass('hidden');
    
                        // reset send_to_editor (allows multiple image uploads on the same tab)
                        window.send_to_editor = window.original_send_to_editor;
    
                        return false;
                    };
    
                });
    
                // trigger on any image remove button click
                $('.launchpad-image-remove-button').click(function(e) {
                    e.preventDefault();
                    var btn_id = this.id,
                        input_id = btn_id.replace('_remove', ''),
                        preview_id = btn_id.replace('_remove', '_preview');
    
                    $('#'+preview_id+' img').attr('src', '');
                    $('#'+input_id).val('');
                    $('#'+btn_id).addClass('hidden');
                });
    
            });
    
        }
    
    };
    
        /*global LaunchPad, tb_show, tb_remove */
    
    /**
     * Rest Methods
     * Manages URL and Rest object parsing
     * @type {Object}
     */
    LaunchPad.AdminSettings = {
    
        /**
         * init
         * loads class methods
         */
        init: function() {
            this.bind();
        },
    
        /**
         * Bind Method
         * Handles dom binding on load
         * @since 0.0.1
         * @version  1.3.0
         * @return void
         */
        bind: function() {
            var _this = this;
    
            // reset settings button action logic
            $('[name="reset"]').on('click', function(e) {
                e.preventDefault();
    
                var reset_settings = window.confirm('Click OK to reset. All settings will be lost and replaced with default settings!');
    
                if (reset_settings) {
    
                    _this.reset_default_settings();
    
                } else {
                    return false;
                }
            });
    
            // generate export on advanced settings page
            $( '[name="generate-export"]' ).on( 'click', function( e ) {
                e.preventDefault();
                $( '#export-target' ).remove();
                _this.generate_export( $( this ) );
            } );
    
            // generate an "import" text field
            $( '[name="generate-import-field"]' ).on( 'click', function( e ) {
                e.preventDefault();
                // $( '#export-target' ).remove();
    
                var $field = $( '<textarea id="settings" class="import-export" />' ),
                    $btn = $( '<button class="button-primary" id="import-settings">Import Settings</button>' );
    
                $field.attr( 'placeholder', 'Paste your saved LaunchPad settings here' );
                $( this ).closest( '.forminp' ).append( $field, $btn );
                $( this ).remove();
    
                // actual do import button
                $btn.on( 'click', function( ev ) {
                    ev.preventDefault();
                    if ( window.confirm('Click OK to import the supplied settings. All settings will be replaced with the submitted settings!') ) {
                        _this.import_settings();
                    }
                } );
    
            } );
    
            // hide sub sections on page load
            this.hide_sub_sections();
    
        },
    
        /**
         * Import a settings object
         * @since 1.3.0
         * @version  1.3.0
         * @return void
         */
        import_settings: function() {
            LaunchPad.Ajax.call({
                data: {
                    action: 'import_settings',
                    settings: $( '#settings' ).val(),
                },
                beforeSend: function() {
                },
                success: function(r) {
                    console.log( r );
                    var notice_class = r.data.success ? 'success' : 'danger';
                    $('.launchpad-notice').addClass( notice_class ).text(r.data.message);
                    location.reload();
                },
                error: function(r) {
                    $('.launchpad-notice').addClass('danger').text('There was an error importing the settings. Please reload the page and try again.');
                }
            });
        },
    
        /**
         * reset default settings ajax call
         */
        reset_default_settings: function() {
    
            LaunchPad.Ajax.call({
                data: {
                    action: 'reset_settings',
                },
                beforeSend: function() {
                },
                success: function(r) {
                    $('.launchpad-notice').addClass('success').text(r.data);
                    location.reload();
                },
                error: function(r) {
                    $('.launchpad-notice').addClass('danger').text('There was an error resetting the settings. Please reload the page and try again.');
                }
            });
    
        },
    
    
        /**
         * Generate a settings object
         * @since 1.3.0
         * @version  1.3.0
         * @return void
         */
        generate_export: function( $btn ) {
    
            LaunchPad.Ajax.call({
                data: {
                    action: 'export_settings',
                },
                beforeSend: function() {
                },
                success: function(r) {
    
                    if ( r.data && r.data.export ) {
                        var $parent = $btn.closest( '.forminp' ),
                            $target = $( '<textarea id="export-target" class="import-export" />' );
                        $target.val( r.data.export );
                        $parent.append( $target );
                        $target[0].select();
                        $('.launchpad-notice').addClass('success').text(r.data.message);
                    }
    
                },
                error: function(r) {
                    $('.launchpad-notice').addClass('danger').text('There was an error resetting generating the export file. Please reload the page and try again.');
                }
            });
    
        },
    
        /**
         * hide sub sections on page load
         */
        hide_sub_sections: function() {
    
            // hide collapsable sections on page load
            $('.launchpad-settings-divider').each(function() {
                if ($(this).hasClass('collapsable')) {
                    var table = $(this).next();
                    $(table).addClass('collapsed');
                    $(table).hide();
                }
            });
    
            // setup slideUp / slideDown functionality for sub sections
            $('.launchpad-settings-divider').on('click', function() {
    
                if ($(this).hasClass('collapsable')) {
                    var next = $(this).next();
    
                    if ($(next).hasClass('expanded')) {
                        $(next).removeClass('expanded');
                        $(next).addClass('collapsed');
                        $(next).slideUp();
                    }
                    else {
                        $(next).removeClass('collapsed');
                        $(next).addClass('expanded');
                        $(next).slideDown();
                    }
                }
    
            });
        }
    
    };
    
        /*global LaunchPad */
    
    /**
     * Responsive Videos
     * @type {Object}
     */
    LaunchPad.Vids = {
    
        /**
         * init
         * loads class methods
         */
        init: function() {
    
            if ( $( 'body' ).hasClass( 'wp-admin' ) ) {
                return;
            }
    
            $( '#page' ).fitVids( {
                customSelector: 'iframe[src*="//fast.wistia.net/"], iframe[src*="//streamable.com/"]'
            } );
    
        },
    
    };
    

    /**
     * Initializes all classes within the Launchpad Namespace
     * @return {[type]} [description]
     */
    LaunchPad.init = function() {

        for (var func in LaunchPad) {

            if ( typeof LaunchPad[func] === 'object' && LaunchPad[func] !== null ) {

                if ( LaunchPad[func].init !== undefined ) {

                    if ( typeof LaunchPad[func].init === 'function') {
                        LaunchPad[func].init();
                    }

                }

            }

        }

    };

    LaunchPad.init($);

})(jQuery);
