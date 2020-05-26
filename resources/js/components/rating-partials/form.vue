<template>
    <div id="rating-partial-form">
        <label for="name">Name:</label>
        <input type="text" id="name" v-model="name">
        <label for="description">Description:</label>
        <textarea id="description" v-model="description"></textarea>
        <label for="possible_score">Total Possible Score:</label>
        <input type="number" id="possible_score" v-model="possible_score">
        <div>
            <h4>Optional Labels</h4>
            <div v-for="(label, index) in labels">
                <label>{{index}}: <input type="text" v-model="labels[index]"></label>
            </div>
        </div>
        <button @click="save">Create</button>
    </div>
</template>

<script>
    export default {
        props: {
            ratingpartial: {
                type: Object,
                default() {
                    return {
                        name: '',
                        description: '',
                        possible_score: 0,
                        labels: {}
                    }
                }
            },
        },
        data() {
            return {
                name: this.ratingpartial.name,
                description: this.ratingpartial.description,
                possible_score: this.ratingpartial.possible_score,
                labels: this.ratingpartial.labels,
            }
        },
        methods: {
            save: function () {
                let url = '/rating-partials';
                if ('id' in this.rating) {
                    url += '/' + this.rating.id;
                }

                axios.post(url, {
                    name: this.name,
                    description: this.description,
                    possible_score: this.possible_score,
                    labels: this.labels
                }).then(res => {
                    if (res.data.success) {
                        window.location.href = '/rating-partials'
                    }
                });
            }
        },
        watch: {
            possible_score: {
                handler(newScore, oldScore) {
                    console.log(this);
                    if (newScore > oldScore) {
                        for (let i = 0; i <= newScore; i++) {
                            if (!(i.toString() in this.labels)) {
                                this.labels[i] = '';
                            }
                        }
                    }
                    if (oldScore > newScore) {
                        for (let i = oldScore; i > newScore; i--) {
                            delete this.labels[i];
                        }
                    }
                }
            }
        }
    }
</script>
