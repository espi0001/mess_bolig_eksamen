function load_markers(items) {
  markers.clearLayers();

  items.forEach((item) => {
    const marker = L.marker([item.lat, item.lon], {
      icon: L.divIcon({
        className: "",
        html: `<button type="button" class="marker" mix-get="/apis/api-get-item.php?key=${item.pk}"></button>`,
      }),
      pk: item.pk,
    });
    markers.addLayer(marker);
  });

  mix_convert();
}

// Signup
const usernameInput = document.getElementById("user_username");
if (usernameInput) {
  usernameInput.addEventListener("input", function () {
    if (this.value.trim().length >= 2) {
      document.getElementById("username-error").textContent = "";
    }
  });
}

const emailInput = document.getElementById("user_email");
if (emailInput) {
  emailInput.addEventListener("input", function () {
    if (this.value.trim().length >= 6) {
      document.getElementById("email-error").textContent = "";
    }
  });
}

const passwordInput = document.getElementById("user_password");
if (passwordInput) {
  passwordInput.addEventListener("input", function () {
    if (this.value.trim().length >= 6 && this.value.trim().length <= 50) {
      document.getElementById("password-error").textContent = "";
    }
  });
}
