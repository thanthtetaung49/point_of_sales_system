import { mapGetters } from "vuex";
export default {
    name: "CartPage",
    data()
    {
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
        plus()
        {
            this.count++;
            this.$store.dispatch('storeQuantity', this.count);
        },
        minus()
        {
            this.count--;
            this.$store.dispatch('storeQuantity', this.count);

            if (this.count <= 1) {
                this.count = 1;
            }
        }
    },
    // mounted()
    // {
    //     this.count = this.getQuantity;
    // },
};