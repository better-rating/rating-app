<template>
    <div>
        <div v-for="field in usable_fields">
            <span>{{ field.label }}</span> <input :type="field.type" v-model="rating_data[field.label]">
        </div>
    </div>
</template>

<script>
export default {
    props: {
        type: String,
        fields: Object
    },
    data() {
        return {
            rating_data: this.keysOnNull(this.fields)
        }
    },
    methods: {
        keysOnNull: (object) => {
            for (const [key, value] of Object.entries(object)) {
                object[key] = null;
            }
            return object;
        }
    },
    computed: {
        usable_fields: function () {
            let result = [];
            for (const [key, value] of Object.entries(this.fields)) {
                result.push({
                    label: key,
                    type: 'text'
                })
            }
            return result;
        }
    }
}
</script>
