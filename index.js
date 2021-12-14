const mysql = require('mysql')
console.log("Running")

const express = require("express");
const app = express();

app.get("/", (req,res) => {
    uploadData(req.query)
    res.statusCode = 200
    res.send("Success!")
    res.end()
})


app.listen(8080)

const con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "wastebin_management"
})
con.connect(function(err){
    if(err) throw err;
    console.log("connected");
});

const uploadData = (data) => {
    console.log(data);
    console.log(data.location);
    console.log(data.capacity);
    var sql = 'UPDATE bins SET capacity='+data.capacity+' WHERE binName="'+data.location+'"';
    con.query(sql, function(err, result){
        if(err) throw err;
        console.log(result.affectedRows + " record(s) updated");
    });
}



