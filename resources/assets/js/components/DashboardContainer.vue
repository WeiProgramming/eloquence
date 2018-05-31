<template>
	<div class = "box">
		<div class = "row">
			<div class = "left col-md-6">
				<div class = "card lbox">
					<h3 align = "center">On-Going Interviews</h3>
					<div class = "container" v-if="showForm">
						<form>
							<div class = "form-group">
								<label for = "companyName">Company</label>
								<input name = "companyName" class = "form-control" v-model = "companyName" type = "text" maxlength="255">
							</div>
							<div class = "form-group">
								<label for = "position">Position</label>
								<input name = "position" class = "form-control" v-model = "position" type = "text" maxlength="255">
							</div>
							<div class = "form-group">
								<label for = "totalInterview">Total Interview Rounds</label>
								<input name = "totalInterview" class = "form-control" v-model = "totalInterview" type = "number" maxlength=	"255">
							</div>
							<div class = "form-group">
								<label for = "currentInterview">Current Interview</label>
								<input name = "currentInterview" class = "form-control" v-model = "currentInterview" type = "number" maxlength="255">							
							</div>
							<div class = "form-check">
								<input name = "jobOffer" class = "form-check-input" v-model = "jobOffer" type = "checkbox" maxlength="255">
								<label for = "jobOffer" class= "form-check-label">Job Offered?</label>
							</div>
								<button @click = 'addItem' class = "btn btn-raised btn-primary">Add</button>
						</form>
					</div>
					<ul v-else class = "interviewList">
						<li v-for = "item in interviewList" class= "interviewList-item">
							<div class="progress">
  								<div class="progress-bar" role="progressbar" :style="{width:item.progress}" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{item.progress}}</div>
							</div>
							<p>{{item.companyName}} {{item.position}}</p>
						</li>
					</ul>
					<button @click = 'showInput' class = "btn btn-raised btn-primary showBtn">Show Form</button>
				</div>
			</div>

			<div class= "col-md-6">
				<div class = "card" align="center">
					<h3>Calendar</h3>
					  <v-calendar :attributes='attrs'>
  					</v-calendar>
  				</div>
				<div class = "card rbox" align = "center">
					<h3>Available Time</h3>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import vCalendar from 'v-calendar';
	import 'v-calendar/lib/v-calendar.min.css';

	export default {
		data(){
			return {
      attrs: [
        {
          key: 'today',
          highlight: {
            backgroundColor: '#ff8080',
            // Other properties are available too, like `height` & `borderRadius`
          },
          dates: new Date()
        }
      ],
				companyName: '',
				position: '',
				currentInterview: '',
				totalInterview:'',
				jobOffer: false,
				showForm: false,
				progress: 0,
				interviewList: []
			}
		},
		created(){
			this.fetchItems();
		},
		methods: {
			fetchItems(){
				fetch('users/dashboard')
				.then(res => res.json())
				.then(res => {
					console.log(res);
				});

			},

			addItem(e) {
				this.interviewList.push({					
					companyName: this.companyName,
					position:this.position,
					totalInterview: this.totalInterview,
					currentInterview: this.currentInterview,
					jobOffer: this.jobOffer,
					progress: String((this.currentInterview/this.totalInterview)*100)+'%'
				});
				//resets the form and shows the list again
				console.log(this.interviewList[0]);
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
		padding: 10%;

	}

	.showBtn {
		position: absolute;
		bottom: 5%;
		left: 50%;
		transform: translateX(-50%);
	}

	.interviewList {
		list-style-type: none;
	}

	.interviewList-item {
		padding: 3%;
	}

	.list-group-item {
		border: 1px solid black;
	}

	.progress {
		height: 12px;
	}

</style>