<template>
    <form @submit.prevent="patch">
        <div class="form-group">
            <label for="body">Comment</label>
            <textarea
                name="body"
                id="body"
                :rows="textareaHeight"
                class="form-control"
                autofocus="autofocus"
                v-model="form.body"
                :class="{
                    'is-invalid': errorMessage
                }"
            >
            </textarea>

            <template v-if="errorMessage">
                <p class="help text-danger">
                    {{ errorMessage }}
                </p>
            </template>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Edit</button>
            <a href="#" @click.prevent="cancel" class="btn btn-link">Cancel</a>
        </div>
    </form>
</template>

<script>
    import bus from '../../bus';
    import axios from 'axios';

    export default {
        data () {
            return {
                form: {
                    body: this.comment.body
                },
                errorMessage: ''
            }
        },
        computed: {
            textareaHeight() {
                return Math.max(Math.floor(this.comment.body.split(/\r*\n/).length / 2), 3);
            }
        },
        props: {
          comment: {
              required: true,
              type: Object
          }
        },
        methods: {
            async patch() {

                try {

                    let comment = await axios.patch(`/comments/${this.comment.id}`, this.form);

                    bus.$emit('comment:edited', comment.data.data);

                    this.cancel();

                } catch (error) {
                    this.errorMessage = error.response.data.errors.body[0];
                }

            },
            cancel() {
                bus.$emit('comment:edit-cancelled', this.comment)
            }
        }
    }
</script>
