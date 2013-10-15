(function (Popcorn) {
  Popcorn.forEach( [ "show", "text" ], function( name ) {

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
          end: { elem: "input", type: "text", label: "Out" },
          target: name + "-container"
        }
      },
    _setup: function(options) {

      var target = document.getElementById( options.target );
	   target.style.display = "none";
      if ( !target && Popcorn.plugin.debug ) {
        throw new Error( "target container doesn't exist" );
      }
    },
    start: function(event, options){
		var target = document.getElementById( options.target );
      	target.style.display = "";
    },
    end: function(event, options){
      	var target = document.getElementById( options.target );
      	target.style.display = "none";
    },
    _teardown: function( options ) {
        var target = document.getElementById( options.target );
      	target.style.display = "none";
    }
  });
});

})( Popcorn );
