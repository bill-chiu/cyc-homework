module.exports = function (request, response, controllerName) {
	var mysql = require('mysql');
	var connection = mysql.createConnection({
		host : '127.0.0.1',
		user : 'root',
		password : '',
		database : 'labDB'
	});
	
	connection.connect(function(err) {
		// if (err) throw err;
		if (err) {
			console.log(JSON.stringify(err));
			return;
		}
	});

    this.request  = request;
    this.response = response;
    this.viewPath = controllerName + "/";
    
	this.index = function () {
	    this.response.render(this.viewPath + "index.html", 
	        {}
	    );
	}
	
	this.about = function () {
	    this.response.render(this.viewPath + "about.html", 
	        {}
	    );
	}

	this.news = function () {
		var objResponse = this.response;
		
		connection.query('select * from news', 
			'',
			function(err, rows) {
				if (err)	{
					console.log(JSON.stringify(err));
					return;
				}
				
				objResponse.send(JSON.stringify(rows));
			}
		);
		
		// connection.end();
		
	} // this.news
	

	this.put_news = function () {
		connection.query(
			"update news set title = ?, ymd = ? where newsId = " 
			    + this.request.body.newsId, 
				[
					this.request.body.title, 
					this.request.body.ymd
				]);
		this.response.send("database updated.");
	} // put_news
	
	this.delete_news = function () {
		console.log(this.request.body);
		connection.query(
			"delete from news where newsId = " + this.request.body.newsId,
				[]
			);
		this.response.send("row deleted.");
		
	} // delete_news

	this.post_news = function () {
		connection.query(
			"insert into news set title = ?, ymd = ? ", 
				[
					this.request.body.title, 
					this.request.body.ymd
				]);
		this.response.send("row inserted.");
	} // post_news

	
}
