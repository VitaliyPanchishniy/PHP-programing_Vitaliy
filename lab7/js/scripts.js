$(document).ready(function () {
    // Реєстрація
    $("#register-form").submit(function (e) {
        e.preventDefault();
        const username = $("#username").val();
        const email = $("#email").val();
        const password = $("#password").val();
        const confirmPassword = $("#confirm-password").val();

        if (password !== confirmPassword) {
            $("#register-message").text("Паролі не співпадають!");
            return;
        }

        $.ajax({
            url: "php/register.php",
            type: "POST",
            data: { username, email, password },
            success: function (response) {
                $("#register-message").text(response);
                if (response === "success") {
                    window.location.href = "login.html";
                }
            },
        });
    });

    // Вхід
    $("#login-form").submit(function (e) {
        e.preventDefault();
        const email = $("#login-email").val();
        const password = $("#login-password").val();

        $.ajax({
            url: "php/login.php",
            type: "POST",
            data: { email, password },
            success: function (response) {
                if (response === "success") {
                    window.location.href = "profile.html";
                } else {
                    $("#login-message").text("Невірні дані для входу.");
                }
            },
        });
    });
});

$(document).ready(function () {
  // Завантаження даних профілю
  $.ajax({
    url: "php/get_profile.php",
    method: "GET",
    success: function (response) {
      const data = JSON.parse(response);
      $("#username-display").text(data.username);
      $("#update-username").val(data.username);
    },
    error: function () {
      alert("Не вдалося завантажити дані профілю.");
    },
  });

  // Оновлення профілю
  $("#update-profile-form").submit(function (e) {
    e.preventDefault();
    const newUsername = $("#update-username").val();
    const newPassword = $("#update-password").val();
    const confirmPassword = $("#confirm-update-password").val();

    if (newPassword && newPassword !== confirmPassword) {
      $("#update-message").text("Паролі не співпадають!");
      return;
    }

    $.ajax({
      url: "php/update_profile.php",
      method: "POST",
      data: { username: newUsername, password: newPassword },
      success: function (response) {
        if (response === "success") {
          $("#update-message").text("Профіль успішно оновлено.");
          $("#username-display").text(newUsername);
        } else {
          $("#update-message").text(response);
        }
      },
      error: function () {
        $("#update-message").text("Помилка оновлення профілю.");
      },
    });
  });
});
