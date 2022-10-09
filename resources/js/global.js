export default {
    data(){
        return {
            responseData : ''
        }
    },
    methods : {
        hire (id , job_id){
            var arr = {
                id : id ,
                job_id : job_id
            }
            axios.post('api/hire',arr).then(response => {
            
            }).catch((error) => {

            });
        },
        rateApplicant (rating , id , job_id) {
   
            var arr = {
                rating : rating ,
                job_id : job_id,
                id : id
            }
            axios.post('api/rateApplicant',arr).then(response => {
            
            }).catch((error) => {

            });
        } ,

        async rate_description (rate_description , id , job_id) {
            var arr = {
                rate_description : rate_description ,
                job_id : job_id,
                id : id
            }     
            
    
           
           await axios.post('api/rate_description',arr).then(response => {
                this.responseData = response.data
            }).catch((error) => {

            });

            return (this.responseData)
        },
     
    }
}