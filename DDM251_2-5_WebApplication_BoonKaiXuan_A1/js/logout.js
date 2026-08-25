        function confirmLogout() {
            if (confirm("Are you sure you want to sign out?")) {
                window.location.href = "logout.php";
            }
        }