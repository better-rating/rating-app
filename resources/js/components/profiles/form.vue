<template>
    <div id="profile-form">
        <div>
            <label for="name">Name:</label> <input type="text" id="name" v-model="name">
        </div>
        <div>
            <label for="media_type">Media Type:</label>
            <select name="media_type" id="media_type" v-model="media_type">
                <option value="">---</option>
                <option value="book">Book</option>
                <option value="movie"> Movie</option>
                <option value="show">TV Show</option>
                <option value="episode"> TV Episode</option>
            </select>
        </div>
        <div>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Score</th>
                    <th>Remove</th>
                </tr>
                <tr v-for="partial in rating_partials">
                    <td>{{ partial.name }}</td>
                    <td>{{ partial.description }}</td>
                    <td>{{ partial.possible_score }}</td>
                    <td>
                        <button @click="removePartial(partial.id)">X</button>
                    </td>
                </tr>
            </table>
        </div>
        <div>
            <multi-select
                :options="searchablePartials"
                :selected-options="selectedPartials"
                placeholder="select item"
                :hideSelectedOptions="true"
                @select="onSelect">
            </multi-select>
        </div>

        <button @click="save">Create</button>
    </div>
</template>

<script>
    import {MultiSelect} from 'vue-search-select'

    export default {
        props: {
            profile: {
                type: Object,
                default() {
                    return {
                        name: '',
                        media_type: '',
                        rating_partials: []
                    }
                }
            },
            all_partials: {
                type: Array,
                default: []
            }
        },
        data() {
            return {
                name: this.profile.name,
                media_type: this.profile.media_type,
                rating_partials: this.profile.rating_partials,
                selectedPartials: this.profile.rating_partials.map(function (partial) {
                    return {
                        value: partial,
                        text: partial.name + ' - ' + partial.description,
                    };
                })
            }
        },
        methods: {
            save() {
                console.log('test');
                let url = '/profiles';
                if ('id' in this.profile) {
                    //we are in edit mode
                    url += '/' + this.profile.id;
                }

                axios.post(url, {
                    name: this.name,
                    media_type: this.media_type,
                    rating_partials: this.rating_partials.map(function (partial) {
                        return partial.id
                    }),
                }).then(res => {
                    if (res.data.success) {
                        window.location.href = '/profiles/' + res.data.id;
                    }
                });
            },
            onSelect(items, lastSelectItem) {
                this.rating_partials = items.map(function (item) {
                    return item.value;
                });
                this.selectedPartials = items;
                this.lastSelectItem = lastSelectItem.value
            },
            removePartial(id) {
                this.rating_partials = this.rating_partials.filter(o => {
                    return o.id !== id;
                })
                this.selectedPartials = this.selectedPartials.filter(o => {
                    return o.value.id !== id;
                })
            },
            // deselect option
            reset() {
                this.rating_partials = [] // reset
            },
        },
        computed: {
            searchablePartials: function () {
                return this.all_partials.map(function (partial) {
                    return {
                        value: partial,
                        text: partial.name + ' - ' + partial.description,
                    };
                })
            },
        },
        components: {
            MultiSelect
        }
    }
</script>
