import { mapGetters } from 'vuex';
import axios from "axios";
import Cart from './../HomePage/CartPage.vue'

export default {
    name: "HomePage",
    data()
    {
        return {
            items: [],
            currentPage: 1,
            itemsPerPage: 4,
            searchKey: '',
            category: [],
            categoryFilterValue: [],
            orderData: [],
            total: 0,
            invoice: [],
            day: '',
            month: '',
            year: '',
            loadingStatus: false
        }
    },
    components: {
        Cart
    },
    computed: {
        ...mapGetters(['getToken', 'getQuantity', 'getid', 'getStatus', 'getItemePrice']),
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
                    this.items = response.data.productData;

                    for (let i = 0; i < this.items.length; i++) {
                        const product = this.items[i];
                        product.item_image = `http://localhost:8000/storage/productImage/${product.item_image}`;
                    }

                    this.loadingStatus = false;
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
        productPage(id, quantity, totalPrice) {
            this.$router.push({
                name: "productDetail"
            });
        },
        cart(itemPrice, itemName, itemId)
        {
            this.$store.dispatch('storeId', itemId);
            this.$store.dispatch('storeItemPrice', itemPrice);

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
                itemPrice: this.getItemePrice
            }

            this.$store.dispatch('storeQuantity', 1);
            this.orderData.push(order);
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
                    itemPrice : data.itemPrice,
                    total: this.total,
                    day: this.day,
                    month: this.month,
                    year: this.year,
                    orderCode: orderCode
                }

                console.log(orderData);

                axios.post('http://localhost:8000/api/order', orderData)
                    .then((response) =>
                    {
                        location.reload();
                    })
                    .catch(error => console.log(error));
            });

            this.invoice = [];
            this.total = 0;
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
    },

    mounted()
    {
        this.products();
        this.categoryName();
        this.calendar();
        this.loadingStatus = true;
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
}

// jquery