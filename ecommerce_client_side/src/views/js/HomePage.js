import { mapGetters } from 'vuex';
import { ref } from 'vue';
import axios from "axios";
import Cart from './../HomePage/CartPage.vue'

const currentPage = ref(1);

export default {
    name: "HomePage",
    data()
    {
        return {
            items: [],
            currentPage: 1,
            itemsPerPage: 8,
            searchKey: '',
            category: [],
            categoryFilterValue: [],
            invoice: [],
            total: 0,
            day: '',
            month: '',
            year: '',
            orderData: [],
            loadingStatus: false,
            paginationStatus: false
        }
    },
    components: {
        Cart
    },
    computed: {
        ...mapGetters(['getToken', 'getQuantity', 'getid', 'getStatus']),
        totalPages()
        {
            return Math.ceil(this.items.length / this.itemsPerPage);
        },
        paginatedItems()
        {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            const end = start + this.itemsPerPage;
            return this.items.slice(start, end);
        }
    },
    methods: {
        previousPage()
        {
            if (this.currentPage > 1) {
                this.currentPage--;
            }
        },
        nextPage()
        {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
            }
        },
        goToPage(pageNumber)
        {
            this.currentPage = pageNumber;
        },
        logout()
        {
            this.$store.dispatch('loginToken', null);
            this.$router.push({
                name: "loginPage"
            });
        },
        products()
        {
            axios.get('http://localhost:8000/api/product')
                .then((response) =>
                {
                    // console.log(response.data.productData);
                    this.items = response.data.productData;

                    for (let i = 0; i < this.items.length; i++) {
                        const product = this.items[i];
                        product.item_image = `http://localhost:8000/storage/productImage/${product.item_image}`;
                    }
                })
                .catch(error => console.log(error));
        },
        search()
        {
            axios.post('http://localhost:8000/api/search', {
                key: this.searchKey
            })
                .then((response) =>
                {
                    this.items = response.data.productData;

                    for (let i = 0; i < this.items.length; i++) {
                        const product = this.items[i];
                        product.item_image = `http://localhost:8000/storage/productImage/${product.item_image}`;
                    }
                })
                .catch((error) => console.log(error));
        },
        categoryName()
        {
            axios.get('http://localhost:8000/api/category')
                .then((response) =>
                {
                    this.category = response.data.categoryData;
                })
                .catch(error => console.log(error));
        },
        filter(id)
        {
            axios.post('http://localhost:8000/api/categoryFilter', {
                categoryId: id
            })
                .then((response) =>
                {
                    this.items = response.data.productData;

                    for (let i = 0; i < this.items.length; i++) {
                        const product = this.items[i];
                        product.item_image = `http://localhost:8000/storage/productImage/${product.item_image}`;
                    }
                })
                .catch(error => error);
        },
        cart(itemPrice, itemName, itemId)
        {
            this.$store.dispatch('storeId', itemId);
            let invoiceData = {
                name: itemName,
                price: itemPrice,
                quantity: this.getQuantity
            }

            this.invoice.push(invoiceData);

            let total = 0;
            this.invoice.forEach(value =>
            {
                total += value.price * value.quantity;
                this.total = total;
            });

            let order = {
                id: this.getid,
                quantity: this.getQuantity,
            }
            this.orderData.push(order);
            // this.$store.dispatch('storeStatus', true);
            this.$store.dispatch('storeQuantity', 0);

        },
        calendar()
        {
            let today = new Date();
            let day = today.getDate();
            let index = today.getMonth();

            let months = ['January', 'February', 'March', 'April', 'May', 'June', "July", 'Auguest', 'September', 'October', 'November', 'December'];

            let year = today.getFullYear();

            this.day = day;
            this.month = months[index];
            this.year = year;
        },
        clear()
        {
            this.invoice = [];
            this.total = 0;
        },
        order()
        {
            let orderCode = 'O/CODE-' + Math.floor(Math.random() * 10000);
            this.orderData.forEach(data =>
            {
                let orderData = {
                    id: data.id,
                    quantity: data.quantity,
                    total: this.total,
                    day: this.day,
                    month: this.month,
                    year: this.year,
                    orderCode: orderCode
                }

                axios.post('http://localhost:8000/api/order', orderData)
                    .then((response) =>
                    {
                        console.log(response);
                    })
                    .catch(error => console.log(error));
            });

            this.invoice = [];
            this.total = 0;
        }
    },

    mounted()
    {
        this.products();
        this.categoryName();
        this.calendar();
        axios.get('http://localhost:8000/api/product')
            .then((response) =>
            {
                console.log(response.data.productData);
                this.items = response.data.productData;

                for (let i = 0; i < this.items.length; i++) {
                    const product = this.items[i];
                    product.item_image = `http://localhost:8000/storage/productImage/${product.item_image}`;
                }
                this.loadingStatus = false;
                this.paginationStatus = true;
            })
            .catch(error => console.log(error));

        this.loadingStatus = true;
    },
}

// jquery