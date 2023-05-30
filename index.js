$(document).ready(function () {
  var sections = ["sec_name", "sec_contact", "sec_account", "sec_files"];
  var currentSectionIndex = 0;

  showSection(currentSectionIndex);

  $(".next-section").click(function (e) {
    e.preventDefault();
    if (validateSection(currentSectionIndex)) {
      currentSectionIndex++;
      if (currentSectionIndex >= sections.length) {
      } else {
        showSection(currentSectionIndex);
      }
    }
  });

  $(".final-section").click(function (e) {
    e.preventDefault();
    if (validateForm()) {
      // Get the input value
      var firstname = $("#fname").val() || "N/A";
      var middlename = $("#mname").val() || "N/A";
      var lastname = $("#lname").val() || "N/A";
      var suffix = $("#suf").val() || "N/A";
      var mobile = $("#mobile").val() || "N/A";
      var email = $("#email").val() || "N/A";
      var idtype = $("#idtype").val() || "N/A";
      var idnum = $("#idnum").val() || "N/A";
      var idphoto = $("#idphoto")[0].files[0] || "N/A";

      // Set the input value as the text in the summary paragraph of the modal
      $("#sum_fname").text(firstname);
      $("#sum_mname").text(middlename);
      $("#sum_lname").text(lastname);
      $("#sum_suf").text(suffix);
      $("#sum_mobile").text(mobile);
      $("#sum_email").text(email);
      $("#sum_id-type").text(idtype);
      $("#sum_id-no").text(idnum);
      $("#sum_id-photo").text(idphoto.name);

      // Show the modal
      $("#modal-large").modal("show");
    }
  });

  $(".previous-section").click(function (e) {
    e.preventDefault();
    if (currentSectionIndex > 0) {
      currentSectionIndex--;
      showSection(currentSectionIndex);
    }
  });

  // Show/hide password fields based on the checkbox state
  $("#showPassword").change(function () {
    var passwordField = $("#pass");
    var confirmPasswordField = $("#conpass");
    if ($(this).is(":checked")) {
      passwordField.attr("type", "text");
      confirmPasswordField.attr("type", "text");
    } else {
      passwordField.attr("type", "password");
      confirmPasswordField.attr("type", "password");
    }
  });

  function showSection(index) {
    // Hide all sections
    $("section").hide();

    // Show the current section
    $("#" + sections[index]).show();

    // Show/hide navigation buttons based on the current section
    if (index === 0) {
      $(".previous-section").hide();
    } else {
      $(".previous-section").show();
    }

    if (index === sections.length - 1) {
      $(".final-section").show();
      $(".next-section").hide();
    } else {
      $(".next-section").show();
      $(".final-section").hide();
    }

    // Calculate and update the progress bar
    var progress = ((index + 1) / sections.length) * 100;
    $(".progress-bar")
      .css("width", progress + "%")
      .attr("aria-valuenow", progress);
    $(".progress-bar span").text(progress + "% Complete");
  }

  function validateSection(index) {
    var isValid = true;
    var currentSection = $("#" + sections[index]);

    currentSection.find("input[required]").each(function () {
      var fieldValue = $(this).val().trim();
      var fieldLabel = $(this).siblings("label").text();
      if (fieldValue === "") {
        $(this).addClass("is-invalid");
        showError(fieldLabel + "Field/s required, try again.");
        isValid = false;
      } else {
        $(this).removeClass("is-invalid").addClass("is-valid");

        if (index === 0) {
          var fieldName = $(this).attr("id");
          if (fieldName === "fname" || fieldName === "lname") {
            if (!isValidName(fieldValue)) {
              $(this).removeClass("is-valid").addClass("is-invalid");
              showError("Invalid Fields, try again. " + fieldLabel);
              isValid = false;
            }
          }
        }
      }
    });

    if (index === 1) {
      var mobileField = $("#mobile");
      var emailField = $("#email");
      var mobileValue = mobileField.val().trim();
      var emailValue = emailField.val().trim();

      if (mobileValue === "" && emailValue === "") {
        mobileField.addClass("is-invalid");
        emailField.addClass("is-invalid");
        showError("Should input any of the contact details");
        isValid = false;
      } else {
        mobileField.removeClass("is-invalid").addClass("is-valid");
        emailField.removeClass("is-invalid").addClass("is-valid");

        if (mobileValue !== "" && !isValidMobile(mobileValue)) {
          mobileField.addClass("is-invalid");
          showError("Invalid Mobile Number");
          isValid = false;
        }

        if (emailValue !== "" && !isValidEmail(emailValue)) {
          emailField.addClass("is-invalid");
          showError("Invalid Email Address");
          isValid = false;
        }
      }
    }

    if (index === 2) {
      var usernameField = $("#uname");
      var passwordField = $("#pass");
      var confirmPasswordField = $("#conpass");
      var usernameValue = usernameField.val().trim();
      var passwordValue = passwordField.val().trim();
      var confirmPasswordValue = confirmPasswordField.val().trim();

      if (passwordValue === "" || confirmPasswordValue === "") {
        passwordField.addClass("is-invalid");
        confirmPasswordField.addClass("is-invalid");
        showError("Field/s required, try again.");
        isValid = false;
      } else {
        passwordField.removeClass("is-invalid").addClass("is-valid");
        confirmPasswordField.removeClass("is-invalid").addClass("is-valid");

        if (passwordValue !== confirmPasswordValue) {
          passwordField.removeClass("is-valid").addClass("is-invalid");
          confirmPasswordField.removeClass("is-valid").addClass("is-invalid");
          showError("Passwords do not match");
          isValid = false;
        }
      }

      if (usernameValue === "") {
        usernameField.addClass("is-invalid");
        showError("Field/s required, try again.");
        isValid = false;
      } else {
        usernameField.removeClass("is-invalid").addClass("is-valid");
      }
    }

    if (index === 3) {
      var idTypeField = $("#idtype");
      var idNumberField = $("#idnum");
      var idPhotoField = $("#idphoto");
      var idPhoto = idPhotoField[0].files[0];

      // Rename the file to "id_photo"
      if (idPhoto) {
        idPhoto = new File(
          [idPhoto],
          "id_photo." + idPhoto.name.split(".").pop(),
          {
            type: idPhoto.type,
          }
        );
      }
      if (idTypeField.val().trim() === "") {
        idTypeField.addClass("is-invalid");
        showError("Identification Type field is required, try again.");
        isValid = false;
      } else {
        idTypeField.removeClass("is-invalid").addClass("is-valid");
      }

      if (idNumberField.val().trim() === "") {
        idNumberField.addClass("is-invalid");
        showError("Identification No. field is required, try again.");
        isValid = false;
      } else {
        idNumberField.removeClass("is-invalid").addClass("is-valid");
      }

      if (!idPhoto) {
        idPhotoField.addClass("is-invalid");
        showError("Identification Photo field is required, try again.");
        isValid = false;
      } else {
        var fileSize = idPhoto.size / 1024 / 1024; // Size in MB
        console.log(fileSize);
        var fileExtension = idPhoto.name.split(".").pop().toLowerCase();
        var allowedExtensions = ["jpeg", "jpg", "png"];

        if (fileSize >= 3) {
          // Update the condition to fileSize > 3
          idPhotoField.addClass("is-invalid");
          showError("Identification Photo should be less than 3MB, try again."); // Update the error message
          isValid = false;
        } else if (!allowedExtensions.includes(fileExtension)) {
          idPhotoField.addClass("is-invalid");
          showError(
            "Invalid file format. Only JPEG, JPG, and PNG formats are allowed."
          );
          isValid = false;
        } else {
          idPhotoField.removeClass("is-invalid").addClass("is-valid");
        }
      }
    }
    return isValid;
  }

  function validateForm() {
    var isValid = true;

    for (var i = 0; i < sections.length; i++) {
      if (!validateSection(i)) {
        isValid = false;
        break;
      }
    }

    return isValid;
  }

  function isValidMobile(mobile) {
    // Check if the mobile number is 11 digits and starts with 09
    return /^\d{11}$/.test(mobile) && mobile.startsWith("09");
  }

  function isValidEmail(email) {
    // Check if the email address is in the correct format
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  }

  function isValidName(name) {
    // Check if the name contains at least 2 letters/characters and does not contain numbers
    var letterCount = 0;
    for (var i = 0; i < name.length; i++) {
      if (isNaN(name[i])) {
        letterCount++;
      }
    }
    return letterCount >= 2;
  }

  function showError(errorMessage) {
    var alertElement = $("#alertdanger");
    alertElement.find(".text-muted").text(errorMessage);
    alertElement.show();

    // Display the danger alert
    $("#alertdanger").addClass("alert-danger").show();
    // Animate the alert danger
    $("#alertdanger").animate({ right: "20px", opacity: 1 }, 300, function () {
      // Fade out and hide the alert div after 3 seconds
      setTimeout(function () {
        $("#alertdanger").animate(
          { right: "-300px", opacity: 0 },
          500,
          function () {
            $(this).removeClass("alert-danger").hide();
          }
        );
      }, 3000);
    });
  }

  // Disable submit button by default
  $("button[type='submit']").prop("disabled", true);

  // Enable or disable submit button based on checkbox state
  $("#check-privacy").change(function () {
    if ($(this).is(":checked")) {
      $("button[type='submit']").prop("disabled", false);
    } else {
      $("button[type='submit']").prop("disabled", true);
    }
  });
});