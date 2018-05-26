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
						<input v-model = "companyName" type = "text" maxlength="255">
						<h2>{{companyName}}</h2>
					</ul>
					<button @click = 'addItems' class = "btn btn-success">Add</button>
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
				message: "hello",
				companyName: '',
				interviewList: []
			}
		},
		methods: {
			addItems() {
				this.interviewList.push(this.companyName);
				this.companyName = '';
			}
		}
	}
</script>

<style scoped>
	.rbox {
		margin-top: 1%;
		height: 50%;
	}
</style>