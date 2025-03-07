import { defineStore } from "pinia";

const baseUrl = import.meta.env.VITE_API_URL;

export const useOrderStore = defineStore('orders', {
    state: () => {
        return {
            orders: [],
            pagination: {
                nextPage: null
            }
        }
    },
    actions: {
        async placeOrder() {
            try {
                const response = await fetch(`${baseUrl}/orders`, { method: "POST" });

                if (!response.ok) {
                    throw new Error('Failed to place order.');
                }

                const data = await response.json();
                this.orders = [data, ...this.orders];
            } catch (error) {
                console.error(error);
            }
        },
        async updateOrder(updatedOrder) {
            const order = this.orders.find((order) => order.id === updatedOrder.id);

            if (order) {
                order.status = updatedOrder.status;
                const orders = this.orders.filter((order) => order.id !== updatedOrder.id);
                this.orders = [order, ...orders];
            }
        },
        async fetchOrders(status) {
            try {
                const response = !status
                    ? await fetch(`${baseUrl}/orders`)
                    : await fetch(`${baseUrl}/orders?status=${status}`);

                if (!response.ok) {
                    throw new Error('Failed to retrieve orders.');
                }

                const data = await response.json();
                this.orders = data.data;
                this.pagination.nextPage = data.links.next;
            } catch (error) {
                console.error(error);
            }
        },
        async loadMore() {
            try {
                const response = await fetch(this.pagination.nextPage);

                if (!response.ok) {
                    throw new Error('Failed to load more orders.');
                }

                const data = await response.json();
                this.orders = [...this.orders, ...data.data];
                this.pagination.nextPage = data.links.next;
            } catch (error) {
                console.error(error);
            }
        }
    },
    create() {
        console.log('works');
    }
});