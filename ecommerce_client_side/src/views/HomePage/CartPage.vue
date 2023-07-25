<template>
    <div class="btn-group btn-group-sm">
      <button
        type="button"
        class="btn btn-sm bg-dark text-light"
        @click="minus()"
      >
        -
      </button>
      <span class="px-3 border-top border-bottom">{{ count }}</span>
      <button
        type="button"
        class="btn btn-sm bg-dark text-light"
        @click="plus()"
      >
        +
      </button>
  </div>
</template>

<script src="./../js/CartPage.js"></script>