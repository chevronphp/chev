define([], function () {
	"use strict";

	var xhr = function(url){

		// A small example of object
		var core = {

			// Method that performs the ajax request
			ajax : function (method, url, request, asBody) {

				// Creating a promise
				var promise = new Promise( function (resolve, reject) {

					// Instantiates the XMLHttpRequest
					var client = new XMLHttpRequest();
					var uri = url;
					var sendAsBody = asBody || false;

					if (request) {
						if(method === "GET"){
							uri += "?" + core.makeQueryString(request);
							request = null;
						}else{
							request = core.makeQueryString(request)
						}
					}

					client.open(method, uri);

					if(!sendAsBody){
						client.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					}

					client.send(request);

					client.onload = function () {
						if (this.status == 200) {
							// Performs the function "resolve" when this.status is equal to 200
							resolve(this.responseText);
						} else {
							// Performs the function "reject" when this.status is different than 200
							reject(this.statusText);
						}
					};

					client.onerror = function () {
						reject(this.statusText);
					};
				});

				// Return the promise
				return promise;
			},

			makeQueryString : function(request){
				var queryString = "";
				var argcount = 0;
				for (var key in request) {
					if (request.hasOwnProperty(key)) {
						if (argcount++) { // avoid adding "&" on first iteration
							queryString += '&';
						}
						queryString += encodeURIComponent(key) + '=' + encodeURIComponent(request[key]);
					}
				}
				return queryString || "";
			}
		};

		// Adapter pattern
		return {
			'get' : function(request) {
				return core.ajax('GET', url, request);
			},
			'post' : function(request, asBody) {
				return core.ajax('POST', url, request, asBody);
			}
		};
	};

	return xhr;

});
