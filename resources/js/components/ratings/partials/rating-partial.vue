<template>
    <div>
        <div>{{ name }}</div>
        <div>{{ description }}</div>
        <div v-if="currentRating >= 0">{{ labels[currentRating] }}</div>
        <star-rating
            v-model="rating"
            :max-rating="possible_score"
            :show-rating="false"
            :rounded-corners="true"
            @rating-selected ="rated"
            @current-rating="showLabel"
        ></star-rating>
        <div>
            <textarea v-model="note" cols="30" rows="10" @change="updateParent"></textarea>
        </div>
    </div>
</template>

<script>
    // import StarRating from 'vue-star-rating'

    export default {
        props: {
            name: String,
            description: String,
            possible_score: Number,
            labels: Array
        },
        data() {
            return {
                stars: [],
                rating: -1,
                note: '',
                currentRating: -1
            }
        },
        mounted() {
            for (let i = 0; i <= this.possible_score; i++) {
                this.stars.push({
                    score: i,
                    label: this.labels[i] || i,
                    checked: false
                });
            }
        },
        methods: {
            rated() {
                this.updateParent();
            },
            showLabel(rating) {
                this.currentRating = rating;
            },
            updateParent() {
                this.$emit('update', {
                    key: this.$vnode.key,
                    rating: this.rating,
                    note: this.note,
                });
            }
        },
        components: {
            // StarRating
        }
    }
</script>
