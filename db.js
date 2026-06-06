const mysql = require("mysql2");

const db = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "canteen"
});

// Connect to MySQL
db.connect((err) => {
    if (err) {
        console.error("Database Connection Failed:", err);
    } else {
        console.log("MySQL Connected");
    }
});

// Export connection
module.exports = db;