<?php
/**
 * Dashboard View
 * 
 * Displays the main dashboard for logged-in users
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Bussin Foodie</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            min-height: 100vh;
        }
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .navbar h1 {
            color: white;
            font-size: 24px;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
            transition: background 0.3s;
        }
        .navbar a:hover {
            background: rgba(255, 255, 255, 0.3);
        }
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }
        .welcome-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        .welcome-card h2 {
            color: #333;
            margin-bottom: 10px;
        }
        .welcome-card p {
            color: #666;
        }
        .food-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }
        .food-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .food-card:hover {
            transform: translateY(-5px);
        }
        .food-card .emoji {
            font-size: 80px;
            text-align: center;
            padding: 30px;
            background: #f8f9fa;
        }
        .food-card .content {
            padding: 20px;
        }
        .food-card h3 {
            color: #333;
            margin-bottom: 10px;
        }
        .food-card p {
            color: #666;
            font-size: 14px;
        }
        .food-card .price {
            color: #667eea;
            font-weight: bold;
            font-size: 18px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>🍔 Bussin Foodie</h1>
        <div>
            <span style="color: white; margin-right: 20px;">
                Welcome, <?php echo htmlspecialchars($_SESSION['user']['name'] ?? 'User'); ?>!
            </span>
            <!-- Important: Logout link uses url() for correct path -->
            <a href="<?php echo htmlspecialchars(url('logout')); ?>">Logout</a>
        </div>
    </nav>
    
    <div class="container">
        <div class="welcome-card">
            <h2>Welcome to Bussin Foodie! 🎉</h2>
            <p>Discover the most delicious food in town. Browse our menu and order your favorites!</p>
        </div>
        
        <h2 style="margin-bottom: 20px; color: #333;">Featured Items</h2>
        
        <div class="food-grid">
            <div class="food-card">
                <div class="emoji">🍔</div>
                <div class="content">
                    <h3>Classic Burger</h3>
                    <p>Juicy beef patty with fresh lettuce, tomatoes, and special sauce</p>
                    <div class="price">$12.99</div>
                </div>
            </div>
            
            <div class="food-card">
                <div class="emoji">🍕</div>
                <div class="content">
                    <h3>Pepperoni Pizza</h3>
                    <p>Hand-tossed pizza with premium pepperoni and mozzarella</p>
                    <div class="price">$15.99</div>
                </div>
            </div>
            
            <div class="food-card">
                <div class="emoji">🍜</div>
                <div class="content">
                    <h3>Ramen Bowl</h3>
                    <p>Rich pork broth with noodles, soft-boiled egg, and chashu</p>
                    <div class="price">$14.99</div>
                </div>
            </div>
            
            <div class="food-card">
                <div class="emoji">🌮</div>
                <div class="content">
                    <h3>Street Tacos</h3>
                    <p>Three authentic tacos with your choice of protein</p>
                    <div class="price">$11.99</div>
                </div>
            </div>
            
            <div class="food-card">
                <div class="emoji">🍣</div>
                <div class="content">
                    <h3>Sushi Platter</h3>
                    <p>Assorted fresh sushi rolls with wasabi and ginger</p>
                    <div class="price">$22.99</div>
                </div>
            </div>
            
            <div class="food-card">
                <div class="emoji">🥗</div>
                <div class="content">
                    <h3>Fresh Salad</h3>
                    <p>Mixed greens with grilled chicken and house dressing</p>
                    <div class="price">$10.99</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
