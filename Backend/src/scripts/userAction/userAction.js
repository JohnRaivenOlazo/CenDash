const logOutVendor = () => {
    const http = new XMLHttpRequest();
    http.onreadystatechange = () => {
        if (http.readyState === 4 && http.status === 200) {
            location.reload();
        }
    };
    http.open("GET", "../src/scripts/userAction/logOutVendor.php", true);
    http.send();
};

const logOutAdmin = () => {
    const http = new XMLHttpRequest();
    http.onreadystatechange = () => {
        if (http.readyState === 4 && http.status === 200) {
            location.reload();
        }
    };
    http.open("GET", "../src/scripts/userAction/logOutAdmin.php", true);
    http.send();
};

const logOutUser = () => {
    const http = new XMLHttpRequest();
    http.onreadystatechange = () => {
        if (http.readyState === 4 && http.status === 200) {
            location.reload();
        }
    };
    http.open("GET", "../src/scripts/userAction/logOutUser.php", true);
    http.send();
};