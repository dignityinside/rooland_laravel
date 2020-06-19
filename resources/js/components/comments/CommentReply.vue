<template>
    <div class="bg-white py-4 px-2 rounded-lg">
        <h3>
            Replying to comment
        </h3>

        <comment :comment="comment" :links="false"></comment>

        <form @submit.prevent="store" id="reply">
            <div class="form-group">
                <label for="body">
                    Comment
                </label>
                <textarea
                    name="body"
                    id="body"
                    cols="30"
                    rows="6"
                    class="form-control"
                    autofocus="autofocus"
                    v-model="form.body"
                    :class="{
                        'is-invalid': errorMessage
                    }"
                ></textarea>

                <template v-if="errorMessage">
                    <p class="help text-danger">
                        {{ errorMessage }}
                    </p>
                </template>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Reply</button>
                <a href="#" @click.prevent="cancel" class="btn btn-link">Cancel</a>
            </div>
        </form>
    </div>
</template>

<script>
    import Comment from './Comment';
    import bus from '../../bus';
    import axios from 'axios';
    import VueScrollTo from 'vue-scrollto';

    export default {
        data () {
            return {
                form: {
                    body: ''
                },
                errorMessage: '',
            }
        },
        props: {
            comment: {
                required: true,
                type: Object
            }
        },
        components: {
            Comment
        },
        methods: {
            async store() {

                try {

                    let reply = await axios.post(`/comments/${this.comment.id}/replies`, this.form);

                    bus.$emit('comment:replied', {
                        comment: this.comment,
                        reply: reply.data.data
                    })

                    this.cancel();

                } catch (error) {
                    this.errorMessage = error.response.data.errors.body[0];
                }

            },
            cancel() {
                bus.$emit('comment:reply-cancelled')
            },
        },
        mounted() {
            VueScrollTo.scrollTo('#reply', 500)
        }
    }
</script>
