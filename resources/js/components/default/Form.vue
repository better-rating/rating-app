<template>
    <div id="rating-form">
        <div class="grid grid-cols-12 mb-4">
            <div class="col-span-6">
                <div class="grid grid-cols-6" v-for="field in usable_fields">
                    <span class="col-span-2">{{ field.label }}</span>
                    <v-date-picker v-if="field.type === 'date'" class="col-span-4 mb-2" v-model="field_data[field.label]">
                        <template v-slot="{ inputValue, inputEvents }">
                            <input
                                class="w-full"
                                :value="inputValue"
                                v-on="inputEvents"
                            />
                        </template>
                    </v-date-picker>
                    <input v-else class="col-span-4 mb-2" :type="field.type" v-model="field_data[field.label]">
                </div>
                <div class="grid grid-cols-6 mb-4" v-if="media_manifest.type !== ''">
                    <span class="col-span-2">Rating Profile</span>
                    <model-select
                        class="col-span-4"
                        :options="searchableProfiles"
                        v-model="selectedProfile"
                        @input="onProfileSelect"
                    ></model-select>
                </div>
            </div>
            <div class="col-start-9 col-span-1" v-if="totalScore >= 0">{{ (totalScore / totalPossibleScore * 100).toFixed(0) }}%</div>
            <div class="col-span-1" v-if="totalScore >= 0">{{ (totalScore / totalPossibleScore * 10).toFixed(0) }}/10</div>
            <div class="col-span-1" v-if="totalScore >= 0">{{ (totalScore / totalPossibleScore * 5).toFixed(0) }}/5</div>
        </div>
        <!-- identify rating profile-->
        <div class="grid grid-cols-12">
            <rating-partial
                v-for="ratingpartial in profile.rating_partials"
                :name="ratingpartial.name"
                :description="ratingpartial.description"
                :possible_score="ratingpartial.possible_score"
                :labels="ratingpartial.labels"
                @update="tallyScores"
                :key="ratingpartial.hashid"
            ></rating-partial>
            <!--really hacky bottom border-->
            <div v-if="profile.rating_partials.length > 0" class="border-b border-gray-500 col-span-12 mb-4"></div>
        </div>
        <button class="btn btn-blue" @click="save">Save</button>
    </div>
</template>

<script>
import {ModelSelect} from 'vue-search-select'

export default {
    props: {
        media: Object,
        media_manifest: Object,
        media_model: String,
        fields: Object
    },
    data() {
        return {
            searchableProfiles: [],
            selectedProfile: '',
            profile: {
                rating_partials: []
            },
            reviews: {},
            totalScore: -1,
            field_data: this.skeleton(this.fields)
        }
    },
    mounted() {
        this.getProfiles();
    },
    methods: {
        getProfiles() {
            axios.get('/data/profiles/list/' + this.media_manifest.type).then(res => {
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
            if (this.media) {
                this.saveRating()
            } else {
                this.saveMedia()
            }
        },
        saveMedia() {
            axios.post('/'+this.media_manifest.save_uri, {
                fields: this.field_data
            }).then(res => {
                if (res.data.success) {
                    this.media = res.data.media
                    this.saveRating();
                }
            });
        },
        saveRating() {
            axios.post('/ratings', {
                media_type: this.media_manifest.type,
                media_slug: this.media.slug,
                reviews: this.reviews
            }).then(res => {
                // if (res.data.success) {
                //     window.location.href = '/'+this.media_type+'/'+this.media.slug
                // }
            });
        },
        skeleton: (object) => {
            let res = _.clone(object);
            for (const [key, value] of Object.entries(res)) {
                res[key] = null;
            }
            return res;
        }
    },
    computed: {
        totalPossibleScore: function () {
            let total = 0;
            this.profile.rating_partials.forEach(function (rp) {
                total += rp.possible_score;
            })
            return total;
        },
        usable_fields: function () {
            let result = [];
            for (const [key, value] of Object.entries(this.fields)) {
                let type = (value.type === 'string') ? 'text' : value.type;
                result.push({
                    label: key,
                    type: type
                })
            }
            return result;
        }
    },
    components: {
        ModelSelect
    }

}
</script>


<!--<template>-->
<!--    <div>-->
<!--        <div v-for="field in usable_fields">-->
<!--            <span>{{ field.label }}</span> <input :type="field.type" v-model="rating_data[field.label]">-->
<!--        </div>-->
<!--        <div></div>-->
<!--    </div>-->
<!--</template>-->

<!--<script>-->
<!--export default {-->
<!--    props: {-->
<!--        type: String,-->
<!--        fields: Object-->
<!--    },-->
<!--    data() {-->
<!--        return {-->
<!--            rating_data: this.skeleton(this.fields)-->
<!--        }-->
<!--    },-->
<!--    methods: {-->
<!--        skeleton: (object) => {-->
<!--            let res = _.clone(object);-->
<!--            for (const [key, value] of Object.entries(res)) {-->
<!--                res[key] = null;-->
<!--            }-->
<!--            return res;-->
<!--        }-->
<!--    },-->
<!--    computed: {-->
<!--        usable_fields: function () {-->
<!--            let result = [];-->
<!--            for (const [key, value] of Object.entries(this.fields)) {-->
<!--                result.push({-->
<!--                    label: key,-->
<!--                    type: 'text'-->
<!--                })-->
<!--            }-->
<!--            return result;-->
<!--        }-->
<!--    }-->
<!--}-->
<!--</script>-->
