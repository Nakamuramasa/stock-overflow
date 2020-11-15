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
            axios.patch(`/stock_overflow/public/questions/${this.questionId}/answers/${this.id}`, {
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
        }
    }
}
</script>