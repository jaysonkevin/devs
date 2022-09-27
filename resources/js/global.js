export default {
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
        }
    }
}