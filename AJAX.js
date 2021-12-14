window.addEventListener('load', function(){
    'use strict';

    //set variable for php file which will retrieve the database data.
    const URL = 'getData.php';
    const URLjson = URL + '?useJSON';
    
    const select = document.getElementById("locSelect")

    callbackJSON = function(data){
        if(select.options[1].selected){
            for(i=0;i<6; i++){
                if(data.locationID='CIS'){
                    html = '<p>'+data.binName +'<span>' + data.locationID + '</span> <span>' + data.capacity +'</span> </p>';
                    //WHATEVER GOES HERE
                    console.log(html);
                }
            }
        }
        if(select.options[2].selected){
            for(i=0; i<6; i++){ 
                if(data.locationID='ELA'){    
                    html = '<p>'+data.binName +'<span>' + data.locationID + '</span> <span>' + data.capacity +'</span> </p>';
                    //WHATEVER GOES HERE
                    document.getElementsByName
                    console.log(html);
                }
            }
        }
        if(select.options[3].selected){
            for(i=0; i<6; i++){ 
                if(data.locationID='ELB'){    
                    html = '<p>'+data.binName +'<span>' + data.locationID + '</span> <span>' + data.capacity +'</span> </p>';
                    //WHATEVER GOES HERE
                    console.log(html);
                }
            }
        }
    }

    const runQuery = function(URL, callback) {
        fetch(URL)
            .then(
                function(response) {
                    //checks if ther content type is JSON, if it is, it will return the response as a json format, otherwise it will return it in a text format.
                    const contentType = response.headers.get('content-type');
                    if (contentType.includes('application/json')) {
                        return response.json();
                    }
                    return response.text();
                }
            )
            .then(
                //takes the returned value and runs a function, passing there data into the passed in callback function.
                function(data) {
                    callback(data);
                }
            )
            .catch(
                function(err) {
                    console.log("Something went wrong!", err);
                }
            )
    }

    setInterval(runQuery(URLjson, callbackJSON), 5000);

});