<template>
	<div class = "box">
		<div class = "row">
			<div class = "left col-md-6">
				<div class = "card lbox">
					<h3 align = "center">On-Going Interviews</h3>
					<div class = "container" v-if="showForm">
					<form>
						<div class = "md-form">
							<label for = "companyName">Company</label>
							<input name = "companyName" class = "form-control" v-model = "companyName" type = "text" maxlength="255">
						</div>
						<div class = "md-form">
							<label for = "position">Position</label>
							<input name = "position" class = "form-control" v-model = "position" type = "text" maxlength="255">
						</div>
						<div class = "md-form">
							<label for = "currentInterview">Current Interview</label>
							<input name = "currentInterview" class = "form-control" v-model = "currentInterview" type = "text" maxlength="255">							
						</div>
						<div class = "md-form">
							<label for = "totalInterview">Total Interview</label>
							<input name = "totalInterview" class = "form-control" v-model = "totalInterview" type = "text" maxlength="255">
						</div>
						<div class = "md-form">
							<label for = "jobOffer">Job Offer</label>
							<input name = "jobOffer" class = "form-control" v-model = "jobOffer" type = "text" maxlength="255">
						</div>
							<button @click = 'addItem' class = "btn btn-raised btn-primary">Add</button>
					</form>
				</div>
					<ul v-else>
						<li v-for = "item in interviewList">
							{{item}}
							<button @click = "deleteItem" class = "btn btn-danger">Delete</button>
						</li>
					</ul>
					<button @click = 'showInput' class = "btn btn-raised btn-primary showBtn">Show Form</button>
				</div>
			</div>

			<div class= "right col-md-6">
				<div class = "card rbox" align = "center">
					<h3>Calendar</h3>
				</div>
				<div class = "card rbox" align = "center">
					<h3>Available Time</h3>
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
				position: '',
				currentInterview: '',
				totalInterview:'',
				jobOffer: false,
				showForm: false,
				interviewList: []
			}
		},
		methods: {
			addItem(e) {
				this.interviewList.push(this.companyName);
				this.companyName = '';
				this.position = '';
				this.currentInterview = '';
				this.totalInterview = '';
				this.showForm = false;
				e.preventDefault();
			},
			deleteItem(e){
				e.preventDefault();
				this.interviewList.pop();
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
		margin-top: 1%;
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