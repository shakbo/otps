--- START OF FILE test.txt ---

<p class="text-center">
  <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
</p>

<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="Login" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Login">Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- The form is placed inside the body of modal -->
        <form id="loginForm" method="post" class="needs-validation" novalidate>
          <div class="mb-3 row">
            <label for="username" class="col-sm-3 col-form-label">Username</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="username" name="username" required>
              <div class="invalid-feedback">
                Please enter your username.
              </div>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="password" class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-9">
              <input type="password" class="form-control" id="password" name="password" required>
              <div class="invalid-feedback">
                Please enter your password.
              </div>
            </div>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary">Login</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  (() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
  })()
</script>
--- END OF FILE test.txt ---