(function (Popcorn) {
  Popcorn.forEach( [ "option", "text" ], function( name ) {

    Popcorn.plugin( name , {

      manifest: {
        about: {
          name: "Popcorn " + name + " Plugin",
          version: "0.2",
          author: "@annasob, @rwaldron",
          website: "annasob.wordpress.com"
        },
        options: {
          start: { elem: "input", type: "text", label: "In" },
          text: { elem: "input", type: "text", label: "Text" },
		 }
      },
    _setup: function(options) {

      
    },
    start: function(event, options){
		if (confirm(options.text)) {
    			// Save it!
		} else {
			alert('OK! I will stop!');
			var p = Popcorn('#video').pause();
		}
    },
    end: function(event, options){
      	
    },
    _teardown: function( options ) {
        
    }
  });
});

})( Popcorn );
