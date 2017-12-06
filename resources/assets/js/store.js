import Vuex from "vuex";
import budget from "./store/budget";
const store = new Vuex.Store({
	modules: {
		budget
	}
});

export default store;
