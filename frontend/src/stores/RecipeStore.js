import { defineStore } from "pinia";

const baseUrl = import.meta.env.VITE_API_URL

export const useRecipeStore = defineStore('recipes', {
    state: () => {
        return {
            recipes: []
        }
    },
    actions: {
        async fetchRecipes() {
            try {
                const response = await fetch(`${baseUrl}/recipes`);

                if (!response.ok) {
                    throw new Error('Failed to fetch recipes.');
                }

                const data = await response.json();
                this.recipes = data;
            } catch (error) {
                console.error(error)
            }
        }
    },
    onCreated() {
        this.fetchRecipes();
    }
});