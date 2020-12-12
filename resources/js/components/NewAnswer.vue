<template>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Your Answer</h3>
                    </div>
                    <hr>
                    <form @submit.prevent="create">
                        <div class="form-group">
                            <m-editor :body="body" name="new-answer">
                                <textarea class="form-control" name="body" required v-model="body" rows="7"></textarea>
                            </m-editor>
                        </div>
                        <div class="form-group">
                            <button type="submit" :disabled="isInvalid" class="btn btn-lg btn-outline-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import MEditor from './MEditor.vue';

export default {
    props: ['questionId'],
    components: { MEditor },
    data(){
        return {
            body: ''
        }
    },
    computed: {
        isInvalid(){
            return !this.signedIn || this.body.length < 10;
        }
    },
    methods: {
        create(){
            axios.post(`/stock_overflow/public/questions/${this.questionId}/answers`, {
                body: this.body
            })
            .then(({data}) => {
                this.$toast.success(data.message, "Success");
                this.body = '';
                this.$emit('created', data.answer);
            })
            .catch(error => {
                this.$toast.error(error.response.data.message, "Error");
            });
        }
    }
}
</script>