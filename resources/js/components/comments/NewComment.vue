<template>
    <div class="mb-4">
        <a
            href="#"
            class="btn btn-primary"
            @click.prevent="active = true"
            v-if="!active"
        >
            Add a comment
        </a>
        <template v-if="active">
            <form @submit.prevent="store">
                <div class="form-group">
                    <label for="body">Comment</label>
                    <textarea
                        name="body"
                        id="body"
                        cols="30"
                        rows="3"
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
                    <button type="submit" class="btn btn-primary">Send</button>
                    <a href="#" class="btn btn-link" @click.prevent="active = false">Cancel</a>
                </div>
            </form>
        </template>
    </div>
</template>

<script>
    import axios from 'axios';
    import bus from '../../bus';

    export default {
        data () {
            return {
                active: false,
                form: {
                    body: ''
                },
                errorMessage: ''
            }
        },
        props: {
            endpoint: {
                required: true,
                type: String
            }
        },
        methods: {
            async store () {

                try {

                    let comment = await axios.post(this.endpoint, this.form);

                    bus.$emit('comment:stored', comment.data.data);

                    this.active = false;
                    this.form.body = '';
                    this.errorMessage = '';

                } catch (error) {
                    this.errorMessage = error.response.data.errors.body[0];
                }

            }
        }
    }
</script>

