export default {
    namespaced: true,
    state: {
        categories: {},
        activeId: -1
    },

    mutations: {
        load(state, data) {
            state.categories = data;
        },
        activate(state, id) {
            let activeId = state.activeId;

            if (id === activeId) {
                return false;
            }

            if (id === -1) {
                state.activeId = -1;
                return;
            }

            let categories = state.categories;

            categories[id]["isActive"] = true;

            if (categories.hasOwnProperty(activeId)) {
                categories[activeId]["isActive"] = false;
            }

            state.activeId = id;

            state.categories = categories;
        },
        addItem(state, item) {
            state.categories[state.activeId].items.push(item);
        }
    },
    getters: {
        heading(state, getters) {
            if (getters.allIsSelected) {
                return "Complete Budget";
            }
            return getters.activeCategory["name"] + " Section";
        },
        allIsSelected(state) {
            return state.activeId === -1;
        },
        selectedCategories(state) {
            const activeId = state.activeId;
            if (activeId == -1) {
                return state.categories;
            }

            if (state.categories.hasOwnProperty(activeId)) {
                return [state.categories[activeId]];
            }
            return [];
        },
        activeCategory(state) {
            if (state.activeId === -1) {
                return null;
            }
            return state.categories[state.activeId];
        },
        activeCategoryId(state, getters) {
            return getters.activeCategory ? getters.activeCategory.id : null;
        },
        total(state, getters) {
            //return if we dont have an array yet
            if (!getters.selectedCategories.reduce) {
                return 0;
            }
            return getters.selectedCategories.reduce((previous, next) => {
                return (
                    previous +
                    next.items.reduce((prev, item) => {
                        return prev + Number(item.total);
                    }, 0)
                );
            }, 0);
        }
    }
};
