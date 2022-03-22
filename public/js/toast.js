window.onload = (event) => {
    let myAlert = document.querySelectorAll('.toast')[0];
    if (myAlert) {
        let bsAlert = new bootstrap.Toast(myAlert, {
                    animation: true,
                    autohide: true,
                    delay: 10000,
                });
        bsAlert.show();
    }
};