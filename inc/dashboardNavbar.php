<?php if ($_SESSION['type'] == 1) : ?>

    <ul>
        <a href="dashboard.php">Dashboard</a>
        <a href="purchasesHistory.php">Purchases History</a>
        <a href="listOfProducts.php">List of Products</a>
        <a href="listOfUsers.php">List of Users</a>
        <a href="accountSetting.php">Account Setting</a>
        <a href="index.php">Back to HomePage</a>
        <a href="logout.php">Logout</a>
    </ul>

<?php else : ?>
    <ul>
        <a href="dashboard.php">Dashboard</a>
        <a href="myPurchases.php">My Purchases</a>
        <a href="myCart.php">My Cart</a>
        <a href="accountSetting.php">My Account</a>
        <a href="index.php">Back to HomePage</a>
        <a href="logout.php">Logout</a>
    </ul>

<?php endif; ?>