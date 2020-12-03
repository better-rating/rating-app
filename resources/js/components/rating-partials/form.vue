<template>
    <div id="rating-partial-form">
        <div class="mb-2">
            <label class="inline-block w-48 font-bold" for="name">Name:</label>
            <input class="w-64" type="text" id="name" v-model="name">
        </div>
        <div class="mb-2">
            <label class="inline-block w-48 font-bold" for="description">Description:</label>
            <textarea class="w-64" id="description" v-model="description"></textarea>
        </div>
        <div class="mb-2">
            <label class="inline-block w-48 font-bold" for="possible_score">Total Possible Score:</label>
            <input class="w-64" type="number" id="possible_score" v-model="possible_score">
        </div>
        <div v-if="Object.keys(labels).length > 0">
            <div class="font-bold mb-2">
                Optional Labels
                <div class="text-sm font-light text-gray-700">Alternative labels to display instead of a number (eg. 0-no/1-yes, 0-poor/1-good/2-excellent)</div>
            </div>
            <div v-for="(label, index) in labels">
                <label class="w-8 inline-block">{{index}}:</label><input type="text" v-model="labels[index]">
            </div>
        </div>
        <button class="mt-8 btn btn-blue" @click="save">Create</button>
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
                if ('id' in this.ratingpartial) {
                    url += '/' + this.ratingpartial.id;
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
