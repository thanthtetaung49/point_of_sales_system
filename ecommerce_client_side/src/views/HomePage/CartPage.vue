<template>
    <div class="btn-group btn-group-sm">
      <button
        type="button"
        class="btn btn-sm bg-dark text-light"
        @click="minus()"
      >
        -
      </button>
      <span class="px-3">{{ count }}</span>
      <button
        type="button"
        class="btn btn-sm bg-dark text-light"
        @click="plus()"
      >
        +
      </button>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  name: "CartPage",
  data() {
    return {
      count: 1,
      statusOne: false,
      statusTwo: false,
    };
  },
  computed: {
    ...mapGetters(['getQuantity', 'getStatus'])
  },
  methods: {
    plus() {
      this.count++;
      this.$store.dispatch('storeQuantity', this.count);
    },
    minus() {
      this.count--;
      this.$store.dispatch('storeQuantity', this.count);

      if (this.count <= 1) {
        this.count = 1;
      }
    }
  },
  mounted () {
    this.count = this.getQuantity;
  },
};
</script>