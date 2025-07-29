<!DOCTYPE html>
<html>
<head>
    <title>Order Menu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
    body {
        background-color: #fff8e1;
    }
    .menu-card {
        background-color: #fff3e0;
        border: 1px solid #ccc;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 20px;
        text-align: center;
        box-shadow: 0 0 5px rgba(0,0,0,0.1);
    }
    .menu-card img {
        width: 100%;
        height: 220px; /* <-- Image size increased here */
        object-fit: cover;
        border-radius: 10px;
    }
</style>

</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">Select Your Items</h2>
        <form action="billing.php" method="post">
            <div class="row">
                <?php
                $conn = mysqli_connect("localhost", "root", "", "cafedb");

$images = [
    1 => "https://www.netmeds.com/images/cms/wysiwyg/blog/Post/2018/10/coffee_its_benefits_898_1_.jpg", //coffee
    2 => "https://thewoods.net.in/wp-content/uploads/2021/02/tea.jpeg", //tea
    3 => "https://images.ctfassets.net/0dkgxhks0leg/2oCfIKmMENMCPVqRfOSwBu/f68d0be25a70d23b729a09aff72ab027/Italian_Turkey_Club_Sandwich_.jpg",//Sandwich
    4 => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRwWpjoJHiG9zmraXbv4Ex-Xny5jRM9GyShvA&s",//cake
    5 => "https://b.zmtcdn.com/data/pictures/chains/1/171/9b8dec1aab645d9d87d449d1a10bb69d.jpg",//burger
    6 => "https://theredvelvetbakery.in/wp-content/uploads/2022/07/Gralic_Crust_Veggie_Pizza.jpg",//pizza
    7 => "https://www.licious.in/blog/wp-content/uploads/2020/12/Penne-Alfredo.jpg",//pasta
    8 => "https://st.depositphotos.com/1066655/1288/i/450/depositphotos_12882151-stock-photo-muffins.jpg",//muffin
    9 => "https://fleurfoodie.com/wp-content/uploads/2021/12/ijskoffie-2.jpg",//cold coffee
    10 => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT3LKIvFNsTUDps5wQ4oNnnXkKURqkev3hgAxwVQEc8Xmr-I3YIvBWYs45Kd3i5-RCm4N0&usqp=CAU",////pasta
    11 => "https://cdn.thefreshmancook.com/wp-content/uploads/2024/07/fruit-salad-with-whipped-cream-1.png", // Fruit Salad
    12 => "https://savorthebest.com/wp-content/uploads/2023/05/baked-sourdough-donuts_4682.jpg" // Donut
];



                $result = mysqli_query($conn, "SELECT * FROM menu");

                while ($row = mysqli_fetch_assoc($result)) {
                    $img = isset($images[$row['item_id']]) ? $images[$row['item_id']] : "https://via.placeholder.com/150";
                    echo "<div class='col-md-4'>";
                    echo "<div class='menu-card'>";
                    echo "<img src='$img' alt='{$row['item_name']}'>";
                    echo "<h5 class='mt-2'>{$row['item_name']}</h5>";
                    echo "<p>₹ {$row['price']}</p>";
                    echo "<input type='hidden' name='item_name[]' value='{$row['item_name']}'>";
                    echo "<input type='hidden' name='price[]' value='{$row['price']}'>";
                    echo "<label>Quantity</label>";
                    echo "<input type='number' name='quantity[]' min='0' value='0' class='form-control'>";
                    echo "</div>";
                    echo "</div>";
                }

                mysqli_close($conn);
                ?>
            </div>
            <div class="text-center">
                <button class="btn btn-success mt-4 px-5">Proceed to Billing</button>
            </div>
        </form>
    </div>
</body>
</html>
