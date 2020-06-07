<template>
    <div id="rating-form">
        <!-- identify media-->
<!--        <select name="media_type" id="media_type" v-model="media_type" @change="getProfiles">-->
<!--            <option value="" disabled>Select Media Type</option>-->
<!--            <option value="book">Book</option>-->
<!--            <option value="movie"> Movie</option>-->
<!--            <option value="show">TV Show</option>-->
<!--            <option value="episode"> TV Episode</option>-->
<!--        </select>-->
        <div v-if="totalScore >= 0">{{ (totalScore/totalPossibleScore*100).toFixed(0)  }}%</div>
        <div v-if="totalScore >= 0">{{ (totalScore/totalPossibleScore*10).toFixed(0) }}/10</div>
        <div v-if="totalScore >= 0">{{ (totalScore/totalPossibleScore*5).toFixed(0) }}/5</div>
        <div v-if="media_type !== ''">
            {{ media_type}}
            <model-select
                :options="searchableProfiles"
                v-model="selectedProfile"
                @input="onProfileSelect"
            ></model-select>
        </div>
        <!-- identify rating profile-->
        <rating-partial
            v-for="ratingpartial in profile.rating_partials"
            :name="ratingpartial.name"
            :description="ratingpartial.description"
            :possible_score="ratingpartial.possible_score"
            :labels="ratingpartial.labels"
            @update="tallyScores"
            :key="ratingpartial.hashid"
        ></rating-partial>
    <button @click="save">Save</button>
    </div>
</template>

<script>
    import {ModelSelect} from 'vue-search-select'

    export default {
        props: {
            media: Object,
            media_type: String,
        },
        data() {
            return {
                searchableProfiles: [],
                selectedProfile: '',
                profile: {
                    rating_partials: []
                },
                reviews: {},
                totalScore: -1
            }
        },
        mounted() {
            this.getProfiles();
        },
        methods: {
            getProfiles() {
                axios.get('/data/profiles/list/' + this.media_type).then(res => {
                    this.searchableProfiles = res.data
                })
            },
            onProfileSelect(selectedItem) {
                axios.get('/data/profiles/' + selectedItem).then(res => {
                    this.profile = res.data
                })
            },
            tallyScores(data) {
                this.reviews[data.key] = data;
                this.totalScore = 0;
                for (let key in this.reviews) {
                    this.totalScore += this.reviews[key].rating;
                }
            },
            save() {
                axios.post('/ratings', {
                    media_type: this.media_type,
                    media_slug: this.media.slug,
                    reviews: this.reviews
                }).then(res => {
                    // if (res.data.success) {
                    //     window.location.href = '/'+this.media_type+'/'+this.media.slug
                    // }
                });
            }
        },
        computed: {
            totalPossibleScore: function () {
                let total = 0;
                this.profile.rating_partials.forEach(function (rp) {
                    total += rp.possible_score;
                })
                return total;
            }
        },
        components: {
            ModelSelect
        }

    }
</script>
