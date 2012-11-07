var App = {
  step: 1,
  width: 0,
  height: 0,
  center: {
    x: 0,
    y: 0
  },
  colors: ['de2c33', 'dd2a31', 'c71f24', 'b61d22', 'a21d21', '911e21', '7e1e21', '6c1e20', '5a1e20', '461f1f'],
  path_angles: [[-5, 15], [-30, -15], [-45, -40], [-60, -60], [-70, -75], [-85, -85], [185, 165], [210, 190], [225, 215], [240, 245], [255, 255]],
  sides_angles: [[-23, -6, -25, -10], [-18, 0, -20, -4], [-157, -174, -155, -170], [-162, -180, -160, -176]],
  
  done: function() {
    //$('#overlay').html('<h1>Done!</h1>');
  },

  draw: function() {  
    // circles
    var i = 0,
        radiuses = [],
        minRadius = Math.round(this.width/17 + Math.pow(this.step, 2.5)/50),
        currentRadius = minRadius;
            
    // generate and draw radiuses
    while(currentRadius < 2*this.width) {
      radiuses.push(currentRadius);
      currentRadius += minRadius;
    }
    
    // done call
    var opacity = 0;


    if(this.step > 80) {
      return this.done();
    }else if(this.step > 50) {
      this.center.y = this.height*3/4 + Math.pow(this.step-50, 1.85);
      opacity = (this.step-50)/30*2;
      $('#overlay').css('opacity', opacity);
    }
    
    for(i in radiuses.reverse()) {
      var color = this.colors[radiuses.length-i] ? '#' + this.colors[radiuses.length-i] : '#000',
          circle = this.r.circle(this.center.x, this.center.y, radiuses[i]);

      circle.attr('stroke', color);
      circle.attr('fill', color);
      circle.attr('fill-opacity', 1-opacity);
    }

    // draw path lines
    for(var l in this.path_angles) {
      var x1 = Math.round(this.center.x + (Math.cos(this.path_angles[l][0]*(Math.PI/180.0)) * minRadius)),
          y1 = Math.round(this.center.y + (Math.sin(this.path_angles[l][0]*(Math.PI/180.0)) * minRadius)),
          x2 = Math.round(this.center.x + (Math.cos(this.path_angles[l][1]*(Math.PI/180.0)) * this.width)),
          y2 = Math.round(this.center.y + (Math.sin(this.path_angles[l][1]*(Math.PI/180.0)) * this.height));

      var path = this.r.path('M'+x1+','+y1+'L'+x2+','+y2);
      path.attr('stroke', '#000');
      path.attr('stroke-width', 2);
      path.attr('stroke-opacity', .1);
    }
    
    // draw sides lines
    for(var l in this.sides_angles) {
      var x1 = Math.round(this.center.x + (Math.cos(this.sides_angles[l][0]*(Math.PI/180.0)) * minRadius)),
          y1 = Math.round(this.center.y + (Math.sin(this.sides_angles[l][0]*(Math.PI/180.0)) * minRadius)),
          x2 = Math.round(this.center.x + (Math.cos(this.sides_angles[l][1]*(Math.PI/180.0)) * this.width)),
          y2 = Math.round(this.center.y + (Math.sin(this.sides_angles[l][1]*(Math.PI/180.0)) * this.height)),
          x3 = Math.round(this.center.x + (Math.cos(this.sides_angles[l][2]*(Math.PI/180.0)) * minRadius)),
          y3 = Math.round(this.center.y + (Math.sin(this.sides_angles[l][2]*(Math.PI/180.0)) * minRadius)),
          x4 = Math.round(this.center.x + (Math.cos(this.sides_angles[l][3]*(Math.PI/180.0)) * this.width)),
          y4 = Math.round(this.center.y + (Math.sin(this.sides_angles[l][3]*(Math.PI/180.0)) * this.height));

      var path = this.r.path('M'+x1+','+y1+'L'+x2+','+y2+'L'+x4+','+y4+'L'+x3+','+y3+'L'+x1+','+y1);
      //console.log('M'+x1+','+y1+'L'+x2+','+y2+'L'+x4+','+y4+'L'+x3+','+y3+'L'+x1+','+y1);
      path.attr('stroke', '#fff');
      path.attr('stroke-width', 1);
      path.attr('fill', '#fff');
    }

    // center circle
    var circle = this.r.circle(this.center.x, this.center.y, minRadius);
    circle.attr('stroke', '#fff');
    circle.attr('fill', '#fff');

    // path for rails
    var x1 = Math.round(this.center.x + (Math.cos(0) * minRadius)),
        y1 = Math.round(this.center.y + (Math.sin(0) * minRadius)),
        x2 = Math.round(this.center.x + (Math.cos(20*(Math.PI/180.0)) * this.width)),
        y2 = Math.round(this.center.y + (Math.sin(20*(Math.PI/180.0)) * this.height)),    
        x3 = Math.round(this.center.x + (Math.cos(180*(Math.PI/180.0)) * minRadius)),
        y3 = Math.round(this.center.y + (Math.sin(180*(Math.PI/180.0)) * minRadius)),
        x4 = Math.round(this.center.x + (Math.cos(160*(Math.PI/180.0)) * this.width)),
        y4 = Math.round(this.center.y + (Math.sin(160*(Math.PI/180.0)) * this.height));
    
    var path = this.r.path('M'+x1+','+y1+'L'+x2+','+y2+'L'+x4+','+y4+'L'+x3+','+y3+'L'+x1+','+y1);
    path.attr('stroke', '#180d2b');
    path.attr('fill', '#180d2b');
    
    // path for rails
    var x1 = Math.round(this.center.x + (Math.cos(0) * minRadius)),
        y1 = Math.round(this.center.y + (Math.sin(0) * minRadius)),
        x2 = Math.round(this.center.x + (Math.cos(25*(Math.PI/180.0)) * this.width)),
        y2 = Math.round(this.center.y + (Math.sin(25*(Math.PI/180.0)) * this.height)),    
        x3 = Math.round(this.center.x + (Math.cos(180*(Math.PI/180.0)) * minRadius)),
        y3 = Math.round(this.center.y + (Math.sin(180*(Math.PI/180.0)) * minRadius)),
        x4 = Math.round(this.center.x + (Math.cos(155*(Math.PI/180.0)) * this.width)),
        y4 = Math.round(this.center.y + (Math.sin(155*(Math.PI/180.0)) * this.height));
    
    var path = this.r.path('M'+x1+','+y1+'L'+x2+','+y2+'L'+x4+','+y4+'L'+x3+','+y3+'L'+x1+','+y1);
    path.attr('stroke', '#282033');
    path.attr('fill', '#282033');
    
    // rails
    var x1 = Math.round(this.center.x + (Math.cos(0) * minRadius/4)),
        y1 = this.center.y-5,
        x2 = Math.round(this.center.x + (Math.cos(60*(Math.PI/180.0)) * this.width)),
        y2 = Math.round(this.center.y + (Math.sin(60*(Math.PI/180.0)) * this.height)),    
        x3 = Math.round(this.center.x + (Math.cos(0) * minRadius/4) - minRadius/15),
        y3 = this.center.y-5,
        x4 = Math.round(this.center.x + (Math.cos(70*(Math.PI/180.0)) * this.width)),
        y4 = Math.round(this.center.y + (Math.sin(70*(Math.PI/180.0)) * this.height));
    
    var path = this.r.path('M'+x1+','+y1+'L'+x2+','+y2+'L'+x4+','+y4+'L'+x3+','+y3+'L'+x1+','+y1);
    path.attr('stroke', '#fff');
    path.attr('fill', '#fff');

    // rails
    var x1 = Math.round(this.center.x + (Math.cos(180*(Math.PI/180.0)) * minRadius/4)),
        y1 = this.center.y-5,
        x2 = Math.round(this.center.x + (Math.cos(120*(Math.PI/180.0)) * this.width)),
        y2 = Math.round(this.center.y + (Math.sin(120*(Math.PI/180.0)) * this.height)),    
        x3 = Math.round(this.center.x + (Math.cos(180*(Math.PI/180.0)) * minRadius/4) + minRadius/15),
        y3 = this.center.y-5,
        x4 = Math.round(this.center.x + (Math.cos(110*(Math.PI/180.0)) * this.width)),
        y4 = Math.round(this.center.y + (Math.sin(110*(Math.PI/180.0)) * this.height));
    
    var path = this.r.path('M'+x1+','+y1+'L'+x2+','+y2+'L'+x4+','+y4+'L'+x3+','+y3+'L'+x1+','+y1);
    path.attr('stroke', '#fff');
    path.attr('fill', '#fff');
            
    return true;
  },
  
  initialize: function() {
    this.width = $('#holder').width();
    this.height = $('#holder').height();
    this.center = {
      x: this.width/2,
      y: this.height*3/4
    }
    this.r = Raphael("holder", this.width, this.height);
    
    // draw application
    this.draw();

    $('body').bind('click', function() {
      App.r.clear();
      App.step++;

      if(App.draw()) {
        setTimeout(arguments.callee, 30);
      }else{
        App.done();
      }
    });
  }
}

Raphael(function() {
  App.initialize();
});