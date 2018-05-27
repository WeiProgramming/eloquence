<template>
	<div class = "box">
		<div class = "row">
			<div class = "left col-md-6">
				<div class = "card lbox">
					<h3 align = "center">On-Going Interviews</h3>
					<ul>
						<li v-for = "item in interviewList">
							{{item}}
						</li>
						<form v-if = "showForm">
							<div class = "form-group">
								<label for = "companyName">Company 
								<input name = "companyName" class = "form-cntrol" v-model = "companyName" type = "text" maxlength="255"><button @click = 'addItems' class = "btn btn-raised btn-primary">Add</button></label>
							</div>
						</form>
					</ul>
					<button @click = 'showInput' class = "btn btn-raised btn-primary showBtn">Show Form</button>
				</div>
			</div>

			<div class= "right col-md-6">
				<div class = "card rbox" align = "center">
					<h3>yo there</h3>
				</div>
				<div class = "card rbox" align = "center">
					<h3>yo here</h3>
				</div>
			</div>
		</div>
	</div>
</template>


<script>
	export default {
		data(){
			return {
				companyName: '',
				showForm: false,
				interviewList: []
			}
		},
		methods: {
			addItems(e) {
				this.interviewList.push(this.companyName);
				this.companyName = '';
				e.preventDefault();
			},

			showInput() {
				this.showForm = !(this.showForm);
			}
		}
	}
</script>

<style scoped>
	input[type='text'] {
		color:black !important;
	}

	.box {
		position:relative;
		height:600px;
	}

	.row {
		height:100%;
	}

	.lbox {
		margin-top: 2%;
		height: 100%;	
		background-color: #976DD0;
	}

	.rbox {
		margin-top: 1%;
		height: 50%;
		background-color: #976DD0;
		position: relative;
	}

	.showBtn {
		position: absolute;
		bottom: 5%;
		left: 50%;
		transform: translateX(-50%);
	}

</style>