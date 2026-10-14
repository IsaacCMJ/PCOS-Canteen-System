<div id="header">
    <h1 style="text-align:center"><br><strong>Pui Ching Ordering System</strong></h1>
</div>
<header>
    <nav>
        <input type="checkbox" id="nav-checkbox">
        <label for="nav-checkbox">&#9776</label>
        <div class="nav-title"><strong>PCOS</strong></div>
        <div class="nav-right">
            <ul>
                <li><a href="index.php" <?php if (basename($_SERVER['PHP_SELF'])=='index.php'){echo 'class="active"';}?>>Home</a></li>

                <li><a href="order.php" <?php if (basename($_SERVER['PHP_SELF'])=='order.php'){echo 'class="active"';}?>>Order</a></li>

                <?php
                             echo '<li><a href="cart_noodle.php"';
                             if (basename($_SERVER['PHP_SELF'])=='cart_noodle.php'){echo 'class="active"';}
                             echo '>Cart Noodles</a></li>';
                ?>

                <li><a href="history.php" <?php if (basename($_SERVER['PHP_SELF'])=='history.php'){echo 'class="active"';}?>>History</a></li>

                <?php
                    if ($_SESSION["admin"]){
                             echo '<li><a href="setting.php"';
                             if (basename($_SERVER['PHP_SELF'])=='setting.php'){echo 'class="active"';}
                             echo '>Setting</a></li>';}
                ?>

                <li><a href="help.php" <?php if (basename($_SERVER['PHP_SELF'])=='help.php'){echo 'class="active"';}?>>Help</a></li>

                <?php
                    if ($_SESSION["admin"]){
                             echo '<li><a href="develop.php"'; //"adminordering.php"';
                             if (basename($_SERVER['PHP_SELF'])=='adminordering.php' || basename($_SERVER['PHP_SELF'])=='develop.php'){echo 'class="active"';}
                             echo '>Status</a></li>';}
                ?>

                <?php
                    if ($_SESSION["admin"]){
                             echo '<li><a href="lunchtime.php"';
                             if (basename($_SERVER['PHP_SELF'])=='lunchtime.php'){echo 'class="active"';}
                             echo '>Lunchtime </a></li>';}
                ?>

            </ul>
            <ul>
                <li><a href="about.php">About</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
</header>
