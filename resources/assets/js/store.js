import Vuex from "vuex";

const store = new Vuex.Store({
	state: {
		budgetCategories: {},
		activeBudgetCategogryId: -1
	},
	mutations: {
		loadBudget(state, data) {
			state.budgetCategories = data;
		},
		activateCategory(state, id) {
			let activeId = state.activeBudgetCategogryId;

			if (id === activeId) {
				return false;
			}

			if (id === -1) {
				state.activeBudgetCategogryId = -1;
				return;
			}

			let budgetCategories = state.budgetCategories;

			budgetCategories[id]["isActive"] = true;

			if (budgetCategories.hasOwnProperty(activeId)) {
				budgetCategories[activeId]["isActive"] = false;
			}

			state.activeBudgetCategogryId = id;

			state.budgetCategories = budgetCategories;
		}
	},
	getters: {
		budgetCategories(state) {
			const activeId = state.activeBudgetCategogryId;
			if (activeId == -1) {
				return state.budgetCategories;
			}

			if (state.budgetCategories.hasOwnProperty(activeId)) {
				return [state.budgetCategories[activeId]];
			}
			return [];
		}
	}
});

export default store;
