import { defineStore } from "pinia";

const baseUrl = import.meta.env.VITE_API_URL

export const usePurchaseStore = defineStore('purchases', {
    state: () => {
        return {
            purchases: [],
            pagination: {
                nextPage: null,
            }
        }
    },
    actions: {
        async fetchPurchases() {
            try {
                const response = await fetch(`${baseUrl}/purchases`);

                if (!response.ok) {
                    throw new Error('Failed to retreive purchases.');
                }

                const data = await response.json();
                this.purchases = data.data;
                this.pagination.nextPage = data.links.next
            } catch (error) {
                console.error(error);
            }
        },
        async loadMore() {
            try {
                const response = await fetch(this.pagination.nextPage);

                if (!response.ok) {
                    throw new Error('Failed to load more purchases.');
                }

                const data = await response.json();
                this.purchases = [...this.purchases, ...data.data];
                this.pagination.nextPage = data.links.next
            } catch (error) {
                console.error(error);
            }
        }
    }
});