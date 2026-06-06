const express = require("express");
const bcrypt = require("bcrypt");
const db = require("../db");

const router = express.Router();

/* ==========================
   TEST ROUTE
========================== */
router.get("/test", (req, res) => {
    res.json({
        success: true,
        message: "Auth route working"
    });
});

/* ==========================
   SIGNUP
========================== */
router.post("/signup", async (req, res) => {
    try {
        const { username, email, password } = req.body;

        // Validation
        if (!username || !email || !password) {
            return res.status(400).json({
                success: false,
                message: "All fields are required"
            });
        }

        // Check if user exists
        db.query(
            "SELECT * FROM users WHERE email = ?",
            [email],
            async (err, results) => {

                if (err) {
                    return res.status(500).json({
                        success: false,
                        message: err.message
                    });
                }

                if (results.length > 0) {
                    return res.json({
                        success: false,
                        message: "User already exists"
                    });
                }

                // Hash password
                const hashedPassword = await bcrypt.hash(password, 10);

                // Insert user
                db.query(
                    "INSERT INTO users (username, email, password) VALUES (?, ?, ?)",
                    [username, email, hashedPassword],
                    (err, result) => {

                        if (err) {
                            return res.status(500).json({
                                success: false,
                                message: err.message
                            });
                        }

                        return res.json({
                            success: true,
                            message: "Signup successful",
                            userId: result.insertId
                        });
                    }
                );
            }
        );

    } catch (error) {
        return res.status(500).json({
            success: false,
            message: error.message
        });
    }
});

/* ==========================
   LOGIN
========================== */
router.post("/login", (req, res) => {

    const { email, password } = req.body;

    if (!email || !password) {
        return res.status(400).json({
            success: false,
            message: "Email and password are required"
        });
    }

    db.query(
        "SELECT * FROM users WHERE email = ?",
        [email],
        async (err, results) => {

            if (err) {
                return res.status(500).json({
                    success: false,
                    message: err.message
                });
            }

            if (results.length === 0) {
                return res.json({
                    success: false,
                    message: "Invalid email or password"
                });
            }

            const user = results[0];

            const passwordMatch = await bcrypt.compare(
                password,
                user.password
            );

            if (!passwordMatch) {
                return res.json({
                    success: false,
                    message: "Invalid email or password"
                });
            }

            return res.json({
                success: true,
                message: "Login successful",
                user: {
                    id: user.id,
                    username: user.username,
                    email: user.email
                }
            });
        }
    );
});

module.exports = router;