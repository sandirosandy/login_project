document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById('loginForm');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('password').value.trim();

        // Jika kosong atau spasi saja
        if (!username || !password) {
            alert('Silakan isi Username dan Password terlebih dahulu!');
            return;
        }

        const usernamePattern = /^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]+$/;
        if (!usernamePattern.test(username)) {
            alert('Username harus kombinasi huruf dan angka (contoh: user123).');
            return;
        }

        alert('Login berhasil! Selamat datang, ' + username + '.');
    });
});
