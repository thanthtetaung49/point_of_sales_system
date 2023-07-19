<template>
  <div class="">
    <div class="row p-0 m-0">
      <div class="col-12 login-section">
        <div class="card shadow-sm w-50 p-3">
          <div class="row">
            <div class="col-6">
              <div>
                <h4 class="text-light">Login</h4>
                <span class="text-light me-2"
                  >Does not have an account yet?</span
                >
                <a href="#" class="pink-color" @click="directRegisterPage()">Sign up</a>
              </div>

              <form action="">
                <div class="form-group my-3">
                  <label for="userEmail" class="text-light fw-bold"
                    >Email Address</label
                  >
                  <input
                    type="email"
                    id="userEmail"
                    class="form-control"
                    placeholder="you@example.com"
                    autocomplete="off"
                    v-model="userEmail"
                  />
                  <span class="pink-color" v-if="emailStatus">You need to fill your email address.</span>
                </div>
                <div class="form-group my-3">
                  <label for="userPassword" class="text-light fw-bold"
                    >Password</label
                  >
                  <input
                    type="password"
                    id="userPassword"
                    class="form-control"
                    placeholder="Enter 6 character or more"
                    autocomplete="off"
                    v-model="userPassword"
                  />
                  <span class="pink-color" v-if="passwordStatus">You need to fill your password.</span>
                </div>
                <div class="form-check my-3">
                  <input
                    type="checkbox"
                    id="rememberMe"
                    class="form-check-input"
                    @click="showPassword()"
                  />
                  <label for="rememberMe" class="text-light">Remember me</label>
                </div>
                <div class="d-grid">
                  <button
                    type="button"
                    class="login-btn text-uppercase text-light rounded bg-pink"
                    @click="login()"
                  >
                    login
                  </button>
                </div>
              </form>
            </div>
            <div class="col-6 logo-container">
              <div class="">
                <img
                  class="w-75 shopping-logo"
                  src="./image/shopping_logo.svg"
                  alt="shopping-logo"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script src="./js/LoginPage.js"></script>

<style>
:root {
  --color-pink: #fc9a86;
}

.pink-color {
  color: var(--color-pink);
}

.login-section {
  background-image: url("./image/shape.svg");
  background-repeat: no-repeat;
  background-size: cover;
  height: 100vh;
  display: grid;
  place-items: center;
}

.card {
  /* From https://css.glass */
  background: rgba(255, 255, 255, 0.2);
  border-radius: 16px;
  box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
  backdrop-filter: blur(5px);
  -webkit-backdrop-filter: blur(5px);
  border: 1px solid rgba(255, 255, 255, 0.3);
}

.form-control {
  color: #fff !important;
  background: transparent;
  border: none;
  border-bottom: 1px solid #fff;
  border-radius: 0% !important;
}

.form-control:focus {
  background: transparent;
  box-shadow: none;
  border: none;
  border-bottom: 1px solid var(--color-pink);
}

.form-control::placeholder {
  color: #fff;
}

.login-btn {
  background-color: var(--color-pink);
  padding: 10px 0;
  border: none;
}

.logo-container {
  position: relative;
}

.shopping-logo {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
</style>