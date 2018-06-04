<template>
	<div class = "box">
		<div class = "row">
			<div class = "left col-md-6">
				<div class = "card lbox">
					<h3 align = "center">On-Going Interviews</h3>
					<div class = "container" v-if="showForm">
						<form @submit.prevent="addItem">
							<div class = "form-group">
								<label for = "companyName">Company</label>
								<input name = "companyName" class = "form-control" type = "text" maxlength="255" v-model="interviewItem.companyName">
							</div>
							<div class = "form-group">
								<label for = "position">Position</label>
								<input name = "position" class = "form-control" type = "text" maxlength="255" v-model="interviewItem.position">
							</div>
							<div class = "form-group">
								<label for = "totalInterview">Total Interview Rounds</label>
								<input name = "totalInterview" class = "form-control" type = "number" maxlength=	"255" v-model="interviewItem.totalInterview">
							</div>
							<div class = "form-group">
								<label for = "currentInterview">Current Interview</label>
								<input name = "currentInterview" class = "form-control" type = "number" maxlength="255" v-model="interviewItem.currentInterview">							
							</div>
							<div class = "form-check">
								<input name = "jobOffer" class = "form-check-input" type = "checkbox" maxlength="255" v-model="interviewItem.jobOffer">
								<label for = "jobOffer" class= "form-check-label">Job Offered?</label>
							</div>
								<button @click = 'addItem' class = "btn btn-raised btn-primary">Add</button>
						</form>
					</div>
					<ul v-else class = "interviewList">
						<li v-for = "item in interviewList" class= "interviewList-item">
							<div class="progress">
  								<div class="progress-bar" role="progressbar" :style="{width:item.progress+'%'}"  aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{item.current_interview}}/{{item.total_interview}}</div>
							</div>
							<p>{{item.company_name}} : {{item.position}}</p>
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
				showForm: false,
				interviewList: [],
				interviewItem : {
					companyName : '',
					position: '',
					currentInterview: '',
					totalInterview:'',
					jobOffer: false,
				}
			}
		},
		created(){
			this.fetchItems();
		},
		methods: {
			fetchItems(){
				fetch('api/users/dashboard')
				.then(res => res.json())
				.then(res => {
					this.interviewList = res;
					console.log(res);
				});

			},
			addItem(e) {
				console.log(this.interviewItem);
				axios({
        			method: "POST",
        			url: "/api/users/dashboard",
        			data: this.interviewItem
      			})
				.then(function(response) {
          			console.log(response);
              	})
              	.catch(function (error){
              		console.log(error);
              	})
				//resets the form and shows the list again
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