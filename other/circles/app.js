var App = {
  draw_circles: function() {
    var radius = 30, currentRadius = 20,
        width = 2, currentWidth = 2;
    
    while(currentRadius < (this.width / 2 + radius * 10)) {
      var circle = this.r.circle(this.width/2, this.height/2, currentRadius);
      circle.attr("stroke", this.get_random_color());
      circle.attr("stroke-width", currentWidth);
      
      radius += this.step % 30;

      currentRadius += radius;
      currentWidth += width;
    }
    
  },
  
  get_random_color: function() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.round(Math.random() * 15)];
    }
    return color;
  },
  
  initialize: function() {
    this.width = $('#holder').width();
    this.height = $('#holder').height();
    this.r = Raphael("holder", this.width, this.height);
    
    // draw application
    this.step = 0;
    (function() {
      App.r.clear();
      App.step++;
      App.draw_circles();
      
      setTimeout(arguments.callee, 50);
    })();
    
  }
}

Raphael(function() {
  App.initialize();
});