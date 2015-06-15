(function (window, document, $)
{
    function Readmore (el, options)
    {
        this.el  = el;
        this.$el = $(el);
        this.options = $.extend({}, this.defaultOptions, options, this.$el.data());

        this._init();
    }

    Readmore.prototype.defaultOptions =
    {   

    };

    Readmore.prototype._init = function ()
    {
        this._setup();
        this._events();
    };

    Readmore.prototype._setup = function ()
    {   
        this.$trigger = $('<a data-readmore>Read more...</a>');

        this.$el.after(this.$trigger);
    };

    Readmore.prototype._events = function ()
    {    
        var self = this;

        this.$trigger.on('click', function (event)
        {
            event.preventDefault();

            self.$el.fadeToggle(200, function ()
            {
                self.$trigger.text(function (index, text)
                {
                    return (text === 'Read more...')? 'Read less...' : 'Read more...';
                });
            });
        });
    };

    function Plugin (options)
    {
        return this.each(function ()
        {
            var el = $(this);

            if (!el.data('tms-readmore'))
            {
                el.data('tms-readmore', new Readmore(this, options));
            }
        });
    }

    $.fn.tmsReadmore = Plugin;

    $(document).ready(function ()
    {
    	$('.readmore-content').tmsReadmore();
    });

}(window, document, jQuery));