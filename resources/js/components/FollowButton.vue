<template>
   <div>
       <button type="button" class="btn btn-primary btn-sm ml-4" @click="followUser" follows={{ $follows }}v-text="buttonText"></button>
   </div>
</template>

<script>
    export default {
        props: [
            'userId',
            'follows'
        ],

        mounted() {
            console.log('Component mounted.')
        },

        // data: function(){
        //     return{
        //         status : this.follows,
        //     }
        // },

        data: {
            status : this.follows,
        },

        methods: {
            followUser(){
                // alert(`You followed me`)
                this.axios.post('follow/' + this.userId)
                    .then(response => {
                        console.log(response.data);
                    });
            }
        },

        computed: {
            buttonText(){
                return (this.status) ? 'Unfollow' : 'Follow';
            }
        },
    }
</script>
