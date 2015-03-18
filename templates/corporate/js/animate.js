	var canvas = document.getElementById("flying-bubbles");
	var ctx = canvas.getContext("2d");
	
	var WW = window.innerWidth, HH = window.innerHeight;
	canvas.width = WW;
	canvas.height = HH;
	
	var circles = []; 
	for(var i = 0; i < 24; i++ ){
		circles.push(new create_circle());
	}	
	function create_circle() {
		this.xx = Math.random()*WW;
		this.yy = Math.random()*HH;
		
		this.vxx = 0.1+Math.random()*2;
		this.vyy = -this.vxx;
		var arr = new Array(-1, 0, 1, -1, 0, 1, 1, -1);
		this.dirx = arr[Math.floor(Math.random()*9)];
		this.diry = arr[Math.floor(Math.random()*9)];
		
		this.r = 10 + Math.random()*50;
		this.colorR = Math.floor( Math.random()*(71) );
		this.colorG = Math.floor( Math.random()*(71) );
		this.colorB = Math.floor( Math.random()*(71) );
	}	
	function draw() {

		var grad = ctx.createLinearGradient(0, 0, WW, 0);
		grad.addColorStop(0, 'rgb(110,110,110)');
		grad.addColorStop(0.35, 'rgb(245,245,245)');
		grad.addColorStop(0.65, 'rgb(245,245,245)');
		grad.addColorStop(1, 'rgb(110,110,110)');


		ctx.globalCompositeOperation = "source-over";
		ctx.fillStyle = grad;
		ctx.fillRect(0,0,WW,HH);

		for(var j = 0; j < circles.length; j++) {
			var c = circles[j];
			
			ctx.beginPath();
			ctx.globalCompositeOperation = "lighter";		
			ctx.fillStyle = "rgba("+c.colorR+","+c.colorG+","+c.colorB+",0.9)";
			ctx.arc(c.xx, c.yy, c.r, Math.PI*2, false);
			ctx.fill();
			
			c.xx += c.vxx*c.dirx;
			c.yy += c.vyy*c.diry;
			
			if(c.xx < -50) c.xx = WW+50;
			if(c.yy < -50) c.yy = HH+50;
			if(c.xx > WW+50) c.xx = -50;
			if(c.yy > HH+50) c.yy = -50;
		}
	}	
	setInterval(draw, 84);