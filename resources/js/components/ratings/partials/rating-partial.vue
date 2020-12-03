<template>
    <div class="contents">
        <div class="col-span-2 p-2 border-t border-l border-gray-500 font-bold bg-gray-300">{{ name }}</div>
        <div class="col-span-3 p-2 border-t border-l border-gray-500">{{ description }}</div>
        <div class="col-span-3 p-2 border-t border-l border-gray-500">
            <div class="h-4">{{ labels[currentRating] }}</div>
            <star-rating
                v-model="rating"
                :max-rating="possible_score"
                :show-rating="false"
                :rounded-corners="true"
                @rating-selected="rated"
                @current-rating="showLabel"
            ></star-rating>
        </div>
        <div class="col-span-4 p-2 border-t border-l border-r border-gray-500">
            <textarea class="w-full h-full" v-model="note" @change="updateParent"></textarea>
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
