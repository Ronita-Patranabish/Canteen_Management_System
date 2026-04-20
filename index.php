<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canteen Management System</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            /* ADD YOUR BACKGROUND IMAGE LINK HERE */
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('your-background-image.jpg');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            color: #333;
            line-height: 1.6;
        }

        /* NAVBAR */
        #navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(51, 51, 51, 0.95);
            padding: 10px 5%;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        #logo img { height: 45px; width: auto; }

        #navbar ul {
            display: flex;
            list-style: none;
            gap: 20px;
            align-items: center;
        }

        #navbar a { color: white; text-decoration: none; font-weight: bold; }
        #navbar a:hover { color: #ff4d6d; }

        .welcome { color: #ff4d6d; font-weight: bold; }

        /* SECTIONS */
        section { padding: 60px 20px; max-width: 1200px; margin: auto; }
        
        .h-primary { 
            text-align: center; 
            margin-bottom: 30px; 
            color: white; 
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5); 
        }

        /* MENU GRID */
        .menu-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .menu-item {
            background: white;
            padding: 15px;
            text-align: center;
            border-radius: 12px;
            width: 200px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .menu-item img {
            width: 100%;
            height: 130px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .menu-item h3 { font-size: 1.1rem; margin: 5px 0; }
        .menu-item p { color: #e63946; font-weight: bold; margin-bottom: 10px; }

        .add-btn {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 8px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        /* CART */
        #cart { background: rgba(255, 255, 255, 0.9); border-radius: 15px; margin-top: 40px; margin-bottom: 40px;}
        #cart h1 { color: #333; text-shadow: none; }
        
        #cart-items { list-style: none; max-width: 600px; margin: auto; padding: 10px; }
        
        #cart-items li {
            background: #fff;
            margin-bottom: 10px;
            padding: 12px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #ddd;
        }

        .btns button {
            padding: 5px 12px;
            margin-left: 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            color: white;
        }

        .btn-plus { background: #4CAF50; }
        .btn-minus { background: #ff4d4d; }

        /* CONTACT FORM */
        #contact { background: rgba(0, 0, 0, 0.7); border-radius: 15px; padding: 40px; }
        #contact form { display: flex; flex-direction: column; width: 320px; margin: auto; gap: 12px; }
        #contact input, #contact textarea { padding: 10px; border-radius: 5px; border: none; }

        .btn-submit { background: #ff4d6d; color: white; border: none; padding: 12px; border-radius: 5px; cursor: pointer; font-weight: bold; }

        footer { text-align: center; background: #333; color: white; padding: 20px; }
    </style>
</head>

<body>

<nav id="navbar">
    <div id="logo"><img src="L.png" alt="Logo"></div>
    <ul>
        <li><a href="#home">Home</a></li>
        <li><a href="#menu">Menu</a></li>
        <li><a href="#cart">Cart</a></li>
        <li><a href="#contact">Contact</a></li>
        <?php if(isset($_SESSION['user'])): ?>
            <li class="welcome">Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?></li>
            <li><a href="logout.php" style="color:#ff4d4d;">Logout</a></li>
        <?php else: ?>
            <li><a href="login.html">Login</a></li>
            <li><a href="signup.html">Signup</a></li>
        <?php endif; ?>
    </ul>
</nav>

<section id="home">
    <h1 class="h-primary" style="font-size: 3rem;">Welcome to Canteen Management System !!!</h1>
    <p style="text-align:center; color: white; font-size: 1.2rem;">Delicious food, just a click away.</p>
</section>

<section id="menu">
    <h1 class="h-primary">Our Delicious Menu</h1>
    <div class="menu-container">
        <div class="menu-item"><img src="samosa.png"><h3>Samosa</h3><p>₹20</p><button class="add-btn" onclick="addToCart('Samosa',20)">Add +</button></div>
        <div class="menu-item"><img src="chai.png"><h3>Chai</h3><p>₹10</p><button class="add-btn" onclick="addToCart('Chai',10)">Add +</button></div>
        <div class="menu-item"><img src="sandwitch.png"><h3>Sandwich</h3><p>₹40</p><button class="add-btn" onclick="addToCart('Sandwich',40)">Add +</button></div>
        <div class="menu-item"><img src="HakkaNoodles.png"><h3>Hakka Noodles</h3><p>₹60</p><button class="add-btn" onclick="addToCart('Hakka Noodles',60)">Add +</button></div>
        <div class="menu-item"><img src="SpringRoll.png"><h3>Spring Roll</h3><p>₹60</p><button class="add-btn" onclick="addToCart('Spring Roll',60)">Add +</button></div>
        <div class="menu-item"><img src="Coffee.png"><h3>Hot Coffee</h3><p>₹20</p><button class="add-btn" onclick="addToCart('Hot Coffee',20)">Add +</button></div>
        <div class="menu-item"><img src="BreadPakora.png"><h3>Bread Pakora</h3><p>₹60</p><button class="add-btn" onclick="addToCart('Bread Pakora',60)">Add +</button></div>
        <div class="menu-item"><img src="ColdCoffee.png"><h3>Cold Coffee</h3><p>₹20</p><button class="add-btn" onclick="addToCart('Cold Coffee',20)">Add +</button></div>
        <div class="menu-item"><img src="FrenchFries.png"><h3>French Fries</h3><p>₹40</p><button class="add-btn" onclick="addToCart('French Fries',40)">Add +</button></div>
        <div class="menu-item"><img src="Lemonade.png"><h3>Lemonade</h3><p>₹20</p><button class="add-btn" onclick="addToCart('Lemonade',20)">Add +</button></div>
        <div class="menu-item"><img src="Kachori.png"><h3>Kachori</h3><p>₹40</p><button class="add-btn" onclick="addToCart('Kachori',40)">Add +</button></div>
        <div class="menu-item"><img src="Pasta.png"><h3>Pasta</h3><p>₹60</p><button class="add-btn" onclick="addToCart('Pasta',60)">Add +</button></div>
    </div>
</section>

<section id="cart">
    <h1 class="h-primary">Your Shopping Cart</h1>
    <ul id="cart-items"></ul>
    <h2 style="text-align:center; padding: 20px;">Total Amount: ₹<span id="total">0</span></h2>
    <div style="text-align:center; padding-bottom: 30px;">
        <button class="btn-submit" style="padding: 12px 50px;" onclick="placeOrder()">Confirm Order</button>
    </div>
</section>

<section id="contact">
    <h1 class="h-primary">Contact Us</h1>
    <form action="contact.php" method="POST">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone" placeholder="Phone" required>
        <textarea name="message" placeholder="Message" rows="3"></textarea>
        <button type="submit" class="btn-submit">Send Message</button>
    </form>
</section>

<footer>
    <p>© 2026 Canteen Management System</p>
</footer>

<script>
let cart = [];

function addToCart(item, price){
    let found = cart.find(c => c.item === item);
    if(found){ found.qty++; } 
    else { cart.push({item, price, qty:1}); }
    updateCart();
}

function removeFromCart(item){
    let found = cart.find(c => c.item === item);
    if(found){
        found.qty--;
        if(found.qty <= 0){ cart = cart.filter(c => c.item !== item); }
    }
    updateCart();
}

function updateCart(){
    let list = document.getElementById("cart-items");
    let totalSpan = document.getElementById("total");
    list.innerHTML = "";
    let total = 0;

    cart.forEach(c => {
        total += c.price * c.qty;
        let li = document.createElement("li");
        li.innerHTML = `
            <span>${c.item} (₹${c.price} x ${c.qty})</span>
            <div class="btns">
                <button class="btn-plus" onclick="addToCart('${c.item}',${c.price})">+</button>
                <button class="btn-minus" onclick="removeFromCart('${c.item}')">-</button>
            </div>
        `;
        list.appendChild(li);
    });
    totalSpan.innerText = total;
}

function placeOrder(){
    if(cart.length === 0){ alert("Your cart is empty!"); return; }

    <?php if(!isset($_SESSION['user'])): ?>
        alert("Please login to place your order!");
        window.location.href = "login.html";
        return;
    <?php endif; ?>

    fetch("place_order.php", {
        method:"POST",
        headers:{"Content-Type":"application/json"},
        body:JSON.stringify({ items: cart, total: document.getElementById("total").innerText })
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            alert("Success! Your Order ID is: " + data.order_id);
            cart = [];
            updateCart();
        } else {
            alert("Error: " + data.message);
        }
    })
    .catch(err => alert("Server error. Please try again."));
}
</script>

</body>
</html>