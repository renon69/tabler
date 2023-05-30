<!doctype html>
<html lang="en">

<head>
  <?php
  include_once('../components/head.php');
  include_once('../components/title.php');
  ?>
</head>

<body class=" d-flex flex-column">
  <div class="page page-center">
    <div class="container container-tight">
      <div class="text-center mb-3">
        <a href="." class="navbar-brand navbar-brand-autodark"><img src="../../../static/athex.png" height="33" alt="athexlogo"></a>
      </div>
      <!-- Application Verification Dialog -->
      <div class="modal modal-blur fade" id="modal-info" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
          <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-info"></div>
            <div class="modal-body text-center py-4">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-info icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                <path d="M12 9h.01"></path>
                <path d="M11 12h1v4h1"></path>
              </svg>
              <h3>Landlord Verification</h3>
              <div class="text-muted">Thank you for submitting your application. Our team will now proceed with the verification process. Kindly await further updates via email or text message. We appreciate your patience and look forward to providing you with an update soon.</div>
            </div>
          </div>
        </div>
      </div>
      <form class="card card-md" id="registrationForm" enctype="multipart/form-data" autocomplete="off">
        <div class="card-body">
          <div class="card-body text-center">
            <h2 class="card-title mb-2">Account Registration</h2>
          </div>
          <section id="sec_name">
            <div class="mb-3">
              <label class="form-label">First Name</label>
              <div class="input-group input-group-flat">
                <input type="text" class="form-control ps-1" name="oFname" id="fname" placeholder="First Name" autocomplete="off" required>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Middle Name</label>
              <div class="input-group input-group-flat">
                <input type="text" class="form-control ps-1" name="oMname" id="mname" placeholder="Middle Name" autocomplete="off">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Last Name</label>
              <div class="input-group input-group-flat">
                <input type="text" class="form-control ps-1" name="oLname" id="lname" placeholder="Last Name" autocomplete="off" required>
              </div>
            </div>
            <div>
              <label class="form-label">Suffix</label>
              <select class="form-select" name="oSuffix" id="suf">
                <option value="" disabled selected>Your Suffix</option>
                <option value="Sr">Sr</option>
                <option value="Jr">Jr</option>
                <option value="III">III</option>
                <option value="IV">IV</option>
                <option value="V">V</option>
                <option value="VI">VI</option>
              </select>
            </div>
          </section>
          <section id="sec_contact">
            <div class="mb-3">
              <label class="form-label">Mobile Number</label>
              <div class="input-group input-group-flat">
                <input type="number" class="form-control ps-1" name="oMobile" id="mobile" placeholder="09xxxxxxxxx" maxlength="11" autocomplete="off">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Email Address</label>
              <div class="input-group input-group-flat">
                <input type="email" class="form-control ps-1" name="oEmail" id="email" placeholder="your@email.com" autocomplete="off">
              </div>
            </div>
          </section>
          <section id="sec_account">
            <div class="mb-3">
              <label class="form-label">Username</label>
              <div class="input-group input-group-flat">
                <input type="text" class="form-control ps-1" name="ownerUser" id="uname" placeholder="Your username" autocomplete="off" required>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <div class="input-group input-group-flat">
                <input type="password" class="form-control ps-1" name="ownerPass" id="pass" placeholder="Your password" autocomplete="off" required>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Confirm Password</label>
              <div class="input-group input-group-flat">
                <input type="password" class="form-control ps-1" id="conpass" placeholder="Confirm password" autocomplete="off" required>
              </div>
            </div>
            <label class="form-check">
              <input type="checkbox" class="form-check-input" id="showPassword" />
              <span class="form-check-label">Show password</span>
            </label>
          </section>
          <section id="sec_files">
            <div class="mb-3">
              <label class="form-label">Identification Type</label>
              <select class="form-select" name="idType" id="idtype" required>
                <option value="" disabled selected>Please select</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Identification No.</label>
              <div class="input-group input-group-flat">
                <input type="number" class="form-control ps-1" name="idNo" id="idnum" placeholder="Ex. 000000000" autocomplete="off" required>
              </div>
            </div>
            <div class="mb-3">
              <div class="form-label">Identification Photo</div>
              <div class="input-group">
                <input type="file" class="form-control" name="idPathe" id="idphoto" accept="image/jpeg, image/jpg, image/png" required />
                <button class="input-group-text btn" id="previewBtn" disabled>Preview</button>
              </div>
            </div>
          </section>
        </div>
        <!-- Image Preview Modal -->
        <div class="modal modal-blur fade" id="modal-small" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">ID Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" id="id-preview">
              </div>
            </div>
          </div>
        </div>
        <!-- Confirmation Modal -->
        <div class="modal modal-blur fade" id="modal-large" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Summary</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col">
                    <h5>FULL NAME</h5>
                    <div class="datagrid-title">Last</div>
                    <p class="fs-5 text-capitalize" id="sum_lname"></p>
                    <div class="datagrid-title">First</div>
                    <p class="fs-5 text-capitalize" id="sum_fname"></p>
                    <div class="datagrid-title">Middle</div>
                    <p class="fs-5 text-capitalize" id="sum_mname"></p>
                    <div class="datagrid-title">Suffix</div>
                    <p class="fs-5 text-capitalize" id="sum_suf"></p>
                  </div>
                  <div class="col">
                    <h5>CONTACT DETAILS</h5>
                    <div class="datagrid-title">Mobile No.</div>
                    <p class="fs-5 text-capitalize" id="sum_mobile"></p>
                    <div class="datagrid-title">Email</div>
                    <p class="fs-5 text-capitalize" id="sum_email"></p>
                  </div>
                  <div class="col">
                    <h5>IDENTIFICATION</h5>
                    <div class="datagrid-title">Id Photo</div>
                    <p class="fs-5" id="sum_id-photo"></p>
                    <div class="datagrid-title">Type</div>
                    <p class="fs-5 text-uppercase" id="sum_id-type"></p>
                    <div class="datagrid-title">ID No.</div>
                    <p class="fs-5 text-capitalize" id="sum_id-no"></p>
                  </div>
                </div>
                <label class="form-check">
                  <input class="form-check-input" type="checkbox" id="check-privacy">
                  <span class="form-check-label">By submitting the registration form, you acknowledge that you have read, understood, and agree to the
                    <a href="../pages/privacy.php" target="_blank">terms and conditions</a> of this privacy policy.</span>
                </label>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Review</button>
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
              </div>
            </div>
          </div>
        </div>
      </form>
      <div class="row align-items-center mt-3">
        <div class="col-4">
          <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
              <span class="visually-hidden">0% Complete</span>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="btn-list justify-content-end">
            <a href="#" class="btn btn-link link-secondary previous-section">
              Previous
            </a>
            <a href="#" class="btn btn-teal next-section">
              Continue
            </a>
            <a href="#" class="btn btn-teal final-section">
              Confirm
            </a>
          </div>
        </div>
        <div class="text-center text-muted mt-3">
          Already have account? <a href="./sign-in.php" tabindex="-1">Sign in</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Required -->
  <?php
  include_once('../components/formalerts.php');
  include_once('../components/alerts.php');
  include_once('../components/scripts.php');
  ?>
  <script src="../ajax/imagepreview.js"></script>
  <script src="../ajax/idselector.js"></script>
  <script src="../ajax/wizard.js"></script>
  <script src="../ajax/signup.js"></script>
</body>

</html>