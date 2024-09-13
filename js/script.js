// Enable dropdown on hover
document.querySelectorAll(".nav-item.dropdown").forEach((item) => {
  item.addEventListener("mouseenter", () => {
    const dropdownMenu = item.querySelector(".dropdown-menu");
    if (dropdownMenu) {
      dropdownMenu.classList.add("show");
    }
  });

  item.addEventListener("mouseleave", () => {
    const dropdownMenu = item.querySelector(".dropdown-menu");
    if (dropdownMenu) {
      dropdownMenu.classList.remove("show");
    }
  });
});
// Volunteering Form(details)
document
  .getElementById("applyVolunteer")
  .addEventListener("click", function () {
    const specificEventRadio = document.getElementById("specificEvent");
    const organizingNGORadio = document.getElementById("organizingNGO");

    if (
      !specificEventRadio.disabled &&
      (specificEventRadio.checked || organizingNGORadio.checked)
    ) {
      $("#volunteerModal").modal("hide");
      $("#volunteerFormModal").modal("show");
    } else if (specificEventRadio.disabled && organizingNGORadio.checked) {
      $("#volunteerModal").modal("hide");
      $("#volunteerFormModal").modal("show");
    } else {
      alert("Please select an option to volunteer.");
    }
  });

const loginBtn = document.getElementById("login");
const signupBtn = document.getElementById("signup");

const toggleForm = (targetForm) => {
  const formContainer = targetForm.parentNode.parentNode;
  formContainer.classList.toggle("slide-up");
};

loginBtn.addEventListener("click", () => toggleForm(loginBtn));
signupBtn.addEventListener("click", () => toggleForm(signupBtn));
