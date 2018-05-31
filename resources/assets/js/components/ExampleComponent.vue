<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <ul>
                            <li v-for = "item in items">{{item.company_name}}</li>
                        </ul>

                        <p>Passed message {{mymessage}}</p>
                    </div>
                    <button v-on:click = "fetchItem">Click Me</button>

                    <h1 v-if = "showHiddenMsg"> Hidden Message </h1>

                    <input type = "text" v-model = "message"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['mymessage'],
        data(){
            return {
                message: "",
                showHiddenMsg: false,
                username: "",
                items: []
            }
        },
        methods: {
            fetchItem(){
                fetch('users/dashboard')
                .then(res => res.json())
                .then(res => {
                    this.items = res;
                });
            }
        }
    }
</script>
