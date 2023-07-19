<template>
  <div>
    <div class="loading-btn" v-if="loadingStatus">
      <div class="loader">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-3 border-end sidebar">
          <div class="mt-3"></div>
          <div>
            <div class="row mt-4">
              <h5 class="text-center">POS Invoice</h5>
              <div class="col-12">
                <small>Date - {{ day }} / {{ month }} / {{ year }}</small>
              </div>
              <div class="col-12">
                <table class="table table-borderless">
                  <thead class="border-bottom">
                    <tr>
                      <th>Items Name</th>
                      <th>Quantity</th>
                      <th>Amount</th>
                      <th>Total amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(item, index) in invoice" :key="index">
                      <td>
                        <small>{{ item.name }}</small>
                      </td>
                      <td>
                        <small>{{ item.quantity }}</small>
                      </td>
                      <td>
                        <small>{{ item.price }} Kyats</small>
                      </td>
                      <td>
                        <small>{{ item.quantity * item.price }} Kyats</small>
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="3" class="text-center">
                        <small>Total</small>
                      </td>
                      <td>{{ total }} Kyats</td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <div class="d-flex justify-content-end">
                <div>
                  <button
                    type="button"
                    class="btn btn-sm bg-danger text-light mx-1"
                    @click="clear()"
                  >
                    Clear
                  </button>
                  <button
                    type="button"
                    class="btn btn-sm bg-dark text-light mx-1"
                    @click="order()"
                  >
                    Order
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-9">
          <nav class="py-3 d-flex justify-content-between border-bottom">
            <div class="my-auto">
              <form action="" class="d-flex">
                <input
                  type="text"
                  name="search"
                  class="form-control"
                  placeholder="Find anything..."
                  v-model="searchKey"
                />
                <button
                  type="button"
                  class="btn bg-dark text-light ms-2"
                  @click="search()"
                >
                  Search
                </button>
              </form>
            </div>
            <div class="me-5">
              <button
                type="button"
                class="btn bg-danger text-light"
                @click="logout()"
              >
                Logout <i class="fa-solid fa-right-from-bracket ms-2"></i>
              </button>
            </div>
          </nav>
          <div class="row">
            <div class="row my-3">
              <div class="col-12 border-bottom pb-3">
                <h5>Category</h5>
                <a
                  href="#"
                  class="btn btn-sm bg-dark text-white text-decoration-none mx-3 mt-2 d-inline-block"
                  @click="filter('')"
                >
                  <i class="fa-solid fa-tag me-2"></i>
                  All</a
                >
                <a
                  href="#"
                  class="btn btn-sm bg-dark text-white text-decoration-none mx-3 mt-2 d-inline-block"
                  v-for="(item, index) in category"
                  :key="index"
                  @click="filter(item.id)"
                >
                  <i class="fa-solid fa-tag me-2"></i>
                  {{ item.name }}</a
                >
              </div>
            </div>
            <div
              class="col-3 mt-3"
              v-for="item in paginatedItems"
              :key="item.id"
            >
              <div class="bg-light shadow-sm p-2">
                <div class="text-center">
                  <img
                    class="rounded"
                    :src="item.item_image"
                    alt="sample"
                    style="width: 100%; height: 250px"
                  />
                </div>

                <div class="my-3">
                  <h6>{{ item.name }}</h6>
                  <span class="d-block my-2"
                    ><i class="fa-solid fa-tag me-2 text-primary"></i
                    >{{ item.category_name }}</span
                  >
                  <span class="d-block my-2"
                    ><i class="fa-solid fa-barcode me-2 text-success"></i>CODE -
                    {{ item.product_code }}</span
                  >
                  <span class="d-block my-2"
                    ><i
                      class="fa-solid fa-money-bill me-2 price text-warning"
                    ></i
                    >{{ item.item_price }} Kyats</span
                  >
                </div>

                <div class="d-flex justify-content-between">
                  <Cart></Cart>
                  <div class="ms-auto">
                    <button
                      type="button"
                      class="btn btn-sm btn-outline-dark me-2"
                      @click="cart(item.item_price, item.name, item.id)"
                    >
                      <i class="fa-solid btn-sm fa-cart-shopping"></i>
                      cart
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <nav class="mt-3" v-if="paginationStatus">
            <ul class="pagination justify-content-center">
              <li class="page-item" :class="{ disabled: currentPage === 1 }">
                <a class="page-link" href="#" @click="previousPage">Previous</a>
              </li>
              <li
                class="page-item"
                v-for="pageNumber in totalPages"
                :key="pageNumber"
                :class="{ active: pageNumber === currentPage }"
              >
                <a class="page-link" href="#" @click="goToPage(pageNumber)">{{
                  pageNumber
                }}</a>
              </li>
              <li
                class="page-item"
                :class="{ disabled: currentPage === totalPages }"
              >
                <a class="page-link" href="#" @click="nextPage">Next</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</template>

<script src="./../js/HomePage.js"></script>

<style>
.profile-photo {
  width: 75px;
}

.loading-btn {
  position: absolute;
  left: 50%;
  top: 50%;
}

.loader {
  --dim: 3rem;
  width: var(--dim);
  height: var(--dim);
  position: relative;
  animation: spin988 2s linear infinite;
}

.loader .circle {
  --color: #333;
  --dim: 1.2rem;
  width: var(--dim);
  height: var(--dim);
  background-color: var(--color);
  border-radius: 50%;
  position: absolute;
}

.loader .circle:nth-child(1) {
  top: 0;
  left: 0;
}

.loader .circle:nth-child(2) {
  top: 0;
  right: 0;
}

.loader .circle:nth-child(3) {
  bottom: 0;
  left: 0;
}

.loader .circle:nth-child(4) {
  bottom: 0;
  right: 0;
}

@keyframes spin988 {
  0% {
    transform: scale(1) rotate(0);
  }

  20%,
  25% {
    transform: scale(1.3) rotate(90deg);
  }

  45%,
  50% {
    transform: scale(1) rotate(180deg);
  }

  70%,
  75% {
    transform: scale(1.3) rotate(270deg);
  }

  95%,
  100% {
    transform: scale(1) rotate(360deg);
  }
}
</style>
