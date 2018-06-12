<template>
	<div class = "box">
		<div class = "row">
			<div class = "left col-md-6">
				<div class = "card lbox">
					<h3 align = "center">On-Going Interviews</h3>
					<ul class = "interviewList">
						<li v-for = "item in interviewList" class= "interviewList-item">
							<p>{{item.company_name}} : {{item.position}}</p>
							<div class="progress">
  								<div class="progress-bar" role="progressbar" :style="{width:item.progress+'%'}"  aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{item.current_interview}}/{{item.total_interview}}</div>
							</div>
							<button @click = "deleteItem(item.id)"><i class="fas fa-times"></i></button>
							<button @click= "editInput(item)"><i class="fas fa-pencil-alt"></i></button>
						</li>
					</ul>
					<div v-if="showForm">
					</div>
					<div v-else = "v-else">
						<button @click = 'showInput' class = "btn btn-raised btn-primary showBtn">Add new interview</button>
					</div>

					<div v-if="showForm">
						<div class = "container">
							<div class = "form-row">
								<div class = "col">
									<input name = "companyName" class = "form-control" type = "text" maxlength="255" v-model="interviewItem.companyName" placeholder="Company..">
								</div>

								<div class = "col">
									<input name = "position" class = "form-control" type = "text" maxlength="255" v-model="interviewItem.position" placeholder="Position..">
								</div>

								<div class = "col num">
									<input name = "currentInterview" class = "numInt form-control" type = "number" maxlength="255" v-model="interviewItem.currentInterview" placeholder="Current Interview">	
								</div>		

								<div class = "col num">
									<input name = "totalInterview" class = "numInt form-control" type = "number" maxlength="255" v-model="interviewItem.totalInterview" placeholder="Total interview rounds">
								</div>									
							</div>
							<div class = "form-check" align ="center">
								<input name = "jobOffer" class = "form-check-input" type = "checkbox" maxlength="255" v-model="interviewItem.jobOffer">
								<label for = "jobOffer" class= "form-check-label">Job Offered?</label>
							</div>
							<button @click = 'addItem' class = "btn btn-raised btn-primary ">Add</button>
							<button @click = 'showInput' class = "btn btn-raised btn-danger ">Cancel</button>
						</div> <!-- end of container -->
 					</div> 
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
		props: {
			token: {
				type:String,
				required:true
			}
		},
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
      			edit:false,
				showForm: false,
				interviewList: [],
				interviewItemId: 0,
				interviewItem : {
					interview_id: 0,
					user_id: this.user,
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
			this.interviewItem.jobOffer = false;

		},
		methods: {
			fetchItems(){
				axios({
					method: 'GET',
					url: 'api/users/dashboard',
					params: {
						api_token : this.token
					}
				})
				.then(res => {
					this.interviewList = res.data;
				})
				.catch(error => {
					console.log(error)
				});

			},
			addItem(e) {
				console.log(this.interviewItemId);
				if(!this.edit){
					console.log("runnin post");
					axios({
        				method: "POST",
        				url: "/api/users/dashboard?api_token="+this.token,
        				data: this.interviewItem
      				})
					.then(response => {
          				this.interviewItem.companyName = '';
          				this.interviewItem.position = '';
          				this.interviewItem.currentInterview = '';
          				this.interviewItem.totalInterview = '';
          				this.interviewItem.jobOffer = false;
          				this.showInput();
          				this.fetchItems();
              		})
              		.catch(function (error){
              			console.log(error);
              		})
              	}
              	else {
              		console.log("updating " + this.interviewItemId + this.interviewItem.jobOffer);
					axios({
						method:"POST",
						url:"api/users/dashboard?api_token="+this.token,
						data: this.interviewItem
					}).
					then(response => {
						this.fetchItems();
						this.interviewItem.companyName = '';
          				this.interviewItem.position = '';
          				this.interviewItem.currentInterview = '';
          				this.interviewItem.totalInterview = '';
          				this.interviewItem.jobOffer = false;
					}).
					catch(error =>{
						console.log(error);
					});
              	}
				//resets the form and shows the list again
				e.preventDefault();
			},
			deleteItem(id){
				axios({
					method:"DELETE",
					url:"api/users/dashboard/" + id + "?api_token=" + this.token
				}).
				then(response => {
					this.fetchItems();
				}).
				catch(error =>{
					console.log(error);
				});
			},
			showInput() {
				this.showForm = !(this.showForm);
			},
			editInput(interviewItem) {
				this.showForm = !(this.showForm);
				this.edit = true;
				this.interviewItemId = interviewItem.id;
				this.interviewItem.interview_id = interviewItem.id;
          		this.interviewItem.companyName = interviewItem.company_name;
          		this.interviewItem.position = interviewItem.position;
          		this.interviewItem.currentInterview = interviewItem.current_interview;
          		this.interviewItem.totalInterview = interviewItem.total_interview;
          		this.interviewItem.jobOffer = interviewItem.jobOffer;
			}
		}
	}
</script>

<style scoped>
	input[type='text'] {
		color:black !important;
	}

	.card {
		padding-top:2%;
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
		position: relative;
		left:50%;
		transform: translateX(-50%);
	}

	.interviewList {
		list-style-type: none;
		overflow-y: scroll;
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

	.numInt {
		max-width: 40%;
	}

</style>