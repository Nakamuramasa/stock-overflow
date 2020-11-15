<script>
export default {
    data(){
        return {
            editing: false,
            body: this.answer.body,
            bodyHtml: this.answer.body_html,
            id: this.answer.id,
            questionId: this.answer.question_id,
            beforeEditCache: null
        }
    },
    props: ['answer'],
    computed: {
        isInvalid(){
            return this.body.length < 10;
        },
        endpoint(){
            return `/stock_overflow/public/questions/${this.questionId}/answers/${this.id}`; 
        }
    },
    methods: {
        edit(){
            this.beforeEditCache = this.body;
            this.editing = true;
        },
        cancel(){
            this.body = this.beforeEditCache;
            this.editing = false;
        },
        update(){
            axios.patch(this.endpoint, {
                body: this.body
            })
            .then(res => {
                console.log(res);
                this.editing = false;
                this.bodyHtml = res.data.body_html;
                alert(res.data.message);
            })
            .catch(err => {
                console.log(err.response);
            });
        },
        destroy(){
            if(confirm('Are you sure?')){
                axios.delete(this.endpoint)
                .then(res => {
                    $(this.$el).fadeOut(500, () => {
                        alert(res.data.message);
                    })
                });
            }
        }
    }
}
</script>