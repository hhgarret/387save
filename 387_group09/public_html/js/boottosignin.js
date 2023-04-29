do {
    var answer = confirm("You can not access this page when not signed in. Please sign in.");
    if (answer) {
        window.location = "signin.php";
    }
} while (!answer);