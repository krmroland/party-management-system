<template>
	<div v-if="!inAllMode" class="">
		<div  class="d-flex justify-content-end mb-5">
			<button class="btn btn-outline-primary">
				<i class="fa fa-plus"></i>
				Add Item to category
			</button>
		</div>
		<div class="card mb-2">
			<div class="card-body">
				<h4 class="text-center">Add A New Item To The Budget</h4>
				<form>
					<div class="form-row">
						<!-- name -->
					    <div class="form-group col-md-4">
					      <input type="text" class="form-control" placeholder="Item Name" v-model="name">
					    </div>
					    <!-- quantity -->
					    <div class="form-group col-md-2">
					      <input type="text" class="form-control" 
					      placeholder="Quantity" :value="rawQty" @change="setQty">
					    </div>
					    <!-- unitCost -->
					    <div class="form-group col-md-2">
					      <input type="text" class="form-control" 
					      placeholder="Unit Cost" v-model="unitCost">
					    </div>
					    <!-- total -->
					    <div class="form-group col-md-2">
					      <input type="text" class="form-control" 
					      placeholder="Total" v-model="total">
					    </div>
					    <div class="form-group col-md-2">
					    <!-- isCovered -->
					      <label class="custom-control custom-checkbox m-0">
					        <input type="checkbox" class="custom-control-input" v-model="isCovered" value="true">
					        <span class="custom-control-indicator"></span>
					        <span class="custom-control-description">
					        	Is Covered
					        </span>
					      </label>
					    </div>
					 </div>
					<div class="form-group">
						<button class="btn btn-outline-primary">
							<i class="fa fa-save"></i>
							Save
						</button>
					</div>		
					 
				</form>
			</div>
		</div>
	</div>
	
</template>

<script>
export default {
	props: ["inAllMode"],
	data() {
		return {
			name: "",
			isCovered: false,
			qty:0,
			unitCost: null,
			qtyUnits: null,
			total: null
		};
	},
	computed:{
		rawQty(){
			return [this.qty,this.qtyUnits].filter(el=>el).join(" ");
		}
	},
	
	methods: {
		parseQuantity(qty) {
			const matched=qty.match(/(^\d+)([\w,\s].+$)/)
			if (matched && matched.length) {
				const parts = [...matched];
				this.qtyUnits= parts[2].trim();
				return Number(parts[1]);
			}
			return 0;
		
		},
		setQty(e){
			console.log(e)
			let qty=e.target.value;
			this.qty=+qty?qty:this.parseQuantity(qty);

			if (this.unitCost) {
				this.total=this.qty*this.unitCost;
				return;
			}

			if (this.total && qty>0) {
				this.unitCost=this.total/this.qty;
			}

		},
	},
	watch:{
		
		unitCost(unitCost){
			unitCost=+unitCost?Number(unitCost):0;
			console.log(unitCost);
			if (this.qty) {
				this.total=this.qty*unitCost;
				return;
			}

			if (this.total && unitCost>0) {
				this.qty=this.total/unitCost;
			}

		},
		total(total){
			this.total=+total?Number(total):0;
			if (this.qty) {
				this.unitCost=this.total/this.qty;
			}

			if (this.unitCost && this.qty>0) {
				this.qty=this.total/this.qty;
			}

		}
	}
};;
</script>

<style lang="scss" scoped>

</style>