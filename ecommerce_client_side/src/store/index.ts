import { createStore } from 'vuex'

export default createStore({
  state: {
    token: '',
    count: 1,
    itemId: 0,
    countStatus: false,
    itemPrice: 0,
  },
  getters: {
    getToken: (state) => state.token,
    getQuantity: (state) => state.count,
    getid: (state) => state.itemId,
    getStatus: (state) => state.countStatus,
    getCount: (state) => state.count,
    getItemePrice: (state) => state.itemPrice
  },
  mutations: {
  },
  actions: {
    loginToken: ({ state }, value) => state.token = value,
    storeQuantity: ({ state }, value) => state.count = value,
    storeId: ({state}, value) => state.itemId = value,
    storeStatus: ({state}, value) => state.countStatus = value,
    storeItemPrice: ({state}, value) => state.itemPrice = value
  },
  modules: {
  }
})
