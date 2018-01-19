const activateId = function activateItemFunction(state, key, id) {
    let active = state[key];
    if (id === active) {
        return false;
    }
    if (id === -1) {
        state[key] = -1;
        return false;
    }
    return state[key];
};

const forEach = function(obj, func) {
    Object.keys(obj).forEach(function(key) {
        func(obj[key], key);
    });
};
export default {
    namespaced: true,
    state: {
        categories: {},
        activeCategoryId: -1,
        activeItemId: -1
    },

    mutations: {
        load(state, data) {
            state.categories = data;
        },
        activateItem(state, id) {
            const activeId = activateId(state, "activeItemId", id);
            if (!activeId) {
                return false;
            }
            state.activeItemId = id;
        },
        activateCategory(state, id) {
            const activeId = activateId(state, "activeCategoryId", id);

            if (!activeId) {
                return;
            }

            let categories = state.categories;

            categories[id]["isActive"] = true;

            if (categories.hasOwnProperty(activeId)) {
                categories[activeId]["isActive"] = false;
            }

            state.activeCategoryId = id;

            state.categories = categories;
        },
        addItem(state, item) {
            state.categories[state.activeCategoryId].items.push(item);
        }
    },
    getters: {
        items(state) {
            let items = [];
            Object.values(state.categories).map(category => {
                items = items.concat(category.items);
            });
            return items;
        },
        activeItem(state, getters) {
            if (!getters.isShowingItem) {
                return {};
            }
            const item = getters.items.find(
                item => item.id == state.activeItemId
            );

            return item ? item : {};
        },
        isShowingItem(state) {
            return state.activeItemId != -1;
        },
        heading(state, getters) {
            if (getters.allIsSelected) {
                return "Complete Budget";
            }
            if (getters.activeCategory) {
                return;
            }
            return getters.activeCategory["name"] + " Section";
        },
        allIsSelected(state) {
            return state.activeCategoryId === -1;
        },
        selectedCategories(state) {
            const categories = state.categories;

            const activeCategoryId = state.activeCategoryId;
            if (activeCategoryId == -1) {
                return state.categories;
            }

            if (categories.hasOwnProperty(activeCategoryId)) {
                return [categories[activeCategoryId]];
            }
            return [];
        },
        activeCategory(state) {
            if (state.activeCategoryId === -1) {
                return {};
            }
            return state.categories[state.activeCategoryId];
        },
        activeCategoryId(state, getters) {
            return getters.activeCategory ? getters.activeCategory.id : null;
        },

        total(state, getters) {
            let categories = getters.selectedCategories;
            if (!Array.isArray(categories)) {
                categories = Object.values(categories);
            }
            return categories.reduce((previous, next) => {
                const nextSum = next.items
                    ? next.items.reduce((prev, item) => {
                          return prev + Number(item.total);
                      }, 0)
                    : 0;
                return previous + nextSum;
            }, 0);
        }
    }
};
