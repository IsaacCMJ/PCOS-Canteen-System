22/5/2023
- Change file 'cart_noodle.php' to 'cart_noodle_original.php'.
- Change file 'cn_unvailable.php' to 'cart_noodle.php'

15/7/2023
- Added field $_SESSION["admin"] to check if user is an admin or not. 
  Show 1 when true and 0 when false
- Block login from non-admin user by redirecting them to logout.php when land on index.php.
- Change nav.php / index.php to use the new algo to check if the user is an admin or not.

28/8/2023
-Added scroll function in history.php to prevent a long page.

1/9/2023
-Allow non-developer user to login the system by deleting the "if $_SESSION["admin"]" command.

9/9/2024
-Set Status page redirect to develop.php instead of adminordering.php by changing nav.php.

15/10/2024
-Set order button hidden on click at cart noodle page.

24/3/2025
-Edited style.css to remove underline on hover at history page.
