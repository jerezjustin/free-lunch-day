import { defineStore } from "pinia";

const baseUrl = import.meta.env.VITE_API_URL

export const useIngredientStore = defineStore('ingredients', {
    state: () => {
        return {
            ingredients: []
        }
    },
    actions: {
        async fetchIngredients() {
            try {
                const response = await fetch(`${baseUrl}/ingredients`);

                if (!response.ok) {
                    throw new Error('Failed to fetch ingredients.');
                }

                const data = await response.json();
                this.ingredients = data;
            } catch (error) {
                console.error(error);
            }
        }
    }
});